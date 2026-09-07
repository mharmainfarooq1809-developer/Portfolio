<?php
require_once __DIR__ . '/../../includes/functions.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function requireAdmin(): void
{
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
}
function adminCsrf(): string
{
    if (empty($_SESSION['admin_csrf'])) $_SESSION['admin_csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['admin_csrf'];
}
function verifyAdminCsrf(): void
{
    if (!hash_equals($_SESSION['admin_csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419); exit('Invalid request token.');
    }
}
function startAdminSession(): void
{
    session_regenerate_id(true);
    $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
}
