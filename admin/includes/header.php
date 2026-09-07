<?php $pageTitle = $pageTitle ?? 'Admin'; $activePage = $activePage ?? ''; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?> | Harmain</title>

    <!-- ===== Font & Icons ===== -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        /* ============================================================
           ROOT — Novexa‑inspired dark tech theme (no charts)
           ============================================================ */
        :root {
            --bg: #070b14;
            --surface: #0c1428;
            --surface2: #18233a;
            --surface-card: rgba(18, 30, 55, 0.75);
            --text: #f0f4ff;
            --muted: #94a9cf;
            --accent: #00d4ff;
            --accent2: #3b82f6;
            --border: rgba(0, 180, 255, 0.12);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.55);
            --radius: 14px;
            --radius-sm: 8px;
            --transition: 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font: 15px 'Inter', system-ui, -apple-system, sans-serif;
            display: flex;
            min-height: 100vh;
            background-image: radial-gradient(ellipse at 20% 50%, rgba(0, 180, 255, 0.06), transparent 70%),
                radial-gradient(ellipse at 80% 20%, rgba(99, 102, 241, 0.06), transparent 60%);
            background-attachment: fixed;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            padding: 28px 18px 24px;
            display: flex;
            flex-direction: column;
            gap: 28px;
            backdrop-filter: blur(4px);
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            font-size: 22px;
            font-weight: 800;
            padding: 0 6px;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .logo span {
            -webkit-text-fill-color: var(--accent);
            color: var(--accent);
        }

        nav {
            display: grid;
            gap: 2px;
        }
        nav a,
        .logout {
            color: var(--muted);
            text-decoration: none;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            font-weight: 500;
            transition: all var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid transparent;
        }
        nav a i {
            width: 20px;
            text-align: center;
            font-size: 14px;
            opacity: 0.7;
        }
        nav a:hover,
        nav a.active {
            background: rgba(0, 180, 255, 0.08);
            color: var(--accent);
            border-color: rgba(0, 180, 255, 0.12);
            box-shadow: 0 0 20px rgba(0, 180, 255, 0.04);
        }
        nav a.active {
            background: rgba(0, 180, 255, 0.12);
            border-color: var(--accent);
        }

        .logout {
            margin-top: auto;
            border-top: 1px solid var(--border);
            padding-top: 20px;
            color: var(--muted);
            transition: color var(--transition);
        }
        .logout:hover {
            color: #ff6b6b;
        }

        /* ===== MAIN CONTENT ===== */
        .main {
            flex: 1;
            padding: 32px 40px 40px;
            max-width: 1440px;
            min-width: 0;
            overflow-x: hidden;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }
        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.4px;
        }
        .sub {
            color: var(--muted);
            margin: 4px 0 24px;
            font-size: 14px;
        }
        .sub strong {
            color: var(--text);
        }

        /* ===== BUTTONS ===== */
        .button,
        button {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border: 0;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            font-size: 13px;
            transition: all var(--transition);
            box-shadow: 0 4px 16px rgba(0, 180, 255, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .button:hover,
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0, 180, 255, 0.35);
        }
        .button.secondary,
        button.secondary {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            box-shadow: none;
        }
        .button.secondary:hover {
            background: var(--surface-card);
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        .danger {
            color: #ff9b9b !important;
        }

        /* ===== NOTICE ===== */
        .notice {
            background: rgba(0, 180, 255, 0.06);
            border: 1px solid rgba(0, 180, 255, 0.15);
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            color: var(--text);
        }

        /* ===== CARDS (stats) ===== */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }
        .card {
            background: var(--surface-card);
            border: 1px solid var(--border);
            padding: 22px 20px;
            border-radius: var(--radius);
            backdrop-filter: blur(4px);
            box-shadow: var(--shadow);
            transition: all var(--transition);
        }
        .card:hover {
            border-color: rgba(0, 180, 255, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.6);
        }
        .card strong {
            display: block;
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }
        .card .card-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            margin-top: 2px;
        }
        .card .card-icon {
            float: right;
            font-size: 26px;
            color: var(--accent);
            opacity: 0.3;
        }

        /* ===== PANEL (tables / forms) ===== */
        .panel {
            background: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px 24px;
            margin-top: 20px;
            backdrop-filter: blur(4px);
            box-shadow: var(--shadow);
            transition: all var(--transition);
            overflow-x: auto;
        }
        .panel:hover {
            border-color: rgba(0, 180, 255, 0.15);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }
        h2 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        h2 i {
            color: var(--accent);
        }

        /* ===== TABLES ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th,
        td {
            text-align: left;
            padding: 12px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            vertical-align: middle;
        }
        th {
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            font-weight: 600;
        }
        td {
            color: var(--text);
        }
        tr:last-child td {
            border-bottom: none;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .actions a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition);
        }
        .actions a:hover {
            color: #fff;
        }

        /* ===== FORMS ===== */
        input,
        textarea,
        select {
            width: 100%;
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border);
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            font: inherit;
            transition: border var(--transition);
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            color-scheme: dark;
            forced-color-adjust: none;
            cursor: pointer;
            padding-right: 42px;
            background-color: #18233a !important;
            color: #f0f4ff !important;
            background-image: linear-gradient(45deg, transparent 50%, var(--accent) 50%), linear-gradient(135deg, var(--accent) 50%, transparent 50%);
            background-position: calc(100% - 19px) 50%, calc(100% - 13px) 50%;
            background-size: 6px 6px, 6px 6px;
            background-repeat: no-repeat;
        }
        select option {
            background-color: #18233a !important;
            color: #f0f4ff !important;
        }
        select option:checked,
        select option:hover {
            background: var(--accent2);
            color: #fff;
        }
        select:hover {
            border-color: rgba(0, 212, 255, 0.45);
        }
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 180, 255, 0.12);
        }
        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .field {
            margin: 0 0 16px;
        }
        .field label {
            display: block;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .full {
            grid-column: 1 / -1;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main {
                padding: 20px;
            }
            .cards {
                grid-template-columns: 1fr;
            }
            .grid {
                grid-template-columns: 1fr;
            }
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent2);
        }
    </style>
</head>
<body>

    <!-- ============================================================
    SIDEBAR (unchanged structure)
    ============================================================ -->
    <aside class="sidebar">
        <div class="logo">Harmain<span>.</span></div>
        <nav>
            <?php foreach ([
                ['dashboard.php', 'Dashboard', 'dashboard'],
                ['leads.php', 'Leads', 'leads'],
                ['projects.php', 'Projects', 'projects'],
                ['statistics.php', 'Statistics', 'statistics'],
                ['assistant.php', 'Assistant', 'assistant'],
                ['terminal.php', 'Terminal', 'terminal'],
                ['faq.php', 'FAQ', 'faq'],
                ['portfolio-settings.php', 'Settings', 'settings']
            ] as $link): ?>
                <a class="<?= $activePage === $link[2] ? 'active' : '' ?>" href="<?= $link[0] ?>">
                    <i class="fas fa-<?= match($link[2]) {
                        'dashboard' => 'chart-pie',
                        'leads' => 'users',
                        'projects' => 'folder-open',
                        'statistics' => 'chart-line',
                        'assistant' => 'robot',
                        'terminal' => 'terminal',
                        'faq' => 'circle-question',
                        'settings' => 'sliders',
                        default => 'circle'
                    } ?>"></i>
                    <?= $link[1] ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <a class="logout" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
    </aside>

    <!-- ============================================================
    MAIN CONTENT
    ============================================================ -->
    <main class="main">