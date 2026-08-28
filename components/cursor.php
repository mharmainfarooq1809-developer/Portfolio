<!-- ============================================================
     NOVEXA TECH // CLEAN SINGLE-CONTROLLER CURSOR
     Place once, immediately after <body>.
     ============================================================ -->
<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<style>
/* ===== NOVEXA CUSTOM CURSOR ===== */
.cursor-dot,
.cursor-ring {
    position: fixed;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 99999;
    border-radius: 50%;
    opacity: 0;
    transform: translate3d(-100px, -100px, 0);
    will-change: transform, width, height, opacity;
}

.cursor-dot {
    width: 6px;
    height: 6px;
    background: var(--accent);
    box-shadow: 0 0 8px var(--accent-dim);
    transition:
        opacity 0.2s ease,
        width 0.2s ease,
        height 0.2s ease;
}

.cursor-ring {
    width: 34px;
    height: 34px;
    border: 1px solid var(--border-strong);
    transition:
        opacity 0.2s ease,
        width 0.22s ease,
        height 0.22s ease,
        border-color 0.22s ease,
        background 0.22s ease;
}

.cursor-dot.is-active,
.cursor-ring.is-active {
    opacity: 1;
}

/* Interactive elements */
.cursor-ring.is-interactive {
    width: 44px;
    height: 44px;
    border-color: var(--accent);
}

.cursor-dot.is-interactive {
    width: 4px;
    height: 4px;
}

/* VIEW state */
.cursor-ring.is-view {
    width: 48px;
    height: 48px;
    border: 2px solid var(--accent);
    background: rgba(22, 119, 255, 0.1);
}

.cursor-ring.is-view::after {
    content: "VIEW";
    font-family: var(--font-mono);
    font-size: 7px;
    letter-spacing: 0.12em;
    color: var(--accent);
    position: absolute;
    inset: 50% auto auto 50%;
    transform: translate(-50%, -50%);
    font-weight: 600;
}

.cursor-dot.is-view {
    opacity: 0;
}

/* CLOSE state */
.cursor-ring.is-close {
    width: 48px;
    height: 48px;
    border: 2px solid var(--accent);
    background: rgba(22, 119, 255, 0.1);
}

.cursor-ring.is-close::after {
    content: "×";
    font-family: var(--font-body);
    font-size: 22px;
    line-height: 1;
    color: var(--accent);
    position: absolute;
    inset: 50% auto auto 50%;
    transform: translate(-50%, -50%);
}

.cursor-dot.is-close {
    opacity: 0;
}

/* Click feedback — does NOT modify cursor position */
.cursor-ring.is-clicking {
    transform-origin: center;
}

.cursor-dot.is-clicking {
    width: 5px;
    height: 5px;
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
</style>

<script>
(function () {
    "use strict";

    function initCursor() {
        const dot = document.getElementById("cursorDot");
        const ring = document.getElementById("cursorRing");

        if (!dot || !ring) return;

        const finePointer = window.matchMedia(
            "(hover: hover) and (pointer: fine)"
        ).matches;

        if (!finePointer) return;

        /*
         * ONE controller:
         * - mouse coordinates are stored once
         * - requestAnimationFrame updates both cursor elements
         * - ring follows the exact same coordinates with a small smoothing delay
         * - no scroll-based positioning is used
         */
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;

        let dotX = mouseX;
        let dotY = mouseY;
        let ringX = mouseX;
        let ringY = mouseY;

        let active = false;
        let rafId = null;

        const DOT_EASE = 0.45;
        const RING_EASE = 0.18;

        function render() {
            dotX += (mouseX - dotX) * DOT_EASE;
            dotY += (mouseY - dotY) * DOT_EASE;

            ringX += (mouseX - ringX) * RING_EASE;
            ringY += (mouseY - ringY) * RING_EASE;

            dot.style.transform =
                `translate3d(${dotX}px, ${dotY}px, 0) translate(-50%, -50%)`;

            ring.style.transform =
                `translate3d(${ringX}px, ${ringY}px, 0) translate(-50%, -50%)`;

            rafId = requestAnimationFrame(render);
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

        window.addEventListener("mousemove", function (event) {
            mouseX = event.clientX;
            mouseY = event.clientY;
            activate();
        }, { passive: true });

        document.addEventListener("mouseleave", deactivate);
        document.addEventListener("mouseenter", activate);

        /*
         * One state controller for all interactive elements.
         * No mouseover/mouseout class fighting.
         */
        function clearStates() {
            dot.classList.remove("is-interactive", "is-view", "is-close");
            ring.classList.remove("is-interactive", "is-view", "is-close");
        }

        document.addEventListener("mouseover", function (event) {
            const target = event.target.closest(
                "a, button, .project-card, [role='button'], input, textarea, select, [contenteditable='true']"
            );

            clearStates();

            if (!target) return;

            if (target.matches("input, textarea, select, [contenteditable='true']")) {
                return;
            }

            dot.classList.add("is-interactive");
            ring.classList.add("is-interactive");
        });

        /*
         * Click feedback without changing the transform position.
         * This prevents the old translate(-50%, -50%) transform
         * from fighting with cursor movement.
         */
        let clickTimer;

        window.addEventListener("mousedown", function () {
            clearTimeout(clickTimer);
            ring.classList.add("is-clicking");
            dot.classList.add("is-clicking");
        }, { passive: true });

        window.addEventListener("mouseup", function () {
            clearTimeout(clickTimer);
            clickTimer = setTimeout(function () {
                ring.classList.remove("is-clicking");
                dot.classList.remove("is-clicking");
            }, 120);
        }, { passive: true });

        /*
         * Public API for case studies / overlays.
         * This is the ONLY function allowed to change cursor type.
         */
        window.setCursorType = function (type) {
            clearStates();

            if (type === "view") {
                ring.classList.add("is-view");
                dot.classList.add("is-view");
            } else if (type === "close") {
                ring.classList.add("is-close");
                dot.classList.add("is-close");
            } else if (type === "interactive") {
                ring.classList.add("is-interactive");
                dot.classList.add("is-interactive");
            }
        };

        /*
         * Optional hero effects remain separate from the cursor.
         * They no longer control cursor coordinates.
         */
        const hero = document.querySelector(".hero");
        const portrait = document.getElementById("portrait");
        const spotlight = document.getElementById("spotlight");
        const floatTags = document.querySelectorAll(".float-tag");

        if (typeof gsap !== "undefined" && hero && (portrait || spotlight || floatTags.length)) {
            let heroRect = hero.getBoundingClientRect();

            function updateHeroRect() {
                heroRect = hero.getBoundingClientRect();
            }

            window.addEventListener("resize", updateHeroRect, { passive: true });
            window.addEventListener("scroll", updateHeroRect, { passive: true });

            window.addEventListener("mousemove", function () {
                if (!heroRect) return;

                if (
                    mouseY >= heroRect.top &&
                    mouseY <= heroRect.bottom &&
                    heroRect.width > 0 &&
                    heroRect.height > 0
                ) {
                    const nx = (mouseX - heroRect.left) / heroRect.width - 0.5;
                    const ny = (mouseY - heroRect.top) / heroRect.height - 0.5;

                    if (portrait) {
                        gsap.to(portrait, {
                            x: nx * 24,
                            y: ny * 24,
                            rotateY: nx * 8,
                            rotateX: -ny * 8,
                            duration: 0.6,
                            ease: "power2.out",
                            overwrite: "auto"
                        });
                    }

                    if (spotlight) {
                        gsap.to(spotlight, {
                            x: mouseX,
                            y: mouseY,
                            duration: 0.4,
                            ease: "power2.out",
                            overwrite: "auto"
                        });
                    }

                    floatTags.forEach(function (tag) {
                        gsap.to(tag, {
                            x: nx * 12,
                            y: ny * 12,
                            duration: 0.6,
                            ease: "power2.out",
                            overwrite: "auto"
                        });
                    });
                }
            }, { passive: true });
        }

        /*
         * Magnetic buttons/cards are independent from cursor position.
         */
        if (typeof gsap !== "undefined" &&
            !window.matchMedia("(prefers-reduced-motion: reduce)").matches) {

            document.querySelectorAll(
                ".btn-primary, .btn-secondary, .nav-cta"
            ).forEach(function (el) {
                el.addEventListener("mousemove", function (event) {
                    const rect = el.getBoundingClientRect();
                    const relX = event.clientX - (rect.left + rect.width / 2);
                    const relY = event.clientY - (rect.top + rect.height / 2);

                    gsap.to(el, {
                        x: Math.max(-4, Math.min(4, relX * 0.06)),
                        y: Math.max(-4, Math.min(4, relY * 0.06)),
                        duration: 0.3,
                        ease: "power2.out",
                        overwrite: "auto"
                    });
                }, { passive: true });

                el.addEventListener("mouseleave", function () {
                    gsap.to(el, {
                        x: 0,
                        y: 0,
                        duration: 0.4,
                        ease: "power2.out"
                    });
                });
            });

            document.querySelectorAll(".project-card").forEach(function (el) {
                el.addEventListener("mousemove", function (event) {
                    const rect = el.getBoundingClientRect();
                    const relX = event.clientX - (rect.left + rect.width / 2);
                    const relY = event.clientY - (rect.top + rect.height / 2);

                    gsap.to(el, {
                        x: Math.max(-3, Math.min(3, relX * 0.03)),
                        y: Math.max(-3, Math.min(3, relY * 0.03)),
                        duration: 0.3,
                        ease: "power2.out",
                        overwrite: "auto"
                    });
                }, { passive: true });

                el.addEventListener("mouseleave", function () {
                    gsap.to(el, {
                        x: 0,
                        y: 0,
                        duration: 0.4,
                        ease: "power2.out"
                    });
                });
            });
        }

        render();

        window.addEventListener("beforeunload", function () {
            if (rafId) cancelAnimationFrame(rafId);
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initCursor, { once: true });
    } else {
        initCursor();
    }
})();
</script>