<?php

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success' => false, 'message' => 'POST required.']); exit; }
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? 'General inquiry');
$message = trim($_POST['message'] ?? '');
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $name === '' || $message === '') { http_response_code(422); echo json_encode(['success' => false, 'message' => 'Name, valid email, and message are required.']); exit; }
$details = [];
foreach (['phone', 'company', 'project_type', 'budget', 'preferred_contact', 'deadline', 'admin_notes'] as $field) {
	$details[$field] = trim((string) ($_POST[$field] ?? ''));
}
if ($details['deadline'] !== '') {
	$deadline = DateTime::createFromFormat('!Y-m-d', $details['deadline']);
	if (!$deadline || $deadline->format('Y-m-d') !== $details['deadline']) {
		http_response_code(422);
		echo json_encode(['success' => false, 'message' => 'Please provide a valid deadline.']);
		exit;
	}
}
$saved = saveMessage($name, $email, $subject, $message, $details);
if (!$saved) { http_response_code(503); echo json_encode(['success' => false, 'message' => 'Unable to save your inquiry right now.']); exit; }
echo json_encode(['success' => true, 'message' => 'Thanks. Your inquiry has been received.']);