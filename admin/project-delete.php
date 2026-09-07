<?php
require_once __DIR__ . '/includes/auth.php';
requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: projects.php'); exit; }
verifyAdminCsrf();
$id = (int) ($_POST['id'] ?? 0);
$db = portfolioDb();
if ($id && $db && hasPortfolioTable('projects')) $db->prepare('DELETE FROM projects WHERE id=?')->execute([$id]);
header('Location: projects.php');
exit;
