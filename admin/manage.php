<?php
require_once __DIR__ . '/includes/auth.php'; requireAdmin();

$definitions = [
    'statistics' => [
        'table' => 'portfolio_stats',
        'title' => 'Statistics',
        'active' => 'statistics',
        'fields' => ['number_value', 'label', 'description', 'sort_order', 'is_active'],
        'icon' => 'fa-chart-line'
    ],
    'assistant' => [
        'table' => 'assistant_knowledge',
        'title' => 'Assistant knowledge',
        'active' => 'assistant',
        'fields' => ['question_pattern', 'answer', 'category', 'sort_order', 'is_suggested', 'is_active'],
        'icon' => 'fa-robot'
    ],
    'terminal' => [
        'table' => 'terminal_commands',
        'title' => 'Terminal commands',
        'active' => 'terminal',
        'fields' => ['command', 'description', 'output', 'category', 'sort_order', 'is_active'],
        'icon' => 'fa-terminal'
    ],
    'faq' => [
        'table' => 'faqs',
        'title' => 'FAQ',
        'active' => 'faq',
        'fields' => ['question', 'answer', 'sort_order', 'is_active'],
        'icon' => 'fa-circle-question'
    ]
];

$definition = $definitions[$section] ?? $definitions['faq'];
$table = $definition['table'];
$message = '';
$db = portfolioDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyAdminCsrf();
    if (!$db) {
        $message = 'Database unavailable. No changes were saved.';
    } else {
        $action = $_POST['action'] ?? '';
        $id = (int)($_POST['id'] ?? 0);
        if ($action === 'delete') {
            $stmt = $db->prepare('DELETE FROM `' . $table . '` WHERE id=?');
            $stmt->execute([$id]);
        } elseif ($action === 'save') {
            $fields = array_values(array_filter($definition['fields'], static fn($field) => $field !== 'is_active' && $field !== 'is_suggested'));
            $booleanFields = array_values(array_filter(['is_active', 'is_suggested'], static fn($field) => in_array($field, $definition['fields'], true)));
            $sets = [];
            $values = [];
            foreach ($fields as $field) {
                $sets[] = $field . '=?';
                $values[] = trim($_POST[$field] ?? '');
            }
            foreach ($booleanFields as $field) {
                $sets[] = $field . '=?';
                $values[] = isset($_POST[$field]) ? 1 : 0;
            }
            if ($id) {
                $values[] = $id;
                $sql = 'UPDATE `' . $table . '` SET ' . implode(', ', $sets) . ' WHERE id=?';
            } else {
                $sql = 'INSERT INTO `' . $table . '` (' . implode(',', array_merge($fields, $booleanFields)) . ') VALUES (' . implode(',', array_fill(0, count($fields) + count($booleanFields), '?')) . ')';
            }
            $db->prepare($sql)->execute($values);
        }
    }
}

$rows = adminRows($table);
$pageTitle = $definition['title'];
$activePage = $definition['active'];
require __DIR__ . '/includes/header.php';
?>

<!-- ===== TOOLBAR ===== -->
<div class="toolbar">
    <div>
        <h1><i class="fas <?= $definition['icon'] ?? 'fa-cog' ?>" style="color:var(--accent); margin-right:12px;"></i><?= htmlspecialchars($definition['title']) ?></h1>
        <div class="sub">Manage data used by the public portfolio.</div>
    </div>
</div>

<!-- ===== MESSAGE (if any) ===== -->
<?php if ($message): ?>
    <div class="notice"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<!-- ===== ADD NEW ENTRY FORM ===== -->
<section class="panel">
    <div class="panel-header">
        <h2><i class="fas fa-plus-circle" style="color:var(--accent);"></i> Add new entry</h2>
    </div>
    <form method="post" class="entry-form">
        <input type="hidden" name="csrf" value="<?= adminCsrf() ?>">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="0">

        <div class="form-grid">
            <?php foreach ($definition['fields'] as $field): ?>
                <?php if ($field === 'is_active' || $field === 'is_suggested'): ?>
                    <div class="field-group checkbox-group">
                        <label>
                            <input type="checkbox" name="<?= $field ?>" value="1" checked>
                            <span class="check-label"><?= ucfirst(str_replace('_', ' ', $field)) ?></span>
                        </label>
                    </div>
                <?php else: ?>
                    <div class="field-group <?= in_array($field, ['answer', 'output', 'description'], true) ? 'full-width' : '' ?>">
                        <label for="field_<?= $field ?>"><?= ucfirst(str_replace('_', ' ', $field)) ?></label>
                        <?php if (in_array($field, ['answer', 'output'], true)): ?>
                            <textarea name="<?= $field ?>" id="field_<?= $field ?>" placeholder="Enter <?= str_replace('_', ' ', $field) ?>…"></textarea>
                        <?php else: ?>
                            <input name="<?= $field ?>" id="field_<?= $field ?>" placeholder="Enter <?= str_replace('_', ' ', $field) ?>">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Save entry</button>
        </div>
    </form>
</section>

<!-- ===== EXISTING ENTRIES TABLE ===== -->
<section class="panel">
    <div class="panel-header">
        <h2><i class="fas fa-list" style="color:var(--accent);"></i> Existing entries</h2>
        <span class="entry-count"><?= count($rows) ?> entries</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <?php foreach ($definition['fields'] as $field): ?>
                        <th><?= htmlspecialchars($field) ?></th>
                    <?php endforeach; ?>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($definition['fields'] as $field): ?>
                            <td>
                                <?php if (in_array($field, ['is_active', 'is_suggested'])): ?>
                                    <span class="status-badge <?= !empty($row[$field]) ? 'active' : 'inactive' ?>">
                                        <?= !empty($row[$field]) ? 'Yes' : 'No' ?>
                                    </span>
                                <?php else: ?>
                                    <?= htmlspecialchars((string)($row[$field] ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td class="actions-cell">
                            <!-- Edit button (future) – for now just delete -->
                            <form method="post" style="display:inline;" onsubmit="return confirm('Delete this entry?')">
                                <input type="hidden" name="csrf" value="<?= adminCsrf() ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="action-link delete-btn" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$rows): ?>
                    <tr>
                        <td colspan="<?= count($definition['fields']) + 1 ?>" class="empty-state">
                            <i class="fas fa-database" style="font-size:24px; opacity:0.4; display:block; margin-bottom:8px;"></i>
                            No records yet. Import the migration first.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- ===== PAGE-SPECIFIC STYLES ===== -->
<style>
    /* ── Form grid ──────────────────────────────────────────────── */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 20px;
    }
    .field-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .field-group.full-width {
        grid-column: 1 / -1;
    }
    .field-group label {
        font-size: 13px;
        font-weight: 500;
        color: var(--muted);
    }
    .field-group input,
    .field-group textarea {
        width: 100%;
        padding: 10px 14px;
        background: var(--surface2);
        color: var(--text);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font: inherit;
        transition: border 0.2s, box-shadow 0.2s;
    }
    .field-group input:focus,
    .field-group textarea:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(0,180,255,0.10);
    }
    .field-group textarea {
        min-height: 80px;
        resize: vertical;
    }

    /* ── Checkbox group ─────────────────────────────────────────── */
    .checkbox-group {
        grid-column: 1 / -1;
        display: flex;
        gap: 20px;
        align-items: center;
        padding-top: 4px;
    }
    .checkbox-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        cursor: pointer;
        color: var(--text);
    }
    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
        cursor: pointer;
    }
    .check-label {
        font-size: 14px;
    }

    /* ── Form actions ───────────────────────────────────────────── */
    .form-actions {
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: flex-end;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        color: #fff;
        border: none;
        padding: 10px 28px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(0,180,255,0.25);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(0,180,255,0.35);
    }

    /* ── Entry count badge ──────────────────────────────────────── */
    .entry-count {
        font-size: 13px;
        color: var(--muted);
        background: var(--surface2);
        padding: 4px 14px;
        border-radius: 30px;
        border: 1px solid var(--border);
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
        color: var(--muted);
        border-bottom: 2px solid var(--border);
    }
    tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid rgba(255,255,255,0.03);
        vertical-align: middle;
        color: var(--text);
    }
    tbody tr:hover td {
        background: rgba(0,180,255,0.03);
    }
    tbody tr:last-child td {
        border-bottom: none;
    }

    /* ── Status badges ──────────────────────────────────────────── */
    .status-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid transparent;
        text-transform: capitalize;
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

    /* ── Actions ────────────────────────────────────────────────── */
    .actions-col {
        text-align: center;
        width: 80px;
    }
    .actions-cell {
        display: flex;
        justify-content: center;
        gap: 12px;
        align-items: center;
    }
    .action-link {
        color: var(--muted);
        text-decoration: none;
        transition: color 0.2s, transform 0.2s;
        font-size: 15px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }
    .action-link:hover {
        color: var(--accent);
        transform: scale(1.1);
    }
    .delete-btn:hover {
        color: #ff6b6b !important;
    }

    /* ── Empty state ───────────────────────────────────────────── */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.6;
    }

    /* ── Responsive ────────────────────────────────────────────── */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .checkbox-group {
            flex-wrap: wrap;
            gap: 12px;
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
        .entry-count {
            font-size: 12px;
            padding: 2px 10px;
        }
    }
</style>

<?php require __DIR__ . '/includes/footer.php'; ?>