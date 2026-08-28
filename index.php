<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/csrf.php';
$siteTitle = getSetting('site_title') ?: 'Muhammad Harmain — Full Stack Developer';
$siteDescription = getSetting('site_description') ?: 'Full stack developer building business management systems, dashboards and portals with Laravel, MySQL and REST APIs.';
$siteUrl = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/\\');
$siteUrl = rtrim($siteUrl, '/');
$projectsForSchema = getProjects();
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($siteDescription, ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="author" content="Muhammad Harmain" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <meta name="theme-color" content="#050505" />
    <link rel="canonical" href="<?= htmlspecialchars($siteUrl . '/', ENT_QUOTES, 'UTF-8') ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= htmlspecialchars($siteTitle, ENT_QUOTES, 'UTF-8') ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($siteDescription, ENT_QUOTES, 'UTF-8') ?>" />
    <meta property="og:url" content="<?= htmlspecialchars($siteUrl . '/', ENT_QUOTES, 'UTF-8') ?>" />
    <meta property="og:image" content="<?= htmlspecialchars($siteUrl . '/pic.png', ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= htmlspecialchars($siteTitle, ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="twitter:description" content="<?= htmlspecialchars($siteDescription, ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="twitter:image" content="<?= htmlspecialchars($siteUrl . '/pic.png', ENT_QUOTES, 'UTF-8') ?>" />
    <title><?= htmlspecialchars($siteTitle) ?></title>
    <script type="application/ld+json"><?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'Muhammad Harmain',
        'jobTitle' => 'Full Stack Web Developer',
        'description' => $siteDescription,
        'email' => 'mailto:mharmainfarooq@gmail.com',
        'url' => $siteUrl . '/',
        'image' => $siteUrl . '/pic.png',
        'sameAs' => ['https://github.com/mharmainfarooq1809-developer'],
        'worksFor' => ['@type' => 'Organization', 'name' => 'NovExa Tech'],
        'knowsAbout' => ['PHP', 'Laravel', 'MySQL', 'JavaScript', 'Bootstrap', 'REST APIs', 'AI integration'],
        'hasOccupation' => ['@type' => 'Occupation', 'name' => 'Full Stack Web Developer'],
        'subjectOf' => array_map(static fn (array $project): array => [
            '@type' => 'CreativeWork',
            'name' => (string) ($project['title'] ?? ''),
            'description' => (string) ($project['description'] ?? ''),
        ], $projectsForSchema),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        if (window.gsap && window.ScrollTrigger) {
            document.documentElement.classList.add('has-gsap');
        }
    </script>

    <!-- ===== FULL ORIGINAL CSS (copied verbatim from your original HTML) ===== -->
    <style>
        /* ============================================================
           DESIGN TOKENS
           ============================================================ */
        :root {
            --bg: #050505;
            --surface: #0d0d0d;
            --surface-2: #111213;
            --card: rgba(18, 18, 18, 0.65);
            --border: rgba(255, 255, 255, 0.08);
            --border-strong: rgba(255, 255, 255, 0.16);
            --accent: #1677FF;
            --accent-2: #00C8FF;
            --accent-dim: rgba(22, 119, 255, 0.14);
            --text: #ffffff;
            --muted: #9ca3af;
            --muted-2: #6b7280;
            --danger: #ff5c5c;
            --font-head: "Space Grotesk", sans-serif;
            --font-body: "Inter", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --ease: cubic-bezier(0.16, 0.84, 0.44, 1);
        }
        [data-theme="light"] {
            --bg: #f7f8f7;
            --surface: #ffffff;
            --surface-2: #f0f2f0;
            --card: rgba(255, 255, 255, 0.75);
            --border: rgba(10, 18, 28, 0.08);
            --border-strong: rgba(10, 18, 28, 0.16);
            --accent: #1266D6;
            --accent-2: #0099CC;
            --accent-dim: rgba(0, 166, 91, 0.1);
            --text: #080D14;
            --muted: #536274;
            --muted-2: #748298;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            cursor: none;
        }
        html {
            scroll-behavior: smooth;
        }
        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
            * {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            overflow-x: hidden;
            line-height: 1.5;
            transition: background 0.4s ease, color 0.4s ease;
            cursor: none;
        }
        /* ===== NOVEXA CURSOR — SINGLE CONTROLLER ===== */
        .cursor-dot,
        .cursor-ring {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 99999;
            border-radius: 50%;
            opacity: 0;
            --cursor-x: -100px;
            --cursor-y: -100px;
            --cursor-scale: 1;
            transform:
                translate3d(var(--cursor-x), var(--cursor-y), 0)
                translate(-50%, -50%)
                scale(var(--cursor-scale));
            will-change: transform;
        }

        .cursor-dot.is-active,
        .cursor-ring.is-active {
            opacity: 1;
        }

        .cursor-dot {
            width: 6px;
            height: 6px;
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent-dim);
            transition:
                opacity 0.2s var(--ease),
                width 0.2s var(--ease),
                height 0.2s var(--ease);
        }

        .cursor-ring {
            width: 34px;
            height: 34px;
            border: 1px solid var(--border-strong);
            transition:
                opacity 0.2s var(--ease),
                width 0.22s var(--ease),
                height 0.22s var(--ease),
                border-color 0.22s var(--ease),
                background 0.22s var(--ease);
        }

        .cursor-ring.is-interactive {
            width: 44px;
            height: 44px;
            border-color: var(--accent);
        }

        .cursor-dot.is-interactive {
            --cursor-scale: 0.7;
        }

        .cursor-ring.is-view {
            width: 48px;
            height: 48px;
            border: 2px solid var(--accent);
            background: rgba(22, 119, 255, 0.1);
        }

        .cursor-ring.is-view::after {
            content: 'VIEW';
            font-family: var(--font-mono);
            font-size: 7px;
            letter-spacing: 0.12em;
            color: var(--accent);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: 600;
        }

        .cursor-dot.is-view {
            opacity: 0;
        }

        .cursor-ring.is-close {
            width: 48px;
            height: 48px;
            border: 2px solid var(--accent);
            background: rgba(22, 119, 255, 0.1);
        }

        .cursor-ring.is-close::after {
            content: '×';
            font-family: var(--font-body);
            font-size: 22px;
            color: var(--accent);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            line-height: 1;
        }

        .cursor-dot.is-close {
            opacity: 0;
        }

        .cursor-ring.is-clicking {
            --cursor-scale: 0.82;
        }

        .cursor-dot.is-clicking {
            --cursor-scale: 0.85;
        }

        @media (hover: none), (pointer: coarse) {
            .cursor-dot,
            .cursor-ring {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .cursor-dot,
            .cursor-ring {
                transition: opacity 0.15s linear;
            }
        }
        a {
            color: inherit;
            text-decoration: none;
        }
        img {
            max-width: 100%;
            display: block;
        }
        ::selection {
            background: var(--accent);
            color: #000;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 32px;
        }
        h1, h2, h3, h4 {
            font-family: var(--font-head);
            letter-spacing: -0.02em;
        }
        button {
            font-family: var(--font-body);
            cursor: pointer;
        }
        .eyebrow {
            font-family: var(--font-mono);
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }
        .eyebrow::before {
            content: "";
            width: 20px;
            height: 1px;
            background: var(--accent);
        }
        .section {
            padding: 140px 0;
            position: relative;
        }
        .section-head {
            max-width: 640px;
            margin-bottom: 64px;
        }
        .section-head h2 {
            font-size: clamp(32px, 4vw, 48px);
            font-weight: 600;
            margin-bottom: 16px;
        }
        .section-head p {
            color: var(--muted);
            font-size: 17px;
        }
        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }
        .hidden-mobile-cursor {
            display: none;
        }

        /* ===== AMBIENT BACKGROUND LAYER ===== */
        .ambient {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .ambient-grid {
            position: absolute;
            inset: -2px;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 64px 64px;
            opacity: 0.35;
            mask-image: radial-gradient(ellipse 70% 60% at 50% 20%, black 20%, transparent 75%);
        }
        .ambient-mesh {
            position: absolute;
            top: -20%;
            left: -10%;
            width: 70%;
            height: 70%;
            background: radial-gradient(circle, rgba(22, 119, 255, 0.12) 0%, transparent 70%);
            filter: blur(60px);
        }
        .ambient-mesh.two {
            top: 30%;
            right: -15%;
            left: auto;
            background: radial-gradient(circle, rgba(0, 200, 255, 0.1) 0%, transparent 70%);
        }
        .ambient-mesh.three {
            bottom: -10%;
            left: 20%;
            background: radial-gradient(circle, rgba(22, 119, 255, 0.06) 0%, transparent 70%);
        }
        .ambient-noise {
            position: absolute;
            inset: 0;
            opacity: 0.025;
            mix-blend-mode: overlay;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }
        .spotlight {
            position: fixed;
            top: 0;
            left: 0;
            width: 640px;
            height: 640px;
            z-index: 1;
            pointer-events: none;
            background: radial-gradient(circle, rgba(22, 119, 255, 0.09), transparent 65%);
            border-radius: 50%;
            transform: translate3d(-9999px, -9999px, 0);
            will-change: transform;
        }
        main, header, footer {
            position: relative;
            z-index: 2;
        }
        .section {
            content-visibility: auto;
            contain-intrinsic-size: 1px 900px;
        }

        /* ===== NAV ===== */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 500;
            padding: 24px 0;
            transition: background 0.3s ease, backdrop-filter 0.3s ease, border-color 0.3s ease;
            border-bottom: 1px solid transparent;
        }
        header.scrolled {
            background: color-mix(in srgb, var(--bg) 78%, transparent);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
        }
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }
        .logo {
            font-family: var(--font-head);
            font-weight: 600;
            font-size: 18px;
        }
        .logo span {
            color: var(--accent);
        }
        .nav-links {
            display: flex;
            gap: 36px;
            list-style: none;
        }
        .nav-links a {
            font-size: 14px;
            color: var(--muted);
            transition: color 0.2s ease;
            position: relative;
        }
        .nav-links a:hover {
            color: var(--text);
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 100px;
            border: 1px solid var(--border);
            background: none;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.2s ease, color 0.2s ease;
        }
        .icon-btn:hover {
            border-color: var(--accent);
            color: var(--text);
        }
        .kbd-hint {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted-2);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 3px 6px;
        }
        .nav-cta {
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 500;
            padding: 10px 22px;
            border: 1px solid var(--border);
            border-radius: 100px;
            transition: border-color 0.25s ease, transform 0.25s ease;
        }
        .nav-cta:hover {
            border-color: var(--accent);
        }
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text);
            cursor: pointer;
            font-size: 20px;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 900px) {
            .nav-links {
                display: flex;
                position: fixed;
                top: 76px;
                left: 16px;
                right: 16px;
                z-index: 1000;
                flex-direction: column;
                gap: 0;
                padding: 8px;
                border: 1px solid var(--border);
                border-radius: var(--radius-md);
                background: var(--surface);
                box-shadow: 0 20px 50px rgba(0,0,0,.24);
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transform: translateY(-12px) scale(.98);
                transform-origin: top right;
                transition: opacity .25s ease, transform .25s ease, visibility .25s ease;
            }
            .nav-links.is-open {
                display: flex;
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                transform: translateY(0) scale(1);
            }
            .nav-links a {
                display: block;
                min-height: 44px;
                padding: 12px 14px;
                border-radius: 8px;
            }
            .nav-links a:hover { background: var(--surface-2); }
            .nav-toggle { display: flex; }
        }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 120px;
            overflow: hidden;
        }
        .hero-bg-word {
            position: absolute;
            top: 52%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: var(--font-head);
            font-weight: 800;
            font-size: min(28vw, 340px);
            color: var(--text);
            opacity: 0.03;
            white-space: nowrap;
            letter-spacing: -0.04em;
            pointer-events: none;
            user-select: none;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 40px;
            align-items: center;
            position: relative;
        }
        .hero-copy .eyebrow {
            margin-bottom: 24px;
        }
        .hero-copy h1 {
            font-size: clamp(40px, 5.6vw, 74px);
            font-weight: 700;
            line-height: 1.04;
            margin-bottom: 24px;
        }
        .hero-copy h1 .line {
            display: block;
            overflow: hidden;
        }
        .has-gsap .hero-copy h1 .line span {
            display: inline-block;
            transform: translateY(110%);
        }
        .hero-copy h1 .accent-text {
            color: var(--accent);
        }
        .hero-rotate {
            display: inline-flex;
            position: relative;
            height: 1.1em;
            overflow: hidden;
            vertical-align: bottom;
            min-width: 1px;
        }
        .hero-rotate .rot-word {
            position: absolute;
            left: 0;
            top: 0;
            color: var(--accent);
            white-space: nowrap;
        }
        .hero-sub {
            font-size: 18px;
            color: var(--muted);
            max-width: 480px;
            margin-bottom: 36px;
        }
        .hero-actions {
            display: flex;
            gap: 16px;
            margin-bottom: 56px;
            flex-wrap: wrap;
        }
        .btn-primary {
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 15px;
            padding: 15px 30px;
            background: var(--accent);
            color: #ffffff;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
            border: none;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .btn-secondary {
            font-weight: 500;
            font-size: 15px;
            padding: 15px 28px;
            border: 1px solid var(--border);
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: border-color 0.25s ease, transform 0.3s ease;
            background: none;
            color: var(--text);
        }
        .btn-secondary:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }
        .hero-stats {
            display: flex;
            gap: 48px;
            flex-wrap: wrap;
        }
        .hero-stat b {
            font-family: var(--font-mono);
            font-size: 30px;
            font-weight: 500;
            color: var(--text);
            display: block;
        }
        .hero-stat span {
            font-size: 13px;
            color: var(--muted);
        }

        .hero-visual {
            position: relative;
            height: 560px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .portrait-halo {
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, rgba(22, 119, 255, 0.5), rgba(0, 200, 255, 0.05), rgba(22, 119, 255, 0.5));
            filter: blur(50px);
            opacity: 0.55;
            animation: spin 18s linear infinite;
            will-change: transform;
        }
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        .portrait-wrap {
            position: relative;
            width: 480px;
            z-index: 2;
            will-change: transform;
        }
        .portrait-wrap img {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(22, 119, 255, 0.22));
        }
        .float-tag {
            position: absolute;
            font-family: var(--font-mono);
            font-size: 12px;
            background: color-mix(in srgb, var(--surface) 80%, transparent);
            border: 1px solid var(--border);
            padding: 8px 14px;
            border-radius: 100px;
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 3;
            will-change: transform;
        }
        .float-tag i {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
        }
        .tag-1 { top: 8%; left: 0; }
        .tag-2 { bottom: 20%; left: -6%; }
        .tag-3 { top: 14%; right: -4%; }
        .tag-4 { bottom: 6%; right: 4%; }

        .scroll-cue {
            position: absolute;
            bottom: 36px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.1em;
        }
        .scroll-cue .line {
            width: 1px;
            height: 34px;
            background: linear-gradient(var(--accent), transparent);
        }

        /* ===== MARQUEE ===== */
        .marquee-section {
            padding: 64px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
        }
        .marquee-track {
            display: flex;
            gap: 64px;
            width: max-content;
            animation: marquee 28s linear infinite;
            will-change: transform;
        }
        .marquee-section:hover .marquee-track {
            animation-play-state: paused;
        }
        @keyframes marquee {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }
        .marquee-item {
            font-family: var(--font-head);
            font-size: 22px;
            color: var(--muted);
            opacity: 0.6;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .marquee-item b {
            color: var(--text);
            opacity: 1;
        }

        /* ===== ABOUT — editorial statement ===== */
        .abt-section { padding-top: 160px; padding-bottom: 160px; }
        .abt-eyebrow-row { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 40px; flex-wrap: wrap; gap: 12px; }
        .abt-eyebrow { font-family: var(--font-mono); font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--accent); }
        .abt-eyebrow-side { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted-2); }
        .abt-statement { font-family: var(--font-head); font-weight: 600; font-size: clamp(38px, 6vw, 82px); line-height: 1.08; letter-spacing: -0.02em; color: var(--text); margin-bottom: 72px; max-width: 1000px; }
        .abt-line { display: block; overflow: hidden; }
        .abt-statement em { font-style: normal; color: var(--accent); position: relative; }
        .abt-rule { height: 1px; background: var(--border); margin-bottom: 56px; transition: background 0.4s var(--ease); }
        .abt-rule.abt-rule-lower { margin-top: 56px; margin-bottom: 0; }
        .abt-copy-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; margin-bottom: 40px; }
        .abt-copy { color: var(--muted); font-size: 16.5px; line-height: 1.7; }
        .abt-location { color: var(--muted-2); font-size: 15px; line-height: 1.7; max-width: 640px; }
        .abt-rail { display: grid; grid-template-columns: repeat(4, 1fr); padding-top: 40px; }
        .abt-rail-item { padding-right: 32px; border-left: 1px solid var(--border); padding-left: 24px; transition: border-color 0.3s var(--ease); }
        .abt-rail-item:first-child { border-left: none; padding-left: 0; }
        .abt-rail-label { display: block; font-family: var(--font-mono); font-size: 10.5px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted-2); margin-bottom: 12px; }
        .abt-rail-value { display: block; font-size: 15px; color: var(--text); line-height: 1.45; transition: transform 0.3s var(--ease), color 0.3s var(--ease); }
        @media (hover: hover) and (pointer: fine) { .abt-rail-item:hover .abt-rail-value { transform: translateX(2px); color: var(--accent-2); } .abt-rail-item:hover { border-color: var(--border-strong); } }
        .has-gsap .abt-eyebrow-row, .has-gsap .abt-line, .has-gsap .abt-copy, .has-gsap .abt-location, .has-gsap .abt-rail { opacity: 0; transform: translateY(20px); }
        .has-gsap .abt-line { transform: translateY(100%); }
        .abt-eyebrow-row.is-revealed, .abt-line.is-revealed, .abt-copy.is-revealed, .abt-location.is-revealed, .abt-rail.is-revealed { opacity: 1; transform: translateY(0); transition: opacity 0.7s var(--ease), transform 0.7s var(--ease); }
        @media (prefers-reduced-motion: reduce) { .abt-eyebrow-row, .abt-line, .abt-copy, .abt-location, .abt-rail { opacity: 1 !important; transform: none !important; transition: none !important; } }
        @media (max-width: 1100px) { .abt-rail { grid-template-columns: repeat(2, 1fr); row-gap: 32px; } .abt-rail-item:nth-child(3) { border-left: none; padding-left: 0; } }
        @media (max-width: 900px) { .abt-section { padding-top: 90px; padding-bottom: 90px; } .abt-statement { margin-bottom: 48px; } .abt-copy-grid { grid-template-columns: 1fr; gap: 24px; margin-bottom: 24px; } .abt-rule { margin-bottom: 40px; } .abt-rule.abt-rule-lower { margin-top: 40px; } .abt-rail { grid-template-columns: 1fr; row-gap: 28px; padding-top: 32px; } .abt-rail-item { border-left: none; padding-left: 0; border-top: 1px solid var(--border); padding-top: 20px; } .abt-rail-item:first-child { border-top: none; padding-top: 0; } }

        /* ===== NOVEXA TECH ===== */
        .novexa-section { position:relative; padding:140px 0; overflow:hidden; border-top:1px solid var(--border); border-bottom:1px solid var(--border); }
        .novexa-section::before { content:""; position:absolute; inset:0; background:linear-gradient(120deg, var(--accent-dim), transparent 42%); opacity:.5; pointer-events:none; }
        .novexa-header, .novexa-founder, .novexa-services, .novexa-principles, .novexa-cta { position:relative; z-index:1; }
        .novexa-header { display:grid; grid-template-columns:minmax(0,1fr) minmax(280px,.8fr); gap:64px; align-items:end; margin-bottom:72px; }
        .novexa-label { font:12px var(--font-mono); letter-spacing:.14em; text-transform:uppercase; color:var(--accent); margin-bottom:20px; }
        .novexa-heading { font:600 clamp(42px,7vw,86px)/.98 var(--font-head); letter-spacing:-.03em; max-width:700px; }
        .novexa-heading em { color:var(--accent); font-style:normal; }
        .novexa-lead { color:var(--muted); font-size:17px; line-height:1.75; max-width:560px; }
        .novexa-founder { display:grid; grid-template-columns:1fr 2fr; gap:32px; padding:28px 0; border-top:1px solid var(--border); border-bottom:1px solid var(--border); margin-bottom:56px; }
        .novexa-kicker { font:11px var(--font-mono); letter-spacing:.1em; text-transform:uppercase; color:var(--muted-2); }
        .novexa-founder h3 { font:600 26px/1.2 var(--font-head); margin-bottom:10px; }
        .novexa-founder p { color:var(--muted); line-height:1.7; max-width:680px; }
        .novexa-subhead { font:600 28px var(--font-head); margin-bottom:24px; }
        .novexa-services { display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--border); border:1px solid var(--border); margin-bottom:72px; }
        .novexa-service { min-width:0; padding:28px 24px; background:var(--bg); transition:background .3s ease, transform .3s ease; }
        .novexa-service:hover { background:var(--surface); transform:translateY(-3px); }
        .novexa-service h4 { font:600 18px var(--font-head); margin-bottom:10px; }
        .novexa-service p { color:var(--muted); font-size:14px; line-height:1.65; }
        .novexa-principles { display:grid; grid-template-columns:repeat(4,1fr); gap:24px; margin-bottom:72px; }
        .novexa-principle { border-left:2px solid var(--accent); padding-left:16px; }
        .novexa-principle h4 { font:600 17px var(--font-head); margin-bottom:8px; }
        .novexa-principle p { color:var(--muted); font-size:13.5px; line-height:1.6; }
        .novexa-cta { display:flex; justify-content:space-between; align-items:end; gap:32px; padding-top:32px; border-top:1px solid var(--border); }
        .novexa-cta h3 { font:600 clamp(26px,3vw,38px) var(--font-head); margin-bottom:10px; }
        .novexa-cta p { color:var(--muted); max-width:540px; line-height:1.6; }
        .novexa-cta-actions { display:flex; flex-wrap:wrap; gap:12px; flex:0 0 auto; }
        .novexa-cta-actions a { white-space:nowrap; }
        @media(max-width:900px) { .novexa-section { padding:90px 0; } .novexa-header { grid-template-columns:1fr; gap:28px; margin-bottom:52px; } .novexa-founder { grid-template-columns:1fr; gap:12px; } .novexa-services { grid-template-columns:repeat(2,1fr); } .novexa-principles { grid-template-columns:repeat(2,1fr); } .novexa-cta { align-items:flex-start; flex-direction:column; } }
        @media(max-width:560px) { .novexa-services, .novexa-principles { grid-template-columns:1fr; } .novexa-service { padding:24px 20px; } .novexa-cta-actions { width:100%; } .novexa-cta-actions a { flex:1 1 100%; text-align:center; } }

        /* ===== EXPERIENCE — editorial timeline ===== */
        .exp-section { padding-top: 160px; padding-bottom: 160px; }
        .exp-header { margin-bottom: 96px; max-width: 640px; }
        .exp-label { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.14em; color: var(--muted-2); margin-bottom: 20px; }
        .exp-heading { font-family: var(--font-head); font-size: clamp(32px, 4vw, 48px); font-weight: 600; line-height: 1.12; letter-spacing: -0.02em; margin-bottom: 32px; }
        .exp-progress { display: flex; align-items: center; gap: 12px; font-family: var(--font-mono); font-size: 11px; color: var(--muted-2); }
        .exp-progress-current { color: var(--accent); min-width: 16px; }
        .exp-progress-track { position: relative; width: 120px; height: 1px; background: var(--border); }
        .exp-progress-fill { position: absolute; top: 0; left: 0; height: 1px; width: 0%; background: var(--accent); transition: width 0.4s var(--ease); }
        .exp-timeline { position: relative; }
        .exp-track { position: absolute; top: 10px; bottom: 10px; left: 168px; width: 1px; background: var(--border); }
        .exp-track-fill { position: absolute; top: 0; left: 0; width: 1px; height: 0%; background: var(--accent); transition: height 0.1s linear; }
        .exp-stage { position: relative; display: grid; grid-template-columns: 140px 56px 1fr; align-items: start; padding: 56px 0; border-bottom: 1px solid var(--border); transition: transform 0.35s var(--ease); }
        .has-gsap .exp-stage { opacity: 0; transform: translateY(28px); }
        .exp-stage:first-child { padding-top: 8px; }
        .exp-stage:last-child { border-bottom: none; padding-bottom: 8px; }
        .exp-meta { display: flex; flex-direction: column; gap: 10px; padding-right: 24px; }
        .exp-num { font-family: var(--font-mono); font-size: 13px; color: var(--muted-2); transition: color 0.4s var(--ease); }
        .exp-stagelabel { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted-2); transition: color 0.4s var(--ease); }
        .exp-node { position: relative; display: flex; align-items: center; justify-content: center; height: 20px; }
        .exp-node::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: var(--bg); border: 1px solid var(--border-strong); transition: background 0.4s var(--ease), border-color 0.4s var(--ease), box-shadow 0.4s var(--ease); }
        .exp-content h3 { font-family: var(--font-head); font-size: clamp(20px, 2.2vw, 26px); font-weight: 600; letter-spacing: -0.01em; margin-bottom: 12px; color: var(--muted); transition: color 0.4s var(--ease); }
        .exp-content p { color: var(--muted-2); font-size: 15px; line-height: 1.65; max-width: 560px; opacity: 0.7; transition: color 0.4s var(--ease), opacity 0.4s var(--ease); }
        .exp-stage.is-active .exp-num { color: var(--accent); }
        .exp-stage.is-active .exp-stagelabel { color: var(--muted); }
        .exp-stage.is-active .exp-node::before { background: var(--accent); border-color: var(--accent); box-shadow: 0 0 0 4px var(--accent-dim); }
        .exp-stage.is-active .exp-content h3 { color: var(--text); }
        .exp-stage.is-active .exp-content p { color: var(--muted); opacity: 1; }
        .exp-stage.is-current .exp-stagelabel { color: var(--accent); }
        .exp-stage.is-current.is-active .exp-node::before { box-shadow: 0 0 0 5px var(--accent-dim); }
        .exp-stage.is-visible { opacity: 1; transform: translateY(0); transition: opacity 0.6s var(--ease), transform 0.6s var(--ease); }
        @media (hover: hover) and (pointer: fine) { .exp-stage:hover, .exp-stage.is-visible:hover { transform: translateX(4px); } .exp-stage:hover .exp-num { color: var(--accent); } .exp-stage:hover .exp-content h3 { color: var(--text); } .exp-stage:hover .exp-content p { opacity: 1; } }
        @media (prefers-reduced-motion: reduce) { .exp-stage { opacity: 1 !important; transform: none !important; transition: none !important; } .exp-track-fill { height: 100% !important; } .exp-stage.is-active .exp-node::before, .exp-stage .exp-node::before { transition: none; } }
        @media (max-width: 900px) { .exp-section { padding-top: 90px; padding-bottom: 90px; } .exp-header { margin-bottom: 56px; } .exp-track { left: 3px; } .exp-stage { grid-template-columns: 16px 1fr; grid-template-areas: "node label" ". content"; column-gap: 20px; padding: 36px 0; } .exp-meta { grid-area: label; flex-direction: row; align-items: baseline; gap: 10px; padding-right: 0; } .exp-node { grid-area: node; height: auto; align-self: start; margin-top: 4px; } .exp-content { grid-area: content; margin-top: 12px; } }

        /* ===== PROCESS TIMELINE ===== */
        /* ===== DEVELOPMENT PROCESS — SYSTEM CORE / BLUEPRINT ===== */
        .core-section {
            position: relative;
        }
        .core-eyebrow-tech {
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.12em;
            color: var(--muted-2);
            margin-bottom: 10px;
        }

        /* subtle technical grid behind the blueprint */
        .core-stage {
            position: relative;
            margin-top: 72px;
        }
        .core-grid-bg {
            position: absolute;
            inset: -40px;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.28;
            mask-image: radial-gradient(ellipse 65% 65% at 50% 50%, black 30%, transparent 78%);
            pointer-events: none;
            z-index: 0;
        }

        /* ===== ORBIT LAYOUT (desktop) ===== */
        .blueprint {
            position: relative;
            width: 100%;
            max-width: 760px;
            aspect-ratio: 1 / 1;
            margin: 0 auto;
            z-index: 1;
        }
        .blueprint-lines {
            position: absolute;
            inset: 0;
        }
        .blueprint-line {
            position: absolute;
            top: 50%;
            left: 50%;
            height: 1px;
            width: var(--radius);
            background: var(--border);
            transform-origin: left center;
            transform: rotate(var(--angle)) translateY(-50%);
            transition: background 0.4s var(--ease), opacity 0.4s var(--ease);
            opacity: 0.7;
        }
        .blueprint-line.is-active {
            background: var(--accent);
            opacity: 1;
        }

        .blueprint-node {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            transform: rotate(var(--angle)) translate(var(--radius)) rotate(calc(-1 * var(--angle)));
        }
        .blueprint-node-btn {
            position: relative;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-family: inherit;
            color: inherit;
            white-space: nowrap;
        }
        .blueprint-node-btn:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
            border-radius: 8px;
        }
        .blueprint-node-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--bg);
            border: 1px solid var(--border-strong);
            transition: background 0.35s var(--ease), border-color 0.35s var(--ease), box-shadow 0.35s var(--ease), transform 0.3s var(--ease);
        }
        .blueprint-node-label {
            font-family: var(--font-mono);
            font-size: 10.5px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted-2);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.35s var(--ease), opacity 0.35s var(--ease);
            opacity: 0.75;
        }
        .blueprint-node-label .n {
            color: var(--muted-2);
            transition: color 0.35s var(--ease);
        }
        .blueprint-node.is-active .blueprint-node-dot {
            background: var(--accent);
            border-color: var(--accent);
            box-shadow: 0 0 0 5px var(--accent-dim);
            transform: scale(1.2);
        }
        .blueprint-node.is-active .blueprint-node-label {
            color: var(--text);
            opacity: 1;
        }
        .blueprint-node.is-active .blueprint-node-label .n {
            color: var(--accent);
        }
        .blueprint:hover .blueprint-node:not(.is-active) .blueprint-node-label {
            opacity: 0.45;
        }

        /* ===== CORE (center) ===== */
        .core-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 268px;
            height: 268px;
            border: 1px solid var(--border-strong);
            border-radius: 20px;
            background: color-mix(in srgb, var(--surface) 88%, transparent);
            backdrop-filter: blur(6px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 28px;
            z-index: 2;
        }
        .core-center::before {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid var(--border);
            border-radius: 14px;
            pointer-events: none;
        }
        .core-center::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 20px;
            box-shadow: 0 0 0 0 var(--accent-dim);
            animation: core-breathe 4s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes core-breathe {
            0%, 100% { box-shadow: 0 0 0 0 var(--accent-dim); }
            50% { box-shadow: 0 0 0 8px var(--accent-dim); }
        }
        .core-idle-tag {
            font-family: var(--font-mono);
            font-size: 9.5px;
            letter-spacing: 0.12em;
            color: var(--muted-2);
            margin-bottom: 14px;
        }
        .core-progress {
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: 0.08em;
            color: var(--accent);
            margin-bottom: 14px;
        }
        .core-micro {
            width: 64px;
            height: 40px;
            margin-bottom: 14px;
        }
        .core-micro svg {
            width: 100%;
            height: 100%;
            overflow: visible;
        }
        .core-micro-path {
            fill: none;
            stroke: var(--accent-2);
            stroke-width: 1.4;
            opacity: 0.85;
        }
        .core-micro-dot {
            fill: var(--accent);
        }
        .core-num {
            font-family: var(--font-mono);
            font-size: 13px;
            color: var(--muted-2);
            margin-bottom: 6px;
        }
        .core-title {
            font-family: var(--font-head);
            font-size: 20px;
            font-weight: 600;
            letter-spacing: -0.01em;
            margin-bottom: 10px;
            min-height: 26px;
        }
        .core-desc {
            font-size: 13.5px;
            color: var(--muted);
            line-height: 1.55;
            max-width: 200px;
        }

        .core-content-inner {
            opacity: 1;
            transition: opacity 0.28s ease;
        }
        .core-content-inner.is-swapping {
            opacity: 0;
        }

        /* ===== MOBILE ===== */
        .core-mobile {
            display: none;
        }
        @media (max-width: 900px) {
            .blueprint { display: none; }
            .core-mobile { display: block; margin-top: 48px; }

            .core-mobile-panel {
                position: relative;
                border: 1px solid var(--border-strong);
                border-radius: 18px;
                background: var(--surface);
                padding: 32px 24px;
                text-align: center;
                margin-bottom: 32px;
            }
            .core-mobile-panel::before {
                content: "";
                position: absolute;
                inset: 8px;
                border: 1px solid var(--border);
                border-radius: 12px;
                pointer-events: none;
            }
            .core-mobile .core-micro { margin: 0 auto 14px; }

            .core-mobile-nodes {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 10px;
            }
            .core-mobile-node {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
                background: none;
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 12px 4px;
                font-family: inherit;
                color: var(--muted-2);
                cursor: pointer;
                transition: border-color 0.3s ease, color 0.3s ease;
            }
            .core-mobile-node .dot {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: var(--bg);
                border: 1px solid var(--border-strong);
                transition: background 0.3s ease, border-color 0.3s ease;
            }
            .core-mobile-node span.lbl {
                font-family: var(--font-mono);
                font-size: 9px;
                letter-spacing: 0.04em;
            }
            .core-mobile-node.is-active {
                border-color: var(--accent);
                color: var(--text);
            }
            .core-mobile-node.is-active .dot {
                background: var(--accent);
                border-color: var(--accent);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .core-center::after { animation: none; }
            .core-content-inner { transition: none; }
        }

        /* ===== TECH STACK ===== */
        .stack-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
        }
        .stack-cell {
            background: var(--surface);
            padding: 32px 24px;
            transition: background 0.25s ease;
        }
        .stack-cell:hover {
            background: var(--card);
        }
        .stack-cell .cat {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 14px;
            display: block;
        }
        .stack-cell ul {
            list-style: none;
        }
        .tech-chip {
            color: var(--muted);
            font-size: 14px;
            padding: 6px 0;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px dashed transparent;
            transition: color 0.2s ease, border-color 0.2s ease;
        }
        .tech-chip:hover {
            color: var(--text);
            border-color: var(--border);
        }
        .tech-chip .stars {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--accent);
            opacity: 0.7;
        }
        .tech-popover {
            position: absolute;
            z-index: 60;
            width: 260px;
            background: var(--surface-2);
            border: 1px solid var(--border-strong);
            border-radius: var(--radius-sm);
            padding: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
        }
        .tech-popover.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .tech-popover h5 {
            font-size: 14px;
            margin-bottom: 6px;
        }
        .tech-popover p {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 10px;
        }
        .tech-popover .tp-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .tech-popover .tp-chip {
            font-family: var(--font-mono);
            font-size: 10.5px;
            border: 1px solid var(--border);
            padding: 3px 8px;
            border-radius: 100px;
            color: var(--muted);
        }

        /* ===== CASE STUDY (projects) ===== */
        .case-study {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 64px;
        }
        .case-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 48px;
            gap: 24px;
            flex-wrap: wrap;
        }
        .case-top h3 {
            font-size: clamp(28px, 3.2vw, 40px);
        }
        .case-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .chip {
            font-family: var(--font-mono);
            font-size: 12px;
            border: 1px solid var(--border);
            padding: 6px 14px;
            border-radius: 100px;
            color: var(--muted);
        }
        .case-cols {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 48px;
        }
        .case-cols h4 {
            font-size: 14px;
            color: var(--accent);
            margin-bottom: 10px;
            font-family: var(--font-mono);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .case-cols p {
            color: var(--muted);
            font-size: 14.5px;
        }
        .case-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 48px;
        }
        .case-feature {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            font-size: 14px;
            color: var(--muted);
        }
        .case-feature b {
            display: block;
            color: var(--text);
            font-size: 15px;
            margin-bottom: 4px;
        }
        .case-shot {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 48px;
            background: var(--card);
        }
        .case-results {
            display: flex;
            gap: 56px;
            flex-wrap: wrap;
            margin-bottom: 36px;
        }
        .result b {
            font-family: var(--font-mono);
            font-size: 26px;
            color: var(--accent);
            display: block;
        }
        .result span {
            color: var(--muted);
            font-size: 13px;
        }
        .case-open-btn {
            margin-top: 8px;
        }

        /* ===== MOCKUP ===== */
        .mockup {
            padding: 20px;
        }
        .mockup-window {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }
        .mockup-topbar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }
        .mockup-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--border-strong);
        }
        .mockup-title {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted);
            margin-left: 8px;
        }
        .mockup-body {
            display: grid;
            grid-template-columns: 150px 1fr;
            min-height: 280px;
        }
        .mockup-side {
            border-right: 1px solid var(--border);
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .mockup-side .m-item {
            font-size: 11.5px;
            color: var(--muted);
            padding: 8px 10px;
            border-radius: 6px;
        }
        .mockup-side .m-item.active {
            background: var(--accent-dim);
            color: var(--accent);
        }
        .mockup-main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .mockup-kpis {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .mockup-kpi {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px;
        }
        .mockup-kpi b {
            display: block;
            font-family: var(--font-mono);
            color: var(--accent);
            font-size: 18px;
        }
        .mockup-kpi span {
            font-size: 10.5px;
            color: var(--muted);
        }
        .mockup-chart {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px;
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 100px;
        }
        .mockup-chart i {
            flex: 1;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            border-radius: 3px 3px 0 0;
            opacity: 0.75;
        }
        .mockup-table-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 0.6fr;
            gap: 8px;
            font-size: 11px;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            padding: 8px 0;
        }
        .mockup-table-row.head {
            color: var(--text);
            font-family: var(--font-mono);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-pill {
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 100px;
            display: inline-block;
        }
        .status-pill.ok {
            background: var(--accent-dim);
            color: var(--accent);
        }
        .status-pill.wait {
            background: rgba(255, 193, 7, 0.12);
            color: #ffc107;
        }

        /* ===== PROJECTS GRID ===== */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
        .project-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 32px;
            background: var(--card);
            position: relative;
            overflow: hidden;
            transition: transform 0.35s ease, border-color 0.35s ease;
            cursor: pointer;
        }
        .project-card:hover {
            transform: translateY(-6px);
            border-color: rgba(22, 119, 255, 0.35);
        }
        .project-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }
        .project-index {
            font-family: var(--font-mono);
            color: var(--muted);
            font-size: 13px;
        }
        .project-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .project-card p {
            color: var(--muted);
            font-size: 14.5px;
            margin-bottom: 20px;
        }
        .project-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }
        .tag {
            font-size: 11.5px;
            font-family: var(--font-mono);
            color: var(--accent-2);
            border: 1px solid var(--border);
            padding: 4px 10px;
            border-radius: 100px;
        }
        .project-metrics {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            border-top: 1px solid var(--border);
            padding-top: 16px;
        }
        .project-metrics .pm {
            font-size: 12px;
            color: var(--muted);
        }
        .project-metrics .pm b {
            color: var(--accent);
            font-family: var(--font-mono);
            display: block;
            font-size: 16px;
        }
        .project-expand {
            position: absolute;
            bottom: 20px;
            right: 24px;
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ===== SERVICES ===== */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .service-card {
            padding: 36px 28px;
            border: 1px solid var(--border);
            border-radius: 16px;
            transition: border-color 0.3s ease;
        }
        .service-card:hover {
            border-color: rgba(22, 119, 255, 0.3);
        }
        .service-num {
            font-family: var(--font-mono);
            color: var(--accent);
            font-size: 13px;
            margin-bottom: 20px;
            display: block;
        }
        .service-card h3 {
            font-size: 20px;
            margin-bottom: 12px;
        }
        .service-card p {
            color: var(--muted);
            font-size: 14.5px;
        }

        /* ===== PHILOSOPHY ===== */
        .philosophy {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        .phil-card {
            border-left: 2px solid var(--accent);
            padding: 8px 0 8px 24px;
        }
        .phil-card h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }
        .phil-card p {
            color: var(--muted);
            font-size: 14.5px;
        }

        /* ===== WHY HIRE — working relationship ===== */
        .why-journey-label { font: 11px var(--font-mono); letter-spacing:.12em; color:var(--muted-2); margin-bottom:8px; }
        .why-rail { position:relative; display:grid; grid-template-columns:repeat(4,1fr); margin-bottom:72px; }
        .why-rail-line{position:absolute;top:5px;left:12.5%;right:12.5%;height:1px;background:var(--border)}
        .why-rail-fill{height:100%;width:0;background:linear-gradient(90deg,var(--accent),var(--accent-2));transition:width .5s var(--ease)}
        .why-node-col{display:flex;flex-direction:column;align-items:center;position:relative;background:none;border:0;color:inherit;cursor:pointer}
        .why-node-col:focus-visible{outline:none}
        .why-node-col:focus-visible .why-node{box-shadow:0 0 0 5px var(--accent-dim),0 0 0 2px var(--accent)}
        .why-node{width:11px;height:11px;border-radius:50%;background:var(--bg);border:1px solid var(--border-strong);z-index:1;transition:all .25s var(--ease)}
        .why-node-num{font:12px var(--font-mono);margin-top:18px;color:var(--muted-2);transition:color .25s var(--ease)}
        .why-node-name{font:11px var(--font-mono);letter-spacing:.08em;text-transform:uppercase;color:var(--muted-2);margin-top:4px;transition:color .25s var(--ease)}
        .why-node-col.is-active .why-node{background:var(--accent);border-color:var(--accent);box-shadow:0 0 0 5px var(--accent-dim)}
        .why-node-col.is-active .why-node-num{color:var(--accent)}
        .why-node-col.is-active .why-node-name{color:var(--text)}
        .why-scroll-host{position:relative}.why-sticky{position:sticky;top:96px}.why-scroll-spacer{height:60vh}.why-scroll-spacer:last-child{height:20vh}.why-stage-wrap{display:grid;grid-template-columns:1.1fr 1fr;gap:64px;min-height:260px}.why-stage{display:none}.why-stage.is-active{display:block}.why-stage-tag{font:12px var(--font-mono);color:var(--accent);margin-bottom:20px}.why-stage-title{font:600 clamp(26px,3vw,36px)/1.15 var(--font-head);margin-bottom:20px}.why-stage-desc{color:var(--muted);font-size:16px;line-height:1.7;max-width:420px}.why-diagram{min-height:260px;padding:24px;border:1px solid var(--border);border-radius:var(--radius-md);background:var(--surface)}.why-diagram svg{width:100%;height:100%}.why-diagram-node{fill:var(--bg);stroke:var(--border-strong);transition:fill .25s var(--ease),stroke .25s var(--ease),transform .25s var(--ease)}.why-diagram-node.is-active{fill:var(--accent);stroke:var(--accent)}.why-diagram-path{stroke:var(--border);transition:stroke .25s var(--ease)}.why-diagram-path.is-drawn{stroke:var(--accent-2)}.why-diagram-label{font:10px var(--font-mono);fill:var(--muted-2);transition:fill .25s var(--ease),opacity .25s var(--ease);opacity:.7}.why-diagram-label.is-active{fill:var(--text);opacity:1}.why-diagram-group{opacity:0;transition:opacity .5s var(--ease)}.why-diagram-group.is-shown{opacity:1}.why-mobile-seq{display:none}@media(max-width:900px){.why-rail,.why-scroll-host{display:none}.why-mobile-seq{display:block}.why-mobile-item{padding:0 0 42px 30px;border-left:1px solid var(--border);position:relative}.why-mobile-item:before{content:"";position:absolute;left:-5px;top:3px;width:9px;height:9px;border-radius:50%;background:var(--accent)}.why-mobile-tag{font:12px var(--font-mono);color:var(--accent);margin-bottom:10px}.why-mobile-title{font:600 22px var(--font-head);margin-bottom:10px}.why-mobile-desc{color:var(--muted);line-height:1.65}}@media(prefers-reduced-motion:reduce){.why-diagram-group{opacity:1;transition:none}}

        .why-diagram-group[data-group="4"] .why-diagram-label { transform: translateY(24px); }

        /* ===== ACHIEVEMENTS ===== */
        .achieve-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        .achieve-cell {
            text-align: center;
            padding: 32px 16px;
            border: 1px solid var(--border);
            border-radius: 16px;
        }
        .achieve-cell b {
            font-family: var(--font-mono);
            font-size: 38px;
            color: var(--accent);
            display: block;
            margin-bottom: 8px;
        }
        .achieve-cell span {
            color: var(--muted);
            font-size: 13px;
        }

        /* ===== GITHUB DASHBOARD ===== */
        .github-dashboard {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            position: relative;
            transition: border-color 0.3s ease;
        }
        .github-dashboard:hover {
            border-color: var(--border-strong);
        }
        .github-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 32px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 16px;
            background: color-mix(in srgb, var(--surface-2) 50%, transparent);
        }
        .github-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .github-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--accent-dim);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 18px;
            font-weight: 700;
            font-family: var(--font-mono);
            transition: background 0.3s ease;
        }
        .github-header h3 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: -0.02em;
        }
        .github-header .gh-status {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--muted);
            font-family: var(--font-mono);
        }
        .github-header .gh-status .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.8); }
        }
        .github-controls {
            padding: 24px 32px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--surface-2) 30%, transparent);
        }
        .github-controls .input-wrap {
            flex: 1;
            min-width: 220px;
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 4px 4px 4px 18px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .github-controls .input-wrap:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }
        .github-controls .input-wrap .prefix {
            font-family: var(--font-mono);
            font-size: 13px;
            color: var(--muted-2);
            opacity: 0.7;
            white-space: nowrap;
        }
        .github-controls .input-wrap input {
            flex: 1;
            background: none;
            border: none;
            color: var(--text);
            font-size: 14px;
            font-family: var(--font-body);
            padding: 10px 0;
            min-width: 100px;
        }
        .github-controls .input-wrap input:focus {
            outline: none;
        }
        .github-controls .input-wrap input::placeholder {
            color: var(--muted-2);
            opacity: 0.6;
            font-size: 13px;
        }
        .github-controls .btn-load {
            background: var(--accent);
            color: #ffffff;
            border: none;
            padding: 10px 28px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-body);
        }
        .github-controls .btn-load:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(22, 119, 255, 0.3);
        }
        .github-controls .btn-load:active {
            transform: scale(0.97);
        }
        .github-controls .btn-load.loading {
            opacity: 0.6;
            pointer-events: none;
        }
        .github-controls .btn-load .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(0,0,0,0.1);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        .github-controls .btn-load.loading .spinner {
            display: inline-block;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .github-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            padding: 24px 32px;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--surface-2) 20%, transparent);
        }
        .github-stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            transition: border-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .github-stat-card:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }
        .github-stat-card .stat-value {
            font-family: var(--font-mono);
            font-size: 28px;
            font-weight: 600;
            color: var(--accent);
            display: block;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        .github-stat-card .stat-label {
            font-size: 12px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-family: var(--font-mono);
            margin-top: 4px;
            display: block;
        }
        .github-stat-card .stat-trend {
            position: absolute;
            top: 12px;
            right: 14px;
            font-size: 10px;
            color: var(--muted-2);
            font-family: var(--font-mono);
            opacity: 0.5;
        }
        .github-repos {
            padding: 24px 32px 16px;
            border-bottom: 1px solid var(--border);
        }
        .github-repos .repos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 8px;
        }
        .github-repos .repos-header h4 {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            font-family: var(--font-head);
        }
        .github-repos .repos-header .repo-count {
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--muted-2);
            background: var(--card);
            padding: 4px 12px;
            border-radius: 100px;
            border: 1px solid var(--border);
        }
        .repo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }
        .repo-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
        }
        .repo-card:hover {
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }
        .repo-card .repo-name {
            font-size: 15px;
            font-weight: 600;
            font-family: var(--font-head);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text);
        }
        .repo-card .repo-name .repo-icon {
            color: var(--muted-2);
            font-size: 14px;
            opacity: 0.6;
        }
        .repo-card .repo-name .repo-badge {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            background: var(--accent-dim);
            color: var(--accent);
            padding: 2px 8px;
            border-radius: 100px;
            font-family: var(--font-mono);
            font-weight: 500;
        }
        .repo-card .repo-desc {
            color: var(--muted);
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 40px;
        }
        .repo-card .repo-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
            font-size: 12px;
            color: var(--muted-2);
            font-family: var(--font-mono);
            border-top: 1px solid var(--border);
            padding-top: 14px;
        }
        .repo-card .repo-meta .lang {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .repo-card .repo-meta .lang .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .repo-card .repo-meta .stat {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .repo-card .repo-meta .stat .icon {
            opacity: 0.6;
        }
        .repo-card .repo-updated {
            font-size: 11px;
            color: var(--muted-2);
            font-family: var(--font-mono);
            margin-top: 10px;
            opacity: 0.6;
        }
        .github-activity {
            padding: 24px 32px 32px;
        }
        .github-activity .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }
        .github-activity .activity-header h4 {
            font-size: 15px;
            font-weight: 600;
            font-family: var(--font-head);
        }
        .github-activity .activity-header .activity-count {
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--muted-2);
        }
        .activity-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .activity-event {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 12px;
            font-family: var(--font-mono);
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: border-color 0.2s ease;
            flex: 1 0 auto;
            max-width: 100%;
        }
        .activity-event .event-type {
            color: var(--accent);
            font-weight: 500;
        }
        .activity-event .event-repo {
            color: var(--text);
            font-weight: 500;
        }
        .activity-event .event-time {
            color: var(--muted-2);
            font-size: 10px;
            margin-left: auto;
            opacity: 0.6;
        }
        .activity-event:hover {
            border-color: var(--border-strong);
        }
        .github-empty {
            padding: 48px 32px;
            text-align: center;
            color: var(--muted);
            border-top: 1px solid var(--border);
        }
        .github-empty .empty-icon {
            font-size: 48px;
            opacity: 0.2;
            margin-bottom: 16px;
            display: block;
        }
        .github-empty h4 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--text);
            font-weight: 500;
        }
        .github-empty p {
            font-size: 14px;
            max-width: 480px;
            margin: 0 auto;
            color: var(--muted-2);
            line-height: 1.6;
        }
        .github-empty .empty-cta {
            margin-top: 20px;
            display: inline-block;
            padding: 8px 20px;
            border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 13px;
            color: var(--muted);
            font-family: var(--font-mono);
            transition: border-color 0.3s ease, color 0.3s ease;
            cursor: default;
        }
        .github-empty .empty-cta:hover {
            border-color: var(--accent);
            color: var(--text);
        }
        .github-error {
            padding: 32px;
            text-align: center;
            color: var(--danger);
            border-top: 1px solid var(--border);
        }
        .github-error .error-icon {
            font-size: 32px;
            opacity: 0.4;
            margin-bottom: 12px;
            display: block;
        }
        .github-error p {
            font-size: 14px;
            font-family: var(--font-mono);
        }

        /* ===== AI ASSISTANT ===== */
        .ai-panel {
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            background: var(--surface);
        }
        .ai-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 22px 28px;
            border-bottom: 1px solid var(--border);
        }
        .ai-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 12px var(--accent);
        }
        .ai-header b {
            font-size: 15px;
        }
        .ai-header span {
            color: var(--muted);
            font-size: 13px;
            margin-left: auto;
            font-family: var(--font-mono);
        }
        .ai-provider-select {
            font-family: var(--font-mono);
            font-size: 12px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--muted);
            border-radius: 8px;
            padding: 4px 8px;
        }
        .ai-body {
            min-height: 220px;
            max-height: 320px;
            overflow-y: auto;
            padding: 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .ai-msg {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14.5px;
            line-height: 1.55;
        }
        .ai-msg.bot {
            background: var(--card);
            border: 1px solid var(--border);
            align-self: flex-start;
        }
        .ai-msg.user {
            background: var(--accent-dim);
            border: 1px solid rgba(22, 119, 255, 0.3);
            align-self: flex-end;
        }
        .ai-typing {
            display: flex;
            gap: 4px;
            align-self: flex-start;
            padding: 12px 16px;
        }
        .ai-typing span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--muted);
            animation: blink 1.2s infinite;
        }
        .ai-typing span:nth-child(2) { animation-delay: 0.2s; }
        .ai-typing span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink {
            0%, 80%, 100% { opacity: 0.2; }
            40% { opacity: 1; }
        }
        .ai-suggestions {
            display: flex;
            gap: 10px;
            padding: 0 28px 20px;
            flex-wrap: wrap;
        }
        .ai-chip {
            font-family: var(--font-mono);
            font-size: 12.5px;
            border: 1px solid var(--border);
            padding: 8px 14px;
            border-radius: 100px;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.2s ease;
            background: none;
        }
        .ai-chip:hover {
            border-color: var(--accent);
            color: var(--text);
        }
        .ai-input-row {
            display: flex;
            border-top: 1px solid var(--border);
        }
        .ai-input-row input {
            flex: 1;
            background: none;
            border: none;
            color: var(--text);
            padding: 18px 28px;
            font-family: var(--font-body);
            font-size: 14.5px;
        }
        .ai-input-row input:focus {
            outline: none;
        }
        .ai-input-row button {
            background: var(--accent);
            border: none;
            color: #ffffff;
            padding: 0 26px;
            font-weight: 600;
        }
        .ai-security-note {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted-2);
            padding: 0 28px 18px;
        }

        /* ===== BLOG ===== */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .blog-card {
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 26px;
            transition: border-color 0.3s ease, transform 0.3s ease;
        }
        .blog-card:hover {
            border-color: rgba(22, 119, 255, 0.3);
            transform: translateY(-4px);
        }
        .blog-tag {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 14px;
            display: block;
        }
        .blog-card h3 {
            font-size: 17px;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        .blog-card p {
            color: var(--muted);
            font-size: 13.5px;
            margin-bottom: 16px;
        }
        .blog-meta {
            font-family: var(--font-mono);
            font-size: 11.5px;
            color: var(--muted-2);
        }

        /* ===== TERMINAL ===== */
        .terminal {
            background: #000;
            border: 1px solid var(--border-strong);
            border-radius: 14px;
            overflow: hidden;
            font-family: var(--font-mono);
        }
        [data-theme="light"] .terminal {
            background: #0d0f0e;
        }
        .terminal-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
        }
        .terminal-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        .terminal-dot.r { background: #ff5f56; }
        .terminal-dot.y { background: #ffbd2e; }
        .terminal-dot.g { background: #27c93f; }
        .terminal-title {
            color: var(--muted);
            font-size: 12px;
            margin-left: 8px;
        }
        .terminal-body {
            padding: 22px;
            height: 280px;
            overflow-y: auto;
            font-size: 13.5px;
            color: #c9f5d9;
        }
        .terminal-line {
            margin-bottom: 8px;
            white-space: pre-wrap;
            line-height: 1.6;
        }
        .terminal-line .prompt {
            color: var(--accent);
        }
        .terminal-input-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 22px 18px;
        }
        .terminal-input-row .prompt {
            color: var(--accent);
        }
        .terminal-input-row input {
            background: none;
            border: none;
            color: #c9f5d9;
            font-family: var(--font-mono);
            font-size: 13.5px;
            flex: 1;
        }
        .terminal-input-row input:focus {
            outline: none;
        }

        /* ===== DEV TOOLS / INDUSTRIES / LEARNING ===== */
        .chip-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .chip-grid .chip-item {
            font-family: var(--font-mono);
            font-size: 13px;
            border: 1px solid var(--border);
            padding: 8px 16px;
            border-radius: 100px;
            color: var(--muted);
        }

        /* ===== AVAILABILITY ===== */
        .avail-grid {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }
        .avail-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--muted);
            border: 1px solid var(--border);
            padding: 8px 14px;
            border-radius: 100px;
        }
        .avail-badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent);
        }

        /* ===== FAQ ===== */
        .faq-item {
            border-bottom: 1px solid var(--border);
        }
        .faq-q {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: var(--text);
            padding: 26px 0;
            font-family: var(--font-head);
            font-size: 17px;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        .faq-q .plus {
            font-family: var(--font-mono);
            color: var(--accent);
            transition: transform 0.3s ease;
        }
        .faq-item.open .plus {
            transform: rotate(45deg);
        }
        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }
        .faq-a p {
            color: var(--muted);
            font-size: 14.5px;
            padding-bottom: 26px;
            max-width: 640px;
        }

        /* ===== CONTACT — OPEN CHANNEL ===== */
        .channel-section{padding:160px 0 0}.channel-rule{height:1px;background:var(--border)}.channel-top{padding:96px 0 88px}.channel-eyebrow,.channel-open-to,.channel-info-rail span{font:11px var(--font-mono);letter-spacing:.1em;text-transform:uppercase;color:var(--accent)}.channel-heading{font:700 clamp(40px,6.2vw,84px)/1.04 var(--font-head);margin:28px 0 36px}.channel-heading .line{display:block;overflow:hidden}.channel-heading .line span{display:inline-block}.channel-status{font:12px var(--font-mono);color:var(--muted);margin-bottom:64px}.channel-status .dot{display:inline-block;width:7px;height:7px;margin-right:10px;border-radius:50%;background:var(--accent)}.channel-meta-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px}.channel-worktype{color:var(--muted)}.channel-worktype b{color:var(--border-strong);margin:0 8px}.channel-info-rail div{display:flex;justify-content:space-between;gap:20px;padding:16px 0;border-top:1px solid var(--border)}.channel-info-rail span{color:var(--muted-2)}.channel-info-rail a,.channel-info-rail em{color:var(--text);font-style:normal}.channel-form-wrap{padding:96px 0 120px}.channel-form{max-width:720px}.channel-field{position:relative;padding:26px 0 14px;border-bottom:1px solid var(--border)}.channel-field label{display:block;font:11px var(--font-mono);letter-spacing:.1em;text-transform:uppercase;color:var(--muted-2);margin-bottom:12px}.channel-field input,.channel-field textarea{width:100%;padding:0;border:0;background:none;color:var(--text);font:17px var(--font-body);resize:none}.channel-field input:focus,.channel-field textarea:focus{outline:0}.channel-field textarea{min-height:84px}.channel-field small{float:right;color:var(--muted-2);font:10px var(--font-mono)}.channel-field i{position:absolute;left:0;bottom:-1px;width:0;height:1px;background:var(--accent);transition:width .35s var(--ease)}.channel-field:focus-within i{width:100%}.channel-submit{margin-top:42px;padding:15px 30px;border:1px solid var(--border-strong);border-radius:999px;background:none;color:var(--text);font-weight:600;cursor:pointer}.channel-submit:hover{border-color:var(--accent)}.channel-result{display:none;max-width:600px;padding:28px 0;color:var(--muted);font-size:16px}.channel-result.is-shown{display:block}@media(max-width:900px){.channel-section{padding-top:90px}.channel-top,.channel-form-wrap{padding:56px 0}.channel-meta-grid{grid-template-columns:1fr;gap:40px}}

        /* ===== CONTACT ===== */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: start;
        }
        .contact-copy h2 {
            font-size: clamp(32px, 4vw, 52px);
            margin-bottom: 20px;
        }
        .contact-copy p {
            color: var(--muted);
            margin-bottom: 32px;
            max-width: 420px;
        }
        .contact-detail {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 32px;
        }
        .contact-detail a {
            font-family: var(--font-mono);
            font-size: 15px;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            padding-bottom: 14px;
            display: inline-flex;
            justify-content: space-between;
        }
        .contact-meta {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .contact-meta div {
            font-size: 13px;
            color: var(--muted);
            display: flex;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            padding-top: 10px;
        }
        .contact-meta b {
            color: var(--text);
            font-weight: 500;
        }
        .form-row {
            margin-bottom: 20px;
        }
        .form-row label {
            display: block;
            font-size: 12.5px;
            color: var(--muted);
            margin-bottom: 8px;
            font-family: var(--font-mono);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .form-row input,
        .form-row textarea {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 16px;
            color: var(--text);
            font-family: var(--font-body);
            font-size: 14.5px;
        }
        .form-row input:focus,
        .form-row textarea:focus {
            outline: none;
            border-color: var(--accent);
        }

        /* ===== FOOTER ===== */
        footer {
            border-top: 1px solid var(--border);
            padding: 56px 0 32px;
        }
        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 48px;
            flex-wrap: wrap;
            gap: 32px;
        }
        .footer-links {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }
        .footer-col span {
            display: block;
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 14px;
        }
        .footer-col a {
            display: block;
            color: var(--muted);
            font-size: 14px;
            padding: 5px 0;
            transition: color 0.2s ease;
        }
        .footer-col a:hover {
            color: var(--text);
        }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            color: var(--muted);
            font-size: 13px;
            border-top: 1px solid var(--border);
            padding-top: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* ===== COMMAND PALETTE ===== */
        .cmdk-overlay {
            position: fixed;
            inset: 0;
            z-index: 2000;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 12vh;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }
        .cmdk-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        .cmdk-box {
            width: min(560px, 90vw);
            background: var(--surface-2);
            border: 1px solid var(--border-strong);
            border-radius: 14px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transform: translateY(-14px);
            transition: transform 0.25s var(--ease);
        }
        .cmdk-overlay.open .cmdk-box {
            transform: translateY(0);
        }
        .cmdk-input-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
        }
        .cmdk-input-row input {
            flex: 1;
            background: none;
            border: none;
            color: var(--text);
            font-size: 15px;
            font-family: var(--font-body);
        }
        .cmdk-input-row input:focus {
            outline: none;
        }
        .cmdk-esc {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted-2);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 3px 6px;
        }
        .cmdk-list {
            max-height: 320px;
            overflow-y: auto;
            padding: 8px;
        }
        .cmdk-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            border-radius: 8px;
            color: var(--muted);
            font-size: 14px;
            cursor: pointer;
        }
        .cmdk-item.active,
        .cmdk-item:hover {
            background: var(--accent-dim);
            color: var(--text);
        }
        .cmdk-item span.k {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted-2);
        }
        .cmdk-empty {
            padding: 24px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        /* ===== PROJECT OVERLAY ===== */
        .overlay {
            position: fixed;
            inset: 0;
            z-index: 1500;
            background: var(--bg);
            transform: translateY(100%);
            transition: transform 0.55s var(--ease);
            overflow-y: auto;
        }
        .overlay.open {
            transform: translateY(0);
        }
        .overlay-close {
            position: fixed;
            top: 24px;
            right: 32px;
            z-index: 1600;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .overlay-nav {
            position: sticky;
            top: 0;
            z-index: 1400;
            background: color-mix(in srgb, var(--bg) 85%, transparent);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            display: flex;
            gap: 4px;
            overflow-x: auto;
            padding: 0 32px;
        }
        .overlay-nav button {
            background: none;
            border: none;
            color: var(--muted);
            font-family: var(--font-mono);
            font-size: 12.5px;
            padding: 18px 16px;
            white-space: nowrap;
            border-bottom: 2px solid transparent;
        }
        .overlay-nav button.active {
            color: var(--accent);
            border-color: var(--accent);
        }
        .overlay-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 64px 32px 120px;
        }
        .overlay-hero {
            margin-bottom: 64px;
        }
        .overlay-hero .eyebrow {
            margin-bottom: 20px;
        }
        .overlay-hero h1 {
            font-size: clamp(36px, 5vw, 60px);
            margin-bottom: 18px;
        }
        .overlay-hero p {
            color: var(--muted);
            font-size: 17px;
            max-width: 640px;
        }
        .ov-section {
            margin-bottom: 72px;
            scroll-margin-top: 80px;
        }
        .ov-section h2 {
            font-size: 26px;
            margin-bottom: 20px;
        }
        .ov-section p {
            color: var(--muted);
            font-size: 15.5px;
            margin-bottom: 14px;
            max-width: 720px;
        }
        .ov-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        .ov-list {
            list-style: none;
            color: var(--muted);
            font-size: 14.5px;
        }
        .ov-list li {
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            gap: 10px;
        }
        .ov-list li::before {
            content: "—";
            color: var(--accent);
        }
        .ov-metric-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 12px;
        }
        .ov-metric {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
        }
        .ov-metric b {
            display: block;
            font-family: var(--font-mono);
            color: var(--accent);
            font-size: 22px;
            margin-bottom: 4px;
        }
        .ov-metric span {
            font-size: 12px;
            color: var(--muted);
        }
        .ov-gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .ov-gallery-item {
            aspect-ratio: 16/10;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--card);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted-2);
            font-family: var(--font-mono);
            font-size: 12px;
        }
        .ov-links {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }
        .ov-diagram {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            background: var(--surface);
            overflow-x: auto;
        }
        .role-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .role-table th {
            text-align: left;
            font-family: var(--font-mono);
            font-size: 11px;
            text-transform: uppercase;
            color: var(--accent);
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }
        .role-table td {
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            color: var(--muted);
        }
        .timeline-mini {
            display: flex;
            flex-wrap: wrap;
            gap: 0;
        }
        .tm-step {
            flex: 1 1 140px;
            padding: 16px 0;
            border-top: 2px solid var(--border);
            position: relative;
        }
        .tm-step.done {
            border-color: var(--accent);
        }
        .tm-step b {
            display: block;
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--accent);
            margin-bottom: 4px;
        }
        .tm-step span {
            font-size: 13px;
            color: var(--muted);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero-grid, .about-grid, .case-cols, .case-features, .contact-grid, .ov-grid-2 {
                grid-template-columns: 1fr;
            }
            .stack-grid, .why-grid, .achieve-grid, .repo-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .services-grid, .projects-grid, .philosophy, .blog-grid {
                grid-template-columns: 1fr;
            }
            .ov-metric-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .ov-gallery {
                grid-template-columns: 1fr;
            }
            .nav-links {
                display: none;
            }
            .nav-toggle {
                display: block;
            }
            .hero-visual {
                height: 400px;
                margin-top: 40px;
            }
            .section {
                padding: 90px 0;
            }
            .case-study {
                padding: 32px;
            }
            body {
                cursor: auto;
            }
        }

        /* =================================================================== */
        /* SELECTED WORK — editorial system showcase */
        /* =================================================================== */
        .sw-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .sw-section { padding: 160px 0; position: relative; }
        .sw-head { margin-bottom: 88px; }
        .sw-head-top { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 22px; flex-wrap: wrap; gap: 10px; }
        .sw-eyebrow { font-family: var(--font-mono); font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--accent); display: flex; align-items: center; gap: 10px; }
        .sw-eyebrow::before { content: ""; width: 20px; height: 1px; background: var(--accent); }
        .sw-count { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted-2); }
        .sw-heading { font-family: var(--font-head); font-weight: 600; font-size: clamp(32px, 4vw, 48px); letter-spacing: -0.02em; margin-bottom: 16px; max-width: 720px; }
        .sw-sub { color: var(--muted); font-size: 17px; max-width: 560px; }
        .sw-list { border-top: 1px solid var(--border); }
        .sw-row {
            position: relative;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            border-bottom: 1px solid var(--border);
            border-radius: 0;
            padding: 72px 0;
            overflow: hidden;
            transition: border-color 0.4s var(--ease);
        }
        .sw-row:focus-visible { outline: 2px solid var(--accent); outline-offset: -2px; }
        .sw-row:hover, .sw-row:focus-visible, .sw-compact:hover, .sw-compact:focus-visible { transform: none; }
        .sw-ghost {
            position: absolute;
            top: -0.06em;
            font-family: var(--font-head);
            font-weight: 700;
            font-size: clamp(120px, 15vw, 230px);
            line-height: 1;
            color: var(--text);
            opacity: 0.035;
            pointer-events: none;
            user-select: none;
            z-index: 0;
            transition: opacity 0.4s var(--ease);
        }
        .sw-row:hover .sw-ghost, .sw-row:focus-visible .sw-ghost { opacity: 0.06; }
        .sw-row--01 .sw-ghost { right: -0.02em; }
        .sw-row--02 .sw-ghost { left: -0.02em; }
        .sw-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 56px;
            align-items: center;
        }
        .sw-row--01 .sw-grid { grid-template-columns: 0.86fr 1.14fr; }
        .sw-row--02 .sw-grid { grid-template-columns: 1.14fr 0.86fr; }
        .sw-copy { min-width: 0; }
        .sw-index-row { display: flex; align-items: center; gap: 18px; margin-bottom: 22px; }
        .sw-index { font-family: var(--font-mono); font-size: 13px; color: var(--muted-2); }
        .sw-status { display: inline-flex; align-items: center; font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); }
        .sw-status i { width: 6px; height: 6px; border-radius: 50%; background: var(--accent); display: inline-block; margin-right: 8px; }
        .sw-title { font-family: var(--font-head); font-weight: 600; font-size: clamp(26px, 2.6vw, 36px); letter-spacing: -0.01em; margin-bottom: 16px; }
        .sw-desc { color: var(--muted); font-size: 15.5px; line-height: 1.7; max-width: 460px; margin-bottom: 26px; }
        .sw-stack { display: flex; flex-wrap: wrap; margin-bottom: 30px; font-family: var(--font-mono); font-size: 12.5px; }
        .sw-stack span { color: var(--muted); }
        .sw-stack span:not(:last-child)::after { content: "·"; color: var(--muted-2); opacity: 0.6; margin: 0 12px; }
        .sw-specs { display: flex; border-top: 1px solid var(--border); padding-top: 22px; margin-bottom: 30px; }
        .sw-spec { display: flex; flex-direction: column; gap: 6px; padding: 0 26px; border-left: 1px solid var(--border); }
        .sw-spec:first-child { padding-left: 0; border-left: none; }
        .sw-spec-cat { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted-2); }
        .sw-spec b { font-family: var(--font-mono); font-weight: 500; font-size: 26px; color: var(--text); line-height: 1.1; }
        .sw-spec-unit { font-family: var(--font-mono); font-size: 10.5px; letter-spacing: 0.06em; text-transform: uppercase; color: var(--muted); }
        .sw-open { display: inline-flex; align-items: center; gap: 10px; font-family: var(--font-mono); font-size: 13px; letter-spacing: 0.06em; text-transform: uppercase; color: var(--text); position: relative; padding-bottom: 6px; }
        .sw-open::after { content: ""; position: absolute; left: 0; bottom: 0; width: 0%; height: 1px; background: var(--accent); transition: width 0.4s var(--ease); }
        .sw-row:hover .sw-open::after, .sw-row:focus-visible .sw-open::after { width: 100%; }
        .sw-arrow { transition: transform 0.4s var(--ease); color: var(--accent); }
        .sw-row:hover .sw-arrow, .sw-row:focus-visible .sw-arrow { transform: translateX(6px); }
        .sw-visual { position: relative; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; background: var(--surface); transition: border-color 0.4s var(--ease); }
        .sw-row:hover .sw-visual, .sw-row:focus-visible .sw-visual { border-color: var(--border-strong); }
        .sw-visual-inner { transition: transform 0.7s var(--ease); will-change: transform; }
        .sw-row:hover .sw-visual-inner, .sw-row:focus-visible .sw-visual-inner { transform: scale(1.02); }
        .sw-pair { display: grid; grid-template-columns: 1fr 1fr; }
        .sw-compact {
            position: relative;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            border-radius: 0;
            padding: 56px 40px 56px 0;
            overflow: hidden;
        }
        .sw-pair .sw-compact:last-child { padding-left: 40px; padding-right: 0; border-left: 1px solid var(--border); }
        .sw-compact:focus-visible { outline: 2px solid var(--accent); outline-offset: -2px; }
        .sw-compact .sw-ghost { font-size: clamp(80px, 8vw, 130px); top: -0.05em; right: -0.02em; }
        .sw-compact-visual { position: relative; z-index: 1; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; background: var(--surface); aspect-ratio: 16/10; margin-bottom: 26px; transition: border-color 0.4s var(--ease); }
        .sw-compact:hover .sw-compact-visual, .sw-compact:focus-visible .sw-compact-visual { border-color: var(--border-strong); }
        .sw-compact-visual .sw-visual-inner { height: 100%; }
        .sw-compact-body { position: relative; z-index: 1; }
        .sw-compact .sw-title { font-size: 21px; margin-bottom: 10px; }
        .sw-compact .sw-desc { font-size: 14px; margin-bottom: 18px; }
        .sw-compact .sw-index-row { margin-bottom: 14px; }
        .sw-meta-line { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.04em; color: var(--muted-2); margin-bottom: 18px; }
        .sw-meta-line b { color: var(--muted); font-weight: 500; }
        @media (max-width: 1100px) {
            .sw-row--01 .sw-grid, .sw-row--02 .sw-grid { grid-template-columns: 1fr; gap: 40px; }
            .sw-row--02 .sw-copy { order: 1; }
            .sw-row--02 .sw-visual { order: 2; }
            .sw-ghost { display: none; }
        }
        @media (max-width: 900px) {
            .sw-section { padding: 90px 0; }
            .sw-head { margin-bottom: 56px; }
            .sw-row { padding: 48px 0; }
            .sw-specs { flex-wrap: wrap; row-gap: 18px; }
            .sw-pair { grid-template-columns: 1fr; }
            .sw-pair .sw-compact { padding: 40px 0; border-bottom: 1px solid var(--border); }
            .sw-pair .sw-compact:last-child { padding-left: 0; border-left: none; border-bottom: none; }
        }
        @media (prefers-reduced-motion: reduce) {
            .sw-row, .sw-compact, .sw-ghost, .sw-visual-inner, .sw-open::after, .sw-arrow {
                transition: none !important;
            }
        }
        .sw-reveal { opacity: 1; }
        .js-sw .sw-reveal { opacity: 0; }
        .js-sw .sw-row-copy-el { opacity: 0; transform: translateY(22px); }
        .js-sw .sw-visual { clip-path: inset(0 0 100% 0); }
        .js-sw .sw-compact-visual { clip-path: inset(0 0 100% 0); }

        /* =================================================================== */
        /* SELECTED WORK — PROJECT CARDS */
        /* =================================================================== */
        .projects-section {
            padding: 140px 0 180px;
            position: relative;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            position: relative;
            z-index: 2;
        }

        .project-card {
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 36px 32px 32px;
            background: var(--card);
            backdrop-filter: blur(8px);
            transition: all 0.5s cubic-bezier(0.16, 0.84, 0.44, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-height: 320px;
            display: flex;
            flex-direction: column;
        }

        .project-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent-dim) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.5s cubic-bezier(0.16, 0.84, 0.44, 1);
            pointer-events: none;
        }

        .project-card:hover {
            transform: translateY(-6px);
            border-color: var(--border-strong);
        }

        .project-card:hover::before {
            opacity: 1;
        }

        .project-card-inner {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .project-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .project-index {
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--muted-2);
            letter-spacing: 0.04em;
        }

        .project-status {
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--accent);
            padding: 4px 12px;
            border: 1px solid var(--accent-dim);
            border-radius: 100px;
            background: rgba(22, 119, 255, 0.05);
        }

        .project-title {
            font-family: var(--font-head);
            font-size: 22px;
            font-weight: 600;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
            color: var(--text);
        }

        .project-description {
            color: var(--muted);
            font-size: 14.5px;
            line-height: 1.6;
            margin-bottom: 20px;
            flex: 1;
        }

        .project-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .project-tags .tag {
            font-size: 11px;
            font-family: var(--font-mono);
            color: var(--accent-2);
            border: 1px solid var(--border);
            padding: 4px 12px;
            border-radius: 100px;
            background: rgba(0, 200, 255, 0.04);
        }

        .project-metrics {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            border-top: 1px solid var(--border);
            padding-top: 16px;
            margin-bottom: 20px;
        }

        .project-metrics .pm {
            font-size: 12px;
            color: var(--muted);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .project-metrics .pm b {
            color: var(--accent);
            font-family: var(--font-mono);
            font-size: 18px;
            font-weight: 500;
        }

        .project-metrics .pm span {
            font-size: 10.5px;
            color: var(--muted-2);
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .project-open-btn {
            background: none;
            border: none;
            color: var(--muted);
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 500;
            padding: 0;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
            align-self: flex-start;
            position: relative;
        }

        .project-open-btn::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--accent);
            transition: width 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
        }

        .project-open-btn:hover {
            color: var(--accent);
        }

        .project-open-btn:hover::after {
            width: 100%;
        }

        .project-open-arrow {
            display: inline-block;
            transition: transform 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
        }

        .project-open-btn:hover .project-open-arrow {
            transform: translateX(4px);
        }

        /* =================================================================== */
        /* CASE STUDY OVERLAY */
        /* =================================================================== */
        .case-study-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: var(--bg);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.6s cubic-bezier(0.16, 0.84, 0.44, 1),
                        visibility 0.6s cubic-bezier(0.16, 0.84, 0.44, 1);
            overflow: hidden;
        }

        .case-study-overlay.open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .case-study-overlay-inner {
            width: 100%;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 40px 32px 80px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .case-study-overlay-inner::-webkit-scrollbar {
            width: 4px;
        }

        .case-study-overlay-inner::-webkit-scrollbar-track {
            background: transparent;
        }

        .case-study-overlay-inner::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 2px;
        }

        .case-study-close {
            position: fixed;
            top: 24px;
            right: 32px;
            z-index: 1001;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--muted);
            font-size: 20px;
            font-weight: 300;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
            opacity: 0;
            transform: scale(0.8) rotate(-90deg);
            pointer-events: none;
            backdrop-filter: blur(8px);
            font-family: var(--font-body);
            line-height: 1;
        }

        .case-study-overlay.open .case-study-close {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            pointer-events: auto;
        }

        .case-study-close:hover {
            border-color: var(--accent);
            color: var(--text);
            transform: scale(1.05) rotate(90deg);
        }

        .case-study-close:active {
            transform: scale(0.95);
        }

        .case-study-close:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        .case-study-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px 0;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 0.84, 0.44, 1),
                        transform 0.8s cubic-bezier(0.16, 0.84, 0.44, 1);
        }

        .case-study-overlay.open .case-study-content {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.15s;
        }

        .case-study-hero {
            margin-bottom: 64px;
            padding-top: 20px;
        }

        .case-study-hero .case-number {
            font-family: var(--font-mono);
            font-size: 13px;
            color: var(--accent);
            letter-spacing: 0.12em;
            opacity: 0;
            transform: translateY(10px);
            animation: case-reveal 0.6s 0.3s forwards;
        }

        .case-study-hero h1 {
            font-family: var(--font-head);
            font-size: clamp(40px, 6vw, 72px);
            font-weight: 700;
            line-height: 1.08;
            letter-spacing: -0.02em;
            margin: 16px 0 20px;
            color: var(--text);
            opacity: 0;
            transform: translateY(20px);
            animation: case-reveal 0.7s 0.4s forwards;
        }

        .case-study-hero .case-subtitle {
            font-size: 18px;
            line-height: 1.6;
            color: var(--muted);
            max-width: 640px;
            opacity: 0;
            transform: translateY(15px);
            animation: case-reveal 0.6s 0.5s forwards;
        }

        .case-tech-stack {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin: 24px 0 32px;
            opacity: 0;
            transform: translateY(10px);
            animation: case-reveal 0.5s 0.6s forwards;
        }

        .case-tech-stack .tech-pill {
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.06em;
            color: var(--muted-2);
            padding: 6px 16px;
            border: 1px solid var(--border);
            border-radius: 100px;
            background: rgba(255, 255, 255, 0.02);
        }

        .case-metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
            margin: 32px 0 48px;
            padding: 32px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            opacity: 0;
            transform: translateY(10px);
            animation: case-reveal 0.5s 0.7s forwards;
        }

        .case-metric-item {
            text-align: center;
        }

        .case-metric-item .metric-value {
            font-family: var(--font-mono);
            font-size: 32px;
            font-weight: 600;
            color: var(--accent);
            display: block;
            line-height: 1.2;
        }

        .case-metric-item .metric-label {
            font-size: 12px;
            color: var(--muted-2);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-family: var(--font-mono);
            margin-top: 4px;
        }

        .case-section {
            margin-bottom: 56px;
            opacity: 0;
            transform: translateY(15px);
            animation: case-reveal 0.6s 0.9s forwards;
        }

        .case-section:not(:first-of-type) {
            animation-delay: 1s;
        }

        .case-section:nth-child(3) {
            animation-delay: 1.1s;
        }

        .case-section:nth-child(4) {
            animation-delay: 1.2s;
        }

        .case-section:nth-child(5) {
            animation-delay: 1.3s;
        }

        .case-section-label {
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 12px;
            display: block;
        }

        .case-section h2 {
            font-family: var(--font-head);
            font-size: clamp(24px, 3vw, 36px);
            font-weight: 600;
            letter-spacing: -0.02em;
            margin-bottom: 16px;
            color: var(--text);
        }

        .case-section p {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
            max-width: 720px;
        }

        .case-section ul {
            list-style: none;
            margin-top: 12px;
        }

        .case-section ul li {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.6;
            padding: 6px 0 6px 24px;
            position: relative;
        }

        .case-section ul li::before {
            content: '—';
            position: absolute;
            left: 0;
            color: var(--accent);
        }

        .case-gallery {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin: 32px 0;
            opacity: 0;
            transform: translateY(10px);
            animation: case-reveal 0.7s 1.3s forwards;
        }

        .case-gallery--single {
            grid-template-columns: 1fr;
        }

        .case-gallery-item {
            aspect-ratio: 16/10;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            overflow: hidden;
            background: var(--surface-2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted-2);
            font-family: var(--font-mono);
            font-size: 12px;
            transition: border-color 0.3s ease;
        }

        .case-gallery-item:hover {
            border-color: var(--border-strong);
        }

        .case-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .case-gallery-item.placeholder {
            background: repeating-linear-gradient(
                45deg,
                var(--surface-2) 0px,
                var(--surface-2) 10px,
                var(--surface) 10px,
                var(--surface) 20px
            );
        }

        .case-gallery-item:first-child {
            grid-row: span 2;
            aspect-ratio: 16/18;
        }

        .case-gallery-item:last-child {
            aspect-ratio: 16/8;
        }

        .case-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 48px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 16px;
        }

        .case-nav-btn {
                display: flex;
            border: none;
            color: var(--muted);
            font-family: var(--font-body);
            font-size: 14px;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 8px;
        }

        .case-nav-btn:hover {
            color: var(--text);
            background: var(--surface-2);
        }

        .case-nav-btn .nav-arrow {
            display: inline-block;
            transition: transform 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
        }

        .case-nav-btn:hover .nav-arrow {
            transform: translateX(4px);
        }

        .case-nav-btn.prev:hover .nav-arrow {
            transform: translateX(-4px);
        }

        .case-nav-back {
            color: var(--accent);
            font-weight: 500;
        }

        .case-nav-back:hover {
            color: var(--accent-2);
        }

        @keyframes case-reveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .projects-section {
                padding: 80px 0 120px;
            }

            .projects-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .project-card {
                padding: 28px 24px 24px;
                min-height: 280px;
            }

            .project-title {
                font-size: 20px;
            }

            .project-description {
                font-size: 14px;
            }

            .project-metrics .pm b {
                font-size: 16px;
            }

            .case-study-overlay-inner {
                padding: 80px 20px 60px;
            }

            .case-study-close {
                top: 16px;
                right: 16px;
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .case-study-hero h1 {
                font-size: clamp(32px, 5vw, 44px);
            }

            .case-study-hero .case-subtitle {
                font-size: 16px;
            }

            .case-metrics-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 24px 0;
            }

            .case-metric-item .metric-value {
                font-size: 28px;
            }

            .case-gallery {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .case-gallery-item:first-child {
                grid-row: span 1;
                aspect-ratio: 16/10;
            }

            .case-gallery-item:last-child {
                aspect-ratio: 16/10;
            }

            .case-section {
                margin-bottom: 40px;
            }

            .case-section h2 {
                font-size: clamp(22px, 4vw, 30px);
            }

            .case-section p {
                font-size: 15px;
            }

            .case-navigation {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .case-nav-btn {
                    display: flex;
                padding: 12px 16px;
            }
        }

        @media (max-width: 480px) {
            .project-card {
                padding: 20px 18px 20px;
                min-height: 240px;
                border-radius: var(--radius-md);
            }

            .project-title {
                font-size: 18px;
            }

            .project-metrics {
                gap: 16px;
            }

            .project-metrics .pm b {
                font-size: 14px;
            }

            .project-open-btn {
                font-size: 12px;
            }

            .case-study-overlay-inner {
                padding: 72px 16px 48px;
            }

            .case-study-close {
                top: 12px;
                right: 12px;
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .case-study-hero h1 {
                font-size: clamp(28px, 6vw, 36px);
            }

            .case-metrics-grid {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            .case-metric-item .metric-value {
                font-size: 24px;
            }

            .case-tech-stack .tech-pill {
                font-size: 10px;
                padding: 4px 12px;
            }

            .case-section ul li {
                font-size: 14px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .project-card {
                transition: none !important;
            }

            .project-card::before {
                display: none !important;
            }

            .project-open-btn::after {
                display: none !important;
            }

            .project-open-arrow {
                transition: none !important;
            }

            .case-study-overlay {
                transition: opacity 0.3s ease;
            }

            .case-study-content {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }

            .case-study-hero .case-number,
            .case-study-hero h1,
            .case-study-hero .case-subtitle,
            .case-tech-stack,
            .case-metrics-grid,
            .case-section,
            .case-gallery {
                opacity: 1 !important;
                transform: none !important;
                animation: none !important;
            }

            .case-study-close {
                transition: opacity 0.3s ease;
            }

            .case-study-close:hover {
                transform: none !important;
            }
        }

        /* ===== LOADER STYLES ===== */
        #loader.loader-screen {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: color-mix(in srgb, var(--bg, #050505) 95%, #000 5%);
            color: var(--text, #fff);
            font-family: var(--font-mono, "JetBrains Mono", monospace);
            transition: opacity 620ms var(--ease, cubic-bezier(0.16, 0.84, 0.44, 1)), visibility 620ms var(--ease, cubic-bezier(0.16, 0.84, 0.44, 1));
        }

        #loader.loader-screen::before {
            content: "";
            position: absolute;
            inset: -20%;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px),
                radial-gradient(circle, rgba(22, 119, 255, 0.14), transparent 68%);
            background-size: 58px 58px, 58px 58px, 100% 100%;
            transform: scale(1.02);
            opacity: 0.72;
            pointer-events: none;
        }

        #loader.loader-screen::after {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                180deg,
                transparent 0px,
                transparent 2px,
                rgba(255,255,255,0.035) 3px
            );
            pointer-events: none;
            opacity: 0.55;
        }

        #loader.loader-screen .loader-shell {
            position: relative;
            width: min(680px, calc(100vw - 40px));
            padding: 34px 34px 30px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(13, 13, 13, 0.88);
            backdrop-filter: blur(15px);
            box-shadow: inset 0 0 30px rgba(22, 119, 255, 0.05), 0 25px 80px rgba(0,0,0,0.55);
        }

        #loader.loader-screen .loader-shell::before {
            content: "SYS//";
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 10px;
            color: var(--muted, #9ca3af);
            letter-spacing: 0.1em;
            opacity: 0.88;
        }

        #loader.loader-screen .loader-brand {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 24px;
        }

        #loader.loader-screen .loader-mark {
            font-family: var(--font-head, "Space Grotesk", sans-serif);
            font-size: clamp(28px, 4vw, 38px);
            font-weight: 700;
            line-height: 1;
            letter-spacing: 0.12em;
            color: var(--text, #fff);
        }

        #loader.loader-screen .loader-system {
            color: var(--accent, #1677FF);
            font-size: 10px;
            font-weight: 500;
            line-height: 1;
            letter-spacing: 0.22em;
            text-transform: uppercase;
        }

        #loader.loader-screen .loader-diagnostics {
            border-top: 1px solid rgba(255,255,255,0.08);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding-top: 14px;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }

        #loader.loader-screen .loader-diagnostic-head {
            font-size: 10px;
            line-height: 1;
            color: var(--muted, #9ca3af);
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        #loader.loader-screen .loader-diagnostic-list {
            margin-top: 12px;
        }

        #loader.loader-screen .loader-diagnostic-row {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 23px;
            font-size: 10px;
            letter-spacing: 0.08em;
            color: var(--muted, #9ca3af);
            opacity: 0.62;
            transform: translateY(0);
            transition: opacity 260ms ease, color 260ms ease, transform 260ms ease;
        }

        #loader.loader-screen .loader-diagnostic-row.active {
            color: var(--text, #fff);
            opacity: 1;
        }

        #loader.loader-screen .loader-diagnostic-row.done {
            color: var(--accent, #1677FF);
            opacity: 1;
        }

        #loader.loader-screen .loader-scan {
            color: var(--accent, #1677FF);
        }

        #loader.loader-screen .loader-status-panel {
            display: grid;
            gap: 8px;
            margin-bottom: 20px;
        }

        #loader.loader-screen .loader-status-row {
            display: grid;
            grid-template-columns: minmax(170px, 210px) minmax(120px, auto);
            gap: 14px;
            align-items: center;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        #loader.loader-screen .loader-status-row:last-child {
            border-bottom: none;
        }

        #loader.loader-screen .loader-status-name {
            font-size: 9px;
            color: var(--muted, #9ca3af);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        #loader.loader-screen .loader-status-value {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 9px;
            color: var(--muted, #9ca3af);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        #loader.loader-screen .loader-status-value::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            border: 1px solid currentColor;
            display: inline-block;
            background: transparent;
        }

        #loader.loader-screen .loader-status-value.online {
            color: var(--accent, #1677FF);
        }

        #loader.loader-screen .loader-status-value.online::before {
            background: var(--accent, #1677FF);
            box-shadow: 0 0 0 1px rgba(22, 119, 255, 0.3) inset, 0 0 8px rgba(22, 119, 255, 0.7);
        }

        #loader.loader-screen .loader-stage-wrap {
            min-height: 44px;
            display: flex;
            align-items: center;
        }

        #loader.loader-screen .loader-stage {
            font-size: 12px;
            color: var(--text, #fff);
            letter-spacing: 0.12em;
            line-height: 1.5;
        }

        #loader.loader-screen .loader-progress {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 16px;
        }

        #loader.loader-screen .loader-bar {
            position: relative;
            width: 100%;
            height: 2px;
            overflow: hidden;
            background: rgba(255,255,255,0.08);
            border-radius: 99px;
        }

        #loader.loader-screen .loader-bar span {
            display: block;
            height: 100%;
            width: 0%;
            background: var(--accent, #1677FF);
            border-radius: inherit;
            box-shadow: 0 0 8px var(--accent, #1677FF);
            transition: width 60ms linear;
        }

        #loader.loader-screen .loader-pct {
            min-width: 50px;
            text-align: right;
            font-size: 11px;
            color: var(--accent, #1677FF);
            font-family: var(--font-mono, "JetBrains Mono", monospace);
        }

        #loader.loader-screen .loader-system-ready {
            margin-top: 16px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            min-height: 38px;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 300ms ease, transform 300ms ease;
        }

        #loader.loader-screen.loader-ready .loader-system-ready {
            opacity: 1;
            transform: translateY(0);
        }

        #loader.loader-screen .loader-ready-line {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.2em;
            color: var(--text, #fff);
        }

        #loader.loader-screen .loader-ready-line.secondary {
            color: var(--accent, #1677FF);
            font-size: 9px;
        }

        #loader.loader-screen.loader-exiting {
            opacity: 0;
            visibility: hidden;
        }

        #loader.loader-screen.loader-exiting .loader-shell {
            transform: translateY(-10px) scale(0.992);
        }

        @media (max-width: 640px) {
            #loader.loader-screen .loader-shell {
                padding: 26px 20px;
            }

            #loader.loader-screen .loader-status-row {
                grid-template-columns: 1fr auto;
            }

            #loader.loader-screen .loader-mark {
                font-size: 30px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            #loader.loader-screen,
            #loader.loader-screen .loader-shell,
            #loader.loader-screen .loader-diagnostic-row,
            #loader.loader-screen .loader-stage,
            #loader.loader-screen .loader-status-value,
            #loader.loader-screen .loader-system-ready {
                transition: none !important;
                animation: none !important;
            }

            #loader.loader-screen .loader-bar span {
                transition: none;
            }
        }

        /* Final narrow-screen safeguards */
        @media (max-width: 640px) {
            .container { width:100%; padding-left:20px; padding-right:20px; }
            .hero { padding-top:96px; }
            .hero-grid { grid-template-columns:minmax(0, 1fr); min-width:0; }
            .hero-copy { min-width:0; width:100%; }
            .hero-copy h1 { font-size:clamp(34px, 10.5vw, 50px); line-height:1.08; margin-bottom:20px; overflow-wrap:anywhere; }
            .hero-copy h1 .line span { white-space:normal; }
            .hero-sub { max-width:100%; font-size:16px; line-height:1.65; margin-bottom:28px; }
            .hero-rotate { min-width:8ch; }
            .hero-actions { flex-wrap:wrap; gap:10px; }
            .hero-actions a { flex:1 1 100%; min-height:48px; justify-content:center; text-align:center; }
            .hero-visual { height:320px; }
            .nav-right { gap:8px; }
            .nav-cta { padding:8px 12px; font-size:12px; }
            .nav-right .icon-btn { width:34px; height:34px; }
            .sw-section, .projects-section { overflow:hidden; }
            .sw-title, .sw-heading, .case-study-hero h1, .novexa-heading { overflow-wrap:anywhere; }
            .sw-specs { gap:16px; }
            .sw-spec { padding:0 14px; }
            .sw-spec:first-child { padding-left:0; }
            .novexa-header, .novexa-founder, .novexa-services, .novexa-principles, .novexa-cta { min-width:0; }
            .novexa-lead, .novexa-founder p, .novexa-cta p { overflow-wrap:anywhere; }
            .core-mobile-nodes { grid-template-columns:repeat(2, minmax(0, 1fr)); }
            .why-stage-wrap { min-width:0; }
            .why-diagram { min-width:0; padding:12px; overflow-x:auto; }
            .case-study-overlay-inner { width:100%; max-width:100%; }
            .case-tech-stack, .case-metrics-grid { min-width:0; }
            .case-metric-item { min-width:0; overflow-wrap:anywhere; }
            .role-table { min-width:520px; }
            .ov-diagram { max-width:100%; }
            .section-head, .services-header, .exp-header, .channel-top, .channel-info-rail, .github-dashboard, .terminal { min-width:0; max-width:100%; }
            .section-head h2, .services-header h2, .exp-heading, .channel-heading { overflow-wrap:anywhere; }
            .services-section, #github, #terminal-section, #blog, #faq, #contact, #process, #stack, #why { overflow:hidden; }
            .services-stack { min-height:560px; padding:24px 0; }
            .service-panel-inner { padding-left:20px; padding-right:20px; }
            .stack-grid, .achieve-grid, .repo-grid { grid-template-columns:1fr; }
            .channel-meta-grid, .channel-info-rail { gap:24px; }
            .channel-info-rail { display:grid; grid-template-columns:1fr; }
            .github-controls { flex-wrap:wrap; }
            .github-controls .input-wrap, .github-controls .btn-load { width:100%; min-width:0; }
            .github-controls .btn-load { min-height:44px; }
            .ai-float-trigger { touch-action:manipulation; }
            .hero-copy, .abt-section .container, .novexa-section .container, .exp-header,
            #process > .container > .section-head, #stack > .container > .section-head,
            #services .services-header, #projects > .container > .section-head,
            #work .sw-head, #context .container, #blog > .container > .section-head,
            #faq > .container > .section-head, #contact .channel-top { text-align:center; }
            .hero-copy .eyebrow, .abt-eyebrow-row, .hero-actions, .hero-stats,
            .novexa-cta-actions { justify-content:center; }
            .hero-sub, .abt-location, .novexa-lead, .exp-header { margin-left:auto; margin-right:auto; }
            .hero-copy h1 .line, .abt-line { overflow:visible; }
            .hero-copy h1 .line span, .abt-line { max-width:100%; overflow-wrap:anywhere; }
            .services-header, .section-head, .sw-head, .channel-top { margin-left:auto; margin-right:auto; }
            .novexa-founder, .novexa-cta { text-align:center; }
            .novexa-principle { border-left:0; border-top:2px solid var(--accent); padding:16px 0 0; }
            .btn-primary, .btn-secondary, .nav-cta, .project-open-btn, .case-nav-btn, .empty-cta {
                max-width:100%;
                white-space:normal;
                overflow-wrap:anywhere;
            }
            .section-head p, .services-subheading, .sw-sub { max-width:100%; margin-left:auto; margin-right:auto; }
            html, body, main, section, footer { max-width:100%; overflow-x:hidden; }
            .container, .section-head, .services-header, .services-stack, .projects-grid,
            .sw-list, .sw-grid, .sw-copy, .sw-visual, .novexa-section,
            .channel-top, .channel-meta-grid, .github-dashboard, .terminal { min-width:0; max-width:100%; }
            h1, h2, h3, h4, p, a, .eyebrow, .sw-status, .service-tag, .meta,
            .channel-worktype, .channel-info-rail, .terminal-title { max-width:100%; overflow-wrap:anywhere; }
            .hero-rotate .rot-word { white-space:normal; overflow-wrap:anywhere; }
            .nav-cta { text-align:center; }
        }

        @media (max-width: 480px) {
            .hero { min-height:auto; padding-top:104px; padding-bottom:64px; }
            .hero-grid { gap:28px; }
            .hero-copy { width:100%; text-align:center; }
            .hero-copy .eyebrow { justify-content:center; font-size:10px; letter-spacing:.08em; }
            .hero-copy h1 { font-size:clamp(30px, 9.6vw, 42px); line-height:1.1; letter-spacing:-.02em; }
            .hero-copy h1 .line { display:block; width:100%; overflow:visible; }
            .hero-copy h1 .line span { display:inline-block; max-width:100%; white-space:normal; }
            .hero-sub { width:100%; font-size:15px; line-height:1.6; }
            .hero-actions { width:100%; align-items:stretch; }
            .hero-actions a { width:100%; min-width:0; padding-left:18px; padding-right:18px; }
            .hero-stats { width:100%; gap:20px; justify-content:center; }
            .hero-stat { min-width:0; flex:1 1 90px; }
            .hero-stat b, .hero-stat span { overflow-wrap:anywhere; }
            .hero-visual { width:100%; height:280px; margin-top:8px; }
        }

        @media (prefers-reduced-motion: reduce) {
            .novexa-service, .service-panel, .ai-float-trigger, .ai-widget-section,
            .terminal-line, .github-dashboard, .project-card, .sw-row, .sw-compact {
                transition:none !important;
                animation:none !important;
            }
        }
    </style>
</head>
<body>
    
<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>
    
    <!-- LOADER --> 
    <div id="loader" class="loader-screen">
      <div class="loader-shell">
        <div class="loader-brand">
          <div class="loader-mark">HARMΛIN</div>
          <div class="loader-system">SYSTEM BOOT</div>
        </div>

        <section class="loader-diagnostics" aria-label="System diagnostics">
          <div class="loader-diagnostic-head">SYSTEM DIAGNOSTICS</div>
          <div class="loader-diagnostic-list">
            <div class="loader-diagnostic-row" data-diagnostic="0">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Initializing core system...</span>
            </div>
            <div class="loader-diagnostic-row" data-diagnostic="1">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Loading visual engine...</span>
            </div>
            <div class="loader-diagnostic-row" data-diagnostic="2">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Connecting project matrix...</span>
            </div>
            <div class="loader-diagnostic-row" data-diagnostic="3">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Loading portfolio database...</span>
            </div>
            <div class="loader-diagnostic-row" data-diagnostic="4">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Initializing AI assistant...</span>
            </div>
            <div class="loader-diagnostic-row" data-diagnostic="5">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Initializing developer terminal...</span>
            </div>
            <div class="loader-diagnostic-row" data-diagnostic="6">
              <span class="loader-scan">&gt;</span>
              <span class="loader-diagnostic-line">Preparing digital experience...</span>
            </div>
          </div>
        </section>

        <section class="loader-status-panel" aria-label="System statuses">
          <div class="loader-status-row">
            <span class="loader-status-name">CORE SYSTEM</span>
            <span class="loader-status-value" data-status="core">WAITING</span>
          </div>
          <div class="loader-status-row">
            <span class="loader-status-name">VISUAL ENGINE</span>
            <span class="loader-status-value" data-status="visual">WAITING</span>
          </div>
          <div class="loader-status-row">
            <span class="loader-status-name">PROJECT MATRIX</span>
            <span class="loader-status-value" data-status="projects">WAITING</span>
          </div>
          <div class="loader-status-row">
            <span class="loader-status-name">DATABASE</span>
            <span class="loader-status-value" data-status="database">WAITING</span>
          </div>
          <div class="loader-status-row">
            <span class="loader-status-name">AI ASSISTANT</span>
            <span class="loader-status-value" data-status="ai">WAITING</span>
          </div>
          <div class="loader-status-row">
            <span class="loader-status-name">DEVELOPER TERMINAL</span>
            <span class="loader-status-value" data-status="terminal">WAITING</span>
          </div>
        </section>

        <div class="loader-stage-wrap">
          <div class="loader-stage" id="loaderStage">Initializing core system...</div>
        </div>

        <div class="loader-progress">
          <div class="loader-bar">
            <span id="loaderFill"></span>
          </div>
          <div class="loader-pct" id="loaderPct">0%</div>
        </div>

        <div class="loader-system-ready">
          <span class="loader-ready-line">SYSTEM READY</span>
          <span class="loader-ready-line secondary">ENTERING EXPERIENCE</span>
        </div>
      </div>
    </div>
    
    <!-- AMBIENT BACKGROUND, CURSOR, SPOTLIGHT -->
    <div class="spotlight" id="spotlight" aria-hidden="true"></div>
    <div class="ambient" aria-hidden="true">
        <div class="ambient-grid"></div>
        <div class="ambient-mesh"></div>
        <div class="ambient-mesh two"></div>
        <div class="ambient-mesh three"></div>
        <div class="ambient-noise"></div>
    </div>

    <!-- HEADER -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <script>
        (function () {
            "use strict";

            /*
             * NOVEXA CURSOR
             * One controller owns both cursor elements.
             * Cursor coordinates are viewport-based, so page scrolling
             * cannot move the ring away from the pointer.
             */
            function initNovexaCursor() {
                var dot = document.getElementById("cursorDot");
                var ring = document.getElementById("cursorRing");

                if (!dot || !ring) return;

                var supportsCursor = window.matchMedia(
                    "(hover: hover) and (pointer: fine)"
                ).matches;

                if (!supportsCursor) {
                    document.documentElement.classList.add("native-cursor");
                    return;
                }

                var mouseX = window.innerWidth / 2;
                var mouseY = window.innerHeight / 2;

                var dotX = mouseX;
                var dotY = mouseY;
                var ringX = mouseX;
                var ringY = mouseY;

                var active = false;
                var cursorType = "default";
                var frame = null;

                var DOT_EASE = 0.45;
                var RING_EASE = 0.18;

                function setPosition(element, x, y) {
                    element.style.setProperty("--cursor-x", x + "px");
                    element.style.setProperty("--cursor-y", y + "px");
                }

                function render() {
                    dotX += (mouseX - dotX) * DOT_EASE;
                    dotY += (mouseY - dotY) * DOT_EASE;

                    ringX += (mouseX - ringX) * RING_EASE;
                    ringY += (mouseY - ringY) * RING_EASE;

                    setPosition(dot, dotX, dotY);
                    setPosition(ring, ringX, ringY);

                    frame = requestAnimationFrame(render);
                }

                function activate() {
                    if (active) return;
                    active = true;
                    dot.classList.add("is-active");
                    ring.classList.add("is-active");
                }

                function deactivate() {
                    active = false;
                    dot.classList.remove("is-active");
                    ring.classList.remove("is-active");
                }

                function clearTypeClasses() {
                    dot.classList.remove(
                        "is-interactive",
                        "is-view",
                        "is-close"
                    );

                    ring.classList.remove(
                        "is-interactive",
                        "is-view",
                        "is-close"
                    );
                }

                function setCursorType(type) {
                    cursorType = type || "default";
                    clearTypeClasses();

                    if (
                        cursorType === "interactive" ||
                        cursorType === "view" ||
                        cursorType === "close"
                    ) {
                        dot.classList.add("is-" + cursorType);
                        ring.classList.add("is-" + cursorType);
                    }
                }

                window.setCursorType = setCursorType;

                window.addEventListener("pointermove", function (event) {
                    mouseX = event.clientX;
                    mouseY = event.clientY;
                    activate();
                }, { passive: true });

                document.addEventListener("mouseleave", deactivate);

                document.addEventListener("mouseenter", function () {
                    if (active) activate();
                });

                document.addEventListener("pointerdown", function () {
                    dot.classList.add("is-clicking");
                    ring.classList.add("is-clicking");
                }, { passive: true });

                document.addEventListener("pointerup", function () {
                    dot.classList.remove("is-clicking");
                    ring.classList.remove("is-clicking");
                }, { passive: true });

                /*
                 * Interactive hover state.
                 * data-cursor="view" / "close" still has priority.
                 */
                document.addEventListener("pointerover", function (event) {
                    if (cursorType !== "default") return;

                    var target = event.target.closest(
                        'a, button, input, textarea, select, [role="button"], [data-cursor]'
                    );

                    if (!target) {
                        setCursorType("default");
                        return;
                    }

                    var requestedType = target.dataset.cursor;

                    if (
                        requestedType === "view" ||
                        requestedType === "close" ||
                        requestedType === "interactive"
                    ) {
                        setCursorType(requestedType);
                    } else {
                        setCursorType("interactive");
                    }
                }, { passive: true });

                document.addEventListener("pointerout", function (event) {
                    if (cursorType === "default") return;

                    var from = event.target.closest(
                        'a, button, input, textarea, select, [role="button"], [data-cursor]'
                    );

                    var to = event.relatedTarget &&
                        event.relatedTarget.closest &&
                        event.relatedTarget.closest(
                            'a, button, input, textarea, select, [role="button"], [data-cursor]'
                        );

                    if (from && from !== to) {
                        setCursorType("default");
                    }
                }, { passive: true });

                render();

                window.addEventListener("beforeunload", function () {
                    if (frame) cancelAnimationFrame(frame);
                });
            }

            if (document.readyState === "loading") {
                document.addEventListener(
                    "DOMContentLoaded",
                    initNovexaCursor,
                    { once: true }
                );
            } else {
                initNovexaCursor();
            }
        })();
    </script>

    <main>
        <!-- ===== HERO SECTION ===== -->
        <section class="hero" id="home">
            <div class="hero-bg-word" aria-hidden="true">HARMAIN</div>
            <div class="container hero-grid">
                <div class="hero-copy">
                    <div class="eyebrow">Full Stack Developer — Pakistan</div>
                    <h1>
                        <span class="line"><span>I build the systems</span></span>
                        <span class="line"><span>businesses run on</span></span>
                        <span class="line"><span>behind the <em class="accent-text">login screen</em>.</span></span>
                    </h1>
                    <p class="hero-sub">
                        I design and build full-stack
                        <span class="hero-rotate" id="heroRotate"><span class="rot-word">dashboards</span></span>
                        — systems for teams that need software to hold up in production,
                        not just in a pitch.
                    </p>
                    <div class="hero-actions">
                        <a href="#work" class="btn-primary">View Case Study →</a>
                        <a href="https://wa.me/923143927745?text=Hello%20NovExa%20Tech%2C%20I%27m%20interested%20in%20starting%20a%20project.%20I%27d%20like%20to%20discuss%20my%20requirements." class="btn-secondary" target="_blank" rel="noopener noreferrer">Start a Project</a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <b id="statSystems">0</b><span>Shipped Systems</span>
                        </div>
                        <div class="hero-stat"><b>Laravel</b><span>Core Stack</span></div>
                        <div class="hero-stat">
                            <b>PK → ∞</b><span>Working Globally</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="portrait-halo"></div>
                    <div class="float-tag tag-1"><i></i>Laravel</div>
                    <div class="float-tag tag-2"><i></i>REST APIs</div>
                    <div class="float-tag tag-3"><i></i>MySQL</div>
                    <div class="float-tag tag-4"><i></i>AI Integration</div>
                    <div class="portrait-wrap" id="portrait">
                        <img src="pic.png" alt="Muhammad Harmain, full-stack web developer" class="hero-image" width="800" height="1000" fetchpriority="high" decoding="async" />
                    </div>
                </div>
            </div>
            <div class="scroll-cue">
                <div class="line"></div>
                SCROLL
            </div>
        </section>

        <!-- ===== MARQUEE ===== -->
        <section class="marquee-section">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item"><b>PHP</b></div>
                <div class="marquee-item">Laravel</div>
                <div class="marquee-item"><b>MySQL</b></div>
                <div class="marquee-item">JavaScript</div>
                <div class="marquee-item"><b>REST APIs</b></div>
                <div class="marquee-item">Bootstrap</div>
                <div class="marquee-item"><b>HTML5 / CSS3</b></div>
                <div class="marquee-item">AI Integration</div>
                <div class="marquee-item"><b>PHP</b></div>
                <div class="marquee-item">Laravel</div>
                <div class="marquee-item"><b>MySQL</b></div>
                <div class="marquee-item">JavaScript</div>
                <div class="marquee-item"><b>REST APIs</b></div>
                <div class="marquee-item">Bootstrap</div>
                <div class="marquee-item"><b>HTML5 / CSS3</b></div>
                <div class="marquee-item">AI Integration</div>
            </div>
        </section>

        <!-- ===== ABOUT ===== -->
        <section class="section abt-section" id="about">
            <div class="container">
                <div class="abt-eyebrow-row">
                    <span class="abt-eyebrow">01 / About</span>
                    <span class="abt-eyebrow-side">Systems · Product · Engineering</span>
                </div>
                <h2 class="abt-statement">
                    <span class="abt-line">I build the systems</span>
                    <span class="abt-line">businesses run on</span>
                    <span class="abt-line">behind the <em>login screen</em>.</span>
                </h2>
                <div class="abt-rule"></div>
                <div class="abt-copy-grid">
                    <p class="abt-copy">Most of my work never faces the public internet — it faces an admin logging in every morning to check shipments, invoices, or stock. That's the software I build: dashboards and portals that hold up under daily, repeated use.</p>
                    <p class="abt-copy">I work primarily in PHP and Laravel, with MySQL underneath and a JavaScript layer that keeps interfaces fast and responsive. Every system I ship is designed around one question: what does the person using this every day actually need to see?</p>
                </div>
                <p class="abt-location">Based in Pakistan, working with clients wherever the project takes me — logistics, retail, and internal operations tooling are where I've spent the most time.</p>
                <div class="abt-rule abt-rule-lower"></div>
                <div class="abt-rail">
                    <div class="abt-rail-item"><span class="abt-rail-label">Focus</span><span class="abt-rail-value">Business management systems</span></div>
                    <div class="abt-rail-item"><span class="abt-rail-label">Core Stack</span><span class="abt-rail-value">PHP · Laravel · MySQL</span></div>
                    <div class="abt-rail-item"><span class="abt-rail-label">Approach</span><span class="abt-rail-value">Admin-first, data-driven UI</span></div>
                    <div class="abt-rail-item"><span class="abt-rail-label">Currently</span><span class="abt-rail-value">Open to new projects</span></div>
                </div>
            </div>
        </section>

        <!-- ===== NOVEXA TECH ===== -->
        <section class="section novexa-section" id="novexa-tech">
            <div class="container">
                <div class="novexa-header">
                    <div>
                        <div class="novexa-label">02 / NOVEXA TECH</div>
                        <h2 class="novexa-heading">NovExa <em>Tech</em></h2>
                    </div>
                    <p class="novexa-lead">New Idea Powered By Technology. NovExa Tech is a technology-focused company founded by Harmain, dedicated to transforming ideas into modern digital solutions. We build professional websites, web applications, business management systems, e-commerce solutions, and custom software tailored to real-world requirements.</p>
                </div>
                <div class="novexa-founder">
                    <div class="novexa-kicker">Founder</div>
                    <div><h3>Harmain — Founder &amp; CEO</h3><p>Harmain founded NovExa Tech with a vision to combine creativity, technology, and practical business solutions. As Founder &amp; CEO, he leads the company's direction while working across software development, digital solutions, and technology projects.</p></div>
                </div>
                <h3 class="novexa-subhead">What NovExa Tech builds.</h3>
                <div class="novexa-services">
                    <article class="novexa-service"><h4>Web Development</h4><p>Modern, responsive, and professional websites for businesses and individuals.</p></article>
                    <article class="novexa-service"><h4>Web Applications</h4><p>Custom web applications designed around specific business requirements.</p></article>
                    <article class="novexa-service"><h4>Business Systems</h4><p>Custom management systems, dashboards, ERP-style solutions, and workflow-based applications.</p></article>
                    <article class="novexa-service"><h4>E-Commerce</h4><p>Online stores and e-commerce solutions designed for modern businesses.</p></article>
                    <article class="novexa-service"><h4>Custom Software</h4><p>Software solutions developed around unique business processes and requirements.</p></article>
                    <article class="novexa-service"><h4>Digital Solutions</h4><p>Technology-driven solutions that help businesses improve their digital presence and operations.</p></article>
                </div>
                <h3 class="novexa-subhead">Why NovExa Tech?</h3>
                <div class="novexa-principles">
                    <article class="novexa-principle"><h4>Innovation</h4><p>Turning new ideas into practical technology solutions.</p></article>
                    <article class="novexa-principle"><h4>Custom Solutions</h4><p>Building around the client's actual requirements instead of a one-size-fits-all approach.</p></article>
                    <article class="novexa-principle"><h4>Modern Technology</h4><p>Using appropriate development technologies to create reliable digital products.</p></article>
                    <article class="novexa-principle"><h4>Business Focused</h4><p>Understanding the business objective behind the technology.</p></article>
                </div>
                <div class="novexa-cta">
                    <div><h3>Have an idea? Let's build it.</h3><p>Tell NovExa Tech what you're looking to build, and let's turn your idea into a digital solution.</p></div>
                    <div class="novexa-cta-actions"><a href="https://wa.me/923143927745?text=Hello%20NovExa%20Tech%2C%20I%27m%20interested%20in%20starting%20a%20project.%20I%27d%20like%20to%20discuss%20my%20requirements." class="btn-primary" target="_blank" rel="noopener noreferrer">Start a Project</a></div>
                </div>
            </div>
        </section>

        <!-- ===== EXPERIENCE ===== -->
        <section class="section exp-section" id="experience">
            <div class="container">
                <div class="exp-header">
                    <div class="exp-label">04 / EXPERIENCE</div>
                    <h2 class="exp-heading">How the work<br>has progressed.</h2>
                    <div class="exp-progress" id="expProgress">
                        <span class="exp-progress-current" id="expProgressCurrent">01</span>
                        <span class="exp-progress-track"><span class="exp-progress-fill" id="expProgressFill"></span></span>
                        <span class="exp-progress-total">04</span>
                    </div>
                </div>
                <div class="exp-timeline" id="expTimeline">
                    <div class="exp-track"><div class="exp-track-fill" id="expTrackFill"></div></div>
                    <div class="exp-stage" data-stage="1">
                        <div class="exp-meta"><span class="exp-num">01</span><span class="exp-stagelabel">Foundation</span></div>
                        <span class="exp-node"></span>
                        <div class="exp-content"><h3>Core web development</h3><p>Built a foundation in HTML5, CSS3, and JavaScript, then moved into PHP to understand how the front end actually connects to real data.</p></div>
                    </div>
                    <div class="exp-stage" data-stage="2">
                        <div class="exp-meta"><span class="exp-num">02</span><span class="exp-stagelabel">Framework Depth</span></div>
                        <span class="exp-node"></span>
                        <div class="exp-content"><h3>Laravel &amp; structured backends</h3>
                        <p>Adopted Laravel as a primary framework — authentication, role management, and database architecture became the default starting point for every build, not an afterthought.</p>
                    </div>
                    </div>
                    <div class="exp-stage" data-stage="3">
                        <div class="exp-meta"><span class="exp-num">03</span><span class="exp-stagelabel">Systems Work</span></div>
                        <span class="exp-node"></span>
                        <div class="exp-content"><h3>Multi-role platforms</h3>
                        <p>Shipped systems with separate admin and client experiences — including the Union Enterprises logistics platform and an Online Movie Booking System — where dashboards, permissions, and reporting all had to work together.</p>
                    </div>
                    </div>
                    <div class="exp-stage is-current" data-stage="4">
                        <div class="exp-meta"><span class="exp-num">04</span><span class="exp-stagelabel">Current</span></div>
                        <span class="exp-node"></span>
                        <div class="exp-content"><h3>AI-integrated tooling</h3>
                        <p>Bringing AI-assisted features into dashboards and client-facing tools, alongside continued work on business management platforms.</p>
                    </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== PROCESS ===== -->
        <section class="section core-section" id="process">
            <div class="container">
                <div class="section-head">
                    <div class="core-eyebrow-tech">07 / BUILD SYSTEM</div>
                    <div class="eyebrow">Development Process</div>
                    <h2>What happens between a brief and a launch.</h2>
                    <p>The same ten-stage process behind every system on this page, in order — each stage feeds directly into the next.</p>
                </div>

                <div class="core-stage">
                    <div class="core-grid-bg" aria-hidden="true"></div>

                    <!-- DESKTOP: radial blueprint -->
                    <div class="blueprint" id="blueprint" role="group" aria-label="Development process stages">
                        <div class="blueprint-lines" id="blueprintLines"></div>

                        <div class="core-center" id="coreCenter" aria-live="polite">
                            <div class="core-content-inner" id="coreContentInner">
                                <div class="core-progress" id="coreProgress">STAGE 01 OF 10</div>
                                <div class="core-micro" id="coreMicro"></div>
                                <div class="core-num" id="coreNum">01</div>
                                <h3 class="core-title" id="coreTitle">Discovery</h3>
                                <p class="core-desc" id="coreDesc">Understand the daily workflow and where it currently breaks down.</p>
                            </div>
                        </div>

                        <div id="blueprintNodes"></div>
                    </div>

                    <!-- MOBILE: compact panel + node grid -->
                    <div class="core-mobile" id="coreMobile">
                        <div class="core-mobile-panel">
                            <div class="core-progress" id="coreProgressM">STAGE 01 OF 10</div>
                            <div class="core-micro" id="coreMicroM"></div>
                            <div class="core-num" id="coreNumM">01</div>
                            <h3 class="core-title" id="coreTitleM">Discovery</h3>
                            <p class="core-desc" id="coreDescM" style="max-width: none;">Understand the daily workflow and where it currently breaks down.</p>
                        </div>
                        <div class="core-mobile-nodes" id="coreMobileNodes"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== TECH STACK ===== -->
        <section class="section" id="stack">
            <div class="container">
                <div class="section-head">
                    <div class="eyebrow">Tech Stack</div>
                    <h2>Tools I reach for by default.</h2>
                    <p>Hover or tap any technology for how it's actually been used.</p>
                </div>
                <div class="stack-grid" id="stackGrid"></div>
            </div>
        </section>

        <!-- ===== SERVICES ===== -->
        <?php include __DIR__ . '/components/services.php'; ?>

        <!-- ===== PHILOSOPHY ===== -->
        <section class="section" id="philosophy">
            <div class="container">
                <div class="section-head">
                    <div class="eyebrow">Development Philosophy</div>
                    <h2>How I approach a build.</h2>
                </div>
                <div class="philosophy">
                    <div class="phil-card"><h3>Start from the daily user</h3><p>The person who opens this every morning defines the interface — not the feature list.</p></div>
                    <div class="phil-card"><h3>Design the schema first</h3><p>A clear database structure prevents most of the problems that show up later as "bugs."</p></div>
                    <div class="phil-card"><h3>Roles before features</h3><p>Who can see and do what is decided before a single screen is built, not patched in afterward.</p></div>
                    <div class="phil-card"><h3>Ship what holds up</h3><p>Software that survives daily, repeated use — not just a demo that looks good once.</p></div>
                </div>
            </div>
        </section>

        <!-- ===== WHY HIRE ===== -->
        <section class="section why-journey" id="why">
            <div class="container">
                <div class="section-head">
                    <div class="why-journey-label">06 / WORKING RELATIONSHIP</div>
                    <div class="eyebrow">Why Hire Me</div>
                    <h2>What working together looks like.</h2>
                </div>
                <div class="why-scroll-host" id="whyScrollHost"><div class="why-sticky">
                    <nav class="why-rail" aria-label="Working relationship stages"><div class="why-rail-line"><div class="why-rail-fill" id="whyRailFill"></div></div>
                    <button class="why-node-col" data-stage="1"><span class="why-node"></span><span class="why-node-num">01</span><span class="why-node-name">Talk</span></button><button class="why-node-col" data-stage="2"><span class="why-node"></span><span class="why-node-num">02</span><span class="why-node-name">Think</span></button><button class="why-node-col" data-stage="3"><span class="why-node"></span><span class="why-node-num">03</span><span class="why-node-name">Own</span></button><button class="why-node-col" data-stage="4"><span class="why-node"></span><span class="why-node-num">04</span><span class="why-node-name">Grow</span></button></nav>
                    <div class="why-stage-wrap"><div><div class="why-stage" data-stage="1"><div class="why-stage-tag">01 / TALK</div><h3 class="why-stage-title">Direct Communication</h3><p class="why-stage-desc">No account managers between you and the person writing the code.</p></div><div class="why-stage" data-stage="2"><div class="why-stage-tag">02 / THINK</div><h3 class="why-stage-title">Systems Thinking</h3><p class="why-stage-desc">Every feature is considered against the database and roles behind it.</p></div><div class="why-stage" data-stage="3"><div class="why-stage-tag">03 / OWN</div><h3 class="why-stage-title">Full Ownership</h3><p class="why-stage-desc">From schema design to the interface, handled end-to-end.</p></div><div class="why-stage" data-stage="4"><div class="why-stage-tag">04 / GROW</div><h3 class="why-stage-title">Built For Growth</h3><p class="why-stage-desc">Architecture that doesn't need to be rebuilt at the next stage.</p></div></div>
                    <div class="why-diagram"><svg viewBox="0 0 320 220" aria-label="Working relationship diagram"><g class="why-diagram-group" data-group="1"><line class="why-diagram-path" id="path-1" x1="60" y1="110" x2="260" y2="110"/><circle class="why-diagram-node" id="node-client" cx="60" cy="110" r="6"/><circle class="why-diagram-node" id="node-dev" cx="260" cy="110" r="6"/><text class="why-diagram-label" id="label-client" x="60" y="136" text-anchor="middle">CLIENT</text><text class="why-diagram-label" id="label-dev" x="260" y="136" text-anchor="middle">DEVELOPER</text></g><g class="why-diagram-group" data-group="2"><line class="why-diagram-path" id="path-2a" x1="160" y1="30" x2="160" y2="70"/><line class="why-diagram-path" id="path-2b" x1="160" y1="70" x2="160" y2="110"/><circle class="why-diagram-node" id="node-db" cx="160" cy="30" r="6"/><circle class="why-diagram-node" id="node-roles" cx="160" cy="70" r="6"/><text class="why-diagram-label" id="label-db" x="160" y="18" text-anchor="middle">DATABASE</text><text class="why-diagram-label" id="label-roles" x="188" y="74">ROLES</text></g><g class="why-diagram-group" data-group="3"><line class="why-diagram-path" id="path-3a" x1="60" y1="160" x2="130" y2="160"/><line class="why-diagram-path" id="path-3b" x1="130" y1="160" x2="200" y2="160"/><line class="why-diagram-path" id="path-3c" x1="200" y1="160" x2="260" y2="160"/><circle class="why-diagram-node" id="node-schema" cx="60" cy="160" r="5"/><circle class="why-diagram-node" id="node-backend" cx="130" cy="160" r="5"/><circle class="why-diagram-node" id="node-api" cx="200" cy="160" r="5"/><circle class="why-diagram-node" id="node-interface" cx="260" cy="160" r="5"/><text class="why-diagram-label" id="label-schema" x="60" y="182" text-anchor="middle">SCHEMA</text><text class="why-diagram-label" id="label-backend" x="130" y="182" text-anchor="middle">BACKEND</text><text class="why-diagram-label" id="label-api" x="200" y="182" text-anchor="middle">API</text><text class="why-diagram-label" id="label-interface" x="260" y="182" text-anchor="middle">UI</text></g><g class="why-diagram-group" data-group="4"><line class="why-diagram-path" id="path-4a" x1="80" y1="200" x2="160" y2="200"/><line class="why-diagram-path" id="path-4b" x1="160" y1="200" x2="240" y2="200"/><circle class="why-diagram-node" id="node-build" cx="80" cy="200" r="5"/><circle class="why-diagram-node" id="node-extend" cx="160" cy="200" r="5"/><circle class="why-diagram-node" id="node-scale" cx="240" cy="200" r="5"/><text class="why-diagram-label" id="label-build" x="80" y="186" text-anchor="middle">BUILD</text><text class="why-diagram-label" id="label-extend" x="160" y="186" text-anchor="middle">EXTEND</text><text class="why-diagram-label" id="label-scale" x="240" y="186" text-anchor="middle">SCALE</text></g></svg></div></div></div>
                    <div class="why-scroll-spacer" data-scroll-stage="1"></div><div class="why-scroll-spacer" data-scroll-stage="2"></div><div class="why-scroll-spacer" data-scroll-stage="3"></div><div class="why-scroll-spacer" data-scroll-stage="4"></div></div>
                <div class="why-mobile-seq"><div class="why-mobile-item"><div class="why-mobile-tag">01 / TALK</div><h3 class="why-mobile-title">Direct Communication</h3><p class="why-mobile-desc">No account managers between you and the person writing the code.</p></div><div class="why-mobile-item"><div class="why-mobile-tag">02 / THINK</div><h3 class="why-mobile-title">Systems Thinking</h3><p class="why-mobile-desc">Every feature is considered against the database and roles behind it.</p></div><div class="why-mobile-item"><div class="why-mobile-tag">03 / OWN</div><h3 class="why-mobile-title">Full Ownership</h3><p class="why-mobile-desc">From schema design to the interface, handled end-to-end.</p></div><div class="why-mobile-item"><div class="why-mobile-tag">04 / GROW</div><h3 class="why-mobile-title">Built For Growth</h3><p class="why-mobile-desc">Architecture that doesn't need to be rebuilt at the next stage.</p></div></div>
                </div>
            </div>
        </section>

        <!-- ===== ACHIEVEMENTS ===== -->
        <section class="section" id="achievements">
            <div class="container">
                <div class="section-head">
                    <div class="eyebrow">By The Numbers</div>
                    <h2>Truthful, not inflated.</h2>
                </div>
                <div class="achieve-grid">
                    <div class="achieve-cell"><b data-count="4">0</b><span>Shipped systems</span></div>
                    <div class="achieve-cell"><b data-count="2">0</b><span>Multi-role platforms</span></div>
                    <div class="achieve-cell"><b data-count="1">0</b><span>Core framework — Laravel</span></div>
                    <div class="achieve-cell"><b data-count="100">0</b><span>% remote-friendly delivery</span></div>
                </div>
            </div>
        </section>

        <!-- ===== SELECTED WORK — editorial case study showcase ===== -->
        <section class="section sw-section" id="work">
            <div class="container">
                <?php
                    $selectedWorkImages = [
                        'union' => 'ue.PNG',
                        'movie' => 'mbs2.PNG',
                        'jewelry' => 'jw.PNG',
                        'aniwear' => 'aw.PNG',
                    ];
                ?>
                <div class="sw-head">
                    <div class="sw-head-top">
                        <span class="sw-eyebrow">05 / Selected Work</span>
                        <span class="sw-count">04 Systems</span>
                    </div>
                    <h2 class="sw-heading">More systems, briefly.</h2>
                    <p class="sw-sub">These aren't cards — click any system to open the full breakdown: the problem, the schema, and how it's put together.</p>
                </div>

                <div class="sw-list" id="swList">

                    <!-- 01 — UNION ENTERPRISES -->
                    <article class="sw-row sw-row--01 project-card sw-reveal" data-open-project="union" tabindex="0" role="button" aria-label="Open case study: Union Enterprises">
                        <span class="sw-ghost" aria-hidden="true">01</span>
                        <div class="sw-grid">
                            <div class="sw-copy">
                                <div class="sw-index-row sw-row-copy-el">
                                    <span class="sw-index">01</span>
                                    <span class="sw-status"><i></i>In production</span>
                                </div>
                                <h3 class="sw-title sw-row-copy-el">Union Enterprises</h3>
                                <p class="sw-desc sw-row-copy-el">A two-sided platform replacing spreadsheet-based tracking with a single operational source of truth for shipments, invoices and documents.</p>
                                <div class="sw-stack sw-row-copy-el">
                                    <span>Laravel</span><span>MySQL</span><span>REST API</span><span>Role-Based Access</span>
                                </div>
                                <div class="sw-specs sw-row-copy-el">
                                    <div class="sw-spec"><span class="sw-spec-cat">Database</span><b>14</b><span class="sw-spec-unit">Tables</span></div>
                                    <div class="sw-spec"><span class="sw-spec-cat">Access</span><b>2</b><span class="sw-spec-unit">Roles</span></div>
                                    <div class="sw-spec"><span class="sw-spec-cat">API</span><b>22</b><span class="sw-spec-unit">Endpoints</span></div>
                                </div>
                                <span class="sw-open sw-row-copy-el">View case study<span class="sw-arrow">→</span></span>
                            </div>
                            <div class="sw-visual">
                                <div class="sw-visual-inner">
                                    <?php if ($selectedWorkImages['union'] !== ''): ?>
                                        <img class="sw-image" src="<?= htmlspecialchars($selectedWorkImages['union'], ENT_QUOTES, 'UTF-8') ?>" alt="Union Enterprises project preview" loading="lazy">
                                    <?php else: ?>
                                    <div class="mockup">
                                        <div class="mockup-window">
                                            <div class="mockup-topbar"><span class="mockup-dot r"></span><span class="mockup-dot y"></span><span class="mockup-dot g"></span><span class="mockup-title">union-enterprises / operations</span></div>
                                            <div class="mockup-body">
                                                <div class="mockup-side">
                                                    <div class="m-item active">Shipments</div>
                                                    <div class="m-item">Invoices</div>
                                                    <div class="m-item">Documents</div>
                                                    <div class="m-item">Clients</div>
                                                </div>
                                                <div class="mockup-main">
                                                    <div class="mockup-kpis">
                                                        <div class="mockup-kpi"><b>128</b><span>Shipments</span></div>
                                                        <div class="mockup-kpi"><b>342</b><span>Invoices</span></div>
                                                        <div class="mockup-kpi"><b>98%</b><span>On-time</span></div>
                                                    </div>
                                                    <div class="mockup-chart">
                                                        <i style="height:38%"></i><i style="height:62%"></i><i style="height:48%"></i><i style="height:80%"></i><i style="height:55%"></i><i style="height:90%"></i><i style="height:70%"></i><i style="height:60%"></i><i style="height:85%"></i><i style="height:95%"></i>
                                                    </div>
                                                    <div class="mockup-table-row head"><span>Ref</span><span>Route</span><span>Client</span><span>Status</span></div>
                                                    <div class="mockup-table-row"><span>SHP-2291</span><span>Karachi → Lahore</span><span>Al Noor Traders</span><span class="status-pill ok">In transit</span></div>
                                                    <div class="mockup-table-row"><span>INV-1042</span><span>—</span><span>Bin Yousuf Co.</span><span class="status-pill ok">Paid</span></div>
                                                    <div class="mockup-table-row"><span>DOC-0087</span><span>Bilty scan</span><span>Al Noor Traders</span><span class="status-pill wait">Pending</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- 02 — ONLINE MOVIE BOOKING SYSTEM -->
                    <article class="sw-row sw-row--02 project-card sw-reveal" data-open-project="movie" tabindex="0" role="button" aria-label="Open case study: Online Movie Booking System">
                        <span class="sw-ghost" aria-hidden="true">02</span>
                        <div class="sw-grid">
                            <div class="sw-visual">
                                <div class="sw-visual-inner">
                                    <?php if ($selectedWorkImages['movie'] !== ''): ?>
                                        <img class="sw-image" src="<?= htmlspecialchars($selectedWorkImages['movie'], ENT_QUOTES, 'UTF-8') ?>" alt="Online Movie Booking System project preview" loading="lazy">
                                    <?php else: ?>
                                    <div class="mockup">
                                        <div class="mockup-window">
                                            <div class="mockup-topbar"><span class="mockup-dot r"></span><span class="mockup-dot y"></span><span class="mockup-dot g"></span><span class="mockup-title">movie-booking / dashboard</span></div>
                                            <div class="mockup-body">
                                                <div class="mockup-side">
                                                    <div class="m-item">Movies</div>
                                                    <div class="m-item active">Showtimes</div>
                                                    <div class="m-item">Bookings</div>
                                                    <div class="m-item">Screens</div>
                                                </div>
                                                <div class="mockup-main">
                                                    <div class="mockup-kpis">
                                                        <div class="mockup-kpi"><b>24</b><span>Movies</span></div>
                                                        <div class="mockup-kpi"><b>18</b><span>Showtimes</span></div>
                                                        <div class="mockup-kpi"><b>126</b><span>Bookings</span></div>
                                                    </div>
                                                    <div class="mockup-chart">
                                                        <i style="height:90%"></i><i style="height:88%"></i><i style="height:92%"></i><i style="height:40%"></i><i style="height:85%"></i><i style="height:80%"></i><i style="height:20%"></i><i style="height:78%"></i><i style="height:90%"></i><i style="height:86%"></i>
                                                    </div>
                                                    <div class="mockup-table-row head"><span>Movie</span><span>Showtime</span><span>Seats</span><span>Status</span></div>
                                                    <div class="mockup-table-row"><span>Inception</span><span>07:30 PM</span><span>G-14</span><span class="status-pill ok">Booked</span></div>
                                                    <div class="mockup-table-row"><span>Interstellar</span><span>09:00 PM</span><span>B-08</span><span class="status-pill ok">Booked</span></div>
                                                    <div class="mockup-table-row"><span>Avatar</span><span>10:15 PM</span><span>—</span><span class="status-pill wait">Available</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="sw-copy">
                                <div class="sw-index-row sw-row-copy-el">
                                    <span class="sw-index">02</span>
                                    <span class="sw-status"><i></i>Completed</span>
                                </div>
                                <h3 class="sw-title sw-row-copy-el">Online Movie Booking System</h3>
                                <p class="sw-desc sw-row-copy-el">A full-stack booking platform for browsing movies, selecting showtimes and seats, and completing cinema ticket bookings online.</p>
                                <div class="sw-stack sw-row-copy-el">
                                    <span>PHP</span><span>MySQL</span><span>Bootstrap</span><span>jQuery</span>
                                </div>
                                <div class="sw-specs sw-row-copy-el">
                                    <div class="sw-spec"><span class="sw-spec-cat">Booking</span><b>1</b><span class="sw-spec-unit">System</span></div>
                                    <div class="sw-spec"><span class="sw-spec-cat">Access</span><b>2</b><span class="sw-spec-unit">Roles</span></div>
                                    <div class="sw-spec"><span class="sw-spec-cat">Core</span><b>14</b><span class="sw-spec-unit">Features</span></div>
                                </div>
                                <span class="sw-open sw-row-copy-el">View case study<span class="sw-arrow">→</span></span>
                            </div>
                        </div>
                    </article>

                    <!-- 03 + 04 — COMPACT PAIR -->
                    <div class="sw-row sw-pair sw-reveal">
                        <article class="sw-compact project-card" data-open-project="jewelry" tabindex="0" role="button" aria-label="Open case study: Jewelry Website">
                            <span class="sw-ghost" aria-hidden="true">03</span>
                            <div class="sw-compact-visual">
                                <div class="sw-visual-inner">
                                    <?php if ($selectedWorkImages['jewelry'] !== ''): ?>
                                        <img class="sw-image" src="<?= htmlspecialchars($selectedWorkImages['jewelry'], ENT_QUOTES, 'UTF-8') ?>" alt="Jewelry Website project preview" loading="lazy">
                                    <?php else: ?>
                                    <div class="mockup">
                                        <div class="mockup-window">
                                            <div class="mockup-topbar"><span class="mockup-dot r"></span><span class="mockup-dot y"></span><span class="mockup-dot g"></span><span class="mockup-title">jewelry-site / catalog</span></div>
                                            <div class="mockup-body" style="min-height:200px;">
                                                <div class="mockup-side">
                                                    <div class="m-item active">Catalog</div>
                                                    <div class="m-item">Categories</div>
                                                    <div class="m-item">Pages</div>
                                                </div>
                                                <div class="mockup-main">
                                                    <div class="mockup-kpis">
                                                        <div class="mockup-kpi"><b>8</b><span>Pages</span></div>
                                                        <div class="mockup-kpi"><b>6</b><span>Categories</span></div>
                                                        <div class="mockup-kpi"><b>2</b><span>Modules</span></div>
                                                    </div>
                                                    <div class="mockup-chart">
                                                        <i style="height:55%"></i><i style="height:70%"></i><i style="height:45%"></i><i style="height:80%"></i><i style="height:60%"></i><i style="height:35%"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="sw-compact-body">
                                <div class="sw-index-row">
                                    <span class="sw-index">03</span>
                                    <span class="sw-status"><i></i>In production</span>
                                </div>
                                <h3 class="sw-title">Jewelry Website</h3>
                                <p class="sw-desc">A product-focused website for a jewelry business, built around clean product presentation and straightforward navigation.</p>
                                <div class="sw-meta-line"><b>PHP</b> · Bootstrap · JavaScript</div>
                                <span class="sw-open">View case study<span class="sw-arrow">→</span></span>
                            </div>
                        </article>

                        <article class="sw-compact project-card" data-open-project="aniwear" tabindex="0" role="button" aria-label="Open case study: Aniwear — Digital Wardrobe + AI Stylist">
                            <span class="sw-ghost" aria-hidden="true">04</span>
                            <div class="sw-compact-visual">
                                <div class="sw-visual-inner">
                                    <?php if ($selectedWorkImages['aniwear'] !== ''): ?>
                                        <img class="sw-image" src="<?= htmlspecialchars($selectedWorkImages['aniwear'], ENT_QUOTES, 'UTF-8') ?>" alt="Aniwear digital wardrobe and AI stylist project preview" loading="lazy">
                                    <?php else: ?>
                                    <div class="mockup">
                                        <div class="mockup-window">
                                            <div class="mockup-topbar"><span class="mockup-dot r"></span><span class="mockup-dot y"></span><span class="mockup-dot g"></span><span class="mockup-title">aniwear / wardrobe</span></div>
                                            <div class="mockup-body" style="min-height:200px;">
                                                <div class="mockup-side">
                                                    <div class="m-item active">Wardrobe</div>
                                                    <div class="m-item">Outfits</div>
                                                    <div class="m-item">AI Stylist</div>
                                                </div>
                                                <div class="mockup-main">
                                                    <div class="mockup-kpis">
                                                        <div class="mockup-kpi"><b>42</b><span>Wardrobe Items</span></div>
                                                        <div class="mockup-kpi"><b>12</b><span>Saved Outfits</span></div>
                                                        <div class="mockup-kpi"><b>8</b><span>AI Suggestions</span></div>
                                                    </div>
                                                    <div class="mockup-chart">
                                                        <i style="height:65%"></i><i style="height:85%"></i><i style="height:50%"></i><i style="height:75%"></i><i style="height:92%"></i><i style="height:40%"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="sw-compact-body">
                                <div class="sw-index-row">
                                    <span class="sw-index">04</span>
                                    <span class="sw-status"><i></i>Live</span>
                                </div>
                                <h3 class="sw-title">Aniwear — Digital Wardrobe + AI Stylist</h3>
                                <p class="sw-desc">A fashion-tech application for organizing clothing, creating outfits, and receiving personalized AI styling recommendations.</p>
                                <div class="sw-meta-line"><b>Laravel</b> · PHP · MySQL · AI Integration</div>
                                <span class="sw-open">View case study<span class="sw-arrow">→</span></span>
                            </div>
                        </article>
                    </div>

                </div>
            </div>
        </section>

        <!-- ===== INDUSTRIES / TOOLS / LEARNING ===== -->
        <section class="section" id="context">
            <div class="container">
                <div class="ov-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 64px;">
                    <div>
                        <div class="eyebrow">Industries Served</div>
                        <h2 style="font-size: 26px; margin-bottom: 20px;">Where the systems have lived.</h2>
                        <div class="chip-grid">
                            <span class="chip-item">Logistics &amp; freight</span>
                            <span class="chip-item">Retail &amp; e-commerce</span>
                            <span class="chip-item">Internal operations tooling</span>
                            <span class="chip-item">HR &amp; workforce management</span>
                        </div>
                    </div>
                    <div>
                        <div class="eyebrow">Currently Learning</div>
                        <h2 style="font-size: 26px; margin-bottom: 20px;">What's next on the stack.</h2>
                        <div class="chip-grid">
                            <span class="chip-item">AI-assisted workflows</span>
                            <span class="chip-item">API-first architecture</span>
                            <span class="chip-item">Advanced MySQL performance tuning</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== GITHUB DASHBOARD ===== -->
        <?php include __DIR__ . '/components/github_dashboard.php'; ?>

        <!-- ===== AI CHATBOT ===== -->
        <?php include __DIR__ . '/components/chatbot.php'; ?>

        <!-- ===== TERMINAL ===== -->
        <?php include __DIR__ . '/components/developer_terminal.php'; ?>

        <!-- ===== BLOG ===== -->
        <section class="section" id="blog">
            <div class="container">
                <div class="section-head">
                    <div class="eyebrow">Technical Writing</div>
                    <h2>Notes from building these systems.</h2>
                </div>
                <div class="blog-grid" id="blogGrid"></div>
            </div>
        </section>

        <!-- ===== FAQ ===== -->
        <?php include __DIR__ . '/components/faq.php'; ?>

        <!-- ===== CONTACT ===== -->
        <?php include __DIR__ . '/components/contact.php'; ?>


    </main>

    <!-- FOOTER (includes the case study overlay as fixed element) -->
    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- COMMAND PALETTE -->
    <div class="cmdk-overlay" id="cmdkOverlay">
        <div class="cmdk-box">
            <div class="cmdk-input-row">
                <span style="color: var(--muted)">⌘</span>
                <input type="text" id="cmdkInput" placeholder="Search projects, skills, commands..." />
                <span class="cmdk-esc">ESC</span>
            </div>
            <div class="cmdk-list" id="cmdkList"></div>
        </div>
    </div>


    <!-- ===== FULL ORIGINAL JAVASCRIPT (with modifications) ===== -->
    <script>
        // ============================================================
// PORTFOLIO DATA — single source of truth (kept for static parts)
// ============================================================
const portfolioData = {
    name: "Muhammad Harmain",
    role: "Full Stack Developer",
    location: "Pakistan",
    bio: "Full stack developer focused on PHP and Laravel, building business management systems, dashboards and portals designed for daily, repeated use rather than one-time demos.",
    stack: {
        Backend: [
            { name: "PHP", stars: 5, desc: "Primary server-side language for every system shipped.", uses: ["Auth", "Business logic", "Session handling"], related: ["Laravel", "REST APIs"] },
            { name: "Laravel", stars: 5, desc: "Default framework — routing, ORM, middleware and auth out of the box.", uses: ["Union Enterprises"], related: ["PHP", "MySQL", "REST APIs"] },
            { name: "REST APIs", stars: 4, desc: "Endpoints powering dashboard views and portal-to-admin data flow.", uses: ["Client portals", "Mobile-ready endpoints"], related: ["Laravel"] },
        ],
        Frontend: [
            { name: "JavaScript", stars: 4, desc: "Keeps dashboard interfaces fast and responsive.", uses: ["Interactive tables", "Live status updates"], related: ["Bootstrap"] },
            { name: "HTML5", stars: 5, desc: "Semantic structure for every interface.", uses: ["All projects"], related: ["CSS3"] },
            { name: "CSS3", stars: 5, desc: "Layout and theming across dashboards and portals.", uses: ["All projects"], related: ["Bootstrap"] },
            { name: "Bootstrap", stars: 4, desc: "Component baseline for admin panels and forms.", uses: ["Online Movie Booking System"], related: ["JavaScript"] },
        ],
        Data: [
            { name: "MySQL", stars: 5, desc: "Relational schema design underneath every system.", uses: ["Union Enterprises", "Online Movie Booking System"], related: ["Laravel"] },
            { name: "Schema Design", stars: 5, desc: "Normalized structures built before any screen is designed.", uses: ["All multi-role platforms"], related: ["MySQL"] },
            { name: "Query Optimization", stars: 4, desc: "Keeps reporting fast as data volume grows.", uses: ["Analytics dashboards"], related: ["MySQL"] },
        ],
        Applied: [
            { name: "AI Integration", stars: 3, desc: "Layering assistants and automation on top of existing dashboards.", uses: ["Portfolio AI Assistant"], related: ["REST APIs"] },
            { name: "Dashboard Development", stars: 5, desc: "Admin and analytics dashboards built around real decisions.", uses: ["Union Enterprises"], related: ["Laravel", "MySQL"] },
            { name: "Auth & Roles", stars: 5, desc: "Role-based middleware separating admin and client access.", uses: ["Union Enterprises", "Online Movie Booking System"], related: ["Laravel"] },
        ],
    },
    projects: [],
    services: [],
    blog: [
        { tag: "Architecture", title: "How I structure a Laravel ERP-style system", summary: "The module and middleware layout behind Union Enterprises, and why roles get decided before screens.", meta: "8 min read" },
        { tag: "Auth", title: "Role-based authentication, done at the query layer", summary: "Why guarding routes isn't enough — the permission boundary has to live in the data access layer too.", meta: "6 min read" },
        { tag: "Database", title: "Designing a schema before the first screen", summary: "A walkthrough of normalizing shipments, invoices and documents around one client record.", meta: "7 min read" },
        { tag: "APIs", title: "REST endpoints for a two-sided platform", summary: "Structuring one API to serve both an admin dashboard and a simplified client portal.", meta: "5 min read" },
        { tag: "Performance", title: "Keeping Laravel dashboards fast at scale", summary: "Indexing and query patterns that keep reporting screens responsive as data grows.", meta: "6 min read" },
        { tag: "AI", title: "Adding an AI assistant to an existing dashboard", summary: "A modular provider pattern for swapping model backends without touching the UI.", meta: "5 min read" },
    ],
    contact: { email: "mharmainfarooq@gmail.com", availability: ["Freelance", "Internship", "Full-Time", "Remote"], responseTime: "Within 24 hours", preferred: "Email" },
    faq: []
};

// ============================================================
// GSAP & ScrollTrigger registration
// ============================================================
if (!window.gsap || !window.ScrollTrigger) {
    console.warn('Animations are unavailable; showing the portfolio without motion effects.');
} else {
    gsap.registerPlugin(ScrollTrigger);

    // ============================================================
    // EXPERIENCE TIMELINE — editorial scroll reveal
    // ============================================================
    (function experienceTimeline() {
        const timeline = document.getElementById("expTimeline");
        if (!timeline) return;

        const stages = gsap.utils.toArray(".exp-stage", timeline);
        const trackFill = document.getElementById("expTrackFill");
        const progressFill = document.getElementById("expProgressFill");
        const progressCurrent = document.getElementById("expProgressCurrent");
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        if (reduceMotion) {
            stages.forEach((stage) => stage.classList.add("is-visible", "is-active"));
            if (trackFill) trackFill.style.height = "100%";
            if (progressFill) progressFill.style.width = "100%";
            return;
        }

        stages.forEach((stage) => {
            ScrollTrigger.create({
                trigger: stage,
                start: "top 85%",
                once: true,
                onEnter: () => stage.classList.add("is-visible"),
            });
        });

        stages.forEach((stage, index) => {
            ScrollTrigger.create({
                trigger: stage,
                start: "top 60%",
                end: "bottom 40%",
                onEnter: () => setActive(index),
                onEnterBack: () => setActive(index),
            });
        });

        function setActive(index) {
            stages.forEach((stage, stageIndex) => stage.classList.toggle("is-active", stageIndex === index));
            if (progressCurrent) progressCurrent.textContent = String(index + 1).padStart(2, "0");
            if (progressFill) progressFill.style.width = ((index + 1) / stages.length) * 100 + "%";
        }

        ScrollTrigger.create({
            trigger: timeline,
            start: "top 70%",
            end: "bottom 60%",
            scrub: 0.6,
            onUpdate: (self) => {
                if (trackFill) trackFill.style.height = (self.progress * 100) + "%";
            },
        });
    })();

    // ============================================================
    // ABOUT — editorial reveal
    // ============================================================
    (function aboutReveal() {
        const section = document.getElementById("about");
        if (!section) return;

        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        if (reduceMotion) return;

        const eyebrowRow = section.querySelector(".abt-eyebrow-row");
        const lines = gsap.utils.toArray(".abt-line", section);
        const copyParas = gsap.utils.toArray(".abt-copy", section);
        const location = section.querySelector(".abt-location");
        const rail = section.querySelector(".abt-rail");

        ScrollTrigger.create({
            trigger: section,
            start: "top 70%",
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: "power3.out" } });

                tl.add(() => eyebrowRow.classList.add("is-revealed"))
                    .to({}, { duration: 0.05 })
                    .add(() => lines.forEach((line, index) => {
                        setTimeout(() => line.classList.add("is-revealed"), index * 90);
                    }), "+=0.1")
                    .add(() => copyParas.forEach((paragraph, index) => {
                        setTimeout(() => paragraph.classList.add("is-revealed"), index * 100);
                    }), "+=0.5")
                    .add(() => location.classList.add("is-revealed"), "+=0.35")
                    .add(() => rail.classList.add("is-revealed"), "+=0.2");
            },
        });
    })();

    // ============================================================
    // WHY HIRE — THE WORKING RELATIONSHIP
    // ============================================================
    (function whyJourney() {
        const host = document.getElementById("whyScrollHost");
        if (!host) return;
        const railFill = document.getElementById("whyRailFill");
        const nodes = gsap.utils.toArray(".why-node-col", host);
        const stages = gsap.utils.toArray(".why-stage", host);
        const groups = gsap.utils.toArray(".why-diagram-group", host);
        const spacers = gsap.utils.toArray(".why-scroll-spacer", host);
        const section = document.getElementById("why");
        const clamp = (value, min, max) => Math.min(Math.max(value, min), max);
        const map = {
            1: ["node-client", "node-dev", "path-1", "label-client", "label-dev"],
            2: ["node-db", "node-roles", "path-2a", "path-2b", "label-db", "label-roles"],
            3: ["node-schema", "node-backend", "node-api", "node-interface", "path-3a", "path-3b", "path-3c", "label-schema", "label-backend", "label-api", "label-interface"],
            4: ["node-build", "node-extend", "node-scale", "path-4a", "path-4b", "label-build", "label-extend", "label-scale"]
        };
        function setStage(stage) {
            const safeStage = clamp(Number(stage), 1, 4);
            nodes.forEach(node => {
                const isActive = Number(node.dataset.stage) === safeStage;
                node.classList.toggle("is-active", isActive);
                node.setAttribute("aria-pressed", String(isActive));
            });
            stages.forEach(item => item.classList.toggle("is-active", Number(item.dataset.stage) === safeStage));
            groups.forEach(group => group.classList.toggle("is-shown", Number(group.dataset.group) <= safeStage));
            Object.entries(map).forEach(([number, ids]) => {
                ids.forEach(id => {
                    const el = document.getElementById(id);
                    if (!el) return;
                    const isActive = Number(number) <= safeStage;
                    const isPath = id.startsWith("path-");
                    const isLabel = id.startsWith("label-");
                    el.classList.toggle(isPath ? "is-drawn" : "is-active", isActive);
                    if (isLabel) el.style.opacity = isActive ? "1" : "0.7";
                });
            });
            if (railFill) {
                const progress = safeStage === 1 ? 0 : ((safeStage - 1) / 3) * 100;
                railFill.style.width = progress + "%";
            }
        }
        function updateFromScroll() {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;
            const viewportCenter = window.scrollY + (window.innerHeight * 0.5);
            const safeRange = Math.max(1, sectionBottom - sectionTop);
            const progress = clamp((viewportCenter - sectionTop) / safeRange, 0, 1);
            const stage = 1 + Math.min(3, Math.floor(progress * 4));
            setStage(stage);
        }
        nodes.forEach(node => {
            node.addEventListener("click", () => {
                const stage = Number(node.dataset.stage);
                const target = spacers[stage - 1];
                setStage(stage);
                if (target) {
                    target.scrollIntoView({ behavior: "smooth", block: "center" });
                }
            });
        });
        if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
            setStage(4);
            return;
        }
        setStage(1);
        window.addEventListener("scroll", updateFromScroll, { passive: true });
        window.addEventListener("resize", updateFromScroll);
        updateFromScroll();
    })();



    // ============================================================
    // THEME
    // ============================================================
    const ThemeModule = (() => {
        let current = "dark";
        function apply(theme) {
            current = theme;
            document.documentElement.setAttribute("data-theme", theme);
        }
        function toggle() {
            apply(current === "dark" ? "light" : "dark");
        }
        function get() { return current; }
        return { apply, toggle, get };
    })();
    const themeToggle = document.getElementById("themeToggle");
    if (themeToggle) themeToggle.addEventListener("click", ThemeModule.toggle);

    const header = document.getElementById("siteHeader");
    let scrollTicking = false;
    if (header) window.addEventListener("scroll", () => {
        if (scrollTicking) return;
        scrollTicking = true;
        requestAnimationFrame(() => {
            header.classList.toggle("scrolled", window.scrollY > 40);
            scrollTicking = false;
        });
    }, { passive: true });

    // Hero intro
    window.playHeroIntro = function playHeroIntro() {
        if (!window.gsap) return;
        gsap.to(".hero-copy h1 .line span", { y: 0, duration: 0.9, stagger: 0.12, ease: "power4.out" });
        gsap.fromTo(".hero-sub, .hero-actions, .hero-stats", { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.8, stagger: 0.12, delay: 0.5, ease: "power2.out" });
        gsap.fromTo(".hero-visual", { opacity: 0, scale: 0.92 }, { opacity: 1, scale: 1, duration: 1, delay: 0.3, ease: "power3.out" });
        animateCounters();
    }

    // ============================================================
    // SPOTLIGHT + HERO TWEAKS
    // ============================================================
    const heroSection = document.querySelector(".hero");
    const portrait = document.getElementById("portrait");
    const spotlight = document.getElementById("spotlight");
    const floatTags = gsap.utils.toArray(".float-tag");

    gsap.set(spotlight, { xPercent: -50, yPercent: -50 });

    const setSpotX = gsap.quickTo(spotlight, "x", { duration: 0.4, ease: "power2.out" });
    const setSpotY = gsap.quickTo(spotlight, "y", { duration: 0.4, ease: "power2.out" });
    const setPortraitX = gsap.quickTo(portrait, "x", { duration: 0.6, ease: "power2.out" });
    const setPortraitY = gsap.quickTo(portrait, "y", { duration: 0.6, ease: "power2.out" });
    const setPortraitRY = gsap.quickTo(portrait, "rotateY", { duration: 0.6, ease: "power2.out" });
    const setPortraitRX = gsap.quickTo(portrait, "rotateX", { duration: 0.6, ease: "power2.out" });
    const floatTagSetters = floatTags.map((tag) => ({
        x: gsap.quickTo(tag, "x", { duration: 0.6, ease: "power2.out" }),
        y: gsap.quickTo(tag, "y", { duration: 0.6, ease: "power2.out" }),
    }));

    let pointerX = -9999, pointerY = -9999, pointerDirty = false;
    let heroRect = null;
    function refreshHeroRect() { heroRect = heroSection.getBoundingClientRect(); }
    refreshHeroRect();
    window.addEventListener("resize", refreshHeroRect, { passive: true });

    window.addEventListener("mousemove", (e) => {
        pointerX = e.clientX;
        pointerY = e.clientY;
        pointerDirty = true;
    }, { passive: true });

    gsap.ticker.add(() => {
        if (!pointerDirty) return;
        pointerDirty = false;
        setSpotX(pointerX);
        setSpotY(pointerY);

        if (heroRect && pointerY >= heroRect.top && pointerY <= heroRect.bottom) {
            const nx = (pointerX - heroRect.left) / heroRect.width - 0.5;
            const ny = (pointerY - heroRect.top) / heroRect.height - 0.5;
            setPortraitX(nx * 24);
            setPortraitY(ny * 24);
            setPortraitRY(nx * 8);
            setPortraitRX(-ny * 8);
            floatTagSetters.forEach((s) => { s.x(nx * 12); s.y(ny * 12); });
        }
    });

    // Hero rotating words
    (function heroRotator() {
        const words = ["dashboards", "portals", "business platforms", "admin systems", "internal tools"];
        const wrap = document.getElementById("heroRotate");
        let i = 0;
        function render() {
            wrap.innerHTML = `<span class="rot-word">${words[i]}</span>`;
            wrap.style.width = "auto";
            gsap.fromTo(wrap.firstChild, { y: "100%", opacity: 0 }, { y: "0%", opacity: 1, duration: 0.5, ease: "power2.out" });
        }
        render();
        setInterval(() => {
            const outEl = wrap.firstChild;
            gsap.to(outEl, { y: "-100%", opacity: 0, duration: 0.4, ease: "power2.in", onComplete: () => { i = (i + 1) % words.length; render(); } });
        }, 2600);
    })();

    // Section reveal animations
    gsap.utils.toArray(".section").forEach((section) => {
        const revealTargets = section.querySelectorAll(".reveal");
        if (!revealTargets || revealTargets.length === 0) return;

        gsap.from(revealTargets, {
            opacity: 0,
            y: 40,
            duration: 0.8,
            stagger: 0.12,
            ease: "power3.out",
            scrollTrigger: { trigger: section, start: "top 75%", once: true },
        });
    });

    // Button hover effects
    document.querySelectorAll(".btn-primary, .btn-secondary").forEach((btn) => {
        btn.addEventListener("mousemove", (e) => {
            const r = btn.getBoundingClientRect();
            const x = e.clientX - r.left - r.width / 2;
            const y = e.clientY - r.top - r.height / 2;
            gsap.to(btn, { x: x * 0.25, y: y * 0.35, duration: 0.3 });
        });
        btn.addEventListener("mouseleave", () =>
            gsap.to(btn, { x: 0, y: 0, duration: 0.4, ease: "elastic.out(1,0.4)" })
        );
    });

    // FAQ accordion
    document.querySelectorAll(".faq-item").forEach((item) => {
        const q = item.querySelector(".faq-q");
        const a = item.querySelector(".faq-a");
        q.addEventListener("click", () => {
            const isOpen = item.classList.contains("open");
            document.querySelectorAll(".faq-item").forEach((i) => {
                i.classList.remove("open");
                i.querySelector(".faq-a").style.maxHeight = null;
            });
            if (!isOpen) {
                item.classList.add("open");
                a.style.maxHeight = a.scrollHeight + "px";
            }
        });
    });

    // Chart mockup (if present)
    (function buildMockupChart() {
        const chart = document.getElementById("ueChart");
        if (!chart) return;
        const vals = [40, 65, 50, 80, 55, 90, 70, 60, 85, 95, 75, 88];
        vals.forEach((v) => {
            const bar = document.createElement("i");
            bar.style.height = v + "%";
            chart.appendChild(bar);
        });
    })();

    // Animate counters
    function animateCounters() {
        document.querySelectorAll("[data-count]").forEach((el) => {
            const target = parseInt(el.getAttribute("data-count"), 10);
            const obj = { val: 0 };
            gsap.to(obj, {
                val: target,
                duration: 1.4,
                ease: "power2.out",
                onUpdate: () => { el.textContent = Math.floor(obj.val); },
                scrollTrigger: { trigger: el, start: "top 90%", once: true },
            });
        });
        const statSystems = document.getElementById("statSystems");
        const projectCards = document.querySelectorAll('.project-card').length;
        gsap.to({ v: 0 }, {
            v: projectCards,
            duration: 1.2,
            ease: "power2.out",
            onUpdate: function() { statSystems.textContent = Math.floor(this.targets()[0].v); },
        });
    }

    // ============================================================
    // TECH STACK (static – from portfolioData)
    // ============================================================
    (function renderStack() {
        const grid = document.getElementById("stackGrid");
        Object.entries(portfolioData.stack).forEach(([category, items]) => {
            const cell = document.createElement("div");
            cell.className = "stack-cell";
            const list = items.map((t) =>
                `<li class="tech-chip" data-tech="${t.name}">
                    <span>${t.name}</span>
                    <span class="stars">${"★".repeat(t.stars)}${"☆".repeat(5 - t.stars)}</span>
                </li>`
            ).join("");
            cell.innerHTML = `<span class="cat">${category}</span><ul>${list}</ul>`;
            grid.appendChild(cell);
        });

        const pop = document.createElement("div");
        pop.className = "tech-popover";
        pop.id = "techPopover";
        document.body.appendChild(pop);

        function findTech(name) {
            for (const cat of Object.values(portfolioData.stack)) {
                const found = cat.find((t) => t.name === name);
                if (found) return found;
            }
            return null;
        }

        function showPopover(chip) {
            const tech = findTech(chip.dataset.tech);
            if (!tech) return;
            pop.innerHTML = `
                <h5>${tech.name}</h5>
                <p>${tech.desc}</p>
                <div class="tp-row">${tech.uses.map((u) => `<span class="tp-chip">${u}</span>`).join("")}</div>
                <div class="tp-row" style="margin-top:8px;">${tech.related.map((r) => `<span class="tp-chip">${r}</span>`).join("")}</div>
            `;
            const r = chip.getBoundingClientRect();
            pop.style.left = Math.min(r.left, window.innerWidth - 280) + "px";
            pop.style.top = r.bottom + window.scrollY + 8 + "px";
            pop.classList.add("show");
        }

        function hidePopover() { pop.classList.remove("show"); }

        document.querySelectorAll(".tech-chip").forEach((chip) => {
            chip.addEventListener("mouseenter", () => showPopover(chip));
            chip.addEventListener("mouseleave", hidePopover);
            chip.addEventListener("click", () => showPopover(chip));
        });
        document.addEventListener("scroll", hidePopover, { passive: true });
    })();

    // ============================================================
    // BLOG (static)
    // ============================================================
    (function renderBlog() {
        const grid = document.getElementById("blogGrid");
        if (!grid) return;
        portfolioData.blog.forEach((b) => {
            const card = document.createElement("div");
            card.className = "blog-card";
            card.innerHTML = `
                <span class="blog-tag">${b.tag}</span>
                <h3>${b.title}</h3>
                <p>${b.summary}</p>
                <div class="blog-meta">${b.meta}</div>
            `;
            grid.appendChild(card);
        });
    })();

    // ============================================================
    // PROJECT OVERLAYS – now handled by PHP-generated HTML
    // ============================================================
    function openOverlay(id) {
        const overlay = document.getElementById("overlay-" + id);
        if (!overlay) return;
        overlay.classList.add("open");
        document.body.style.overflow = "hidden";
        gsap.fromTo(overlay.querySelectorAll(".ov-section, .overlay-hero"), { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.6, stagger: 0.05, ease: "power2.out", delay: 0.15 });
    }

    function closeOverlay(overlay) {
        overlay.classList.remove("open");
        document.body.style.overflow = "";
    }

    document.addEventListener("click", (e) => {
        const opener = e.target.closest("[data-open-project]");
        if (opener) { openOverlay(opener.dataset.openProject); }
        const closer = e.target.closest("[data-close-overlay]");
        if (closer) { closeOverlay(closer.closest(".overlay")); }
        const tabBtn = e.target.closest(".overlay-nav button");
        if (tabBtn) {
            const overlay = tabBtn.closest(".overlay");
            overlay.querySelectorAll(".overlay-nav button").forEach((b) => b.classList.remove("active"));
            tabBtn.classList.add("active");
            const target = overlay.querySelector("#" + tabBtn.dataset.tab + "-" + overlay.id.replace("overlay-", ""));
            if (target) target.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    });
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            document.querySelectorAll(".overlay.open").forEach((o) => closeOverlay(o));
        }
    });

    // ============================================================
    // CASE STUDY — PREMIUM FULL-SCREEN PROJECT EXPERIENCE
    // ============================================================
    (function caseStudySystem() {
        'use strict';

        const overlay = document.getElementById('caseStudyOverlay');
        const overlayInner = document.getElementById('caseStudyInner');
        const closeBtn = document.getElementById('caseStudyClose');
        const content = document.getElementById('caseStudyContent');

        if (!overlay || !overlayInner || !content) {
            console.warn('Case study overlay elements not found');
            return;
        }

        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        let isOpen = false;
        let scrollPosition = 0;

        // ============================================================
        // PROJECT DATA - Hardcoded for the editorial section
        // ============================================================
        const projectData = [
            {
                id: 'union',
                title: 'Union Enterprises',
                image: 'ue.PNG',
                short_description: 'A two-sided platform replacing spreadsheet-based tracking with a single operational source of truth for shipments, invoices and documents.',
                description: 'A two-sided platform replacing spreadsheet-based tracking with a single operational source of truth for shipments, invoices and documents.',
                technologies: ['Laravel', 'MySQL', 'REST API', 'Role-Based Access'],
                metrics: [
                    { value: '14', label: 'DB Tables' },
                    { value: '2', label: 'User Roles' },
                    { value: '22', label: 'REST Endpoints' },
                    { value: '2', label: 'Sides — Admin & Client' }
                ],
                overview: 'Union Enterprises needed one system that both internal operations staff and clients could rely on for the same shipment, invoice and document records — instead of each side keeping its own version in a spreadsheet.',
                problem: 'Shipment status, invoice records and supporting documents were tracked across scattered spreadsheets, with no shared source of truth between the team handling operations and the clients waiting on updates. Anything that changed on one side had to be manually re-entered on the other.',
                approach: 'Built as a two-sided Laravel platform on a single MySQL schema: one experience for internal operations, one simplified view for clients, both reading from the same underlying records rather than duplicated data. Role-based access controls which side of the platform a given login can see.',
                architecture: 'The schema spans 14 tables covering shipments, invoices, documents and the relationships between them, exposed through 22 REST endpoints and gated by two distinct roles — internal staff and client accounts.',
                features: '• Shipment tracking across origin, transit and delivery status\n• Invoice records with payment status per client\n• Centralized document storage tied to each shipment\n• Role-gated views separating internal staff and client access\n• A single operational source of truth shared by both sides',
                status: 'In production'
            },
            {
                id: 'movie',
                title: 'Online Movie Booking System',
                image: 'mbs2.PNG',
                short_description: 'A full-stack booking platform for browsing movies, selecting showtimes and seats, and completing cinema ticket bookings online.',
                description: 'Developed a full-stack web-based Online Movie Booking System designed to streamline the cinema ticket-booking process.',
                technologies: ['PHP', 'MySQL', 'Bootstrap', 'jQuery'],
                metrics: [
                    { value: '14', label: 'Key Features' },
                    { value: '2', label: 'User Roles' },
                    { value: '1', label: 'Booking System' }
                ],
                overview: 'A full-stack web-based platform that lets users browse movies, explore showtimes, select seats through an interactive seating interface, and complete online ticket bookings.',
                problem: 'Cinema ticket booking needed a streamlined digital flow for movie discovery, showtime selection, seat availability, and booking history, while administrators needed centralized control over cinema operations.',
                approach: 'Built a PHP and MySQL booking system with user authentication, movie and showtime management, interactive seat selection, session-based booking flows, and an administrative dashboard.',
                features: '• User registration and authentication\n• Movie browsing and detailed movie pages\n• Showtime and date selection\n• Interactive seat selection and availability management\n• Online ticket booking and booking history\n• Movie, screen, seat, showtime, user, and booking management\n• Administrative dashboard and validated forms',
                status: 'Completed'
            },
            {
                id: 'jewelry',
                title: 'Jewelry Website',
                image: 'jw.PNG',
                short_description: 'A product-focused website for a jewelry business, built around clean product presentation and straightforward navigation.',
                description: 'A product-focused website for a jewelry business, built around clean product presentation and straightforward navigation.',
                technologies: ['PHP', 'Bootstrap', 'JavaScript'],
                metrics: [
                    { value: '8', label: 'Pages' },
                    { value: '6', label: 'Product Categories' },
                    { value: '2', label: 'Modules' }
                ],
                overview: 'A PHP and Bootstrap site built for a jewelry business, prioritizing clear product presentation and simple navigation over anything decorative.',
                problem: 'The client needed a clean, professional website that would showcase their jewelry products without unnecessary complexity or distracting design elements.',
                approach: 'Structured around 8 pages and 6 product categories, with the front end kept deliberately straightforward — a PHP backend, Bootstrap for layout and components, and JavaScript for interactive product presentation.',
                features: '• Product catalog organized across 6 categories\n• Clean, image-forward product presentation\n• Straightforward navigation across 8 pages',
                status: 'Live'
            },
            {
                id: 'aniwear',
                title: 'Aniwear — Digital Wardrobe + AI Stylist',
                image: 'aw.PNG',
                short_description: 'Digital wardrobe management with personalized AI styling recommendations.',
                description: 'A fashion-tech web application combining digital wardrobe management with an AI-powered personal styling assistant.',
                technologies: ['HTML5', 'CSS3', 'JavaScript', 'Bootstrap', 'jQuery', 'PHP', 'Laravel', 'MySQL', 'AI API'],
                metrics: [
                    { value: '14', label: 'Key Features' },
                    { value: '1', label: 'AI Stylist' },
                    { value: '1', label: 'Live Platform' }
                ],
                overview: 'Aniwear lets users digitally organize clothing, categorize wardrobe items, create and save outfits, and receive personalized recommendations from an AI stylist.',
                problem: 'Users needed a practical way to manage their clothing collection and discover outfit combinations based on what they already own.',
                approach: 'Built a Laravel and MySQL application with authenticated dashboards, structured wardrobe data, outfit management, and an AI knowledge base for consistent styling recommendations.',
                features: '• Digital wardrobe management and clothing categorization\n• Add, edit, view, and remove wardrobe items\n• Outfit creation and saved or favorite outfits\n• Personalized AI stylist and outfit recommendations\n• Occasion, color, style, season, and preference-based suggestions\n• User authentication and personalized dashboard',
                status: 'Live'
            }
        ];

        // ============================================================
        // BUILD CASE STUDY HTML
        // ============================================================
        function buildCaseStudy(project, index, total) {
            const tech = project.technologies || [];
            const metrics = project.metrics || [];

            let metricsHTML = '';
            if (metrics.length > 0) {
                metricsHTML = metrics.map(m => `
                    <div class="case-metric-item">
                        <span class="metric-value">${m.value || ''}</span>
                        <span class="metric-label">${m.label || ''}</span>
                    </div>
                `).join('');
            }

            let techHTML = tech.map(t => `<span class="tech-pill">${t}</span>`).join('');

            const sections = [
                { label: 'Overview', content: project.overview || '' },
                { label: 'Problem', content: project.problem || '' },
                { label: 'Approach', content: project.approach || '' },
                { label: 'Architecture', content: project.architecture || '' },
                { label: 'Features', content: project.features || '' }
            ].filter(s => s.content && s.content.trim().length > 0);

            let sectionsHTML = sections.map(s => `
                <div class="case-section">
                    <span class="case-section-label">${s.label}</span>
                    <h2>${s.label}</h2>
                    <p>${s.content.replace(/\n/g, '<br>')}</p>
                </div>
            `).join('');

            const galleryHTML = project.image
                ? `<div class="case-gallery case-gallery--single">
                    <div class="case-gallery-item"><img src="${project.image}" alt="${project.title} project screenshot" loading="lazy"></div>
                </div>`
                : `<div class="case-gallery case-gallery--single">
                    <div class="case-gallery-item placeholder">Project screenshot</div>
                </div>`;

            const prevIndex = index > 0 ? index - 1 : total - 1;
            const nextIndex = index < total - 1 ? index + 1 : 0;

            return `
                <div class="case-study-hero">
                    <div class="case-number">${String(index + 1).padStart(2, '0')} / ${String(total).padStart(2, '0')}</div>
                    <h1>${project.title}</h1>
                    <p class="case-subtitle">${project.short_description || project.description || ''}</p>
                    <div class="case-tech-stack">${techHTML}</div>
                    <div class="case-metrics-grid">${metricsHTML}</div>
                </div>

                ${galleryHTML}

                ${sectionsHTML}

                <div class="case-navigation">
                    <button class="case-nav-btn prev" data-project-index="${prevIndex}">
                        <span class="nav-arrow">←</span> Previous Project
                    </button>
                    <button class="case-nav-btn case-nav-back" data-project-index="-1">
                        ← Back to Projects
                    </button>
                    <button class="case-nav-btn next" data-project-index="${nextIndex}">
                        Next Project <span class="nav-arrow">→</span>
                    </button>
                </div>
            `;
        }

        // ============================================================
        // OPEN CASE STUDY
        // ============================================================
        function openCaseStudy(projectId) {
            if (isOpen) return;

            const projectIndex = projectData.findIndex(p => p.id === projectId);
            if (projectIndex === -1) {
                console.warn('Project not found:', projectId);
                return;
            }

            const project = projectData[projectIndex];
            scrollPosition = window.scrollY;

            content.innerHTML = buildCaseStudy(project, projectIndex, projectData.length);

            document.body.style.overflow = 'hidden';
            overlay.classList.add('open');
            isOpen = true;

            if (window.setCursorType) {
                window.setCursorType('default');
            }

            setupNavigation(projectIndex);
            overlayInner.scrollTop = 0;
        }

        // ============================================================
        // CLOSE CASE STUDY
        // ============================================================
        function closeCaseStudy() {
            if (!isOpen) return;

            overlay.classList.remove('open');
            document.body.style.overflow = '';
            isOpen = false;

            window.scrollTo(0, scrollPosition);

            if (window.setCursorType) {
                window.setCursorType('default');
            }

            setTimeout(() => {
                content.innerHTML = '';
            }, 400);
        }

        // ============================================================
        // SETUP NAVIGATION
        // ============================================================
        function setupNavigation(currentIndex) {
            const navBtns = content.querySelectorAll('.case-nav-btn');
            navBtns.forEach(btn => {
                btn.removeEventListener('click', handleNavClick);
                btn.addEventListener('click', handleNavClick);
            });
        }

        function handleNavClick(e) {
            const btn = e.currentTarget;
            const index = parseInt(btn.dataset.projectIndex, 10);

            if (index === -1) {
                closeCaseStudy();
                return;
            }

            const project = projectData[index];
            if (project) {
                const newContent = buildCaseStudy(project, index, projectData.length);
                content.innerHTML = newContent;
                setupNavigation(index);
                overlayInner.scrollTop = 0;
            }
        }

        // ============================================================
        // EVENT LISTENERS
        // ============================================================

        // Click on "View case study" links (data-open-project)
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-open-project]');
            if (trigger) {
                e.preventDefault();
                const projectId = trigger.dataset.openProject;
                if (projectId) {
                    openCaseStudy(projectId);
                }
            }
        });

        // Click on "View case study" spans
        document.addEventListener('click', function(e) {
            const span = e.target.closest('.sw-open');
            if (span) {
                const parent = span.closest('[data-open-project]');
                if (parent) {
                    e.preventDefault();
                    const projectId = parent.dataset.openProject;
                    if (projectId) {
                        openCaseStudy(projectId);
                    }
                }
            }
        });

        // Close button
        if (closeBtn) {
            closeBtn.addEventListener('click', closeCaseStudy);
        }

        // Click on overlay backdrop closes
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeCaseStudy();
            }
        });

        // ESC key closes
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) {
                closeCaseStudy();
            }
        });

        // ============================================================
        // CURSOR INTEGRATION
        // ============================================================
        if (window.setCursorType) {
            document.querySelectorAll('[data-open-project]').forEach(el => {
                el.addEventListener('mouseenter', () => {
                    if (!isOpen) {
                        window.setCursorType('view');
                    }
                });
                el.addEventListener('mouseleave', () => {
                    if (!isOpen) {
                        window.setCursorType('default');
                    }
                });
            });

            if (closeBtn) {
                closeBtn.addEventListener('mouseenter', () => {
                    if (isOpen) {
                        window.setCursorType('close');
                    }
                });
                closeBtn.addEventListener('mouseleave', () => {
                    if (isOpen) {
                        window.setCursorType('default');
                    }
                });
            }
        }

        console.log('✅ Case study system initialized with ' + projectData.length + ' projects');
    })();

    // ============================================================
    // COMMAND PALETTE
    // ============================================================
    const cmdkOverlay = document.getElementById("cmdkOverlay");
    const cmdkInput = document.getElementById("cmdkInput");
    const cmdkList = document.getElementById("cmdkList");

    const cmdkCommands = [
        { label: "Search Projects", hint: "↵", action: () => scrollToSection("#projects") },
        { label: "Search Skills", hint: "↵", action: () => scrollToSection("#stack") },
        { label: "Download Resume", hint: "↵", action: () => { closeCmdk(); const link = document.createElement("a"); link.href = "Muhammad_Harmain_NovExa_Executive_CV.pdf"; link.download = "Harmain_Resume.pdf"; document.body.appendChild(link); link.click(); link.remove(); } },
        { label: "Open GitHub", hint: "↵", action: () => scrollToSection("#github") },
        { label: "GitHub Activity", hint: "↵", action: () => scrollToSection("#github") },
        { label: "Contact", hint: "↵", action: () => scrollToSection("#contact") },
        { label: "AI Assistant", hint: "↵", action: () => scrollToSection("#assistant") },
        { label: "Navigate: About", hint: "↵", action: () => scrollToSection("#about") },
        { label: "Navigate: Work", hint: "↵", action: () => scrollToSection("#projects") },
        { label: "Navigate: Services", hint: "↵", action: () => scrollToSection("#services") },
        { label: "Navigate: Blog", hint: "↵", action: () => scrollToSection("#blog") },
        { label: "Toggle Dark Mode", hint: "↵", action: () => ThemeModule.apply("dark") },
        { label: "Toggle Light Mode", hint: "↵", action: () => ThemeModule.apply("light") },
    ];

    document.querySelectorAll('.project-card[data-open-project]').forEach((card) => {
        const id = card.dataset.openProject;
        const name = card.querySelector('h3')?.textContent || 'Project';
        cmdkCommands.push({
            label: `Open case study: ${name}`,
            hint: "↵",
            action: () => { closeCmdk(); openCaseStudy(id); }
        });
    });

    function scrollToSection(sel) {
        closeCmdk();
        const el = document.querySelector(sel);
        if (el) el.scrollIntoView({ behavior: "smooth" });
    }

    let cmdkActiveIndex = 0;

    function renderCmdk(filter = "") {
        const f = filter.toLowerCase();
        const filtered = cmdkCommands.filter((c) => c.label.toLowerCase().includes(f));
        cmdkList.innerHTML = filtered.length ?
            filtered.map((c, i) =>
                `<div class="cmdk-item ${i === cmdkActiveIndex ? "active" : ""}" data-idx="${i}">
                    <span>${c.label}</span><span class="k">${c.hint}</span>
                </div>`
            ).join("") :
            `<div class="cmdk-empty">No matching commands</div>`;
        cmdkList._filtered = filtered;
    }

    function openCmdk() {
        cmdkOverlay.classList.add("open");
        cmdkInput.value = "";
        cmdkActiveIndex = 0;
        renderCmdk("");
        setTimeout(() => cmdkInput.focus(), 50);
    }

    function closeCmdk() { cmdkOverlay.classList.remove("open"); }

    document.getElementById("cmdkTrigger").addEventListener("click", openCmdk);
    document.addEventListener("keydown", (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "k") { e.preventDefault(); openCmdk(); }
        if (e.key === "Escape") { closeCmdk(); }
    });
    cmdkOverlay.addEventListener("click", (e) => {
        if (e.target === cmdkOverlay) closeCmdk();
    });
    cmdkInput.addEventListener("input", () => { cmdkActiveIndex = 0; renderCmdk(cmdkInput.value); });
    cmdkInput.addEventListener("keydown", (e) => {
        const items = cmdkList._filtered || [];
        if (e.key === "ArrowDown") { e.preventDefault(); cmdkActiveIndex = Math.min(items.length - 1, cmdkActiveIndex + 1); renderCmdk(cmdkInput.value); }
        if (e.key === "ArrowUp") { e.preventDefault(); cmdkActiveIndex = Math.max(0, cmdkActiveIndex - 1); renderCmdk(cmdkInput.value); }
        if (e.key === "Enter") {
            const item = items[cmdkActiveIndex];
            if (item) { item.action(); closeCmdk(); }
        }
    });
    cmdkList.addEventListener("click", (e) => {
        const item = e.target.closest(".cmdk-item");
        if (item) {
            const idx = parseInt(item.dataset.idx, 10);
            const cmd = cmdkList._filtered[idx];
            if (cmd) { cmd.action(); closeCmdk(); }
        }
    });

    // ============================================================
    // MOBILE NAV TOGGLE
    // ============================================================
    (function initMobileNavigation() {
        const toggle = document.getElementById('navToggle');
        const links = document.querySelector('.nav-links');
        if (!toggle || !links) return;
        links.id = 'primaryNavigation';
        const setOpen = (open) => {
            links.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', String(open));
            toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        };
        toggle.addEventListener('click', () => setOpen(!links.classList.contains('is-open')));
        links.addEventListener('click', (event) => {
            if (event.target.closest('a')) setOpen(false);
        });
        document.addEventListener('pointerdown', (event) => {
            if (!links.classList.contains('is-open') || links.contains(event.target) || toggle.contains(event.target)) return;
            setOpen(false);
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && links.classList.contains('is-open')) {
                setOpen(false);
                toggle.focus();
            }
        });
    })();

    // ============================================================
    // DEVELOPMENT PROCESS — SYSTEM CORE / BLUEPRINT
    // ============================================================
    (function systemCoreBlueprint() {
        const blueprint = document.getElementById("blueprint");
        if (!blueprint) return;

        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        const stages = [
            { n: "01", label: "Discovery", title: "Discovery", desc: "Understand the daily workflow and where it currently breaks down.", micro: "discovery" },
            { n: "02", label: "Planning", title: "Planning", desc: "Scope modules, roles, and what belongs in v1 versus later.", micro: "planning" },
            { n: "03", label: "Research", title: "Research", desc: "Map what each user type repeatedly needs to see or do.", micro: "research" },
            { n: "04", label: "UI Design", title: "UI Design", desc: "Wireframe around the daily user, not the feature list.", micro: "uidesign" },
            { n: "05", label: "Architecture", title: "Architecture", desc: "Define the Laravel MVC structure and middleware boundaries.", micro: "architecture" },
            { n: "06", label: "Database", title: "Database Design", desc: "Normalize the schema before a single screen is built.", micro: "database" },
            { n: "07", label: "Development", title: "Development", desc: "Build backend and frontend in parallel against the agreed schema.", micro: "development" },
            { n: "08", label: "Testing", title: "Testing", desc: "Verify roles, permissions, and edge cases against real workflows.", micro: "testing" },
            { n: "09", label: "Deployment", title: "Deployment", desc: "Ship to production with migrations and rollback in place.", micro: "deployment" },
            { n: "10", label: "Maintenance", title: "Maintenance", desc: "Monitor, fix, and extend as the business's needs change.", micro: "maintenance" },
        ];

        const microVisuals = {
            discovery: `<svg viewBox="0 0 64 40"><circle class="core-micro-dot" cx="14" cy="20" r="2.4"/><circle class="core-micro-dot" cx="32" cy="10" r="2"/><circle class="core-micro-dot" cx="50" cy="26" r="2"/><path class="core-micro-path" d="M14 20 L32 10 L50 26"/></svg>`,
            planning: `<svg viewBox="0 0 64 40"><rect class="core-micro-path" x="10" y="8" width="16" height="10" rx="1"/><rect class="core-micro-path" x="10" y="22" width="16" height="10" rx="1"/><rect class="core-micro-path" x="38" y="15" width="16" height="10" rx="1"/></svg>`,
            research: `<svg viewBox="0 0 64 40"><circle class="core-micro-path" cx="32" cy="20" r="10"/><circle class="core-micro-dot" cx="32" cy="20" r="2"/><circle class="core-micro-dot" cx="14" cy="10" r="1.6"/><circle class="core-micro-dot" cx="52" cy="30" r="1.6"/></svg>`,
            uidesign: `<svg viewBox="0 0 64 40"><rect class="core-micro-path" x="10" y="8" width="44" height="24" rx="2"/><line class="core-micro-path" x1="10" y1="16" x2="54" y2="16"/><line class="core-micro-path" x1="18" y1="22" x2="40" y2="22"/></svg>`,
            architecture: `<svg viewBox="0 0 64 40"><circle class="core-micro-dot" cx="32" cy="8" r="2"/><circle class="core-micro-dot" cx="14" cy="30" r="2"/><circle class="core-micro-dot" cx="50" cy="30" r="2"/><path class="core-micro-path" d="M32 8 L14 30 M32 8 L50 30 M14 30 L50 30"/></svg>`,
            database: `<svg viewBox="0 0 64 40"><rect class="core-micro-path" x="8" y="6" width="16" height="12" rx="1"/><rect class="core-micro-path" x="40" y="6" width="16" height="12" rx="1"/><rect class="core-micro-path" x="24" y="24" width="16" height="12" rx="1"/><path class="core-micro-path" d="M16 18 L32 24 M48 18 L32 24"/></svg>`,
            development: `<svg viewBox="0 0 64 40"><rect class="core-micro-path" x="12" y="6" width="40" height="8" rx="1"/><rect class="core-micro-path" x="12" y="17" width="40" height="8" rx="1"/><rect class="core-micro-path" x="12" y="28" width="24" height="8" rx="1"/></svg>`,
            testing: `<svg viewBox="0 0 64 40"><line class="core-micro-path" x1="8" y1="12" x2="32" y2="12"/><circle class="core-micro-dot" cx="32" cy="12" r="2"/><line class="core-micro-path" x1="32" y1="12" x2="32" y2="24"/><line class="core-micro-path" x1="32" y1="24" x2="18" y2="32"/><line class="core-micro-path" x1="32" y1="24" x2="46" y2="32"/><circle class="core-micro-dot" cx="18" cy="32" r="2"/><circle class="core-micro-dot" cx="46" cy="32" r="2"/></svg>`,
            deployment: `<svg viewBox="0 0 64 40"><circle class="core-micro-dot" cx="10" cy="20" r="2.4"/><line class="core-micro-path" x1="14" y1="20" x2="48" y2="20"/><path class="core-micro-path" d="M42 15 L50 20 L42 25"/></svg>`,
            maintenance: `<svg viewBox="0 0 64 40"><circle class="core-micro-path" cx="32" cy="20" r="12"/><circle class="core-micro-dot" cx="32" cy="8" r="1.8"/><circle class="core-micro-dot" cx="44" cy="20" r="1.8"/><circle class="core-micro-dot" cx="32" cy="32" r="1.8"/><circle class="core-micro-dot" cx="20" cy="20" r="1.8"/></svg>`,
        };

        const total = stages.length;
        const linesHost = document.getElementById("blueprintLines");
        const nodesHost = document.getElementById("blueprintNodes");
        const mobileNodesHost = document.getElementById("coreMobileNodes");

        const nodeEls = [];
        const lineEls = [];
        stages.forEach((stage, i) => {
            const angle = (360 / total) * i - 90;

            const line = document.createElement("div");
            line.className = "blueprint-line";
            line.style.setProperty("--angle", angle + "deg");
            line.style.setProperty("--radius", "132px");
            linesHost.appendChild(line);
            lineEls.push(line);

            const nodeWrap = document.createElement("div");
            nodeWrap.className = "blueprint-node";
            nodeWrap.dataset.stage = String(i);
            nodeWrap.style.setProperty("--angle", angle + "deg");
            nodeWrap.style.setProperty("--radius", "216px");
            nodeWrap.innerHTML = `
                <button type="button" class="blueprint-node-btn" aria-label="Stage ${stage.n}: ${stage.label}">
                    <span class="blueprint-node-dot"></span>
                    <span class="blueprint-node-label"><span class="n">${stage.n}</span>${stage.label}</span>
                </button>
            `;
            nodesHost.appendChild(nodeWrap);
            nodeEls.push(nodeWrap);
        });

        const mobileNodeEls = [];
        stages.forEach((stage, i) => {
            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "core-mobile-node";
            btn.dataset.stage = String(i);
            btn.setAttribute("aria-label", `Stage ${stage.n}: ${stage.label}`);
            btn.innerHTML = `<span class="dot"></span><span class="lbl">${stage.n}</span>`;
            mobileNodesHost.appendChild(btn);
            mobileNodeEls.push(btn);
        });

        const refs = {
            progress: [document.getElementById("coreProgress"), document.getElementById("coreProgressM")],
            micro: [document.getElementById("coreMicro"), document.getElementById("coreMicroM")],
            num: [document.getElementById("coreNum"), document.getElementById("coreNumM")],
            title: [document.getElementById("coreTitle"), document.getElementById("coreTitleM")],
            desc: [document.getElementById("coreDesc"), document.getElementById("coreDescM")],
        };
        const coreContentInner = document.getElementById("coreContentInner");

        let activeIndex = 0;

        function render(index, opts = {}) {
            const stage = stages[index];
            if (!stage) return;

            const apply = () => {
                refs.progress.forEach((el) => el && (el.textContent = `STAGE ${stage.n} OF ${total}`));
                refs.micro.forEach((el) => el && (el.innerHTML = microVisuals[stage.micro] || ""));
                refs.num.forEach((el) => el && (el.textContent = stage.n));
                refs.title.forEach((el) => el && (el.textContent = stage.title));
                refs.desc.forEach((el) => el && (el.textContent = stage.desc));
            };

            if (reduceMotion || opts.instant) {
                apply();
            } else {
                coreContentInner.classList.add("is-swapping");
                setTimeout(() => {
                    apply();
                    coreContentInner.classList.remove("is-swapping");
                }, 140);
            }

            nodeEls.forEach((el) => el.classList.toggle("is-active", Number(el.dataset.stage) === index));
            lineEls.forEach((el, i) => el.classList.toggle("is-active", i === index));
            mobileNodeEls.forEach((el) => el.classList.toggle("is-active", Number(el.dataset.stage) === index));

            activeIndex = index;
        }

        nodeEls.forEach((el) => {
            const btn = el.querySelector(".blueprint-node-btn");
            btn.addEventListener("click", () => render(Number(el.dataset.stage)));
            btn.addEventListener("focus", () => render(Number(el.dataset.stage)));
        });
        mobileNodeEls.forEach((el) => {
            el.addEventListener("click", () => render(Number(el.dataset.stage)));
        });

        if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
            nodeEls.forEach((el) => {
                el.addEventListener("mouseenter", () => render(Number(el.dataset.stage)));
            });
        }

        render(0, { instant: true });

        if (!reduceMotion) {
            gsap.from([...lineEls, ...nodeEls, "#coreCenter"], {
                opacity: 0,
                scale: 0.95,
                duration: 0.7,
                stagger: 0.02,
                ease: "power2.out",
                scrollTrigger: { trigger: blueprint, start: "top 75%", once: true },
            });
        }

        if (!reduceMotion && window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
            const setCoreX = gsap.quickTo("#coreCenter", "x", { duration: 0.6, ease: "power2.out" });
            const setCoreY = gsap.quickTo("#coreCenter", "y", { duration: 0.6, ease: "power2.out" });
            let bpRect = null;
            function refreshRect() { bpRect = blueprint.getBoundingClientRect(); }
            refreshRect();
            window.addEventListener("resize", refreshRect, { passive: true });

            blueprint.addEventListener("mousemove", (e) => {
                if (!bpRect) refreshRect();
                const nx = (e.clientX - bpRect.left) / bpRect.width - 0.5;
                const ny = (e.clientY - bpRect.top) / bpRect.height - 0.5;
                setCoreX(nx * 3);
                setCoreY(ny * 3);
            });
            blueprint.addEventListener("mouseleave", () => {
                setCoreX(0);
                setCoreY(0);
            });
        }
    })();

    // ============================================================
    // SELECTED WORK — scoped animation module
    // ============================================================
    (function selectedWork() {
        if (typeof gsap === "undefined") return;
        if (typeof ScrollTrigger !== "undefined") gsap.registerPlugin(ScrollTrigger);

        var root = document.getElementById("swList");
        if (!root) return;

        var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        document.documentElement.classList.add("js-sw");

        var rows = Array.prototype.slice.call(root.querySelectorAll(".sw-row"));

        if (reduceMotion || typeof ScrollTrigger === "undefined") {
            document.documentElement.classList.remove("js-sw");
        } else {
            rows.forEach(function (row) {
                var copyEls = row.querySelectorAll(".sw-row-copy-el");
                var visuals = row.querySelectorAll(".sw-visual, .sw-compact-visual");
                var ghost = row.querySelectorAll(".sw-ghost");

                ScrollTrigger.create({
                    trigger: row,
                    start: "top 82%",
                    once: true,
                    onEnter: function () {
                        var tl = gsap.timeline({ defaults: { ease: "power3.out" } });
                        tl.to(row, { opacity: 1, duration: 0.01 })
                            .to(ghost, { opacity: 0.035, duration: 1.1, ease: "power2.out" }, 0)
                            .to(visuals, { clipPath: "inset(0 0 0% 0)", duration: 1.0, ease: "power3.inOut" }, 0.05)
                            .to(copyEls, { opacity: 1, y: 0, duration: 0.7, stagger: 0.08 }, 0.15);
                    },
                });
            });
        }

        var interactive = root.querySelectorAll(".project-card[data-open-project]");
        interactive.forEach(function (el) {
            el.addEventListener("keydown", function (e) {
                if (e.key === "Enter" || e.key === " ") {
                    e.preventDefault();
                    el.click();
                }
            });
        });

        document.addEventListener("click", function (e) {
            var card = e.target.closest(".sw-row .project-card, .sw-compact.project-card");
            if (!card) return;
            var visual = card.querySelector(".sw-visual-inner");
            if (!visual || reduceMotion) return;
            gsap.fromTo(visual, { scale: 1.02 }, { scale: 1, duration: 0.5, ease: "power3.out" });
        });
    })();

    console.log("Portfolio fully loaded with PHP/MySQL backend.");
}
</script>

<script>
(function () {
  var loader = document.getElementById('loader');
  if (!loader) {
    console.error('Loader not found in DOM');
    return;
  }

  loader.style.display = 'flex';
  loader.style.visibility = 'visible';
  loader.style.opacity = '1';
  loader.style.pointerEvents = 'auto';

  var loaderReleased = false;
  function forceHideLoader() {
    if (loaderReleased) return;
    loaderReleased = true;
    loader.classList.add('loader-exiting');
    loader.style.pointerEvents = 'none';
    document.body.style.overflow = '';
    window.setTimeout(function () {
      loader.style.display = 'none';
      loader.style.visibility = 'hidden';
    }, 700);
  }
  var loaderFailSafeTimer = window.setTimeout(forceHideLoader, 5000);
  window.addEventListener('error', forceHideLoader, { once: true });

  var fill = document.getElementById('loaderFill');
  var pct = document.getElementById('loaderPct');
  var stage = document.getElementById('loaderStage');

  if (!fill || !pct || !stage) {
    console.error('Loader elements missing');
    forceHideLoader();
    return;
  }

  var loaderDismissed = false;
  function dismissLoader() {
    if (loaderDismissed) return;
    loaderDismissed = true;
    window.clearTimeout(loaderFailSafeTimer);
    forceHideLoader();
  }
  var loaderSafetyTimer = window.setTimeout(dismissLoader, 5000);

  var diagnostics = [
    '> Initializing core system...',
    '> Loading visual engine...',
    '> Connecting project matrix...',
    '> Loading portfolio database...',
    '> Initializing AI assistant...',
    '> Initializing developer terminal...',
    '> Preparing digital experience...'
  ];

  var statusRows = Array.prototype.slice.call(document.querySelectorAll('[data-status]'));
  var diagnosticRows = Array.prototype.slice.call(document.querySelectorAll('[data-diagnostic]'));

  function activateStatus(key, active) {
    var row = document.querySelector('[data-status="' + key + '"]');
    if (!row) return;
    row.textContent = active ? 'ONLINE' : 'WAITING';
    row.classList.toggle('online', active);
  }

  function updateDiagnostics(progress) {
    var idx = Math.min(diagnostics.length - 1, Math.max(0, Math.floor((progress / 100) * diagnostics.length)));

    if (idx >= 0 && idx < diagnostics.length) {
      stage.textContent = diagnostics[idx];
    }

    diagnosticRows.forEach(function (row, i) {
      var current = i < idx;
      row.classList.toggle('done', current);
      row.classList.toggle('active', i === idx);
    });

    if (progress >= 4) activateStatus('core', true);
    if (progress >= 20) activateStatus('visual', true);
    if (progress >= 34) activateStatus('projects', true);
    if (progress >= 50) activateStatus('database', true);
    if (progress >= 72) activateStatus('ai', true);
    if (progress >= 88) activateStatus('terminal', true);
  }

  var startedAt = null;
  var duration = 2600;
  var rafId = null;

  function tick(now) {
    if (!startedAt) startedAt = now;

    var elapsed = now - startedAt;
    var progress = Math.min(100, Math.round((elapsed / duration) * 100));

    fill.style.width = progress + '%';
    pct.textContent = String(progress).padStart(3, '0') + '%';

    if (progress > 0 && progress < 100) {
      updateDiagnostics(progress);
    }

    if (progress < 100) {
      rafId = window.requestAnimationFrame(tick);
    } else {
      fill.style.width = '100%';
      pct.textContent = '100%';
      stage.textContent = 'SYSTEM READY';
      loader.classList.add('loader-ready');

      statusRows.forEach(function (row) {
        row.classList.add('online');
        row.textContent = 'ONLINE';
      });

      diagnosticRows.forEach(function (row) {
        row.classList.add('done');
        row.classList.remove('active');
      });

      window.setTimeout(function () {
        window.clearTimeout(loaderSafetyTimer);
        dismissLoader();
      }, 600);

      if (typeof window.playHeroIntro === 'function') {
        window.playHeroIntro();
      }
    }
  }

  stage.textContent = diagnostics[0];
  window.requestAnimationFrame(tick);
})();
</script>
</body>
</html>
 