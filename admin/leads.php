<?php require_once __DIR__ . '/includes/auth.php'; requireAdmin(); 
$status = $_GET['status'] ?? null; 
$leadsTableAvailable = hasPortfolioTable('leads');
$leads = getLeads($status); 
$pageTitle = 'Leads'; 
$activePage = 'leads'; 
require __DIR__ . '/includes/header.php'; 
?>

<!-- ===== TOOLBAR (unchanged) ===== -->
<div class="toolbar">
    <div>
        <h1>Leads</h1>
        <div class="sub">Contact submissions and pipeline status.</div>
    </div>
</div>

<!-- ===== FILTER BUTTONS – modernised ===== -->
<div class="filter-bar">
    <?php 
    $statuses = ['', 'new', 'contacted', 'discussion', 'proposal', 'client', 'completed', 'rejected'];
    foreach ($statuses as $s): 
        $active = ($status === $s) ? 'active' : '';
        $label = $s ? ucfirst($s) : 'All';
    ?>
        <a href="?status=<?= urlencode($s) ?>" 
           class="filter-btn <?= $active ?>" 
           data-status="<?= $s ?: 'all' ?>">
            <?= htmlspecialchars($label) ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- ===== LEADS TABLE – enhanced styling ===== -->
<section class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($lead['name']) ?></strong></td>
                        <td><?= htmlspecialchars($lead['email']) ?></td>
                        <td><?= htmlspecialchars($lead['project_type'] ?? '—') ?></td>
                        <td>
                            <span class="status-badge <?= strtolower(htmlspecialchars($lead['status'])) ?>">
                                <?= htmlspecialchars($lead['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($lead['created_at']) ?></td>
                        <td class="actions-cell">
                            <a href="lead-view.php?id=<?= $lead['id'] ?>" class="action-link" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="lead-edit.php?id=<?= $lead['id'] ?>" class="action-link" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$leads): ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-inbox" style="font-size:24px; opacity:0.4; display:block; margin-bottom:8px;"></i>
                            <?= $leadsTableAvailable ? ($status ? 'No leads match this status.' : 'No leads have been submitted yet.') : 'Lead storage is unavailable. Check the database connection and import the SQL migration.' ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- ===== ADDITIONAL STYLES (complement the global theme) ===== -->
<style>
    /* ── Filter bar ─────────────────────────────────────────────── */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 16px 0 24px;
        padding: 4px 0;
    }
    .filter-btn {
        background: var(--surface2, #18233a);
        color: var(--muted, #94a9cf);
        border: 1px solid var(--border, rgba(0,180,255,0.12));
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .filter-btn:hover {
        background: var(--surface-card, rgba(18,30,55,0.75));
        color: var(--text, #f0f4ff);
        border-color: var(--accent, #00d4ff);
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0,180,255,0.15);
    }
    .filter-btn.active {
        background: linear-gradient(135deg, var(--accent, #00d4ff), var(--accent2, #3b82f6));
        color: #fff;
        border-color: transparent;
        box-shadow: 0 4px 16px rgba(0,180,255,0.30);
    }
    .filter-btn.active:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,180,255,0.40);
    }

    /* ── Table enhancements ────────────────────────────────────── */
    .table-wrap {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    thead th {
        text-align: left;
        padding: 14px 12px;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--muted, #94a9cf);
        border-bottom: 2px solid var(--border, rgba(0,180,255,0.10));
    }
    tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid rgba(255,255,255,0.03);
        vertical-align: middle;
        color: var(--text, #f0f4ff);
    }
    tbody tr:hover td {
        background: rgba(0,180,255,0.03);
    }
    tbody tr:last-child td {
        border-bottom: none;
    }

    /* ── Status badges (matching global theme) ────────────────── */
    .status-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
        border: 1px solid transparent;
    }
    .status-badge.new {
        background: rgba(251,191,36,0.12);
        color: #fbbf24;
        border-color: rgba(251,191,36,0.15);
    }
    .status-badge.contacted {
        background: rgba(99,102,241,0.12);
        color: #818cf8;
        border-color: rgba(99,102,241,0.15);
    }
    .status-badge.discussion {
        background: rgba(0,212,255,0.12);
        color: #00d4ff;
        border-color: rgba(0,212,255,0.15);
    }
    .status-badge.proposal {
        background: rgba(139,92,246,0.12);
        color: #a78bfa;
        border-color: rgba(139,92,246,0.15);
    }
    .status-badge.client {
        background: rgba(52,211,153,0.12);
        color: #34d399;
        border-color: rgba(52,211,153,0.15);
    }
    .status-badge.completed {
        background: rgba(34,197,94,0.12);
        color: #22c55e;
        border-color: rgba(34,197,94,0.15);
    }
    .status-badge.rejected {
        background: rgba(248,113,113,0.12);
        color: #f87171;
        border-color: rgba(248,113,113,0.15);
    }

    /* ── Action icons ──────────────────────────────────────────── */
    .actions-cell {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .action-link {
        color: var(--muted, #94a9cf);
        text-decoration: none;
        transition: color 0.2s, transform 0.2s;
        font-size: 15px;
    }
    .action-link:hover {
        color: var(--accent, #00d4ff);
        transform: scale(1.1);
    }

    /* ── Empty state ───────────────────────────────────────────── */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--muted, #94a9cf);
        font-size: 15px;
        line-height: 1.6;
    }

    /* ── Responsive tweaks ────────────────────────────────────── */
    @media (max-width: 768px) {
        .filter-bar {
            gap: 6px;
        }
        .filter-btn {
            padding: 6px 14px;
            font-size: 12px;
        }
        table {
            font-size: 13px;
        }
        thead th, tbody td {
            padding: 10px 8px;
        }
        .actions-cell {
            gap: 8px;
        }
    }
</style>

<?php require __DIR__ . '/includes/footer.php'; ?>