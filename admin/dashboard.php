<?php
require_once __DIR__ . '/includes/auth.php';
requireAdmin();
$pageTitle = 'Dashboard';
$activePage = 'dashboard';
$leads = getLeads();
$projects = countProjects();
$totalLeads = countLeadsByStatus();
$statusOrder = ['new', 'contacted', 'discussion', 'proposal', 'client', 'completed', 'rejected'];
$statusLabels = [
	'new' => 'New',
	'contacted' => 'Contacted',
	'discussion' => 'Discussion',
	'proposal' => 'Proposal',
	'client' => 'Client',
	'completed' => 'Completed',
	'rejected' => 'Rejected',
];
$statusCounts = array_fill_keys($statusOrder, 0);
$lastThirtyDays = array_fill(0, 30, 0);

foreach ($leads as $lead) {
	$status = strtolower((string) ($lead['status'] ?? 'new'));
	if (isset($statusCounts[$status])) $statusCounts[$status]++;
	$createdAt = strtotime((string) ($lead['created_at'] ?? ''));
	$daysAgo = $createdAt ? (int) floor((time() - $createdAt) / 86400) : 30;
	if ($daysAgo >= 0 && $daysAgo < 30) $lastThirtyDays[29 - $daysAgo]++;
}

$recentLeads = array_slice($leads, 0, 8);
$newLeads = $statusCounts['new'];
$clients = $statusCounts['client'];
$chartLabels = [];
for ($day = 29; $day >= 0; $day--) $chartLabels[] = date('M j', strtotime('-' . $day . ' days'));

require __DIR__ . '/includes/header.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
	.dashboard-page { --dash-bg: #07111b; --dash-surface: #0d1b28; --dash-surface-2: #122637; --dash-border: #203b4c; --dash-text: #eef9f5; --dash-muted: #8ba8ac; --dash-cyan: #5fe0c0; --dash-blue: #71a9ff; width:100%; min-width:0; overflow:hidden; font-family: 'DM Sans', sans-serif; }
	.dashboard-page * { box-sizing: border-box; }
	.dashboard-page .dash-topbar { display:flex; justify-content:space-between; align-items:flex-end; gap:20px; margin-bottom:28px; min-width:0; }
	.dashboard-page .dash-topbar > div:first-child { min-width:0; }
	.dashboard-page h1, .dashboard-page h2, .dashboard-page h3 { font-family:'Space Grotesk', sans-serif; color:var(--dash-text); }
	.dashboard-page h1 { margin:0; max-width:100%; overflow-wrap:anywhere; font-size:clamp(28px, 4vw, 42px); letter-spacing:-1px; }
	.dashboard-page .dash-eyebrow { color:var(--dash-cyan); font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:8px; }
	.dashboard-page .dash-sub { color:var(--dash-muted); margin:7px 0 0; }
	.dashboard-page .dash-date { color:var(--dash-muted); font-size:13px; padding:9px 12px; border:1px solid var(--dash-border); border-radius:7px; white-space:nowrap; }
	.dashboard-page .dash-date i { color:var(--dash-cyan); margin-right:7px; }
	.dashboard-page .stats-grid { display:grid; grid-template-columns:repeat(4, minmax(0, 1fr)); gap:14px; margin-bottom:22px; }
	.dashboard-page .stat-card, .dashboard-page .chart-card, .dashboard-page .leads-panel { background:linear-gradient(145deg, rgba(18,38,55,.95), rgba(9,23,35,.98)); border:1px solid var(--dash-border); border-radius:10px; box-shadow:0 12px 28px rgba(0,0,0,.18); }
	.dashboard-page .stat-card { padding:18px; position:relative; overflow:hidden; }
	.dashboard-page .stat-card::after { content:''; position:absolute; top:0; left:0; width:42px; height:3px; background:var(--dash-cyan); }
	.dashboard-page .stat-card:nth-child(2)::after { background:var(--dash-blue); }
	.dashboard-page .stat-card:nth-child(3)::after { background:#f6c85f; }
	.dashboard-page .stat-card:nth-child(4)::after { background:#d38cff; }
	.dashboard-page .stat-icon { color:var(--dash-cyan); font-size:18px; margin-bottom:16px; }
	.dashboard-page .stat-card:nth-child(2) .stat-icon { color:var(--dash-blue); }
	.dashboard-page .stat-card:nth-child(3) .stat-icon { color:#f6c85f; }
	.dashboard-page .stat-card:nth-child(4) .stat-icon { color:#d38cff; }
	.dashboard-page .stat-value { display:block; color:var(--dash-text); font:700 30px 'Space Grotesk', sans-serif; line-height:1; }
	.dashboard-page .stat-label { display:block; color:var(--dash-muted); font-size:13px; margin-top:8px; }
	.dashboard-page .charts-grid { display:grid; grid-template-columns:minmax(0, 1.65fr) minmax(220px, 1fr); gap:18px; margin-bottom:22px; min-width:0; }
	.dashboard-page .chart-card { padding:18px; min-width:0; }
	.dashboard-page .chart-head, .dashboard-page .panel-head { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:16px; }
	.dashboard-page .chart-head h2, .dashboard-page .panel-head h2 { margin:0; font-size:17px; }
	.dashboard-page .chart-head span { color:var(--dash-muted); font-size:12px; }
	.dashboard-page .chart-wrap { height:245px; position:relative; }
	.dashboard-page .leads-panel { padding:18px; overflow:hidden; }
	.dashboard-page .panel-head { margin-bottom:10px; }
	.dashboard-page .panel-head a { color:var(--dash-cyan); text-decoration:none; font-size:13px; font-weight:600; }
	.dashboard-page .table-wrap { overflow-x:auto; }
	.dashboard-page table { min-width:620px; }
	.dashboard-page th { color:var(--dash-muted); font-size:11px; letter-spacing:.8px; }
	.dashboard-page td { color:#d8e9e5; }
	.dashboard-page td a { color:var(--dash-cyan); font-weight:600; text-decoration:none; }
	.dashboard-page td a:hover { text-decoration:underline; }
	.dashboard-page .status-badge { display:inline-block; border:1px solid var(--dash-border); border-radius:20px; padding:4px 9px; color:var(--dash-cyan); font-size:11px; text-transform:capitalize; }
	.dashboard-page .status-badge.client, .dashboard-page .status-badge.completed { color:#69dda0; border-color:rgba(105,221,160,.3); }
	.dashboard-page .status-badge.rejected { color:#ff9999; border-color:rgba(255,153,153,.3); }
	.dashboard-page .empty-state { color:var(--dash-muted); text-align:center; padding:26px; }
	@media (max-width: 1100px) { .dashboard-page .stats-grid { grid-template-columns:repeat(2, minmax(0, 1fr)); } .dashboard-page .charts-grid { grid-template-columns:1fr; } }
	@media (max-width: 560px) { .dashboard-page .dash-topbar { align-items:flex-start; flex-direction:column; } .dashboard-page .stats-grid { grid-template-columns:1fr; } .dashboard-page .chart-wrap { height:210px; } }
</style>

<div class="dashboard-page">
	<div class="dash-topbar">
		<div>
			<div class="dash-eyebrow">Command center</div>
			<h1>Good to see you, <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin', ENT_QUOTES, 'UTF-8') ?>.</h1>
			<p class="dash-sub">A clear view of your portfolio and client pipeline.</p>
		</div>
		<div class="dash-date"><i class="far fa-calendar"></i><?= htmlspecialchars(date('D, M j, Y'), ENT_QUOTES, 'UTF-8') ?></div>
	</div>

	<section class="stats-grid" aria-label="Portfolio overview">
		<div class="stat-card"><div class="stat-icon"><i class="fas fa-layer-group"></i></div><span class="stat-value"><?= $projects ?></span><span class="stat-label">Total projects</span></div>
		<div class="stat-card"><div class="stat-icon"><i class="fas fa-inbox"></i></div><span class="stat-value"><?= $totalLeads ?></span><span class="stat-label">Total leads</span></div>
		<div class="stat-card"><div class="stat-icon"><i class="fas fa-bolt"></i></div><span class="stat-value"><?= $newLeads ?></span><span class="stat-label">New leads</span></div>
		<div class="stat-card"><div class="stat-icon"><i class="fas fa-handshake"></i></div><span class="stat-value"><?= $clients ?></span><span class="stat-label">Clients</span></div>
	</section>

	<section class="charts-grid">
		<div class="chart-card"><div class="chart-head"><h2>Lead activity</h2><span>Last 30 days</span></div><div class="chart-wrap"><canvas id="leadActivityChart"></canvas></div></div>
		<div class="chart-card"><div class="chart-head"><h2>Pipeline distribution</h2><span>All leads</span></div><div class="chart-wrap"><canvas id="leadDistributionChart"></canvas></div></div>
	</section>

	<section class="leads-panel">
		<div class="panel-head"><h2>Recent leads</h2><a href="leads.php">View all <i class="fas fa-arrow-right"></i></a></div>
		<div class="table-wrap"><table><thead><tr><th>Name</th><th>Email</th><th>Status</th><th>Received</th></tr></thead><tbody>
		<?php foreach ($recentLeads as $lead): ?>
			<?php $leadStatus = strtolower((string) ($lead['status'] ?? 'new')); ?>
			<tr><td><a href="lead-view.php?id=<?= (int) $lead['id'] ?>"><?= htmlspecialchars($lead['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></a></td><td><?= htmlspecialchars($lead['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></td><td><span class="status-badge <?= htmlspecialchars($leadStatus, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($leadStatus, ENT_QUOTES, 'UTF-8') ?></span></td><td><?= htmlspecialchars($lead['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
		<?php endforeach; ?>
		<?php if (!$recentLeads): ?><tr><td class="empty-state" colspan="4">No leads yet.</td></tr><?php endif; ?>
		</tbody></table></div>
	</section>
</div>

<script>
(() => {
	const chartFont = { family: 'DM Sans', size: 11 };
	const gridColor = 'rgba(139, 168, 172, .12)';
	const textColor = '#8ba8ac';
	const tooltip = { backgroundColor: '#07111b', borderColor: '#2c5362', borderWidth: 1, titleColor: '#eef9f5', bodyColor: '#c7dcd8', padding: 10 };
	const labels = <?= json_encode($chartLabels, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
	const activity = <?= json_encode($lastThirtyDays) ?>;
	const statusLabels = <?= json_encode(array_values($statusLabels), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
	const statusCounts = <?= json_encode(array_values($statusCounts)) ?>;

	new Chart(document.getElementById('leadActivityChart'), {
		type: 'line', data: { labels, datasets: [{ data: activity, borderColor: '#5fe0c0', backgroundColor: 'rgba(95,224,192,.12)', fill: true, tension: .35, pointRadius: 2, pointBackgroundColor: '#5fe0c0' }] },
		options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{display:false}, tooltip }, scales:{ x:{ grid:{display:false}, ticks:{color:textColor,font:chartFont,maxTicksLimit:6} }, y:{ beginAtZero:true, grid:{color:gridColor}, ticks:{color:textColor,font:chartFont,precision:0} } } }
	});
	new Chart(document.getElementById('leadDistributionChart'), {
		type: 'doughnut', data: { labels: statusLabels, datasets: [{ data: statusCounts, backgroundColor:['#f6c85f','#71a9ff','#9b8cff','#d38cff','#69dda0','#5fe0c0','#ff9999'], borderColor:'#0d1b28', borderWidth:3, hoverOffset:5 }] },
		options: { responsive:true, maintainAspectRatio:false, cutout:'68%', plugins:{ legend:{ position:'bottom', labels:{color:textColor,font:chartFont,padding:10,usePointStyle:true,boxWidth:8} }, tooltip } }
	});
})();
</script>
<?php require __DIR__ . '/includes/footer.php'; ?>
