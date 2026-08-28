<?php

declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/csrf.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}
$data = json_decode((string) file_get_contents('php://input'), true);
if (!is_array($data) || !verifyCsrfToken((string) ($data['csrf_token'] ?? ''))) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Your session has expired.']);
    exit;
}
unset($_SESSION['ai_history'], $_SESSION['ai_rate']);
echo json_encode(['success' => true]);
