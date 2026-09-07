<?php
// admin/filemanager.php
session_start();
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

// Configuration
$upload_dir = __DIR__ . '/../uploads/projects/';
$upload_url = '/portfolio/uploads/projects/';
$resume_dir = __DIR__ . '/../uploads/resume/';
$resume_url = '/portfolio/uploads/resume/';

// Create directory if not exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}
if (!is_dir($resume_dir)) {
    mkdir($resume_dir, 0755, true);
}

// Handle file upload
$upload_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    verifyAdminCsrf();
    $file = $_FILES['image'];
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $mimeTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
    $imageInfo = @getimagesize($file['tmp_name']);
    $mime = $imageInfo['mime'] ?? '';

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $upload_message = 'Upload error.';
    } elseif ($file['size'] > 2 * 1024 * 1024) {
        $upload_message = 'File too large (max 2MB).';
    } elseif (!isset($mimeTypes[$mime])) {
        $upload_message = 'Invalid file type. Allowed: ' . implode(', ', $allowed);
    } else {
        $filename = bin2hex(random_bytes(16)) . '.' . $mimeTypes[$mime];
        if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
            $upload_message = 'File uploaded successfully.';
        } else {
            $upload_message = 'Failed to move uploaded file.';
        }
    }
}

$resume_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume'])) {
    verifyAdminCsrf();
    $file = $_FILES['resume'];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if ($file['error'] !== UPLOAD_ERR_OK) $resume_message = 'Resume upload error.';
    elseif ($file['size'] > 5 * 1024 * 1024) $resume_message = 'Resume is too large (max 5MB).';
    elseif ($mime !== 'application/pdf') $resume_message = 'Only PDF resumes are allowed.';
    else {
        $filename = 'resume_' . bin2hex(random_bytes(16)) . '.pdf';
        if (move_uploaded_file($file['tmp_name'], $resume_dir . $filename)) {
            $db = portfolioDb();
            if ($db) {
                $db->prepare('INSERT INTO settings(setting_key, setting_value) VALUES(?, ?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)')->execute(['resume_file', $filename]);
                $resume_message = 'Resume uploaded and activated.';
            } else $resume_message = 'Resume uploaded, but the database is unavailable so it could not be activated.';
        } else $resume_message = 'Failed to save the resume.';
    }
}

// Get list of images
$images = array_values(array_filter(scandir($upload_dir), function($item) use ($upload_dir) {
    return !in_array($item, ['.', '..']) && is_file($upload_dir . $item);
}));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>File Manager</title>
    <style>
        body { background: #0d0d0d; color: #e5e5e5; font-family: 'Inter', sans-serif; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        .upload-form { background: #1a1a1a; padding: 20px; border-radius: 10px; margin-bottom: 30px; display: flex; gap: 20px; align-items: flex-end; flex-wrap: wrap; }
        .upload-form .field { flex: 1; }
        .upload-form label { display: block; font-size: 13px; color: #9ca3af; margin-bottom: 4px; }
        .upload-form input[type="file"] { background: #111; border: 1px solid #333; padding: 8px; border-radius: 6px; color: #fff; width: 100%; }
        .upload-form button { background: #00e676; color: #04140b; border: none; padding: 10px 24px; border-radius: 100px; font-weight: 600; cursor: pointer; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 16px; }
        .grid .item { background: #1a1a1a; border: 2px solid transparent; border-radius: 8px; overflow: hidden; cursor: pointer; transition: border 0.2s; text-align: center; padding: 10px; }
        .grid .item:hover { border-color: #00e676; }
        .grid .item img { width: 100%; height: 120px; object-fit: cover; border-radius: 4px; }
        .grid .item .name { font-size: 12px; color: #9ca3af; margin-top: 6px; word-break: break-all; }
        .grid .item .select-btn { background: none; border: none; color: #00e676; cursor: pointer; font-size: 12px; margin-top: 4px; }
        .message { padding: 12px; background: rgba(0,230,118,0.1); color: #00e676; border-radius: 6px; margin-bottom: 20px; }
        .back { display: inline-block; margin-top: 20px; color: #9ca3af; text-decoration: none; }
        .back:hover { color: #fff; }
    </style>
</head>
<body>
<div class="container">
    <h1>📁 File Manager</h1>

    <?php if ($upload_message): ?>
        <div class="message"><?= htmlspecialchars($upload_message) ?></div>
    <?php endif; ?>
    <?php if ($resume_message): ?>
        <div class="message"><?= htmlspecialchars($resume_message) ?></div>
    <?php endif; ?>

    <div class="upload-form">
        <div class="field">
            <label>Replace downloadable resume (PDF, max 5MB)</label>
            <form method="post" enctype="multipart/form-data" style="display:flex;gap:12px;align-items:center;">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>">
                <input type="file" name="resume" accept="application/pdf,.pdf" required style="flex:1;">
                <button type="submit">Upload resume</button>
            </form>
            <?php $activeResume = basename((string) getSetting('resume_file')); ?>
            <?php if ($activeResume && is_file($resume_dir . $activeResume)): ?><div style="margin-top:10px;color:#9ca3af;font-size:13px;">Active: <a href="<?= $resume_url . rawurlencode($activeResume) ?>" target="_blank" style="color:#00e676;"><?= htmlspecialchars($activeResume) ?></a></div><?php endif; ?>
        </div>
    </div>

    <div class="upload-form">
        <div class="field">
            <label>Upload new image (max 2MB, jpg/png/gif/webp)</label>
            <form method="post" enctype="multipart/form-data" style="display:flex;gap:12px;align-items:center;">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>">
                <input type="file" name="image" accept="image/*" required style="flex:1;">
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>

    <div class="grid">
        <?php foreach ($images as $img): ?>
            <div class="item" data-filename="<?= htmlspecialchars($img) ?>">
                <img src="<?= $upload_url . $img ?>" alt="<?= htmlspecialchars($img) ?>">
                <div class="name"><?= htmlspecialchars($img) ?></div>
                <button class="select-btn" onclick="selectImage('<?= htmlspecialchars($img) ?>')">Select</button>
            </div>
        <?php endforeach; ?>
        <?php if (empty($images)): ?>
            <p style="grid-column:1/-1;color:#6b7280;">No images uploaded yet.</p>
        <?php endif; ?>
    </div>

    <a href="#" class="back" onclick="window.close(); return false;">Close</a>
</div>

<script>
    function selectImage(filename) {
        // Send selected filename to parent window
        if (window.opener && !window.opener.closed) {
            window.opener.document.getElementById('project_image').value = filename;
            window.opener.document.getElementById('image_preview').src = '<?= $upload_url ?>' + filename;
            window.opener.document.getElementById('image_preview').style.display = 'block';
        }
        window.close();
    }
</script>
</body>
</html>