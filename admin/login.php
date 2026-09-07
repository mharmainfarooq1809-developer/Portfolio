<?php
require_once __DIR__ . '/includes/auth.php';
if (!empty($_SESSION['admin_logged_in'])) { header('Location: dashboard.php'); exit; }
$error = '';
$isLocalRequest = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyAdminCsrf();
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    if (isAdminEmail($email) && ADMIN_PASSWORD_HASH !== '' && password_verify($password, ADMIN_PASSWORD_HASH)) {
        startAdminSession();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_name'] = $email;
        header('Location: dashboard.php'); exit;
    }
    $error = 'Invalid admin credentials. Configure PORTFOLIO_ADMIN_PASSWORD_HASH or use Google OAuth.';
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Login</title><style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#07110d;color:#f2fff7;font:15px system-ui}.box{width:min(390px,calc(100% - 40px));background:#0d1b15;border:1px solid #244235;border-radius:12px;padding:30px}h1{margin-top:0}p{color:#9ab3a4}label{display:block;color:#9ab3a4;margin:16px 0 6px}input{width:100%;box-sizing:border-box;padding:11px;background:#12251c;border:1px solid #244235;border-radius:6px;color:white}button{margin-top:18px;width:100%;padding:11px;border:0;border-radius:6px;background:#77e6a2;font-weight:700}.oauth{display:block;text-align:center;margin-top:16px;color:#77e6a2}.setup{display:block;text-align:center;margin-top:12px;color:#9ab3a4;font-size:13px}</style></head><body><div class="box"><h1>Admin access</h1><p>Sign in with your authorized admin credentials.</p><?php if ($error): ?><p style="color:#ff9b9b"><?= htmlspecialchars($error) ?></p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>"><label>Email</label><input type="email" name="email" required autofocus><label>Password</label><input type="password" name="password" required><button>Sign in</button></form><?php if (GOOGLE_CLIENT_ID && GOOGLE_CLIENT_SECRET): ?><a class="oauth" href="google-callback.php">Continue with Google</a><?php endif; ?><?php if ($isLocalRequest && ADMIN_PASSWORD_HASH === ''): ?><a class="setup" href="setup-password.php">Set a new local password</a><?php endif; ?></div></body></html>
