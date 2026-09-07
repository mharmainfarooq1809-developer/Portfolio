<?php

// App configuration
define('SITE_NAME', 'Muhammad Harmain Portfolio');
// Set PORTFOLIO_SITE_URL in production to the public HTTPS origin, including
// the application path when the portfolio is hosted in a subdirectory.
define('SITE_URL', rtrim(getenv('PORTFOLIO_SITE_URL') ?: 'http://localhost/portfolio/', '/') . '/');
define('ADMIN_EMAIL', 'hello@muhammadharmain.dev');

// MySQL is used when available; the public site falls back to portfolio_data.php
// until the migration has been imported and the database is reachable.
define('DB_HOST', getenv('PORTFOLIO_DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('PORTFOLIO_DB_PORT') ?: '3306');
define('DB_NAME', getenv('PORTFOLIO_DB_NAME') ?: 'portfolio');
define('DB_USER', getenv('PORTFOLIO_DB_USER') ?: 'root');
define('DB_PASS', getenv('PORTFOLIO_DB_PASS') ?: '');
define('GOOGLE_CLIENT_ID', getenv('GOOGLE_CLIENT_ID') ?: '');
define('GOOGLE_CLIENT_SECRET', getenv('GOOGLE_CLIENT_SECRET') ?: '');
define('GOOGLE_REDIRECT_URI', getenv('GOOGLE_REDIRECT_URI') ?: SITE_URL . 'admin/google-callback.php');
define('AUTHORIZED_ADMIN_EMAIL', getenv('AUTHORIZED_ADMIN_EMAIL') ?: '');
define('ADMIN_PASSWORD_FILE', __DIR__ . '/admin_password.local.php');
$localAdminPasswordHash = '';
if (is_file(ADMIN_PASSWORD_FILE)) {
	$localAdminPasswordHash = (string) include ADMIN_PASSWORD_FILE;
}
define('ADMIN_PASSWORD_HASH', getenv('PORTFOLIO_ADMIN_PASSWORD_HASH') ?: $localAdminPasswordHash);
define('APP_ENV', getenv('APP_ENV') ?: 'production');

// Set timezone
date_default_timezone_set('Asia/Karachi');

error_reporting(E_ALL);
ini_set('display_errors', APP_ENV === 'local' ? '1' : '0');
