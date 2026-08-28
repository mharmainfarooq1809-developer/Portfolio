<?php
require_once __DIR__ . '/../includes/functions.php';
$services = getServices();
$serviceCategories = [
    ['tag' => 'OPERATIONS', 'title' => 'Business Management Systems', 'meta' => ['PLATFORMS', 'WORKFLOWS', 'INTEGRATION']],
    ['tag' => 'ANALYTICS', 'title' => 'Dashboard Development', 'meta' => ['ADMIN', 'REPORTING', 'METRICS']],
    ['tag' => 'ACCESS', 'title' => 'Client Portals', 'meta' => ['EXTERNAL', 'SECURE', 'VISIBILITY']],
    ['tag' => 'CONNECTIVITY', 'title' => 'API Development', 'meta' => ['REST', 'INTEGRATION', 'SCALABLE']],
    ['tag' => 'DATA', 'title' => 'Database Architecture', 'meta' => ['SCHEMA', 'PERFORMANCE', 'GROWTH']],
    ['tag' => 'INTELLIGENCE', 'title' => 'AI-Assisted Features', 'meta' => ['AI', 'AUTOMATION', 'WORKFLOWS']],
];
?>

<!-- ===== SERVICES — PREMIUM STACKED TECHNICAL LAYERS ===== -->
<section class="section services-section" id="services">
    <div class="services-background">
        <div class="services-bg-gradient"></div>
        <div class="services-bg-grid"></div>
    </div>
    
    <div class="container">
        <div class="services-header">
            <div class="eyebrow" id="servicesEyebrow">Services</div>
            <h2 id="servicesHeading">Where I add the most value.</h2>
            <p class="services-subheading" id="servicesSubheading">Six layers of engineering capability — each a complete system built to hold up under production use.</p>
        </div>

        <!-- The Stack Container -->
        <div class="services-stack" id="servicesStack">
            <?php foreach ($serviceCategories as $index => $svc): ?>
            <div class="service-panel" data-index="<?= $index ?>">
                <div class="service-panel-glow"></div>
                <div class="service-panel-inner">
                    <div class="service-corner-accent"></div>
                    
                    <div class="service-meta">
                        <span class="service-number">
                            <span class="service-num-val"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></span>
                            <span class="service-total">/06</span>
                        </span>
                        <span class="service-tag"><?= htmlspecialchars($svc['tag']) ?></span>
                    </div>
                    
                    <h3 class="service-title"><?= htmlspecialchars($svc['title']) ?></h3>
                    <p class="service-description"><?php 
                        if (isset($services[$index])) {
                            echo htmlspecialchars($services[$index]['description']);
                        } else {
                            echo 'Professional ' . strtolower($svc['title']) . ' solutions tailored to your business needs.';
                        }
                    ?></p>
                    
                    <div class="service-metadata">
                        <?php foreach ($svc['meta'] as $meta): ?>
                        <span class="meta-chip"><?= htmlspecialchars($meta) ?></span>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="service-accent-line"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Enhanced progress indicator -->
        <div class="services-progress" id="servicesProgress">
            <div class="services-progress-container">
                <div class="services-progress-dots">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                    <button class="progress-dot" data-index="<?= $i ?>" aria-label="Go to service <?= $i + 1 ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="services-progress-bar" id="servicesProgressBar"></div>
            </div>
            <div class="services-progress-label" id="servicesProgressLabel">01 / 06</div>
        </div>
    </div>
</section>

<style>
/* ============================================================
   SERVICES — PREMIUM STACKED TECHNICAL LAYERS
   ============================================================ */
.services-section {
    padding: 140px 0 180px;
    position: relative;
    overflow: hidden;
}

/* Sophisticated background layers */
.services-background {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
    pointer-events: none;
}

.services-bg-gradient {
    position: absolute;
    top: -40%;
    right: -20%;
    width: 800px;
    height: 800px;
    background: radial-gradient(ellipse at center, rgba(0, 230, 118, 0.06) 0%, transparent 70%);
    border-radius: 50%;
    filter: blur(80px);
    animation: float-gradient 20s ease-in-out infinite;
}

.services-bg-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
    background-size: 80px 80px;
    opacity: 0.4;
    mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);
}

@keyframes float-gradient {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(-30px, 30px); }
}

.services-header {
    margin-bottom: 80px;
    max-width: 720px;
    position: relative;
    z-index: 10;
}

.has-gsap .services-header .eyebrow {
    opacity: 0;
    transform: translateY(20px);
}

.services-header h2 {
    font-size: clamp(32px, 4vw, 48px);
    font-weight: 600;
    margin-top: 8px;
}

.has-gsap .services-header h2 {
    font-size: clamp(32px, 4vw, 48px);
    font-weight: 600;
    opacity: 0;
    transform: translateY(20px);
    margin-top: 8px;
}

.services-subheading {
    font-size: 17px;
    line-height: 1.6;
    color: var(--muted);
    margin-top: 16px;
    max-width: 600px;
}

.has-gsap .services-subheading {
    font-size: 17px;
    line-height: 1.6;
    color: var(--muted);
    opacity: 0;
    transform: translateY(20px);
    margin-top: 16px;
    max-width: 600px;
}

/* Stack container */
.services-stack {
    position: relative;
    min-height: 700px;
    padding: 40px 0;
}

/* Individual panels - smooth center-based display */
.service-panel {
    position: sticky;
    top: 120px;
    width: 100%;
    max-width: 820px;
    margin: 0 auto;
    padding: 0 20px;
    opacity: 1;
    transform: scale(1);
    pointer-events: auto;
    will-change: transform, opacity;
    margin-bottom: 100px;
}

.service-panel:last-child {
    margin-bottom: 0;
}

.service-panel.active {
    pointer-events: auto;
}

.service-panel-glow {
    position: absolute;
    inset: -20px;
    background: radial-gradient(ellipse at center, var(--accent-dim) 0%, transparent 70%);
    border-radius: 24px;
    opacity: 0;
    transition: opacity 0.8s cubic-bezier(0.16, 0.84, 0.44, 1);
    filter: blur(40px);
    pointer-events: none;
}

.service-panel.active .service-panel-glow {
    opacity: 1;
}

.service-panel-inner {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 52px 60px 60px;
    position: relative;
    backdrop-filter: blur(8px);
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    transition: border-color 0.6s cubic-bezier(0.16, 0.84, 0.44, 1);
    overflow: hidden;
}

.service-panel-inner::before {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 24px;
    padding: 1px;
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 50%, transparent 100%);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.8s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.service-panel.active .service-panel-inner::before {
    opacity: 1;
}

.service-panel.active .service-panel-inner {
    border-color: var(--accent);
}

.service-corner-accent {
    position: absolute;
    top: 0;
    right: 0;
    width: 160px;
    height: 160px;
    background: linear-gradient(135deg, var(--accent-dim) 0%, transparent 100%);
    border-radius: 0 24px 0 160px;
    opacity: 0;
    transition: opacity 0.6s ease;
    pointer-events: none;
}

.service-panel.active .service-corner-accent {
    opacity: 1;
}

/* Service meta row */
.service-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    font-family: var(--font-mono);
    position: relative;
    z-index: 2;
}

.service-number {
    font-size: 14px;
    color: var(--muted-2);
    letter-spacing: 0.04em;
}

.service-num-val {
    font-weight: 600;
    color: var(--accent);
}

.service-total {
    color: var(--muted-2);
    font-size: 12px;
    opacity: 0.4;
    margin-left: 4px;
}

.service-tag {
    font-size: 10px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--accent);
    padding: 5px 14px;
    border: 1px solid var(--accent-dim);
    border-radius: 100px;
    opacity: 1;
    transform: none;
    transition: all 0.6s cubic-bezier(0.16, 0.84, 0.44, 1);
    background: rgba(0, 230, 118, 0.04);
}

.service-panel.active .service-tag {
    opacity: 1;
    transform: translateX(0);
}

/* Service title */
.service-title {
    font-family: var(--font-head);
    font-size: clamp(28px, 3.6vw, 44px);
    font-weight: 700;
    line-height: 1.08;
    letter-spacing: -0.02em;
    margin-bottom: 20px;
    color: var(--text);
    opacity: 1;
    transition: opacity 0.6s cubic-bezier(0.16, 0.84, 0.44, 1);
    position: relative;
    z-index: 2;
}

.service-panel.active .service-title {
    opacity: 1;
}

/* Service description */
.service-description {
    font-size: 16px;
    line-height: 1.7;
    color: var(--muted);
    max-width: 540px;
    margin-bottom: 32px;
    opacity: 1;
    transform: none;
    transition: all 0.6s cubic-bezier(0.16, 0.84, 0.44, 1) 0.1s;
    position: relative;
    z-index: 2;
}

.service-panel.active .service-description {
    opacity: 1;
    transform: translateY(0);
}

/* Service metadata tags */
.service-metadata {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 28px;
    position: relative;
    z-index: 2;
}

.meta-chip {
    font-family: var(--font-mono);
    font-size: 10px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--muted-2);
    padding: 5px 14px;
    border: 1px solid var(--border);
    border-radius: 100px;
    opacity: 0.6;
    transform: none;
    transition: all 0.5s cubic-bezier(0.16, 0.84, 0.44, 1);
    background: rgba(255, 255, 255, 0.02);
}

.service-panel.active .meta-chip {
    opacity: 0.6;
    transform: translateY(0);
}

.service-panel.active .meta-chip:nth-child(1) {
    transition-delay: 0.1s;
}

.service-panel.active .meta-chip:nth-child(2) {
    transition-delay: 0.16s;
}

.service-panel.active .meta-chip:nth-child(3) {
    transition-delay: 0.22s;
}

.meta-chip:hover {
    border-color: var(--accent);
    opacity: 1 !important;
    color: var(--accent);
}

/* Accent line */
.service-accent-line {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, var(--accent), transparent);
    transition: width 0.8s cubic-bezier(0.16, 0.84, 0.44, 1);
    margin-top: auto;
    position: relative;
    z-index: 2;
}

.service-panel.active .service-accent-line {
    width: 60px;
}

/* Panel state styling */
.service-panel.previous .service-panel-inner {
    opacity: 0.5;
    filter: brightness(0.7);
}

.service-panel.future .service-panel-inner {
    opacity: 0.3;
    filter: brightness(0.5);
}

/* ============================================================
   PROGRESS INDICATOR
   ============================================================ */
.services-progress {
    position: sticky;
    bottom: 40px;
    left: 0;
    right: 0;
    max-width: 820px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    z-index: 25;
    opacity: 0;
    transition: opacity 0.6s ease 0.2s;
}

.services-progress.visible {
    opacity: 1;
}

.services-progress-container {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 16px;
}

.services-progress-dots {
    display: flex;
    gap: 10px;
}

.progress-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--border);
    border: none;
    padding: 0;
    transition: all 0.4s cubic-bezier(0.16, 0.84, 0.44, 1);
    cursor: pointer;
    opacity: 0.4;
    appearance: none;
}

.progress-dot.active {
    width: 24px;
    border-radius: 4px;
    background: var(--accent);
    opacity: 1;
}

.progress-dot:hover {
    background: var(--accent);
    opacity: 0.8;
}

.services-progress-bar {
    flex: 1;
    height: 2px;
    background: var(--border);
    border-radius: 2px;
    overflow: hidden;
    position: relative;
}

.services-progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 0%;
    background: var(--accent);
    transition: width 0.4s cubic-bezier(0.16, 0.84, 0.44, 1);
}

.services-progress-label {
    font-family: var(--font-mono);
    font-size: 12px;
    font-weight: 500;
    color: var(--muted-2);
    min-width: 56px;
    text-align: right;
    letter-spacing: 0.04em;
}

/* ============================================================
   RESPONSIVE: MOBILE
   ============================================================ */
@media (max-width: 768px) {
    .services-section {
        padding: 80px 0 120px;
    }

    .services-header {
        margin-bottom: 60px;
    }

    .services-header h2 {
        font-size: clamp(28px, 4vw, 40px);
    }

    .services-subheading {
        font-size: 15px;
    }

    .services-stack {
        min-height: 500px;
        padding: 20px 0;
    }

    .service-panel {
        top: 80px;
        padding: 0 12px;
        margin-bottom: 60px;
    }

    .service-panel-inner {
        padding: 36px 28px 44px;
        min-height: 340px;
        border-radius: 20px;
    }

    .service-meta {
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .service-title {
        font-size: clamp(24px, 5vw, 36px);
        margin-bottom: 16px;
    }

    .service-description {
        font-size: 15px;
        margin-bottom: 24px;
    }

    .meta-chip {
        font-size: 9px;
        padding: 4px 12px;
    }

    .services-progress {
        bottom: 20px;
        padding: 0 12px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .services-progress-container {
        width: 100%;
    }

    .services-progress-dots {
        gap: 8px;
    }

    .services-progress-label {
        width: 100%;
        text-align: left;
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    .services-section {
        padding: 60px 0 100px;
    }

    .services-header {
        margin-bottom: 40px;
    }

    .services-header h2 {
        font-size: clamp(24px, 5vw, 32px);
    }

    .services-subheading {
        font-size: 14px;
    }

    .services-stack {
        min-height: 400px;
    }

    .service-panel {
        top: 60px;
        padding: 0 8px;
        margin-bottom: 40px;
    }

    .service-panel-inner {
        padding: 28px 20px 36px;
        min-height: 300px;
        border-radius: 16px;
    }

    .service-title {
        font-size: clamp(20px, 5vw, 28px);
        margin-bottom: 12px;
    }

    .service-description {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .service-metadata {
        margin-bottom: 20px;
        gap: 8px;
    }

    .meta-chip {
        font-size: 8px;
        padding: 4px 10px;
    }

    .services-progress-dots {
        gap: 6px;
    }

    .progress-dot {
        width: 6px;
        height: 6px;
    }

    .progress-dot.active {
        width: 18px;
    }
}

/* ============================================================
   REDUCED MOTION
   ============================================================ */
@media (prefers-reduced-motion: reduce) {
    .services-bg-gradient {
        animation: none;
    }

    .services-stack {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        min-height: auto !important;
        padding: 20px 0 !important;
    }

    .service-panel {
        position: relative !important;
        top: 0 !important;
        opacity: 1 !important;
        transform: none !important;
        pointer-events: auto !important;
        padding: 0 !important;
        margin-bottom: 0 !important;
    }

    .service-panel-inner {
        opacity: 1 !important;
        filter: none !important;
    }

    .service-panel-inner::before {
        display: none !important;
    }

    .service-panel-glow,
    .service-corner-accent {
        display: none !important;
    }

    .service-tag,
    .service-description,
    .meta-chip,
    .service-accent-line {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }

    .service-accent-line {
        width: 60px !important;
    }

    .service-title {
        opacity: 1 !important;
    }

    .service-meta {
        opacity: 1 !important;
    }

    .services-progress {
        opacity: 1 !important;
    }

    .services-header .eyebrow,
    .services-header h2,
    .services-subheading {
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>

<script>
// ============================================================
// SERVICES — GSAP SCROLLTRIGGER STACKING EFFECT
// ============================================================
(function servicesStack() {
    const section = document.getElementById('services');
    const stack = document.getElementById('servicesStack');
    const panels = gsap.utils.toArray('.service-panel', stack);
    const progressBar = document.querySelector('#servicesProgressBar');
    const progressLabel = document.getElementById('servicesProgressLabel');
    const progressDots = document.querySelectorAll('.progress-dot');
    const progressWrap = document.getElementById('servicesProgress');
    const headerEyebrow = document.getElementById('servicesEyebrow');
    const headerHeading = document.getElementById('servicesHeading');
    const headerSubheading = document.getElementById('servicesSubheading');

    if (!section || !stack || panels.length === 0) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // If reduced motion is enabled, show all panels normally
    if (reduceMotion) {
        panels.forEach((panel) => {
            panel.classList.add('active');
        });
        if (progressWrap) progressWrap.classList.add('visible');
        return;
    }

    const totalPanels = panels.length;

    // ============================================================
    // HEADER ENTRANCE ANIMATION
    // ============================================================
    const headerTl = gsap.timeline({
        scrollTrigger: {
            trigger: section,
            start: 'top 80%',
            once: true,
        },
    });

    headerTl
        .to(headerEyebrow, { 
            opacity: 1, 
            y: 0, 
            duration: 0.7, 
            ease: 'power2.out' 
        })
        .to(headerHeading, { 
            opacity: 1, 
            y: 0, 
            duration: 0.8, 
            ease: 'power2.out' 
        }, '-=0.4')
        .to(headerSubheading, { 
            opacity: 1, 
            y: 0, 
            duration: 0.7, 
            ease: 'power2.out' 
        }, '-=0.5');

    // ============================================================
    // PROGRESS INDICATOR VISIBILITY
    // ============================================================
    ScrollTrigger.create({
        trigger: stack,
        start: 'top 60%',
        onEnter: () => {
            if (progressWrap) {
                gsap.to(progressWrap, {
                    opacity: 1,
                    duration: 0.6,
                    ease: 'power2.out'
                });
            }
        },
        onLeaveBack: () => {
            if (progressWrap) {
                gsap.to(progressWrap, {
                    opacity: 0,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            }
        },
    });

    // ============================================================
    // PANEL STACKING ANIMATION
    // ============================================================
    panels.forEach((panel, index) => {
        // Calculate the scale for each panel (subtle difference)
        const scaleValue = 1 - (index * 0.025);
        const yOffset = index * 8;

        // Set initial state
        gsap.set(panel, {
            opacity: 0.2,
            scale: scaleValue - 0.04,
            y: yOffset + 20,
            zIndex: index,
        });

        // Create the animation timeline
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: panel,
                start: 'top bottom-=10%',
                end: 'top center',
                scrub: 1.2,
                invalidateOnRefresh: true,
                onUpdate: (self) => {
                    const progress = self.progress;
                    
                    // Update active state based on progress
                    if (progress > 0.3 && progress < 0.95) {
                        panel.classList.add('active');
                        panel.classList.remove('previous', 'future');
                        
                        // Update progress
                        if (progressBar) {
                            const pct = (index / (totalPanels - 1)) * 100;
                            progressBar.style.setProperty('width', pct + '%');
                        }
                        if (progressLabel) {
                            const num = String(index + 1).padStart(2, '0');
                            progressLabel.textContent = `${num} / ${String(totalPanels).padStart(2, '0')}`;
                        }
                        // Update dots
                        progressDots.forEach((dot, i) => {
                            dot.classList.toggle('active', i === index);
                        });
                    } else if (progress <= 0.3) {
                        panel.classList.remove('active');
                        panel.classList.add('future');
                        panel.classList.remove('previous');
                    } else {
                        panel.classList.remove('active');
                        panel.classList.add('previous');
                        panel.classList.remove('future');
                    }
                },
            },
        });

        // Main panel entrance animation
        tl.fromTo(panel, 
            {
                opacity: 0.2,
                scale: scaleValue - 0.04,
                y: yOffset + 20,
            },
            {
                opacity: 1,
                scale: scaleValue,
                y: yOffset,
                duration: 1.2,
                ease: 'power2.out',
            }
        );

        // Inner elements animation with stagger
        const inner = panel.querySelector('.service-panel-inner');
        if (inner) {
            tl.fromTo(inner,
                { opacity: 0.6 },
                { opacity: 1, duration: 1, ease: 'power2.out' },
                '-=0.6'
            );
        }

        // Title animation
        const title = panel.querySelector('.service-title');
        if (title) {
            tl.fromTo(title,
                { y: 10, opacity: 0.4 },
                { y: 0, opacity: 1, duration: 0.8, ease: 'power2.out' },
                '-=0.4'
            );
        }

        // Description animation
        const desc = panel.querySelector('.service-description');
        if (desc) {
            tl.fromTo(desc,
                { y: 14, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.7, ease: 'power2.out' },
                '-=0.3'
            );
        }

        // Metadata tags with stagger
        const chips = panel.querySelectorAll('.meta-chip');
        if (chips.length) {
            tl.fromTo(chips,
                { y: 10, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.5, stagger: 0.08, ease: 'power2.out' },
                '-=0.2'
            );
        }

        // Accent line
        const accentLine = panel.querySelector('.service-accent-line');
        if (accentLine) {
            tl.fromTo(accentLine,
                { width: '0%' },
                { width: '60px', duration: 0.8, ease: 'power2.out' },
                '-=0.3'
            );
        }

        // Tag animation
        const tag = panel.querySelector('.service-tag');
        if (tag) {
            tl.fromTo(tag,
                { x: 14, opacity: 0 },
                { x: 0, opacity: 1, duration: 0.5, ease: 'power2.out' },
                '-=0.5'
            );
        }
    });

    // ============================================================
    // PROGRESS DOT INTERACTION
    // ============================================================
    progressDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const targetPanel = panels[index];
            if (targetPanel) {
                const rect = targetPanel.getBoundingClientRect();
                const offset = window.innerHeight / 2 - 200;
                window.scrollTo({
                    top: window.scrollY + rect.top - offset,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ============================================================
    // REFRESH ON RESIZE
    // ============================================================
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            ScrollTrigger.refresh();
        }, 250);
    });

    // ============================================================
    // CLEANUP FUNCTION
    // ============================================================
    return () => {
        ScrollTrigger.getAll().forEach(st => {
            if (st.trigger && stack.contains(st.trigger)) {
                st.kill();
            }
        });
    };
})();
</script>
