<?php
require_once __DIR__ . '/includes/auth.php';

$isLocalRequest = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true);
if (!$isLocalRequest || ADMIN_PASSWORD_HASH !== '') {
    http_response_code(404);
    exit('Not found.');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyAdminCsrf();
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $confirmation = (string) ($_POST['password_confirmation'] ?? '');
    if (!isAdminEmail($email)) $error = 'This email is not authorized.';
    elseif (strlen($password) < 12) $error = 'Password must be at least 12 characters.';
    elseif ($password !== $confirmation) $error = 'Passwords do not match.';
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $contents = "<?php\nreturn " . var_export($hash, true) . ";\n";
        if (file_put_contents(ADMIN_PASSWORD_FILE, $contents, LOCK_EX) === false) $error = 'Unable to save the local password file.';
        else { header('Location: login.php'); exit; }
    }
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Set admin password</title><style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#07110d;color:#f2fff7;font:15px system-ui}.box{width:min(390px,calc(100% - 40px));background:#0d1b15;border:1px solid #244235;border-radius:12px;padding:30px}h1{margin-top:0}p{color:#9ab3a4}label{display:block;color:#9ab3a4;margin:16px 0 6px}input{width:100%;box-sizing:border-box;padding:11px;background:#12251c;border:1px solid #244235;border-radius:6px;color:white}button{margin-top:18px;width:100%;padding:11px;border:0;border-radius:6px;background:#77e6a2;font-weight:700}</style></head><body><div class="box"><h1>Set admin password</h1><p>This one-time setup works only on this computer. Choose a password of at least 12 characters.</p><?php if ($error): ?><p style="color:#ff9b9b"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>"><label>Authorized email</label><input type="email" name="email" required autofocus><label>New password</label><input type="password" name="password" minlength="12" required><label>Confirm password</label><input type="password" name="password_confirmation" minlength="12" required><button>Save password</button></form></div></body></html>
