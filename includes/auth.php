<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function loginUser($username, $password)
{
    $configuredUsername = getenv('PORTFOLIO_ADMIN_USERNAME') ?: 'admin';
    $passwordHash = getenv('PORTFOLIO_ADMIN_PASSWORD_HASH') ?: '';
    if ($passwordHash !== '' && hash_equals($configuredUsername, $username) && password_verify($password, $passwordHash)) {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function logout()
{
    session_destroy();
    header('Location: login.php');
    exit;
}
