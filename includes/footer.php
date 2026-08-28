<?php
// No direct access
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}
?>

<footer id="siteFooter">
    <div class="container">
        <div class="footer-top">
            <div class="logo" style="font-family: var(--font-head); font-weight: 600; font-size: 18px;">
                <span style="color: var(--accent);">HARMAIN</span>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <span>Navigate</span>
                    <a href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#projects">Work</a>
                    <a href="#stack">Stack</a>
                </div>
                <div class="footer-col">
                    <span>Connect</span>
                    <a href="#contact">Contact</a>
                    <a href="#assistant">AI Assistant</a>
                    <a href="#github">GitHub</a>
                    <a href="#blog">Blog</a>
                </div>
                <div class="footer-col">
                    <span>Legal</span>
                    <a href="#" style="cursor: default;">© <?= date('Y') ?></a>
                    <a href="#" style="cursor: default;">Built with PHP · Laravel · MySQL</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>Muhammad Harmain — Full Stack Developer</span>
            <span>Pakistan · Remote</span>
        </div>
    </div>
</footer>

<!-- ============================================================ -->
<!-- CASE STUDY OVERLAY — Full-Screen Experience (fixed position)  -->
<!-- Hidden by default, appears when "Open case study" is clicked -->
<!-- ============================================================ -->
<div class="case-study-overlay" id="caseStudyOverlay" role="dialog" aria-modal="true" aria-label="Project case study">
    <button class="case-study-close" id="caseStudyClose" aria-label="Close case study">×</button>
    <div class="case-study-overlay-inner" id="caseStudyInner">
        <div class="case-study-content" id="caseStudyContent">
            <!-- Content populated dynamically by JavaScript -->
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- CASE STUDY JAVASCRIPT & STYLES                                -->
<!-- ============================================================ -->
<style>
/* Case Study Overlay - hidden by default, fixed position */
.case-study-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: var(--bg, #050505);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.5s cubic-bezier(0.16, 0.84, 0.44, 1),
                visibility 0.5s cubic-bezier(0.16, 0.84, 0.44, 1);
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

.case-study-close {
    position: fixed;
    top: 24px;
    right: 32px;
    z-index: 10000;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    background: var(--surface, #0d0d0d);
    color: var(--muted, #9ca3af);
    font-size: 24px;
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
    font-family: var(--font-body, Inter, sans-serif);
    line-height: 1;
}

.case-study-overlay.open .case-study-close {
    opacity: 1;
    transform: scale(1) rotate(0deg);
    pointer-events: auto;
}

.case-study-close:hover {
    border-color: var(--accent, #1677FF);
    color: var(--text, #ffffff);
    transform: scale(1.05) rotate(90deg);
}

.case-study-content {
    max-width: 1000px;
    margin: 0 auto;
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s cubic-bezier(0.16, 0.84, 0.44, 1),
                transform 0.6s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.case-study-overlay.open .case-study-content {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.15s;
}

/* Case study internal styles */
.case-study-hero {
    margin-bottom: 64px;
    padding-top: 20px;
}

.case-study-hero .case-number {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 13px;
    color: var(--accent, #1677FF);
    letter-spacing: 0.12em;
}

.case-study-hero h1 {
    font-family: var(--font-head, "Space Grotesk", sans-serif);
    font-size: clamp(40px, 6vw, 72px);
    font-weight: 700;
    line-height: 1.08;
    letter-spacing: -0.02em;
    margin: 16px 0 20px;
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
    gap: 12px;
    flex-wrap: wrap;
    margin: 24px 0 32px;
}

.case-tech-stack .tech-pill {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 11px;
    letter-spacing: 0.06em;
    color: var(--muted-2, #6b7280);
    padding: 6px 16px;
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    border-radius: 100px;
    background: rgba(255,255,255,0.02);
}

.case-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 16px;
    margin: 32px 0 48px;
    padding: 32px 0;
    border-top: 1px solid var(--border, rgba(255,255,255,0.08));
    border-bottom: 1px solid var(--border, rgba(255,255,255,0.08));
}

.case-metric-item {
    text-align: center;
}

.case-metric-item .metric-value {
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 32px;
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

.case-section {
    margin-bottom: 56px;
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
    font-size: clamp(24px, 3vw, 36px);
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
}

.case-gallery {
    display: grid;
    gap: 16px;
    margin: 32px 0;
}

.case-gallery-item {
    border-radius: var(--radius-md, 16px);
    overflow: hidden;
}

.case-gallery-item.placeholder {
    background: var(--surface-2, #111213);
    border: 1px solid var(--border, rgba(255,255,255,0.08));
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 200px;
    color: var(--muted-2, #6b7280);
    font-family: var(--font-mono, "JetBrains Mono", monospace);
    font-size: 12px;
}

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
    padding: 10px 20px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 0.84, 0.44, 1);
    display: flex;
    align-items: center;
    gap: 8px;
    border-radius: 8px;
}

.case-nav-btn:hover {
    color: var(--text, #ffffff);
    background: var(--surface-2, #111213);
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
    color: var(--accent, #1677FF);
    font-weight: 500;
}

.case-nav-back:hover {
    color: var(--accent-2, #00C8FF);
}

/* Mobile responsive */
@media (max-width: 768px) {
    .case-study-overlay-inner {
        padding: 72px 20px 60px;
    }

    .case-study-close {
        top: 16px;
        right: 16px;
        width: 40px;
        height: 40px;
        font-size: 20px;
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
        grid-template-columns: 1fr !important;
    }

    .case-gallery-item {
        min-height: 180px !important;
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
        justify-content: center;
        padding: 12px 16px;
    }
}

@media (max-width: 480px) {
    .case-study-overlay-inner {
        padding: 64px 16px 48px;
    }

    .case-study-close {
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        font-size: 18px;
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
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .case-study-overlay {
        transition: opacity 0.3s ease;
    }

    .case-study-overlay.open .case-study-content {
        transition: opacity 0.3s ease;
        opacity: 1 !important;
        transform: none !important;
    }

    .case-study-close {
        transition: opacity 0.3s ease;
    }

    .case-study-close:hover {
        transform: none !important;
    }

    .case-nav-btn .nav-arrow {
        transition: none !important;
    }
}
</style>

<script>
(function() {
    'use strict';

    const overlay = document.getElementById('caseStudyOverlay');
    const overlayInner = document.getElementById('caseStudyInner');
    const closeBtn = document.getElementById('caseStudyClose');
    const content = document.getElementById('caseStudyContent');

    if (!overlay || !overlayInner || !content) {
        console.warn('Case study overlay elements not found');
        return;
    }

    let projectData = [];
    let isOpen = false;
    let scrollPosition = 0;

    function loadProjectData() {
        const cards = document.querySelectorAll('.project-card');
        cards.forEach(card => {
            const id = parseInt(card.dataset.projectId, 10);
            if (!Number.isFinite(id)) return;

            if (!projectData.find(p => p.id === id)) {
                const title = card.querySelector('.project-title')?.textContent || '';
                const description = card.querySelector('.project-description')?.textContent || '';
                const tags = Array.from(card.querySelectorAll('.project-tags .tag')).map(t => t.textContent.trim());
                const metrics = Array.from(card.querySelectorAll('.project-metrics .pm')).map(m => ({
                    value: m.querySelector('b')?.textContent || '',
                    label: m.querySelector('span')?.textContent || ''
                }));

                projectData.push({
                    id: id,
                    title: title,
                    description: description,
                    short_description: description.substring(0, 120) + (description.length > 120 ? '...' : ''),
                    technologies: tags,
                    metrics: metrics,
                    status: card.querySelector('.project-status')?.textContent || 'Completed',
                    overview: description,
                    problem: `The client needed a comprehensive ${title.toLowerCase()} solution that could handle their growing business needs.`,
                    approach: `We took a modular approach to building ${title}, focusing on scalability and maintainability from day one.`,
                    architecture: `The system was built using a layered architecture pattern, separating concerns between data, business logic, and presentation.`,
                    database: `MySQL was chosen as the primary database with a carefully normalized schema design.`,
                    features: `Key features include user management, role-based access control, reporting, and real-time data updates.`,
                    technical: `Built with Laravel, MySQL, and modern JavaScript for a responsive, fast experience.`,
                    challenges: `The main challenge was handling complex data relationships while maintaining performance at scale.`,
                    results: `The system has been successfully deployed and is being used daily by the client's team.`,
                    images: []
                });
            }
        });
    }

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
            { label: 'Overview', content: project.overview || project.description || '' },
            { label: 'Problem', content: project.problem || '' },
            { label: 'Approach', content: project.approach || '' },
            { label: 'Architecture', content: project.architecture || '' },
            { label: 'Database', content: project.database || '' },
            { label: 'Features', content: project.features || '' },
            { label: 'Technical Implementation', content: project.technical || '' },
            { label: 'Challenges', content: project.challenges || '' },
            { label: 'Results', content: project.results || '' }
        ].filter(s => s.content && s.content.trim().length > 0);

        let sectionsHTML = sections.map(s => `
            <div class="case-section">
                <span class="case-section-label">${s.label}</span>
                <h2>${s.label}</h2>
                <p>${s.content}</p>
            </div>
        `).join('');

        let galleryHTML = `
            <div class="case-gallery" style="grid-template-columns: 2fr 1fr;">
                <div class="case-gallery-item placeholder" style="display:flex;align-items:center;justify-content:center;background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-md);min-height:200px;color:var(--muted-2);font-family:var(--font-mono);font-size:12px;">Project screenshot</div>
                <div class="case-gallery-item placeholder" style="display:flex;align-items:center;justify-content:center;background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-md);min-height:200px;color:var(--muted-2);font-family:var(--font-mono);font-size:12px;">Project screenshot</div>
                <div class="case-gallery-item placeholder" style="display:flex;align-items:center;justify-content:center;background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-md);min-height:200px;color:var(--muted-2);font-family:var(--font-mono);font-size:12px;">Project screenshot</div>
            </div>
        `;

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
                    const newContent = buildCaseStudy(project, index, projectData.length);
                    content.innerHTML = newContent;
                    setupNavigation(index);
                    overlayInner.scrollTop = 0;
                }
            });
        });
    }

    // Event Listeners
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

    // Load project data after DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadProjectData);
    } else {
        loadProjectData();
    }

})();
</script>

</body>
</html>