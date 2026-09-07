<section class="section channel-section" id="contact">
    
    <div class="channel-rule"></div>
    <div class="container channel-top">
        <div class="channel-eyebrow" id="channelEyebrow">CONTACT</div>
        <h2 class="channel-heading" id="channelHeading">
            <span class="line"><span>LET'S BUILD</span></span>
            <span class="line"><span>SOMETHING THAT</span></span>
            <span class="line"><span>HAS TO WORK.</span></span>
        </h2>
        <div class="channel-status" id="channelStatus">
            <span class="dot"></span>AVAILABLE FOR NEW PROJECTS
        </div>
        <div class="channel-meta-grid">
            <div>
                <div class="channel-open-to">Open To</div>
                <p class="channel-worktype">Freelance <b>·</b> Internship <b>·</b> Full-Time <b>·</b> Remote</p>
            </div>
            <div class="channel-info-rail">
                <div>
                    <span>Email</span>
                    <a href="mailto:mharmainfarooq@gmail.com">mharmainfarooq@gmail.com ↗</a>
                </div>
                <div>
                    <span>Preferred Contact</span>
                    <em>Email</em>
                </div>
                <div>
                    <span>Typical Response</span>
                    <em>Within 24 hours</em>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ENHANCED CTA BUTTON (with pulse animation) ===== -->
    <div class="container" style="max-width:760px; margin-top:36px; text-align:center;">
        <button id="openWizardBtn" class="wizard-cta">
            <span class="cta-pulse"></span>
            <i class="fas fa-rocket"></i> 
            <span>Kickstart your project</span>
            <i class="fas fa-arrow-right"></i>
        </button>
        <div id="contactFormStatus" style="margin-top:12px; color:var(--muted);"></div>
    </div>

    <!-- ============================================================
    MULTI‑STEP WIZARD MODAL
    ============================================================ -->
    <div id="wizardModal" class="wizard-overlay">
        <div class="wizard-container">

            <!-- ===== HEADER with close button ===== -->
            <div class="wizard-header">
                <h2>Let's bring your idea to life</h2>
                <button class="wizard-close" id="closeWizardBtn">&times;</button>
            </div>

            <!-- ===== PROGRESS INDICATOR ===== -->
            <div class="wizard-progress">
                <div class="step-dots">
                    <span class="dot-step active" data-step="1"></span>
                    <span class="dot-step" data-step="2"></span>
                    <span class="dot-step" data-step="3"></span>
                </div>
                <div class="step-labels">
                    <span class="step-label active" data-step="1">About you</span>
                    <span class="step-label" data-step="2">Project scope</span>
                    <span class="step-label" data-step="3">Your message</span>
                </div>
            </div>

            <!-- ===== FORM ===== -->
            <form id="wizardForm" class="wizard-form">

                <!-- ====== STEP 1 ====== -->
                <div class="wizard-step active" data-step="1">
                    <div class="step-icon"><i class="fas fa-user-astronaut"></i></div>
                    <h3>Tell us about you</h3>
                    <p class="step-desc">We'll use this to get back to you personally.</p>
                    <div class="form-grid-2">
                        <div class="field-group">
                            <label for="w_name">Full name *</label>
                            <input type="text" id="w_name" name="name" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="field-group">
                            <label for="w_email">Email *</label>
                            <input type="email" id="w_email" name="email" placeholder="john@example.com" required>
                        </div>
                        <div class="field-group">
                            <label for="w_phone">Phone number</label>
                            <input type="tel" id="w_phone" name="phone" placeholder="+92 300 1234567">
                        </div>
                        <div class="field-group">
                            <label for="w_company">Company / Organisation</label>
                            <input type="text" id="w_company" name="company" placeholder="Your company name">
                        </div>
                    </div>
                </div>

                <!-- ====== STEP 2 ====== -->
                <div class="wizard-step" data-step="2">
                    <div class="step-icon"><i class="fas fa-cogs"></i></div>
                    <h3>Define the project</h3>
                    <p class="step-desc">Give us the high‑level details.</p>
                    <div class="form-grid-2">
                        <div class="field-group">
                            <label for="w_project_type">Project type *</label>
                            <select class="theme-select" id="w_project_type" name="project_type" required>
                                <option value="">Select…</option>
                                <option value="Website">Website</option>
                                <option value="Web App">Web Application</option>
                                <option value="Mobile App">Mobile App</option>
                                <option value="UI/UX Design">UI/UX Design</option>
                                <option value="Branding & Identity">Branding & Identity</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label for="w_budget">Estimated budget (USD)</label>
                            <input type="text" id="w_budget" name="budget" placeholder="e.g. 5,000 – 10,000">
                        </div>
                        <div class="field-group">
                            <label for="w_preferred_contact">Preferred contact method</label>
                            <select class="theme-select" id="w_preferred_contact" name="preferred_contact">
                                <option value="Email">Email</option>
                                <option value="Phone">Phone</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Telegram">Telegram</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label for="w_deadline">Target deadline</label>
                            <input type="date" id="w_deadline" name="deadline">
                        </div>
                    </div>
                </div>

                <!-- ====== STEP 3 ====== -->
                <div class="wizard-step" data-step="3">
                    <div class="step-icon"><i class="fas fa-pen-fancy"></i></div>
                    <h3>Your message</h3>
                    <p class="step-desc">What do you need to be built? Be as detailed as you like.</p>
                    <div class="form-grid-2" style="grid-template-columns:1fr;">
                        <div class="field-group">
                            <label for="w_message">Project brief *</label>
                            <textarea id="w_message" name="message" placeholder="Tell me what needs to work…" required></textarea>
                        </div>
                    </div>

                    <!-- ===== REVIEW CARD (preview before submit) ===== -->
                    <div class="review-card" id="reviewCard">
                        <div class="review-title"><i class="fas fa-check-circle"></i> Review your answers</div>
                        <div class="review-grid" id="reviewGrid"></div>
                    </div>
                </div>

                <!-- hidden fields -->
                <input type="hidden" name="status" value="new">
                <input type="hidden" name="admin_notes" value="—">

                <!-- ===== NAVIGATION BUTTONS ===== -->
                <div class="wizard-actions">
                    <button type="button" class="btn-secondary" id="wizardBack" style="visibility:hidden;">
                        <i class="fas fa-chevron-left"></i> Back
                    </button>
                    <button type="button" class="btn-primary" id="wizardNext">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="submit" class="btn-primary submit-btn" id="wizardSubmit" style="display:none;">
                        <span class="submit-text"><i class="fas fa-paper-plane"></i> Send inquiry</span>
                        <span class="submit-spinner" style="display:none;"><i class="fas fa-spinner fa-spin"></i> Sending…</span>
                    </button>
                </div>

                <!-- ===== STATUS / FEEDBACK ===== -->
                <div id="wizardStatus" class="wizard-status"></div>

                <!-- ===== SUCCESS STATE (overlay) ===== -->
                <div id="successState" class="success-state" style="display:none;">
                    <div class="success-check">
                        <svg viewBox="0 0 52 52"><circle class="check-ring" cx="26" cy="26" r="25"/><path class="check-mark" d="M14 27l8 8 16-16"/></svg>
                    </div>
                    <h3>Inquiry sent! 🚀</h3>
                    <p>We'll get back to you within 24 hours.</p>
                </div>

            </form>
        </div>
    </div>

    <!-- ============================================================
    STYLES — Enhanced multi‑step wizard
    ============================================================ -->
    <style>
        /* ─── CTA button with pulse ──────────────────────────────── */
        .wizard-cta {
            position: relative;
            background: linear-gradient(135deg, var(--accent, #00d4ff), var(--accent2, #3b82f6));
            color: #fff;
            border: none;
            padding: 16px 40px;
            border-radius: 60px;
            font-weight: 700;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 8px 32px rgba(0, 180, 255, 0.30);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 14px;
            letter-spacing: 0.3px;
            overflow: visible;
        }
        .wizard-cta:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 48px rgba(0, 180, 255, 0.45);
        }
        .cta-pulse {
            position: absolute;
            inset: -4px;
            border-radius: 60px;
            border: 2px solid var(--accent);
            animation: pulseRing 2s ease-out infinite;
            pointer-events: none;
        }
        @keyframes pulseRing {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.12); opacity: 0; }
        }

        /* ─── Modal overlay ──────────────────────────────────────── */
        .wizard-overlay {
            display: none;
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100dvh;
            background: var(--overlay-bg, rgba(5, 5, 5, 0.88));
            backdrop-filter: blur(8px);
            z-index: 9999;
            justify-content: center;
            align-items: flex-start;
            overflow-y: auto;
            overscroll-behavior: contain;
            padding: max(12px, env(safe-area-inset-top)) 12px max(12px, env(safe-area-inset-bottom));
        }
        .wizard-overlay.active { display: flex; }

        .wizard-container {
            background: var(--surface, #0c1428);
            border: 1px solid rgba(0, 180, 255, 0.15);
            border-radius: var(--radius, 16px);
            max-width: 760px;
            width: 100%;
            max-height: calc(100dvh - max(24px, env(safe-area-inset-top) + env(safe-area-inset-bottom) + 24px));
            overflow-y: auto;
            overscroll-behavior: contain;
            padding: 32px 36px 28px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.8);
            position: relative;
            animation: slideUp 0.35s cubic-bezier(0.21, 1.02, 0.35, 1);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ─── Header ──────────────────────────────────────────────── */
        .wizard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .wizard-header h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
            margin: 0;
        }
        .wizard-close {
            background: transparent;
            border: none;
            color: var(--muted);
            font-size: 30px;
            line-height: 1;
            cursor: pointer;
            transition: color 0.2s;
        }
        .wizard-close:hover { color: #fff; }

        /* ─── Progress ────────────────────────────────────────────── */
        .wizard-progress {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 16px 0 24px;
        }
        .step-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .dot-step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--surface2);
            border: 2px solid var(--border);
            transition: all 0.3s;
        }
        .dot-step.active {
            background: var(--accent);
            border-color: var(--accent);
            box-shadow: 0 0 16px rgba(0, 180, 255, 0.4);
            transform: scale(1.15);
        }
        .dot-step.done {
            background: var(--accent2);
            border-color: var(--accent2);
        }
        .step-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 4px;
        }
        .step-label.active { color: var(--accent); }
        .step-label.done { color: var(--accent2); }

        /* ─── Steps ───────────────────────────────────────────────── */
        .wizard-step {
            display: none;
            animation: fadeStep 0.3s ease;
        }
        .wizard-step.active { display: block; }
        @keyframes fadeStep {
            from { opacity: 0; transform: translateX(12px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .step-icon {
            font-size: 32px;
            color: var(--accent);
            margin-bottom: 4px;
        }
        .wizard-step h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 2px;
        }
        .step-desc {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 18px;
        }

        /* ─── Form fields ─────────────────────────────────────────── */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .field-group label {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
        }
        .field-group input,
        .field-group select,
        .field-group textarea {
            width: 100%;
            padding: 10px 14px;
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font: inherit;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .theme-select {
            appearance: none;
            -webkit-appearance: none;
            color-scheme: dark;
            forced-color-adjust: none;
            cursor: pointer;
            padding-right: 42px !important;
            background-color: #18233a !important;
            color: #f0f4ff !important;
            background-image: linear-gradient(45deg, transparent 50%, var(--accent) 50%), linear-gradient(135deg, var(--accent) 50%, transparent 50%) !important;
            background-position: calc(100% - 19px) 50%, calc(100% - 13px) 50% !important;
            background-size: 6px 6px, 6px 6px !important;
            background-repeat: no-repeat !important;
        }
        .theme-select option {
            background-color: #18233a !important;
            color: #f0f4ff !important;
        }
        .theme-select option:checked,
        .theme-select option:hover {
            background: var(--accent2);
            color: #fff;
        }
        .theme-select:hover {
            border-color: var(--accent);
        }
        .field-group input:focus,
        .field-group select:focus,
        .field-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 180, 255, 0.10);
        }
        .field-group textarea {
            min-height: 110px;
            resize: vertical;
        }

        /* ─── Review card ──────────────────────────────────────────── */
        .review-card {
            background: rgba(0, 180, 255, 0.04);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 18px;
            margin-top: 12px;
        }
        .review-title {
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 8px;
            font-size: 14px;
        }
        .review-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 16px;
            font-size: 14px;
        }
        .review-grid .rv-item {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .review-grid .rv-item .rv-label {
            color: var(--muted);
        }
        .review-grid .rv-item .rv-value {
            color: var(--text);
            font-weight: 500;
            text-align: right;
            max-width: 60%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ─── Navigation ──────────────────────────────────────────── */
        .wizard-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            gap: 12px;
        }
        .wizard-actions .btn-primary,
        .wizard-actions .btn-secondary {
            padding: 10px 28px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-2, #0099cc));
            color: #fff;
            box-shadow: 0 4px 16px rgba(0, 180, 255, 0.25);
        }
        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0, 180, 255, 0.35);
        }
        .btn-primary:disabled { opacity: 0.6; cursor: not-allowed; }
        .btn-secondary {
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover { background: var(--surface-card); border-color: var(--accent); }

        .wizard-status {
            margin-top: 12px;
            text-align: center;
            font-size: 14px;
            min-height: 24px;
            color: var(--muted);
        }

        /* ─── Success state ───────────────────────────────────────── */
        .success-state {
            text-align: center;
            padding: 20px 0 10px;
        }
        .success-check {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
        }
        .success-check svg {
            width: 100%;
            height: 100%;
        }
        .check-ring {
            fill: none;
            stroke: var(--accent);
            stroke-width: 3;
            stroke-dasharray: 160;
            stroke-dashoffset: 160;
            animation: drawRing 0.6s ease forwards 0.2s;
        }
        .check-mark {
            fill: none;
            stroke: #34d399;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: drawCheck 0.4s ease forwards 0.6s;
        }
        @keyframes drawRing { to { stroke-dashoffset: 0; } }
        @keyframes drawCheck { to { stroke-dashoffset: 0; } }
        .success-state h3 { font-size: 24px; margin: 8px 0 4px; color: #34d399; }
        .success-state p { color: var(--muted); }

        /* ─── Responsive ──────────────────────────────────────────── */
        @media (max-width: 640px) {
            .form-grid-2 { grid-template-columns: 1fr; }
            .wizard-container { max-height: calc(100dvh - 24px); padding: 20px 16px 18px; border-radius: 12px; }
            .review-grid { grid-template-columns: 1fr; }
            .wizard-actions { flex-wrap: wrap; }
            .wizard-actions .btn-primary,
            .wizard-actions .btn-secondary { flex: 1; justify-content: center; }
            .wizard-cta { width: 100%; justify-content: center; font-size: 16px; padding: 14px 24px; }
        }

        @media (max-height: 620px) and (orientation: landscape) {
            .wizard-overlay { align-items: flex-start; }
            .wizard-container { max-height: calc(100dvh - 16px); padding: 16px 20px; }
            .wizard-progress { margin: 10px 0 14px; }
            .step-desc { margin-bottom: 10px; }
        }
    </style>

    <!-- ============================================================
    JAVASCRIPT — Wizard logic + submission
    ============================================================ -->
    <script>
    (function() {
        'use strict';

        // ─── DOM refs ──────────────────────────────────────────────
        const overlay = document.getElementById('wizardModal');
        const openBtn = document.getElementById('openWizardBtn');
        const closeBtn = document.getElementById('closeWizardBtn');
        const form = document.getElementById('wizardForm');
        const steps = document.querySelectorAll('.wizard-step');
        const dots = document.querySelectorAll('.dot-step');
        const labels = document.querySelectorAll('.step-label');
        const backBtn = document.getElementById('wizardBack');
        const nextBtn = document.getElementById('wizardNext');
        const submitBtn = document.getElementById('wizardSubmit');
        const statusEl = document.getElementById('wizardStatus');
        const successState = document.getElementById('successState');
        const reviewGrid = document.getElementById('reviewGrid');

        // Keep the fixed dialog outside the contact section's scroll context.
        document.body.appendChild(overlay);

        let currentStep = 1;
        const totalSteps = 3;
        let previousBodyOverflow = '';

        // ─── Open / Close ──────────────────────────────────────────
        function openModal() {
            overlay.classList.add('active');
            previousBodyOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            steps.forEach(el => { el.style.display = ''; });
            document.querySelector('.wizard-progress').style.display = '';
            document.querySelector('.wizard-actions').style.display = '';
            goToStep(1);
            statusEl.textContent = '';
            successState.style.display = 'none';
            submitBtn.style.display = 'none';
            submitBtn.disabled = false;
            submitBtn.querySelector('.submit-text').style.display = 'inline-flex';
            submitBtn.querySelector('.submit-spinner').style.display = 'none';
            nextBtn.style.display = 'inline-flex';
            // reset form if needed (but keep hidden fields)
            form.querySelectorAll('input:not([type="hidden"]), textarea, select').forEach(el => el.value = '');
        }
        function closeModal() {
            overlay.classList.remove('active');
            document.body.style.overflow = previousBodyOverflow;
        }

        openBtn.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

        // ─── Step navigation ──────────────────────────────────────
        function goToStep(step) {
            currentStep = Math.min(Math.max(step, 1), totalSteps);
            steps.forEach((el, i) => {
                el.classList.toggle('active', (i + 1) === currentStep);
            });
            dots.forEach((dot, i) => {
                const num = i + 1;
                dot.classList.remove('active', 'done');
                if (num === currentStep) dot.classList.add('active');
                else if (num < currentStep) dot.classList.add('done');
            });
            labels.forEach((label, i) => {
                const num = i + 1;
                label.classList.remove('active', 'done');
                if (num === currentStep) label.classList.add('active');
                else if (num < currentStep) label.classList.add('done');
            });

            // Back button visibility
            backBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';

            // Next / Submit toggle
            if (currentStep === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-flex';
                updateReviewCard();
            } else {
                nextBtn.style.display = 'inline-flex';
                submitBtn.style.display = 'none';
            }

            // scroll to top of modal content
            document.querySelector('.wizard-container').scrollTop = 0;
        }

        backBtn.addEventListener('click', () => goToStep(currentStep - 1));
        nextBtn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                goToStep(currentStep + 1);
            }
        });

        // ─── Step validation ──────────────────────────────────────
        function validateStep(step) {
            const stepEl = document.querySelector(`.wizard-step[data-step="${step}"]`);
            const required = stepEl.querySelectorAll('[required]');
            let valid = true;
            required.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#ff6b6b';
                    valid = false;
                } else {
                    field.style.borderColor = '';
                }
            });
            if (!valid) {
                statusEl.textContent = 'Please fill in all required fields.';
                statusEl.style.color = '#ff6b6b';
            } else {
                statusEl.textContent = '';
            }
            return valid;
        }

        // ─── Review card update ──────────────────────────────────
        function updateReviewCard() {
            const fields = {
                'Name': document.getElementById('w_name').value || '—',
                'Email': document.getElementById('w_email').value || '—',
                'Phone': document.getElementById('w_phone').value || '—',
                'Company': document.getElementById('w_company').value || '—',
                'Project type': document.getElementById('w_project_type').value || '—',
                'Budget': document.getElementById('w_budget').value || '—',
                'Preferred contact': document.getElementById('w_preferred_contact').value || '—',
                'Deadline': document.getElementById('w_deadline').value || '—',
            };
            let html = '';
            for (const [label, value] of Object.entries(fields)) {
                html += `<div class="rv-item"><span class="rv-label">${label}</span><span class="rv-value">${value}</span></div>`;
            }
            reviewGrid.innerHTML = html;
        }

        // ─── Form submission ──────────────────────────────────────
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate step 3 (message)
            const msg = document.getElementById('w_message');
            if (!msg.value.trim()) {
                statusEl.textContent = 'Please write your project brief.';
                statusEl.style.color = '#ff6b6b';
                msg.style.borderColor = '#ff6b6b';
                return;
            }
            msg.style.borderColor = '';

            // Show spinner, hide text
            const submitText = submitBtn.querySelector('.submit-text');
            const spinner = submitBtn.querySelector('.submit-spinner');
            submitText.style.display = 'none';
            spinner.style.display = 'inline-flex';
            submitBtn.disabled = true;
            statusEl.textContent = '';
            statusEl.style.color = 'var(--muted)';

            try {
                const formData = new FormData(form);
                const response = await fetch('api/contact.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    // Show success state
                    form.querySelectorAll('.wizard-step').forEach(el => el.style.display = 'none');
                    document.querySelector('.wizard-progress').style.display = 'none';
                    document.querySelector('.wizard-actions').style.display = 'none';
                    successState.style.display = 'block';
                    statusEl.textContent = '';
                    // reset external status
                    document.getElementById('contactFormStatus').textContent = '✅ Inquiry sent successfully!';
                } else {
                    statusEl.textContent = result.message || 'Server error. Please try again.';
                    statusEl.style.color = '#ff6b6b';
                    submitText.style.display = 'inline-flex';
                    spinner.style.display = 'none';
                    submitBtn.disabled = false;
                }
            } catch (err) {
                statusEl.textContent = 'Network error. Check your connection.';
                statusEl.style.color = '#ff6b6b';
                submitText.style.display = 'inline-flex';
                spinner.style.display = 'none';
                submitBtn.disabled = false;
            }
        });

        // ─── Auto‑close on success after 4s ─────────────────────
        // (We'll let the user click the close button or overlay)

        // ─── Allow Enter key to advance / submit ─────────────────
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && overlay.classList.contains('active')) {
                const active = document.activeElement;
                if (active && (active.tagName === 'INPUT' || active.tagName === 'SELECT' || active.tagName ===
                        'TEXTAREA')) {
                    e.preventDefault();
                    if (currentStep === totalSteps) {
                        form.dispatchEvent(new Event('submit'));
                    } else {
                        if (validateStep(currentStep)) goToStep(currentStep + 1);
                    }
                }
            }
        });

    })();
    </script>

</section>