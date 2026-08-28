<?php
require_once __DIR__ . '/../includes/functions.php';
$projects = getProjects();

/**
 * ============================================================
 * Build a clean, JS-safe data source directly from $projects.
 * No new DB calls, no hardcoded project objects — every value
 * below traces back to $project or its decoded `content` JSON.
 * Only fields that actually exist are included; nothing here
 * invents copy for problem/approach/architecture/etc.
 * ============================================================
 */
$narrativeSectionKeys = [
    'overview', 'problem', 'approach', 'architecture',
    'database', 'features', 'technical', 'challenges', 'results',
];

$jsProjects = [];

foreach ($projects as $index => $project) {
    $content = [];
    if (!empty($project['content'])) {
        $content = is_array($project['content']) ? $project['content'] : (json_decode($project['content'], true) ?: []);
    }

    // Tags
    $rawTags = $project['tags'] ?? '';
    $tags = is_array($rawTags)
        ? $rawTags
        : array_filter(array_map('trim', explode(',', (string) $rawTags)));
    $tags = array_values(array_filter($tags, fn($t) => $t !== ''));

    // Metrics — only real entries from content.metrics
    $metrics = [];
    if (!empty($content['metrics']) && is_array($content['metrics'])) {
        foreach ($content['metrics'] as $m) {
            if (is_array($m)) {
                $value = (string) ($m['value'] ?? '');
                $label = (string) ($m['label'] ?? '');
                if ($value !== '' || $label !== '') {
                    $metrics[] = ['value' => $value, 'label' => $label];
                }
            } elseif (is_string($m) || is_numeric($m)) {
                $metrics[] = ['value' => (string) $m, 'label' => ''];
            }
        }
    }

    // Narrative sections — only include keys that exist and are non-empty
    $sections = [];
    foreach ($narrativeSectionKeys as $key) {
        if (!empty($content[$key]) && is_string($content[$key]) && trim($content[$key]) !== '') {
            $sections[$key] = trim($content[$key]);
        }
    }
    // Fall back to the card's own description for Overview if nothing was set explicitly
    if (!isset($sections['overview']) && !empty($project['description'])) {
        $sections = ['overview' => (string) $project['description']] + $sections;
    }

    // Images — only if the project content actually provides them
    $images = [
        'cover' => null,
        'gallery' => [],
    ];
    if (!empty($content['cover_image']) && is_string($content['cover_image'])) {
        $images['cover'] = $content['cover_image'];
    }
    foreach (['images', 'gallery'] as $galleryKey) {
        if (!empty($content[$galleryKey]) && is_array($content[$galleryKey])) {
            foreach ($content[$galleryKey] as $img) {
                if (is_string($img) && trim($img) !== '') {
                    $images['gallery'][] = $img;
                } elseif (is_array($img) && !empty($img['url']) && is_string($img['url'])) {
                    $images['gallery'][] = $img['url'];
                }
            }
        }
    }

    $jsProjects[] = [
        'id'                => (int) ($project['id'] ?? 0),
        'index'             => (int) $index,
        'title'             => (string) ($project['title'] ?? 'Untitled project'),
        'description'       => (string) ($project['description'] ?? ''),
        'short_description' => (string) ($project['short_description'] ?? ($project['description'] ?? '')),
        'status'            => (string) ($project['status'] ?? 'Completed'),
        'tags'              => $tags,
        'metrics'           => $metrics,
        'sections'          => $sections,
        'images'            => $images,
    ];
}
?>

<!-- ===== SELECTED WORK — PROJECT CARDS SECTION ===== -->
<section class="section projects-section" id="projects">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Selected Work</div>
            <h2>Systems I've shipped.</h2>
            <p>Each project represents a complete system — not just a feature — built for real business use.</p>
        </div>

        <div class="projects-grid" id="projectsGrid">
            <?php foreach ($projects as $index => $project): ?>
            <?php
                $content = [];
                if (!empty($project['content'])) {
                    $content = is_array($project['content']) ? $project['content'] : (json_decode($project['content'], true) ?: []);
                }
                $title = (string) ($project['title'] ?? 'Untitled project');
                $description = (string) ($project['description'] ?? '');
                $shortDescription = (string) ($project['short_description'] ?? ($description !== '' ? substr($description, 0, 150) . '...' : ''));
                $image = trim((string) ($project['image'] ?? ''));
            ?>
            <div class="project-card" data-project-id="<?= (int) ($project['id'] ?? 0) ?>" data-index="<?= (int) $index ?>">
                <div class="project-card-inner">
                    <?php if ($image !== ''): ?>
                    <div class="project-image-wrap">
                        <img class="project-image" src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?> project preview" loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="project-top">
                        <span class="project-index"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></span>
                        <span class="project-status"><?= htmlspecialchars($project['status'] ?? 'Completed') ?></span>
                    </div>
                    <h3 class="project-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="project-description"><?= htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="project-tags">
                        <?php
                        $tech = is_array($project['tags']) ? $project['tags'] : array_map('trim', explode(',', $project['tags'] ?? ''));
                        foreach (array_slice($tech, 0, 4) as $techItem):
                        ?>
                        <span class="tag"><?= htmlspecialchars($techItem) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="project-metrics">
                        <?php
                        $metrics = $content['metrics'] ?? [];
                        if (is_array($metrics) && count($metrics) > 0):
                            foreach (array_slice($metrics, 0, 3) as $metric):
                        ?>
                        <div class="pm">
                            <b><?= htmlspecialchars(is_array($metric) ? ($metric['value'] ?? $metric) : $metric) ?></b>
                            <span><?= htmlspecialchars(is_array($metric) ? ($metric['label'] ?? '') : '') ?></span>
                        </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <button class="project-open-btn" data-project-id="<?= (int) ($project['id'] ?? 0) ?>" aria-label="Open case study for <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>">
                        Open case study <span class="project-open-arrow">→</span>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.project-image-wrap {
    aspect-ratio: 16 / 9;
    overflow: hidden;
    margin: -4px -4px 24px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--surface-2);
}

.project-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.45s var(--ease);
}

.project-card:hover .project-image {
    transform: scale(1.04);
}
</style>

<!-- ============================================================ -->
<!-- REAL PROJECT DATA — embedded as JSON, not executed as script -->
<!-- Every value traces back to $projects / getProjects(). No     -->
<!-- narrative copy is invented here or in the JS below.          -->
<!-- ============================================================ -->
<script type="application/json" id="projectsData"><?= json_encode(
    $jsProjects,
    JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE
) ?></script>

<!-- ============================================================ -->
<!-- CASE STUDY OVERLAY — Full-Screen Experience                   -->
<!-- Hidden by default, appears when "Open case study" is clicked -->
<!-- ============================================================ -->
<div class="case-study-overlay" id="caseStudyOverlay" role="dialog" aria-modal="true" aria-label="Project case study">
    <button class="case-study-close" id="caseStudyClose" aria-label="Close case study">
        <span class="close-icon" aria-hidden="true">&times;</span>
        <span class="close-label">Close</span>
    </button>
    <div class="case-study-overlay-inner" id="caseStudyInner">
        <div class="case-study-content" id="caseStudyContent">
            <!-- Content populated dynamically by JavaScript, from real data only -->
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- CASE STUDY JAVASCRIPT                                         -->
<!-- ============================================================ -->
<script>
(function() {
    'use strict';

    const overlay = document.getElementById('caseStudyOverlay');
    const overlayInner = document.getElementById('caseStudyInner');
    const closeBtn = document.getElementById('caseStudyClose');
    const content = document.getElementById('caseStudyContent');
    const dataEl = document.getElementById('projectsData');

    if (!overlay || !overlayInner || !content || !dataEl) {
        console.warn('Case study overlay elements not found');
        return;
    }

    // Real project data, straight from PHP/database — nothing invented client-side
    let projectData = [];
    try {
        projectData = JSON.parse(dataEl.textContent || '[]');
    } catch (err) {
        console.warn('Could not parse project data:', err);
        projectData = [];
    }

    let isOpen = false;
    let scrollPosition = 0;

    const SECTION_LABELS = {
        overview: 'Overview',
        problem: 'Problem',
        approach: 'Approach',
        architecture: 'Architecture',
        database: 'Database',
        features: 'Features',
        technical: 'Technical Implementation',
        challenges: 'Challenges',
        results: 'Results'
    };
    const SECTION_ORDER = ['overview', 'problem', 'approach', 'architecture', 'database', 'features', 'technical', 'challenges', 'results'];

    // Escape any dynamic value before it goes into innerHTML
    function esc(str) {
        if (str === null || str === undefined) return '';
        const div = document.createElement('div');
        div.textContent = String(str);
        return div.innerHTML;
    }

    function initials(title) {
        return String(title || '')
            .split(/\s+/)
            .filter(Boolean)
            .slice(0, 2)
            .map(w => w[0])
            .join('')
            .toUpperCase();
    }

    // Premium fallback visual — used only when no real image exists.
    // Built from typography, the project number, and tech stack. Never
    // pretends to be an actual screenshot.
    function buildVisualFallback(project) {
        const techLine = (project.tags || []).slice(0, 3).join(' · ');
        return `
            <div class="case-visual-fallback" aria-hidden="true">
                <div class="cvf-grid"></div>
                <span class="cvf-number">${esc(String(project.index + 1).padStart(2, '0'))}</span>
                <span class="cvf-initials">${esc(initials(project.title))}</span>
                <span class="cvf-tech">${esc(techLine)}</span>
            </div>
        `;
    }

    function buildVisualArea(project) {
        const gallery = Array.isArray(project.images && project.images.gallery) ? project.images.gallery : [];
        const cover = project.images && project.images.cover;

        if (cover || gallery.length > 0) {
            const featured = cover || gallery[0];
            const rest = cover ? gallery : gallery.slice(1);

            let restHTML = '';
            if (rest.length > 0) {
                restHTML = `
                    <div class="case-gallery-secondary">
                        ${rest.slice(0, 4).map(src => `
                            <div class="case-gallery-item">
                                <img src="${esc(src)}" alt="${esc(project.title)} project image" loading="lazy">
                            </div>
                        `).join('')}
                    </div>
                `;
            }

            return `
                <div class="case-gallery">
                    <div class="case-gallery-featured">
                        <img src="${esc(featured)}" alt="${esc(project.title)} featured image" loading="lazy">
                    </div>
                    ${restHTML}
                </div>
            `;
        }

        return buildVisualFallback(project);
    }

    // Build case study HTML — only from real project data
    function buildCaseStudy(project, index, total) {
        const tech = project.tags || [];
        const metrics = project.metrics || [];
        const sections = project.sections || {};

        let metricsHTML = '';
        if (metrics.length > 0) {
            metricsHTML = `
                <div class="case-metrics-grid">
                    ${metrics.map(m => `
                        <div class="case-metric-item">
                            <span class="metric-value">${esc(m.value || '')}</span>
                            <span class="metric-label">${esc(m.label || '')}</span>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        const techHTML = tech.length > 0
            ? `<div class="case-tech-stack">${tech.map(t => `<span class="tech-pill">${esc(t)}</span>`).join('')}</div>`
            : '';

        const sectionsHTML = SECTION_ORDER
            .filter(key => sections[key] && String(sections[key]).trim() !== '')
            .map(key => `
                <div class="case-section">
                    <span class="case-section-label">${esc(SECTION_LABELS[key] || key)}</span>
                    <h2>${esc(SECTION_LABELS[key] || key)}</h2>
                    <p>${esc(sections[key])}</p>
                </div>
            `).join('');

        const visualHTML = buildVisualArea(project);

        const prevIndex = index > 0 ? index - 1 : total - 1;
        const nextIndex = index < total - 1 ? index + 1 : 0;
        const prevProject = projectData[prevIndex];
        const nextProject = projectData[nextIndex];

        return `
            <div class="case-study-hero">
                <div class="case-hero-meta">
                    <span class="case-number">${esc(String(index + 1).padStart(2, '0'))} / ${esc(String(total).padStart(2, '0'))}</span>
                    <span class="case-status">${esc(project.status || '')}</span>
                </div>
                <h1>${esc(project.title)}</h1>
                ${project.short_description ? `<p class="case-subtitle">${esc(project.short_description)}</p>` : ''}
                ${techHTML}
                ${metricsHTML}
            </div>

            ${visualHTML}

            ${sectionsHTML}

            <div class="case-navigation">
                <button class="case-nav-btn prev" data-project-index="${prevIndex}">
                    <span class="nav-arrow">←</span>
                    <span class="nav-copy">
                        <span class="nav-label">Previous</span>
                        <span class="nav-title">${esc(prevProject ? prevProject.title : '')}</span>
                    </span>
                </button>
                <button class="case-nav-btn case-nav-back" data-project-index="-1">
                    ← Back to Projects
                </button>
                <button class="case-nav-btn next" data-project-index="${nextIndex}">
                    <span class="nav-copy">
                        <span class="nav-label">Next Project</span>
                        <span class="nav-title">${esc(nextProject ? nextProject.title : '')}</span>
                    </span>
                    <span class="nav-arrow">→</span>
                </button>
            </div>
        `;
    }

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

    function setupNavigation(currentIndex) {
        const navBtns = content.querySelectorAll('.case-nav-btn');
        navBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const index = parseInt(this.dataset.projectIndex, 10);

                if (index === -1) {
                    closeCaseStudy();
                    return;
                }

                const project = projectData[index];
                if (project) {
                    content.innerHTML = buildCaseStudy(project, index, projectData.length);
                    setupNavigation(index);
                    overlayInner.scrollTop = 0;
                }
            });
        });
    }

    // ============================================================
    // EVENT LISTENERS
    // ============================================================

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.project-open-btn');
        if (btn) {
            e.preventDefault();
            const projectId = parseInt(btn.dataset.projectId, 10);
            if (Number.isFinite(projectId) && projectId > 0) {
                openCaseStudy(projectId);
            }
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.project-open-btn')) return;

        const card = e.target.closest('.project-card');
        if (card) {
            const projectId = parseInt(card.dataset.projectId, 10);
            if (Number.isFinite(projectId) && projectId > 0) {
                openCaseStudy(projectId);
            }
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeCaseStudy);
    }

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            closeCaseStudy();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) {
            closeCaseStudy();
        }
    });

    if (projectData.length === 0) {
        console.warn('No project data found. Check that getProjects() is returning records.');
    }

})();
</script>

<!-- ============================================================ -->
<!-- CASE STUDY + PROJECT CARD STYLES (inline to ensure they work) -->
<!-- ============================================================ -->
<style>
/* ---------- Project card interaction polish ---------- */
.project-card {
    transition: transform 0.4s cubic-bezier(0.16, 0.84, 0.44, 1),
                border-color 0.4s cubic-bezier(0.16, 0.84, 0.44, 1),
                background 0.4s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.project-card:hover {
    transform: translateY(-4px);
    border-color: var(--accent, #1677FF);
    background: rgba(255, 255, 255, 0.02);
}

.project-open-btn {
    transition: color 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.project-open-arrow {
    display: inline-block;
    transition: transform 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.project-card:hover .project-open-arrow {
    transform: translateX(4px);
}

/* ---------- Case Study Overlay - hidden by default ---------- */
.case-study-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: var(--bg, #050505);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.4s cubic-bezier(0.16, 0.84, 0.44, 1),
                visibility 0.4s cubic-bezier(0.16, 0.84, 0.44, 1);
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
    padding: 80px 32px 100px;
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
    background: var(--accent, #1677FF);
    border-radius: 2px;
}

/* ---------- Close button: compact, expands to reveal label ---------- */
.case-study-close {
    position: fixed;
    top: 24px;
    right: 32px;
    z-index: 10000;
    height: 44px;
    min-width: 44px;
    padding: 0 14px;
    border-radius: 100px;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    background: var(--surface, #0d0d0d);
    color: var(--muted, #9ca3af);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
    opacity: 0;
    transform: scale(0.9);
    pointer-events: none;
    backdrop-filter: blur(8px);
    font-family: var(--font-body, Inter, sans-serif);
    overflow: hidden;
}

.case-study-overlay.open .case-study-close {
    opacity: 1;
    transform: scale(1);
    pointer-events: auto;
}

.case-study-close .close-icon {
    font-size: 20px;
    font-weight: 300;
    line-height: 1;
}

.case-study-close .close-label {
    font-size: 12px;
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    max-width: 0;
    opacity: 0;
    white-space: nowrap;
    overflow: hidden;
    transition: max-width 0.3s cubic-bezier(0.16, 0.84, 0.44, 1),
                opacity 0.2s ease,
                margin-left 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
    margin-left: 0;
}

.case-study-close:hover {
    border-color: var(--accent, #1677FF);
    color: var(--text, #ffffff);
}

.case-study-close:hover .close-label {
    max-width: 70px;
    opacity: 1;
    margin-left: 8px;
}

.case-study-content {
    max-width: 1000px;
    margin: 0 auto;
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.5s cubic-bezier(0.16, 0.84, 0.44, 1),
                transform 0.5s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.case-study-overlay.open .case-study-content {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.1s;
}

/* ---------- Hero ---------- */
.case-study-hero {
    margin-bottom: 56px;
    padding-top: 20px;
}

.case-hero-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
}

.case-hero-meta .case-number {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 13px;
    color: var(--accent, #1677FF);
    letter-spacing: 0.12em;
}

.case-hero-meta .case-status {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 11px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted-2, #6b7280);
    padding: 4px 12px;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    border-radius: 100px;
}

.case-study-hero h1 {
    font-family: var(--font-head, "Space Grotesk", sans-serif);
    font-size: clamp(36px, 6vw, 68px);
    font-weight: 700;
    line-height: 1.08;
    letter-spacing: -0.02em;
    margin: 0 0 20px;
    color: var(--text, #ffffff);
}

.case-study-hero .case-subtitle {
    font-size: 18px;
    line-height: 1.6;
    color: var(--muted, #9ca3af);
    max-width: 640px;
}

.case-tech-stack {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin: 24px 0 8px;
}

.case-tech-stack .tech-pill {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 11px;
    letter-spacing: 0.06em;
    color: var(--muted-2, #6b7280);
    padding: 6px 14px;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    border-radius: 100px;
    background: rgba(255,255,255,0.02);
}

.case-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 16px;
    margin: 32px 0 8px;
    padding: 28px 0;
    border-top: 1px solid var(--border, rgba(255,255,255,0.08));
    border-bottom: 1px solid var(--border, rgba(255,255,255,0.08));
}

.case-metric-item {
    text-align: center;
}

.case-metric-item .metric-value {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 30px;
    font-weight: 600;
    color: var(--accent, #1677FF);
    display: block;
    line-height: 1.2;
}

.case-metric-item .metric-label {
    font-size: 12px;
    color: var(--muted-2, #6b7280);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    margin-top: 4px;
}

/* ---------- Visual area: real gallery ---------- */
.case-gallery {
    display: grid;
    gap: 12px;
    margin: 40px 0;
}

.case-gallery-featured {
    border-radius: var(--radius-md, 16px);
    overflow: hidden;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
}

.case-gallery-featured img {
    display: block;
    width: 100%;
    height: auto;
}

.case-gallery-secondary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 12px;
}

.case-gallery-item {
    border-radius: var(--radius-md, 12px);
    overflow: hidden;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
}

.case-gallery-item img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ---------- Visual area: premium fallback (no invented screenshots) ---------- */
.case-visual-fallback {
    position: relative;
    margin: 40px 0;
    min-height: 280px;
    border-radius: var(--radius-md, 16px);
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    background: var(--surface-2, #111213);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 32px;
}

.case-visual-fallback .cvf-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(var(--border, rgba(255,255,255,0.06)) 1px, transparent 1px),
        linear-gradient(90deg, var(--border, rgba(255,255,255,0.06)) 1px, transparent 1px);
    background-size: 40px 40px;
    opacity: 0.5;
    pointer-events: none;
}

.case-visual-fallback .cvf-number {
    position: relative;
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 13px;
    letter-spacing: 0.12em;
    color: var(--accent, #1677FF);
}

.case-visual-fallback .cvf-initials {
    position: relative;
    font-family: var(--font-head, "Space Grotesk", sans-serif);
    font-size: clamp(72px, 12vw, 160px);
    font-weight: 700;
    line-height: 1;
    color: var(--text, #ffffff);
    opacity: 0.08;
    align-self: center;
}

.case-visual-fallback .cvf-tech {
    position: relative;
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 11px;
    letter-spacing: 0.06em;
    color: var(--muted-2, #6b7280);
    text-transform: uppercase;
}

/* ---------- Narrative sections ---------- */
.case-section {
    margin-bottom: 52px;
}

.case-section-label {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 11px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--accent, #1677FF);
    margin-bottom: 12px;
    display: block;
}

.case-section h2 {
    font-family: var(--font-head, "Space Grotesk", sans-serif);
    font-size: clamp(22px, 3vw, 34px);
    font-weight: 600;
    letter-spacing: -0.02em;
    margin-bottom: 16px;
    color: var(--text, #ffffff);
}

.case-section p {
    color: var(--muted, #9ca3af);
    font-size: 16px;
    line-height: 1.7;
    max-width: 720px;
    white-space: pre-line;
}

/* ---------- Editorial prev/next navigation ---------- */
.case-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 48px;
    padding-top: 32px;
    border-top: 1px solid var(--border, rgba(255,255,255,0.08));
    flex-wrap: wrap;
    gap: 16px;
}

.case-nav-btn {
    background: none;
    border: none;
    color: var(--muted, #9ca3af);
    font-family: var(--font-body, Inter, sans-serif);
    font-size: 14px;
    padding: 10px 16px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
    display: flex;
    align-items: center;
    gap: 10px;
    border-radius: 8px;
}

.case-nav-btn:hover {
    color: var(--text, #ffffff);
    background: var(--surface-2, #111213);
}

.case-nav-btn.next {
    text-align: right;
}

.case-nav-btn .nav-copy {
    display: flex;
    flex-direction: column;
    line-height: 1.3;
}

.case-nav-btn .nav-label {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 10px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted-2, #6b7280);
}

.case-nav-btn .nav-title {
    font-size: 14px;
    font-weight: 500;
    color: var(--text, #ffffff);
}

.case-nav-btn .nav-arrow {
    display: inline-block;
    transition: transform 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
    color: var(--accent, #1677FF);
}

.case-nav-btn:hover .nav-arrow {
    transform: translateX(4px);
}

.case-nav-btn.prev:hover .nav-arrow {
    transform: translateX(-4px);
}

.case-nav-back {
    color: var(--accent, #1677FF);
    font-weight: 500;
}

.case-nav-back:hover {
    color: var(--accent-2, #00C8FF);
}

/* ---------- Mobile responsive ---------- */
@media (max-width: 768px) {
    .case-study-overlay-inner {
        padding: 72px 20px 60px;
    }

    .case-study-close {
        top: 16px;
        right: 16px;
        height: 40px;
        min-width: 40px;
        padding: 0 12px;
    }

    .case-study-close .close-label {
        max-width: 0 !important;
        opacity: 0 !important;
        margin-left: 0 !important;
    }

    .case-study-hero h1 {
        font-size: clamp(30px, 5vw, 42px);
    }

    .case-study-hero .case-subtitle {
        font-size: 15px;
    }

    .case-metrics-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        padding: 22px 0;
    }

    .case-metric-item .metric-value {
        font-size: 26px;
    }

    .case-visual-fallback {
        min-height: 220px;
        padding: 20px;
    }

    .case-gallery-secondary {
        grid-template-columns: repeat(2, 1fr);
    }

    .case-section {
        margin-bottom: 38px;
    }

    .case-section h2 {
        font-size: clamp(20px, 4vw, 28px);
    }

    .case-section p {
        font-size: 15px;
    }

    .case-navigation {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }

    .case-nav-btn {
        justify-content: center;
        padding: 12px 16px;
        text-align: center;
    }

    .case-nav-btn .nav-copy {
        align-items: center;
    }
}

@media (max-width: 480px) {
    .case-study-overlay-inner {
        padding: 64px 16px 48px;
    }

    .case-study-close {
        top: 12px;
        right: 12px;
        height: 36px;
        min-width: 36px;
    }

    .case-study-close .close-icon {
        font-size: 18px;
    }

    .case-study-hero h1 {
        font-size: clamp(26px, 6vw, 34px);
    }

    .case-metrics-grid {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .case-metric-item .metric-value {
        font-size: 22px;
    }

    .case-tech-stack .tech-pill {
        font-size: 10px;
        padding: 4px 12px;
    }

    .case-visual-fallback .cvf-initials {
        font-size: clamp(56px, 16vw, 100px);
    }
}

/* ---------- Reduced motion ---------- */
@media (prefers-reduced-motion: reduce) {
    .case-study-overlay,
    .case-study-close,
    .case-study-close .close-label,
    .project-card,
    .project-open-arrow {
        transition: opacity 0.2s ease !important;
    }

    .case-study-overlay.open .case-study-content {
        transition: opacity 0.2s ease;
        opacity: 1 !important;
        transform: none !important;
    }

    .case-nav-btn .nav-arrow {
        transition: none !important;
    }

    .project-card:hover {
        transform: none !important;
    }
}
</style>
