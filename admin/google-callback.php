<?php
require_once __DIR__ . '/includes/auth.php';
if (!GOOGLE_CLIENT_ID || !GOOGLE_CLIENT_SECRET) { header('Location: login.php'); exit; }
if (!isset($_GET['code'])) {
	$state = bin2hex(random_bytes(32));
	$_SESSION['google_oauth_state'] = $state;
	header('Location: https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query(['client_id'=>GOOGLE_CLIENT_ID,'redirect_uri'=>GOOGLE_REDIRECT_URI,'response_type'=>'code','scope'=>'openid email profile','state'=>$state])); exit;
}
if (empty($_GET['state']) || empty($_SESSION['google_oauth_state']) || !hash_equals($_SESSION['google_oauth_state'], (string) $_GET['state'])) { http_response_code(400); exit('Invalid OAuth state.'); }
unset($_SESSION['google_oauth_state']);
$ch = curl_init('https://oauth2.googleapis.com/token');
curl_setopt_array($ch, [
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => http_build_query([
		'code' => $_GET['code'],
		'client_id' => GOOGLE_CLIENT_ID,
		'client_secret' => GOOGLE_CLIENT_SECRET,
		'redirect_uri' => GOOGLE_REDIRECT_URI,
		'grant_type' => 'authorization_code',
	]),
	CURLOPT_RETURNTRANSFER => true,
]);
$token = json_decode(curl_exec($ch), true);
curl_close($ch);
if (empty($token['access_token'])) exit('OAuth token exchange failed.');
$ch=curl_init('https://openidconnect.googleapis.com/v1/userinfo'); curl_setopt_array($ch,[CURLOPT_HTTPHEADER=>['Authorization: Bearer '.$token['access_token']],CURLOPT_RETURNTRANSFER=>true]); $user=json_decode(curl_exec($ch),true); curl_close($ch);
if (empty($user['email']) || !isAdminEmail($user['email'])) exit('Access denied.');
startAdminSession();
$_SESSION['admin_logged_in']=true; $_SESSION['admin_email']=$user['email']; $_SESSION['admin_name']=$user['name'] ?? $user['email']; header('Location: dashboard.php'); exit;
