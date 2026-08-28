<?php

declare(strict_types=1);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
header('Content-Type: application/json; charset=utf-8');

function githubResponse(array $data, int $status = 200): never
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_SLASHES);
    exit;
}
function githubFail(string $message, string $code, int $status, ?string $detail = null): never
{
    if ($detail) {
        error_log('[github-api] ' . $detail);
    } githubResponse(['success' => false, 'message' => $message, 'code' => $code], $status);
}
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    githubFail('This endpoint only accepts GET requests.', 'invalid_method', 405);
}
$username = trim((string) ($_GET['username'] ?? ''));
if (!preg_match('/^[A-Za-z0-9](?:[A-Za-z0-9-]{0,37}[A-Za-z0-9])?$/', $username)) {
    githubFail("That doesn't look like a valid GitHub username.", 'invalid_username', 400);
}
if (!function_exists('curl_init')) {
    githubFail('GitHub data is temporarily unavailable. Please try again shortly.', 'unavailable', 503, 'cURL extension is unavailable');
}

function githubRequest(string $path): array
{
    $headers = ['User-Agent: portfolio-github-proxy', 'Accept: application/vnd.github+json', 'X-GitHub-Api-Version: 2022-11-28'];
    $token = getenv('GITHUB_TOKEN');
    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }
    $curl = curl_init('https://api.github.com' . $path);
    curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => $headers, CURLOPT_TIMEOUT => 6, CURLOPT_CONNECTTIMEOUT => 6, CURLOPT_SSL_VERIFYPEER => true]);
    $body = curl_exec($curl);
    $error = curl_error($curl);
    $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return ['status' => $status, 'data' => is_string($body) ? json_decode($body, true) : null, 'error' => $error];
}
$profileResult = githubRequest('/users/' . rawurlencode($username));
if ($profileResult['status'] === 404) {
    githubFail('GitHub user not found. Check the username and try again.', 'not_found', 404);
}
if ($profileResult['status'] === 403) {
    githubFail("GitHub's public API rate limit has been reached. Try again later.", 'rate_limited', 429);
}
if ($profileResult['status'] !== 200 || !is_array($profileResult['data'])) {
    githubFail('GitHub data is temporarily unavailable. Please try again shortly.', 'unavailable', 502, $profileResult['error'] ?: 'profile status ' . $profileResult['status']);
}
$p = $profileResult['data'];
$reposResult = githubRequest('/users/' . rawurlencode($username) . '/repos?sort=updated&direction=desc&per_page=8&type=owner');
$repos = [];
$languages = [];
if ($reposResult['status'] === 200 && is_array($reposResult['data'])) {
    foreach ($reposResult['data'] as $repo) {
        if (!empty($repo['fork']) || !empty($repo['private'])) {
            continue;
        } $language = $repo['language'] ?? null;
        if ($language) {
            $languages[$language] = true;
        } $repos[] = ['name' => (string) ($repo['name'] ?? ''), 'description' => $repo['description'] ?? null, 'html_url' => $repo['html_url'] ?? null, 'language' => $language, 'stargazers_count' => (int) ($repo['stargazers_count'] ?? 0), 'forks_count' => (int) ($repo['forks_count'] ?? 0), 'updated_at' => $repo['updated_at'] ?? null];
    }
}
githubResponse(['success' => true, 'profile' => ['login' => $p['login'] ?? $username, 'name' => $p['name'] ?? null, 'bio' => $p['bio'] ?? null, 'avatar_url' => $p['avatar_url'] ?? null, 'html_url' => $p['html_url'] ?? 'https://github.com/' . rawurlencode($username), 'public_repos' => (int) ($p['public_repos'] ?? 0), 'followers' => (int) ($p['followers'] ?? 0), 'following' => (int) ($p['following'] ?? 0)], 'repos' => $repos, 'language_count' => count($languages), 'has_more' => (int) ($p['public_repos'] ?? 0) > count($repos)]);
