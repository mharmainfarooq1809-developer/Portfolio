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
          <span class="loader-diagnostic-line">Loading portfolio content...</span>
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
        <span class="loader-status-name">CONTENT SOURCE</span>
        <span class="loader-status-value" data-status="content">WAITING</span>
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

<style>
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
    radial-gradient(circle, rgba(0,230,118,0.14), transparent 68%);
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
  box-shadow: inset 0 0 30px rgba(0,230,118,0.05), 0 25px 80px rgba(0,0,0,0.55);
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
  color: var(--accent, #00e676);
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
  color: var(--accent, #00e676);
  opacity: 1;
}

#loader.loader-screen .loader-scan {
  color: var(--accent, #00e676);
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
  color: var(--accent, #00e676);
}

#loader.loader-screen .loader-status-value.online::before {
  background: var(--accent, #00e676);
  box-shadow: 0 0 0 1px rgba(0,230,118,0.3) inset, 0 0 8px rgba(0,230,118,0.7);
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
  background: var(--accent, #00e676);
  border-radius: inherit;
  box-shadow: 0 0 8px var(--accent, #00e676);
  transition: width 60ms linear;
}

#loader.loader-screen .loader-pct {
  min-width: 50px;
  text-align: right;
  font-size: 11px;
  color: var(--accent, #00e676);
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
  color: var(--accent, #00e676);
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
</style>

<script>
(function () {
  var loader = document.getElementById('loader');
  if (!loader) return;

  var fill = document.getElementById('loaderFill');
  var pct = document.getElementById('loaderPct');
  var stage = document.getElementById('loaderStage');

  var diagnostics = [
    '> Initializing core system...',
    '> Loading visual engine...',
    '> Connecting project matrix...',
    '> Loading portfolio content...',
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
    if (progress >= 50) activateStatus('content', true);
    if (progress >= 72) activateStatus('ai', true);
    if (progress >= 88) activateStatus('terminal', true);
  }

  var startedAt = null;
  var duration = (window.matchMedia('(prefers-reduced-motion: reduce)').matches) ? 1200 : 2600;
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

      function finishLoader() {
        loader.classList.add('loader-ready');

        function triggerHeroIntro() {
          if (typeof window.playHeroIntro === 'function') {
            window.playHeroIntro();
            return true;
          }

          if (!window.__heroIntroPoll) {
            var attempt = 0;
            window.__heroIntroPoll = window.setInterval(function () {
              attempt += 1;
              if (typeof window.playHeroIntro === 'function') {
                window.clearInterval(window.__heroIntroPoll);
                window.__heroIntroPoll = null;
                window.playHeroIntro();
              } else if (attempt >= 100) {
                window.clearInterval(window.__heroIntroPoll);
                window.__heroIntroPoll = null;
              }
            }, 16);
          }

          return false;
        }

        triggerHeroIntro();

        window.setTimeout(function () {
          loader.classList.add('loader-exiting');
          loader.style.pointerEvents = 'none';
        }, 500);
        
        if (rafId) window.cancelAnimationFrame(rafId);
      }

      if (document.readyState === 'complete') {
        window.setTimeout(finishLoader, 1000);
      } else {
        window.addEventListener('load', function () {
          window.setTimeout(finishLoader, 800);
        }, { once: true });
      }
    }
  }

  stage.textContent = diagnostics[0];
  window.requestAnimationFrame(tick);
})();
</script>
