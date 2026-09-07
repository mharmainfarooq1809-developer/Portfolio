<?php
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$keys = ['site_title', 'site_description', 'contact_email', 'admin_emails'];
$message = '';
$resumeDir = __DIR__ . '/../uploads/resume/';
if (!is_dir($resumeDir)) mkdir($resumeDir, 0755, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyAdminCsrf();
    $db = portfolioDb();
    if (!$db) {
        $message = 'Database unavailable. No changes were saved.';
    } else {
        foreach ($keys as $key) {
            $db->prepare('INSERT INTO settings(setting_key,setting_value) VALUES(?,?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)')->execute([$key, trim($_POST[$key] ?? '')]);
        }

        if (isset($_FILES['resume']) && $_FILES['resume']['error'] !== UPLOAD_ERR_NO_FILE) {
            $resume = $_FILES['resume'];
            $mime = $resume['error'] === UPLOAD_ERR_OK ? (new finfo(FILEINFO_MIME_TYPE))->file($resume['tmp_name']) : '';
            if ($resume['error'] !== UPLOAD_ERR_OK) $message = 'Resume upload failed.';
            elseif ($resume['size'] > 5 * 1024 * 1024) $message = 'Resume is too large. Maximum size is 5MB.';
            elseif ($mime !== 'application/pdf') $message = 'Resume must be a PDF file.';
            else {
                $filename = 'resume_' . bin2hex(random_bytes(16)) . '.pdf';
                if (move_uploaded_file($resume['tmp_name'], $resumeDir . $filename)) {
                    $db->prepare('INSERT INTO settings(setting_key,setting_value) VALUES(?,?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)')->execute(['resume_file', $filename]);
                    $message = 'Settings and resume updated successfully.';
                } else $message = 'Settings saved, but the resume could not be stored.';
            }
        } elseif ($message === '') {
            $message = 'Settings saved successfully.';
        }
    }
}

$activeResume = basename((string) getSetting('resume_file'));
$hasActiveResume = $activeResume !== '' && is_file($resumeDir . $activeResume);
$pageTitle = 'Settings';
$activePage = 'settings';
require __DIR__ . '/includes/header.php';
?>

<!-- ===== TOOLBAR ===== -->
<div class="toolbar">
    <div>
        <h1><i class="fas fa-sliders-h" style="color:var(--accent); margin-right:12px;"></i>Portfolio settings</h1>
        <div class="sub">Manage public content, admin access, and your downloadable resume.</div>
    </div>
</div>

<!-- ===== MESSAGE (if any) ===== -->
<?php if ($message): ?>
    <div class="notice"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<!-- ===== SETTINGS FORM ===== -->
<form method="post" enctype="multipart/form-data" class="settings-form">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <div class="panel settings-panel">
        <div class="panel-header">
            <h2><i class="fas fa-globe" style="color:var(--accent);"></i> Public content</h2>
        </div>
        <div class="form-grid">
            <?php foreach ($keys as $key): ?>
                <div class="field-group <?= $key === 'site_description' ? 'full-width' : '' ?>">
                    <label for="setting_<?= $key ?>">
                        <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $key)), ENT_QUOTES, 'UTF-8') ?>
                    </label>
                    <?php if ($key === 'site_description'): ?>
                        <textarea id="setting_<?= $key ?>" name="<?= $key ?>" placeholder="Describe your portfolio in a few sentences…"><?= htmlspecialchars(getSetting($key) ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                    <?php else: ?>
                        <input id="setting_<?= $key ?>" name="<?= $key ?>" value="<?= htmlspecialchars(getSetting($key) ?? '', ENT_QUOTES, 'UTF-8') ?>" <?= $key === 'contact_email' ? 'type="email"' : '' ?> placeholder="Enter <?= str_replace('_', ' ', $key) ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ===== RESUME SECTION ===== -->
    <div class="panel settings-panel">
        <div class="panel-header">
            <h2><i class="fas fa-file-pdf" style="color:var(--accent);"></i> Resume</h2>
            <span class="badge">PDF, max 5MB</span>
        </div>

        <div class="resume-upload-area">
            <label for="resume" class="upload-label">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Choose a new resume file</span>
                <small>Drag & drop or click to browse</small>
                <input id="resume" type="file" name="resume" accept="application/pdf,.pdf">
            </label>

            <?php if ($hasActiveResume): ?>
                <div class="resume-status active">
                    <i class="fas fa-check-circle"></i>
                    Current resume: <a href="../uploads/resume/<?= rawurlencode($activeResume) ?>" target="_blank" class="resume-link"><?= htmlspecialchars($activeResume, ENT_QUOTES, 'UTF-8') ?></a>
                </div>
            <?php else: ?>
                <div class="resume-status inactive">
                    <i class="fas fa-info-circle"></i>
                    Using the default resume until you upload one.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== SAVE BUTTON ===== -->
    <div class="form-actions">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Save settings</button>
    </div>
</form>

<!-- ============================================================
PAGE-SPECIFIC STYLES
============================================================ -->
<style>
    /* ── Form grid ──────────────────────────────────────────────── */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 24px;
    }
    .field-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .field-group.full-width {
        grid-column: 1 / -1;
    }
    .field-group label {
        font-size: 13px;
        font-weight: 600;
        color: var(--muted, #94a9cf);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .field-group input,
    .field-group textarea {
        width: 100%;
        padding: 10px 14px;
        background: var(--surface2, #18233a);
        color: var(--text, #f0f4ff);
        border: 1px solid var(--border, rgba(0,180,255,0.12));
        border-radius: var(--radius-sm, 8px);
        font: inherit;
        transition: border 0.2s, box-shadow 0.2s;
    }
    .field-group input:focus,
    .field-group textarea:focus {
        outline: none;
        border-color: var(--accent, #00d4ff);
        box-shadow: 0 0 0 3px rgba(0,180,255,0.10);
    }
    .field-group textarea {
        min-height: 80px;
        resize: vertical;
    }

    /* ── Panels ──────────────────────────────────────────────────── */
    .settings-panel {
        margin-bottom: 24px;
    }
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
    }
    .panel-header h2 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .badge {
        font-size: 12px;
        color: var(--muted);
        background: var(--surface2);
        padding: 4px 14px;
        border-radius: 30px;
        border: 1px solid var(--border);
    }

    /* ── Resume upload area ────────────────────────────────────── */
    .resume-upload-area {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 20px;
        background: var(--surface2, #18233a);
        border: 2px dashed var(--border, rgba(0,180,255,0.15));
        border-radius: var(--radius, 14px);
        cursor: pointer;
        transition: all 0.25s;
        text-align: center;
        gap: 6px;
        position: relative;
    }
    .upload-label:hover {
        border-color: var(--accent, #00d4ff);
        background: rgba(0,180,255,0.05);
        transform: translateY(-2px);
    }
    .upload-label i {
        font-size: 36px;
        color: var(--accent);
        opacity: 0.7;
    }
    .upload-label span {
        font-weight: 600;
        color: var(--text);
        font-size: 16px;
    }
    .upload-label small {
        color: var(--muted);
        font-size: 13px;
    }
    .upload-label input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .resume-status {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        border: 1px solid var(--border);
    }
    .resume-status.active {
        background: rgba(52,211,153,0.06);
        border-color: rgba(52,211,153,0.15);
        color: #34d399;
    }
    .resume-status.active i {
        color: #34d399;
    }
    .resume-status.inactive {
        background: rgba(148,163,184,0.06);
        border-color: var(--border);
        color: var(--muted);
    }
    .resume-status.inactive i {
        color: var(--muted);
    }
    .resume-link {
        color: var(--accent, #00d4ff);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .resume-link:hover {
        color: #fff;
        text-decoration: underline;
    }

    /* ── Form actions ───────────────────────────────────────────── */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 8px;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--accent, #00d4ff), var(--accent2, #3b82f6));
        color: #fff;
        border: none;
        padding: 12px 36px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 16px rgba(0,180,255,0.25);
    }
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(0,180,255,0.35);
    }

    /* ── Responsive ────────────────────────────────────────────── */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .upload-label {
            padding: 24px 16px;
        }
        .upload-label i {
            font-size: 28px;
        }
        .btn-primary {
            width: 100%;
            justify-content: center;
        }
        .panel-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<?php require __DIR__ . '/includes/footer.php'; ?>