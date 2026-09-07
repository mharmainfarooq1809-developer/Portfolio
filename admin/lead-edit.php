<?php
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$id = (int) ($_GET['id'] ?? 0);
$lead = getLead($id);
if (!$lead) exit('Lead not found.');

$allowedStatuses = ['new', 'contacted', 'discussion', 'proposal', 'client', 'completed', 'rejected'];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	verifyAdminCsrf();
	$data = $lead;
	foreach (['name', 'email', 'phone', 'company', 'project_type', 'budget', 'preferred_contact', 'deadline', 'message', 'status', 'admin_notes'] as $field) {
		$data[$field] = trim((string) ($_POST[$field] ?? ''));
	}
	$deadline = $data['deadline'];
	$validDate = $deadline === '' || (DateTime::createFromFormat('!Y-m-d', $deadline) && DateTime::createFromFormat('!Y-m-d', $deadline)->format('Y-m-d') === $deadline);
	if ($data['name'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || $data['message'] === '') $error = 'Name, valid email, and message are required.';
	elseif (!in_array($data['status'], $allowedStatuses, true)) $error = 'Invalid lead status.';
	elseif (!$validDate) $error = 'Deadline must use the YYYY-MM-DD format.';
	elseif (!saveLead($id, $data)) $error = 'Unable to save the lead. Check the database connection.';
	else { header('Location: lead-view.php?id=' . $id); exit; }
	$lead = array_merge($lead, $data);
}

$pageTitle = 'Edit Lead'; $activePage = 'leads'; require __DIR__ . '/includes/header.php';
?>
<h1>Edit lead</h1>
<?php if ($error): ?><div class="notice"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
<form method="post" class="panel"><input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>"><div class="grid">
<?php foreach (['name','email','phone','company','project_type','budget','preferred_contact','deadline'] as $field): ?><div class="field"><label><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $field)), ENT_QUOTES, 'UTF-8') ?></label><input name="<?= $field ?>" value="<?= htmlspecialchars((string) ($lead[$field] ?? ''), ENT_QUOTES, 'UTF-8') ?>" <?= $field === 'email' ? 'type="email"' : ($field === 'deadline' ? 'type="date"' : '') ?>></div><?php endforeach; ?>
<div class="field"><label>Status</label><select name="status"><?php foreach ($allowedStatuses as $status): ?><option value="<?= $status ?>" <?= ($lead['status'] ?? '') === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option><?php endforeach; ?></select></div>
<div class="field full"><label>Message</label><textarea name="message" required><?= htmlspecialchars($lead['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea></div><div class="field full"><label>Admin notes</label><textarea name="admin_notes"><?= htmlspecialchars($lead['admin_notes'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea></div></div><button>Save changes</button></form>
<?php require __DIR__ . '/includes/footer.php'; ?>
