<?php require_once __DIR__ . '/includes/auth.php'; requireAdmin(); 
$projects = getProjects(false); 
$pageTitle = 'Projects'; 
$activePage = 'projects'; 
require __DIR__ . '/includes/header.php'; 
?>

<!-- ===== TOOLBAR (unchanged) ===== -->
<div class="toolbar">
    <div>
        <h1><i class="fas fa-folder-open" style="color:var(--accent); margin-right:12px;"></i>Projects</h1>
        <div class="sub">Manage public project entries.</div>
    </div>
    <a class="button" href="project-add.php"><i class="fas fa-plus"></i> Add project</a>
</div>

<!-- ===== PROJECTS TABLE ===== -->
<section class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($project['title']) ?></strong></td>
                        <td>
                            <?php 
                            $tags = (array) $project['tags'];
                            if (!empty($tags)): 
                                foreach ($tags as $tag): ?>
                                    <span class="tag-pill"><?= htmlspecialchars($tag) ?></span>
                                <?php endforeach; 
                            else: ?>
                                <span class="no-tags">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="status-badge <?= !empty($project['is_active']) ? 'active' : 'inactive' ?>">
                                <?= !empty($project['is_active']) ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td class="actions-cell">
                            <a href="project-edit.php?id=<?= $project['id'] ?>" class="action-link" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="post" action="project-delete.php" style="display:inline;" 
                                  onsubmit="return confirm('Delete this project?')">
                                <input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="id" value="<?= (int) $project['id'] ?>">
                                <button type="submit" class="action-link delete-btn" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$projects): ?>
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="fas fa-folder-open" style="font-size:24px; opacity:0.4; display:block; margin-bottom:8px;"></i>
                            No projects yet. Click “Add project” to get started.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- ===== ADDITIONAL STYLES (complement the global theme) ===== -->
<style>
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

    /* ── Tags ──────────────────────────────────────────────────── */
    .tag-pill {
        display: inline-block;
        background: var(--surface2, #18233a);
        color: var(--muted, #94a9cf);
        padding: 2px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 500;
        margin: 2px 4px 2px 0;
        border: 1px solid var(--border, rgba(0,180,255,0.08));
    }
    .no-tags {
        color: var(--muted);
        opacity: 0.5;
    }

    /* ── Status badge (active / inactive) ────────────────────── */
    .status-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
        border: 1px solid transparent;
    }
    .status-badge.active {
        background: rgba(52,211,153,0.12);
        color: #34d399;
        border-color: rgba(52,211,153,0.15);
    }
    .status-badge.inactive {
        background: rgba(148,163,184,0.10);
        color: var(--muted);
        border-color: rgba(148,163,184,0.15);
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
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }
    .action-link:hover {
        color: var(--accent, #00d4ff);
        transform: scale(1.1);
    }
    .delete-btn:hover {
        color: #ff6b6b !important;
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
        table {
            font-size: 13px;
        }
        thead th, tbody td {
            padding: 10px 8px;
        }
        .actions-cell {
            gap: 8px;
        }
        .tag-pill {
            font-size: 11px;
            padding: 1px 10px;
        }
    }
</style>

<?php require __DIR__ . '/includes/footer.php'; ?>