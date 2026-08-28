<?php

declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('log_errors', '1');
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/csrf.php';

function assistantRespond(array $payload, int $status = 200): never
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    assistantRespond(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$raw = file_get_contents('php://input');
$data = is_string($raw) ? json_decode($raw, true) : null;
if (!is_array($data) || !is_string($data['message'] ?? null)) {
    assistantRespond(['success' => false, 'message' => 'A valid message is required.'], 400);
}
if (!verifyCsrfToken((string) ($data['csrf_token'] ?? ''))) {
    assistantRespond(['success' => false, 'message' => 'Your session has expired. Please refresh and try again.'], 403);
}

$message = trim($data['message']);
if ($message === '' || mb_strlen($message) > 800) {
    assistantRespond(['success' => false, 'message' => 'Please send a question between 1 and 800 characters.'], 422);
}

$now = time();
$_SESSION['ai_rate'] = array_values(array_filter($_SESSION['ai_rate'] ?? [], static fn ($time): bool => is_int($time) && $time > $now - 10));
if (count($_SESSION['ai_rate']) >= 5) {
    assistantRespond(['success' => false, 'message' => 'Please wait a moment before sending another message.'], 429);
}
$_SESSION['ai_rate'][] = $now;

try {
    require_once __DIR__ . '/../includes/functions.php';
    require_once __DIR__ . '/../includes/assistant/LocalKnowledgeProvider.php';
    $provider = new LocalKnowledgeProvider();
    $answer = $provider->answer($message, $_SESSION['ai_history'] ?? []);
    $_SESSION['ai_history'][] = ['role' => 'user', 'content' => $message, 'entity' => $answer['entity']];
    $_SESSION['ai_history'][] = ['role' => 'assistant', 'content' => $answer['message'], 'entity' => $answer['entity']];
    $_SESSION['ai_history'] = array_slice($_SESSION['ai_history'], -8);
    $payload = ['success' => true, 'message' => $answer['message'], 'intent' => $answer['intent'], 'sources' => $answer['sources'], 'provider' => 'local'];
    if ($answer['intent'] === 'resume') {
        $payload['resume_url'] = 'Muhammad_Harmain_NovExa_Executive_CV.pdf';
        $payload['resume_name'] = 'Harmain_Resume.pdf';
    }
    assistantRespond($payload);
} catch (Throwable $exception) {
    error_log('[portfolio-assistant] ' . $exception->getMessage());
    assistantRespond(['success' => false, 'message' => 'The assistant is temporarily unavailable. Please try again shortly.'], 503);
}
