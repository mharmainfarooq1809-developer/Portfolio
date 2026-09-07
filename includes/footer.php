<?php
// No direct access
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}
?>

<footer id="siteFooter">
    <div class="container">
        <div class="footer-grid">
            <!-- ===== BRAND COLUMN with logo ===== -->
            <div class="footer-brand">
                <div class="brand-wrapper">
                    <!-- Logo mark (SVG) -->
                    <div class="logo-mark">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="48" height="48" rx="12" fill="url(#footerLogoGrad)" />
                            <text x="24" y="33" font-family="Inter, sans-serif" font-size="28" font-weight="700" fill="#fff" text-anchor="middle" letter-spacing="-1">H</text>
                            <defs>
                                <linearGradient id="footerLogoGrad" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00d4ff" />
                                    <stop offset="1" stop-color="#3b82f6" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="logo-text">HARMAIN</div>
                </div>
                <p class="footer-tagline">Full Stack Developer · Pakistan</p>
            </div>

            <!-- ===== SOCIAL PLATFORMS (logos + names) ===== -->
            <div class="footer-social-wrapper">
                <span class="social-title">Connect with me</span>
                <div class="footer-social">
                    <a href="https://www.linkedin.com/in/muhammad-harmain-9616743ab/" target="_blank" rel="noopener" class="social-link linkedin">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                    <a href="https://wa.me/923143927745" target="_blank" rel="noopener" class="social-link whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://www.instagram.com/m.ha_rmain/" target="_blank" rel="noopener" class="social-link instagram">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61555912632505&rdid=FB157zhmUtYzKRIu&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1BqTrHdXEm%2F#" target="_blank" rel="noopener" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://github.com/mharmainfarooq1809-developer" target="_blank" rel="noopener" class="social-link github">
                        <i class="fab fa-github"></i> GitHub
                    </a>
                </div>
            </div>

            <!-- ===== NAVIGATE COLUMN ===== -->
            <div class="footer-col">
                <span class="footer-col-title">Navigate</span>
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#work">Work</a>
                <a href="#stack">Stack</a>
            </div>

            <!-- ===== LEGAL COLUMN ===== -->
            <div class="footer-col">
                <span class="footer-col-title">Legal</span>
                <a href="#" style="cursor: default;">© <?= date('Y') ?></a>
                <a href="#" style="cursor: default;">Built with PHP · Laravel · MySQL</a>
                <a href="#" style="cursor: default; font-size: 12px; opacity: 0.6;">All rights reserved</a>
            </div>
        </div>

        <!-- ===== BOTTOM BAR ===== -->
        <div class="footer-bottom">
            <span>Muhammad Harmain — Full Stack Developer</span>
            <span>Pakistan · Remote</span>
        </div>
    </div>
</footer>

<!-- ============================================================ -->
<!-- CASE STUDY OVERLAY (unchanged)                               -->
<!-- ============================================================ -->
<div class="case-study-overlay" id="caseStudyOverlay" role="dialog" aria-modal="true" aria-label="Project case study">
    <button class="case-study-close" id="caseStudyClose" aria-label="Close case study">×</button>
    <div class="case-study-overlay-inner" id="caseStudyInner">
        <div class="case-study-content" id="caseStudyContent">
            <!-- Content populated dynamically -->
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- ENHANCED FOOTER STYLES                                       -->
<!-- ============================================================ -->
<style>
/* ─── Footer grid ─────────────────────────────────────────────── */
#siteFooter {
    position: relative;
    z-index: 1;
    background: var(--surface, #0c1428);
    border-top: 1px solid var(--border, rgba(0,180,255,0.10));
    padding: 48px 0 24px;
    margin-top: 60px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1.5fr 1fr 1fr;
    gap: 32px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--border, rgba(0,180,255,0.08));
}

/* ─── Brand column ────────────────────────────────────────────── */
.footer-brand {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.brand-wrapper {
    display: flex;
    align-items: center;
    gap: 14px;
}

.logo-mark {
    flex-shrink: 0;
    line-height: 0;
}

.logo-mark svg {
    display: block;
    width: 48px;
    height: 48px;
}

.logo-text {
    font-family: var(--font-head, Inter, sans-serif);
    font-weight: 700;
    font-size: 26px;
    letter-spacing: -0.5px;
    color: var(--accent, #00d4ff);
}

.footer-tagline {
    color: var(--muted, #94a9cf);
    font-size: 14px;
    margin: 0;
}

/* ─── Social platforms (logos + names) ─────────────────────────── */
.footer-social-wrapper {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.social-title {
    font-weight: 600;
    color: var(--text, #f0f4ff);
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-social {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.social-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 30px;
    background: var(--surface2, #18233a);
    color: var(--muted, #94a9cf);
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid var(--border, rgba(0,180,255,0.08));
    transition: all 0.25s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.social-link i {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

/* Brand-specific hover colors */
.social-link.linkedin:hover {
    background: #0A66C2;
    color: #fff;
    border-color: #0A66C2;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(10, 102, 194, 0.35);
}
.social-link.whatsapp:hover {
    background: #25D366;
    color: #fff;
    border-color: #25D366;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.35);
}
.social-link.instagram:hover {
    background: radial-gradient(circle at 30% 30%, #fdf497, #fd5949, #d6249f);
    color: #fff;
    border-color: #d6249f;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(214, 36, 159, 0.35);
}
.social-link.facebook:hover {
    background: #1877F2;
    color: #fff;
    border-color: #1877F2;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(24, 119, 242, 0.35);
}
.social-link.github:hover {
    background: #f0f4ff;
    color: #0c1428;
    border-color: #f0f4ff;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255,255,255,0.15);
}

/* ─── Footer columns ───────────────────────────────────────────── */
.footer-col {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.footer-col-title {
    font-weight: 600;
    color: var(--text, #f0f4ff);
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.footer-col a {
    color: var(--muted, #94a9cf);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s, transform 0.2s;
}

.footer-col a:hover {
    color: var(--accent, #00d4ff);
    transform: translateX(4px);
}

/* ─── Bottom bar ───────────────────────────────────────────────── */
.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    font-size: 13px;
    color: var(--muted-2, #5a72a0);
    flex-wrap: wrap;
    gap: 12px;
}

.footer-bottom span:last-child {
    text-align: right;
}

/* ─── Responsive ───────────────────────────────────────────────── */
@media (max-width: 1024px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }
    .footer-brand {
        grid-column: 1 / -1;
    }
}

@media (max-width: 640px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    .footer-brand {
        grid-column: 1;
    }
    .footer-social {
        flex-direction: column;
        align-items: stretch;
    }
    .social-link {
        justify-content: center;
        padding: 10px 16px;
    }
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
    .footer-bottom span:last-child {
        text-align: center;
    }
    .logo-mark svg {
        width: 40px;
        height: 40px;
    }
    .logo-text {
        font-size: 22px;
    }
}
</style>

<!-- ============================================================ -->
<!-- CASE STUDY JAVASCRIPT (unchanged)                            -->
<!-- ============================================================ -->
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