<?php
require_once __DIR__ . '/../includes/csrf.php';
$assistantCsrf = generateCsrfToken();
?>
<button type="button" class="ai-float-trigger" id="aiFloatTrigger" aria-label="Open AI Portfolio Assistant" aria-controls="assistant" aria-expanded="false">AI</button>
<section class="section ai-widget-section" id="assistant" aria-hidden="true">
    <div class="container">
        <div class="section-head"><div class="eyebrow">AI Portfolio Assistant</div><h2>Ask it about the work.</h2><p>Answers are grounded in Harmain's public portfolio information.</p></div>
        <div class="ai-panel">
            <div class="ai-header"><span class="ai-dot"></span><b>Harmain's Assistant</b><span id="aiOnlineLabel" aria-live="polite">Checking…</span><button type="button" class="ai-clear-btn" id="aiClearBtn">Clear</button><button type="button" class="ai-close-btn" id="aiCloseBtn" aria-label="Close AI Portfolio Assistant">&times;</button></div>
            <div class="ai-body" id="aiBody" role="log" aria-live="polite" aria-label="Portfolio assistant conversation"><div class="ai-msg bot">Hi — ask me about Harmain's skills, projects, services, or how to get in touch.</div></div>
            <div class="ai-suggestions" id="aiSuggestions">
                <button type="button" class="ai-chip" data-q="Tell me about Harmain">Tell me about Harmain</button><button type="button" class="ai-chip" data-q="What are Harmain's skills?">What are Harmain's skills?</button><button type="button" class="ai-chip" data-q="Show me his projects">Show me his projects</button><button type="button" class="ai-chip" data-q="Explain Union Enterprises">Explain Union Enterprises</button><button type="button" class="ai-chip" data-q="Can Harmain build an ERP?">Can Harmain build an ERP?</button><button type="button" class="ai-chip" data-q="What services does Harmain offer?">What services does Harmain offer?</button><button type="button" class="ai-chip" data-q="Tell me about NovExa Tech">Tell me about NovExa Tech</button><button type="button" class="ai-chip" data-q="Can I hire Harmain?">Can I hire Harmain?</button><button type="button" class="ai-chip" data-q="Can I download his resume?">Can I download his resume?</button><button type="button" class="ai-chip" data-q="How can I contact Harmain?">How can I contact Harmain?</button>
            </div>
            <form class="ai-input-row" id="aiForm"><input type="text" id="aiInput" placeholder="Ask about the work…" autocomplete="off" maxlength="800" aria-label="Ask the portfolio assistant a question"><button type="submit" id="aiSendBtn">Send</button></form>
            <div class="ai-security-note">Provider: local portfolio knowledge base.</div>
        </div>
    </div>
</section>
<style>
.ai-float-trigger { position:fixed; right:24px; bottom:24px; z-index:1100; width:56px; height:56px; border:1px solid var(--border-strong); border-radius:50%; background:var(--surface); color:var(--accent); font:600 12px var(--font-mono); letter-spacing:.04em; cursor:pointer; box-shadow:0 12px 30px rgba(0,0,0,.22); transition:transform .3s ease, border-color .3s ease, background .3s ease; }
.ai-float-trigger:hover, .ai-float-trigger:focus-visible { transform:translateY(-4px); border-color:var(--accent); background:var(--surface-2); outline:none; }
.ai-float-trigger.is-hidden { opacity:0; pointer-events:none; transform:scale(.9); }
.ai-widget-section { position:fixed; right:24px; bottom:96px; z-index:1099; width:min(430px, calc(100vw - 48px)); padding:0; opacity:0; visibility:hidden; pointer-events:none; transform:translateY(18px) scale(.97); transform-origin:bottom right; transition:opacity .3s ease, transform .3s ease, visibility .3s ease; }
.ai-widget-section.is-open { opacity:1; visibility:visible; pointer-events:auto; transform:translateY(0) scale(1); }
.ai-widget-section .container { width:100%; max-width:none; min-width:0; padding:0; }
.ai-widget-section .section-head { display:none; }
.ai-widget-section .ai-panel { width:100%; max-width:100%; height:min(480px, calc(100dvh - 120px)); max-height:calc(100dvh - 120px); display:flex; flex-direction:column; box-shadow:0 18px 50px rgba(0,0,0,.28); }
.ai-widget-section .ai-header { min-width:0; flex:0 0 auto; flex-wrap:wrap; }
.ai-widget-section .ai-header .ai-dot { flex:0 0 auto; margin-left:0; }
.ai-widget-section .ai-header b { min-width:0; overflow-wrap:anywhere; }
.ai-widget-section .ai-header #aiOnlineLabel { margin-left:auto; }
.ai-widget-section .ai-body { min-height:0; flex:1 1 auto; max-height:none; overflow-x:hidden; overflow-y:auto; }
.ai-widget-section .ai-msg { min-width:0; max-width:88%; overflow-wrap:anywhere; word-break:break-word; }
.ai-widget-section .ai-suggestions { flex:0 0 auto; max-height:88px; overflow-y:auto; overflow-x:hidden; }
.ai-widget-section .ai-chip { max-width:100%; white-space:normal; text-align:left; overflow-wrap:anywhere; }
.ai-widget-section .ai-input-row { min-width:0; flex:0 0 auto; }
.ai-widget-section .ai-input-row input { min-width:0; width:0; }
.ai-widget-section .ai-input-row button { flex:0 0 auto; }
.ai-widget-section .ai-security-note { overflow-wrap:anywhere; }
.ai-close-btn { margin-left:8px; width:28px; height:28px; padding:0; border:1px solid var(--border); border-radius:50%; background:none; color:var(--muted); font:20px/1 var(--font-body); cursor:pointer; }
.ai-close-btn:hover, .ai-close-btn:focus-visible { color:var(--text); border-color:var(--accent); outline:none; }
.ai-clear-btn { margin-left:auto; background:none; border:1px solid var(--border); color:var(--muted); padding:6px 12px; border-radius:999px; font:11px var(--font-mono); }
.ai-clear-btn:hover { border-color:var(--accent); color:var(--text); }.ai-msg.error { background:rgba(255,92,92,.08); border:1px solid rgba(255,92,92,.25); align-self:flex-start; }.ai-msg-sources { display:flex; flex-wrap:wrap; gap:6px; margin-top:8px; }.ai-msg-source { border:1px solid var(--border); border-radius:999px; padding:2px 8px; color:var(--muted-2); font:10px var(--font-mono); }.ai-header #aiOnlineLabel { margin-left:10px; font:11px var(--font-mono); color:var(--muted-2); }.ai-header #aiOnlineLabel.online { color:var(--accent); }.ai-chip:disabled,#aiSendBtn:disabled { opacity:.5; cursor:wait; } @media(max-width:640px){.ai-header{flex-wrap:wrap;gap:10px}.ai-clear-btn{margin-left:0}.ai-body{max-height:none}.ai-widget-section .ai-panel{height:min(430px,calc(100dvh - 104px));max-height:calc(100dvh - 104px)}.ai-widget-section .ai-header{padding:16px}.ai-widget-section .ai-body{padding:16px}.ai-widget-section .ai-suggestions{max-height:64px;padding:0 16px 14px}.ai-widget-section .ai-input-row input{padding:14px 16px}.ai-widget-section .ai-input-row button{padding:0 16px}.ai-widget-section .ai-security-note{padding:0 16px 14px}}
</style>
<script>
(() => {
  const csrf = <?= json_encode($assistantCsrf, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
  const api = 'api/portfolio-assistant.php', clearApi = 'api/portfolio-assistant-clear.php', healthApi = 'api/portfolio-assistant-health.php';
    const section = document.getElementById('assistant'), trigger = document.getElementById('aiFloatTrigger'), closeBtn = document.getElementById('aiCloseBtn'), body = document.getElementById('aiBody'), form = document.getElementById('aiForm'), input = document.getElementById('aiInput'), send = document.getElementById('aiSendBtn'), suggestions = document.getElementById('aiSuggestions'), clear = document.getElementById('aiClearBtn'), status = document.getElementById('aiOnlineLabel');
    let busy = false, typing;
    function setOpen(open) { section.classList.toggle('is-open', open); section.setAttribute('aria-hidden', String(!open)); trigger.setAttribute('aria-expanded', String(open)); trigger.classList.toggle('is-hidden', open); if (open) input.focus(); else trigger.focus(); }
    trigger.addEventListener('click', () => setOpen(true));
    closeBtn.addEventListener('click', () => setOpen(false));
    document.addEventListener('pointerdown', event => { if (section.classList.contains('is-open') && !section.contains(event.target)) setOpen(false); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && section.classList.contains('is-open')) setOpen(false); });
  const scroll = () => body.scrollTo({top: body.scrollHeight, behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth'});
  function message(text, role, sources = [], resume = null) { const el=document.createElement('div'); el.className='ai-msg '+role; el.textContent=text; if(resume?.url){const link=document.createElement('a');link.className='ai-resume-link';link.href=resume.url;link.download=resume.name||'Harmain_Resume.pdf';link.textContent='Download resume PDF';link.rel='noopener';el.append(document.createElement('br'),link)} if(sources.length){const row=document.createElement('div');row.className='ai-msg-sources';sources.forEach(s=>{const tag=document.createElement('span');tag.className='ai-msg-source';tag.textContent=s.title||s.type;row.append(tag)});el.append(row)} body.append(el);scroll(); }
  function setBusy(value){busy=value;send.disabled=value;input.disabled=value;suggestions.querySelectorAll('button').forEach(b=>b.disabled=value)}
  function showTyping(){typing=document.createElement('div');typing.className='ai-typing';typing.setAttribute('aria-label','Assistant is thinking');typing.innerHTML='<span></span><span></span><span></span>';body.append(typing);scroll()}
  function hideTyping(){typing?.remove();typing=null}
  async function ask(raw){const text=String(raw||'').trim();if(!text||busy)return;setBusy(true);message(text,'user');input.value='';showTyping();try{const response=await fetch(api,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({message:text,csrf_token:csrf})});const data=await response.json();hideTyping();if(!response.ok||!data.success)throw new Error(data.message||'Unable to answer that right now.');message(data.message,'bot',data.sources||[],data.resume_url?{url:data.resume_url,name:data.resume_name}:null)}catch(error){hideTyping();message(error.message||'Unable to answer that right now.','error')}finally{setBusy(false);input.focus()}}
  form.addEventListener('submit',event=>{event.preventDefault();ask(input.value)});suggestions.addEventListener('click',event=>{const button=event.target.closest('.ai-chip');if(button)ask(button.dataset.q)});
  clear.addEventListener('click',async()=>{if(busy)return;try{await fetch(clearApi,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({csrf_token:csrf})})}catch(_){}body.replaceChildren();message("Hi — ask me about Harmain's skills, projects, services, or how to get in touch.",'bot')});
  fetch(healthApi).then(r=>r.json()).then(data=>{status.textContent=data.online?'Online':'Offline';status.className=data.online?'online':''}).catch(()=>{status.textContent='Offline'});
})();
</script>
