<?php
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$id = (int) ($_GET['id'] ?? 0);
$project = $id ? getProject($id) : [];
if ($id && !$project) exit('Project not found.');

$content = is_array($project['content'] ?? null) ? $project['content'] : (json_decode((string) ($project['content'] ?? '{}'), true) ?: []);
$metrics = $content['metrics'] ?? [];
$roles = is_array($content['roles'] ?? null) ? json_encode($content['roles'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : (string) ($content['roles'] ?? '[]');
$timeline = is_array($content['timeline'] ?? null) ? implode("\n", $content['timeline']) : (string) ($content['timeline'] ?? ''); $saveError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyAdminCsrf();
    $values = [];
    foreach (['title', 'tagline', 'description', 'tags', 'tech_stack', 'repo_url', 'demo_url', 'image'] as $field) {
        $values[$field] = trim($_POST[$field] ?? '');
    }
    $content = [
        'problem' => trim($_POST['problem'] ?? ''), 'research' => trim($_POST['research'] ?? ''),
        'planning' => trim($_POST['planning'] ?? ''), 'uiux' => trim($_POST['uiux'] ?? ''),
        'architecture' => trim($_POST['architecture'] ?? ''), 'database' => trim($_POST['database'] ?? ''),
        'roles' => json_decode($_POST['roles'] ?? '[]', true) ?: [], 'auth' => trim($_POST['auth'] ?? ''),
        'api' => trim($_POST['api'] ?? ''), 'challenges' => trim($_POST['challenges'] ?? ''),
        'lessons' => trim($_POST['lessons'] ?? ''), 'future' => trim($_POST['future'] ?? ''),
        'techstack' => trim($_POST['techstack'] ?? ''), 'results' => trim($_POST['results'] ?? ''),
        'timeline' => array_values(array_filter(array_map('trim', explode("\n", $_POST['timeline'] ?? '')))),
        'metrics' => [
            'DB Tables' => (int) ($_POST['metric_db_tables'] ?? 0), 'User Roles' => (int) ($_POST['metric_user_roles'] ?? 0),
            'REST Endpoints' => (int) ($_POST['metric_rest_endpoints'] ?? 0), 'Sides' => (int) ($_POST['metric_sides'] ?? 0),
        ],
    ];
    $values['sort_order'] = (int) ($_POST['sort_order'] ?? 0);
    $values['is_active'] = isset($_POST['is_active']) ? 1 : 0;
    $values['content'] = json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    if ($id) {
        $sql = 'UPDATE projects SET title=?, tagline=?, description=?, content=?, tags=?, tech_stack=?, repo_url=?, demo_url=?, sort_order=?, is_active=?, image=? WHERE id=?';
        $params = [$values['title'], $values['tagline'], $values['description'], $values['content'], $values['tags'], $values['tech_stack'], $values['repo_url'], $values['demo_url'], $values['sort_order'], $values['is_active'], $values['image'], $id];
    } else {
        $sql = 'INSERT INTO projects (title, tagline, description, content, tags, tech_stack, repo_url, demo_url, sort_order, is_active, image) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        $params = [$values['title'], $values['tagline'], $values['description'], $values['content'], $values['tags'], $values['tech_stack'], $values['repo_url'], $values['demo_url'], $values['sort_order'], $values['is_active'], $values['image']];
    }
    $db = portfolioDb();
    if (!$db) $saveError = 'Database unavailable. No changes were saved.';
    else { $db->prepare($sql)->execute($params); header('Location: projects.php'); exit; }
}

$pageTitle = $id ? 'Edit Project' : 'Add Project';
$activePage = 'projects';
require __DIR__ . '/includes/header.php';
?>
<div class="toolbar"><div><h1><?= $id ? 'Edit' : 'Add' ?> project</h1><div class="sub">Manage the complete project case study.</div></div><a class="button secondary" href="projects.php">Back to Projects</a></div>
<?php if ($saveError): ?><div class="notice"><?= htmlspecialchars($saveError, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
<form method="post" id="projectForm">
<input type="hidden" name="csrf" value="<?= htmlspecialchars(adminCsrf(), ENT_QUOTES, 'UTF-8') ?>">
<section class="panel"><h2>Basic Information</h2><div class="grid">
<div class="field"><label>Title *</label><input name="title" value="<?= htmlspecialchars($project['title'] ?? '') ?>" required></div>
<div class="field"><label>Tagline</label><input name="tagline" value="<?= htmlspecialchars($project['tagline'] ?? '') ?>"></div>
<div class="field full"><label>Short Description *</label><textarea name="description" required><?= htmlspecialchars($project['description'] ?? '') ?></textarea></div>
<div class="field"><label>Tags</label><input name="tags" value="<?= htmlspecialchars(is_array($project['tags'] ?? null) ? implode(', ', $project['tags']) : ($project['tags'] ?? '')) ?>" placeholder="Laravel, MySQL, REST API"></div>
<div class="field"><label>Tech Stack</label><input name="tech_stack" value="<?= htmlspecialchars($project['tech_stack'] ?? '') ?>"></div>
<div class="field"><label>GitHub URL</label><input type="url" name="repo_url" value="<?= htmlspecialchars($project['repo_url'] ?? '') ?>"></div>
<div class="field"><label>Demo URL</label><input type="url" name="demo_url" value="<?= htmlspecialchars($project['demo_url'] ?? '') ?>"></div>
<div class="field"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($project['sort_order'] ?? 0) ?>"></div>
<div class="field"><label><input type="checkbox" name="is_active" value="1" <?= !isset($project['is_active']) || $project['is_active'] ? 'checked' : '' ?>> Active (published)</label></div>
</div></section>
<section class="panel"><h2>Project Image</h2><div class="field"><label>Selected image</label><div class="actions"><input type="text" name="image" id="project_image" value="<?= htmlspecialchars($project['image'] ?? '') ?>" placeholder="Select an image" readonly><button type="button" class="secondary" onclick="window.open('filemanager.php','ImageManager','width=800,height=600')">Browse</button><button type="button" class="secondary" onclick="clearProjectImage()">Remove</button></div><div style="margin-top:12px"><img id="image_preview" src="<?= !empty($project['image']) ? '/portfolio/uploads/projects/' . rawurlencode($project['image']) : '' ?>" alt="Image preview" style="max-width:200px;max-height:150px;border-radius:8px;display:<?= !empty($project['image']) ? 'block' : 'none' ?>"></div></div></section>
<section class="panel"><h2>Metrics</h2><div class="grid">
<div class="field"><label>DB Tables</label><input type="number" name="metric_db_tables" value="<?= (int) ($metrics['DB Tables'] ?? 0) ?>"></div>
<div class="field"><label>User Roles</label><input type="number" name="metric_user_roles" value="<?= (int) ($metrics['User Roles'] ?? 0) ?>"></div>
<div class="field"><label>REST Endpoints</label><input type="number" name="metric_rest_endpoints" value="<?= (int) ($metrics['REST Endpoints'] ?? 0) ?>"></div>
<div class="field"><label>Sides (Admin &amp; Client)</label><input type="number" name="metric_sides" value="<?= (int) ($metrics['Sides'] ?? 0) ?>"></div>
</div></section>
<section class="panel"><h2>Case Study Content</h2>
<?php foreach (['problem'=>'Problem','research'=>'Research','planning'=>'Planning','uiux'=>'UI/UX Decisions','architecture'=>'Architecture','database'=>'Database Design','auth'=>'Authentication','api'=>'API Structure','challenges'=>'Challenges','lessons'=>'Lessons Learned','future'=>'Future Improvements','techstack'=>'Tech Stack Details','results'=>'Results'] as $field => $label): ?><div class="field"><label><?= $label ?></label><textarea name="<?= $field ?>"><?= htmlspecialchars($content[$field] ?? '') ?></textarea></div><?php endforeach; ?>
<div class="field"><label>Roles (JSON array)</label><textarea name="roles" placeholder='[{"role":"Admin","access":"Full access"}]'><?= htmlspecialchars($roles) ?></textarea></div>
<div class="field"><label>Timeline (one item per line)</label><textarea name="timeline" rows="5"><?= htmlspecialchars($timeline) ?></textarea></div>
</section><div class="toolbar"><button type="submit" class="button">Save Project</button><a href="projects.php" class="button secondary">Cancel</a></div>
</form><script>function clearProjectImage(){document.getElementById('project_image').value='';document.getElementById('image_preview').src='';document.getElementById('image_preview').style.display='none';}</script>
<?php require __DIR__ . '/includes/footer.php'; ?>
