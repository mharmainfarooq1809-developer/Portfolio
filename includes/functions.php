<?php

require_once __DIR__ . '/portfolio_data.php';
require_once __DIR__ . '/../config/config.php';

function portfolioDb()
{
    static $pdo;
    static $attempted = false;
    if ($attempted) return $pdo;
    $attempted = true;
    try {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    } catch (Throwable $exception) {
        $pdo = null;
    }
    return $pdo;
}

function hasPortfolioTable($table)
{
    $allowed = ['projects', 'faqs', 'settings', 'leads', 'portfolio_stats', 'assistant_knowledge', 'terminal_commands'];
    if (!in_array($table, $allowed, true)) return false;
    $pdo = portfolioDb();
    if (!$pdo) return false;
    try {
        $stmt = $pdo->prepare('SELECT 1 FROM `' . $table . '` LIMIT 1');
        $stmt->execute();
        return true;
    } catch (Throwable $exception) {
        return false;
    }
}

function getProjects($activeOnly = true)
{
    if (hasPortfolioTable('projects')) {
        $sql = 'SELECT * FROM projects' . ($activeOnly ? ' WHERE is_active = 1' : '') . ' ORDER BY sort_order, id';
        $rows = portfolioDb()->query($sql)->fetchAll();
        if (!$rows && $activeOnly) {
            $projects = portfolioData()['projects'];
            return array_values(array_filter($projects, static fn (array $project): bool => !empty($project['is_active'])));
        }
        foreach ($rows as &$project) {
            $project['tags'] = is_array($project['tags'] ?? null) ? $project['tags'] : array_values(array_filter(array_map('trim', explode(',', (string) ($project['tags'] ?? '')))));
            $project['content'] = json_decode((string) ($project['content'] ?? '{}'), true) ?: [];
        }
        if ($activeOnly) {
            $knownTitles = array_fill_keys(array_map(static fn (array $project): string => strtolower(trim((string) ($project['title'] ?? ''))), $rows), true);
            foreach (portfolioData()['projects'] as $localProject) {
                $titleKey = strtolower(trim((string) ($localProject['title'] ?? '')));
                if (!empty($localProject['is_active']) && $titleKey !== '' && !isset($knownTitles[$titleKey])) {
                    $rows[] = $localProject;
                }
            }
            usort($rows, static fn (array $left, array $right): int => ((int) ($left['sort_order'] ?? 0)) <=> ((int) ($right['sort_order'] ?? 0)));
            $usedIds = [];
            foreach ($rows as $rowIndex => &$row) {
                $projectId = (int) ($row['id'] ?? 0);
                if ($projectId <= 0 || isset($usedIds[$projectId])) {
                    do {
                        $projectId = 100000 + $rowIndex;
                    } while (isset($usedIds[$projectId]));
                    $row['id'] = $projectId;
                }
                $usedIds[$projectId] = true;
            }
            unset($row);
        }
        return $rows;
    }
    $projects = portfolioData()['projects'];
    return array_values(array_filter($projects, static fn (array $project): bool => !$activeOnly || !empty($project['is_active'])));
}

function getServices($activeOnly = true)
{
    $services = portfolioData()['services'];
    return array_values(array_filter($services, static fn (array $service): bool => !$activeOnly || !empty($service['is_active'])));
}

function getFaqs($activeOnly = true)
{
    if (hasPortfolioTable('faqs')) {
        $sql = 'SELECT * FROM faqs' . ($activeOnly ? ' WHERE is_active = 1' : '') . ' ORDER BY sort_order, id';
        return portfolioDb()->query($sql)->fetchAll();
    }
    $faqs = portfolioData()['faqs'];
    return array_values(array_filter($faqs, static fn (array $faq): bool => !$activeOnly || !empty($faq['is_active'])));
}

function saveMessage($name, $email, $subject, $message, array $details = [])
{
    if ($name === '' || $email === '' || $message === '') return false;
    if (hasPortfolioTable('leads')) {
        $db = portfolioDb();
        if (!$db) return false;
        $stmt = $db->prepare('INSERT INTO leads (name, email, phone, company, project_type, budget, preferred_contact, deadline, message, status, admin_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "new", ?)');
        return $stmt->execute([
            $name,
            $email,
            $details['phone'] ?? '',
            $details['company'] ?? '',
            $details['project_type'] ?? $subject,
            $details['budget'] ?? '',
            $details['preferred_contact'] ?? '',
            ($details['deadline'] ?? '') !== '' ? $details['deadline'] : null,
            $message,
            $details['admin_notes'] ?? '—',
        ]);
    }
    return true;
}

function getSetting($key)
{
    if (hasPortfolioTable('settings')) {
        $stmt = portfolioDb()->prepare('SELECT setting_value FROM settings WHERE setting_key = ? LIMIT 1');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        if ($value !== false) return $value;
    }
    $settings = portfolioData()['settings'];
    return $settings[$key] ?? null;
}

function getResumeUrl()
{
    $filename = basename((string) getSetting('resume_file'));
    if ($filename !== '' && is_file(__DIR__ . '/../uploads/resume/' . $filename)) {
        return 'uploads/resume/' . rawurlencode($filename);
    }
    return 'Muhammad_Harmain_NovExa_Executive_CV.pdf';
}

function getAdminEmails()
{
    $configured = getSetting('admin_emails') ?: AUTHORIZED_ADMIN_EMAIL;
    return array_values(array_filter(array_map('trim', explode(',', (string) $configured))));
}

function isAdminEmail($email)
{
    return in_array(strtolower(trim($email)), array_map('strtolower', getAdminEmails()), true);
}

function adminRows($table, $activeOnly = false)
{
    if (!hasPortfolioTable($table)) return [];
    $where = $activeOnly ? ' WHERE is_active = 1' : '';
    return portfolioDb()->query('SELECT * FROM `' . $table . '`' . $where . ' ORDER BY sort_order, id')->fetchAll();
}

function getLeads($status = null)
{
    if (!hasPortfolioTable('leads')) return [];
    if ($status) {
        $stmt = portfolioDb()->prepare('SELECT * FROM leads WHERE status = ? ORDER BY created_at DESC');
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }
    return portfolioDb()->query('SELECT * FROM leads ORDER BY created_at DESC')->fetchAll();
}

function getLead($id)
{
    if (!hasPortfolioTable('leads')) return null;
    $stmt = portfolioDb()->prepare('SELECT * FROM leads WHERE id = ?');
    $stmt->execute([(int) $id]);
    return $stmt->fetch() ?: null;
}

function saveLead($id, array $data)
{
    $db = portfolioDb();
    if (!$db) return false;
    $fields = ['name', 'email', 'phone', 'company', 'project_type', 'budget', 'preferred_contact', 'deadline', 'message', 'attachment', 'status', 'admin_notes'];
    $values = array_map(static fn ($field) => $data[$field] ?? null, $fields);
    if ($id) {
        $set = implode(', ', array_map(static fn ($field) => $field . ' = ?', $fields));
        $values[] = $id;
        return $db->prepare('UPDATE leads SET ' . $set . ' WHERE id = ?')->execute($values);
    }
    return $db->prepare('INSERT INTO leads (' . implode(',', $fields) . ') VALUES (' . implode(',', array_fill(0, count($fields), '?')) . ')')->execute($values);
}

function deleteLead($id) { $db = portfolioDb(); return $db ? $db->prepare('DELETE FROM leads WHERE id = ?')->execute([(int) $id]) : false; }
function countLeadsByStatus($status = null)
{
    if (!hasPortfolioTable('leads')) return 0;
    if ($status === null) return (int) portfolioDb()->query('SELECT COUNT(*) FROM leads')->fetchColumn();
    $stmt = portfolioDb()->prepare('SELECT COUNT(*) FROM leads WHERE status = ?');
    $stmt->execute([$status]);
    return (int) $stmt->fetchColumn();
}

function getStats($activeOnly = true) { return adminRows('portfolio_stats', $activeOnly); }
function getAllStats() { return getStats(false); }
function saveStat($id, $number, $label, $description, $sort, $active)
{
    if ($id) return portfolioDb()->prepare('UPDATE portfolio_stats SET number_value=?, label=?, description=?, sort_order=?, is_active=? WHERE id=?')->execute([$number, $label, $description, $sort, $active, $id]);
    return portfolioDb()->prepare('INSERT INTO portfolio_stats (number_value,label,description,sort_order,is_active) VALUES (?,?,?,?,?)')->execute([$number, $label, $description, $sort, $active]);
}
function deleteStat($id) { return portfolioDb()->prepare('DELETE FROM portfolio_stats WHERE id = ?')->execute([(int) $id]); }

function getKnowledge($activeOnly = true) { return adminRows('assistant_knowledge', $activeOnly); }
function getCommands($activeOnly = true) { return adminRows('terminal_commands', $activeOnly); }
function getAllCommands() { return getCommands(false); }
function getProject($id)
{
    foreach (getProjects(false) as $project) if ((int) $project['id'] === (int) $id) return $project;
    return null;
}
function countProjects() { return count(getProjects(false)); }
