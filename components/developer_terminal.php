<section class="section" id="terminal-section">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Developer Terminal</div>
            <h2>Prefer the command line?</h2>
            <p>Type <span style="color: var(--accent)">help</span> to see available commands.</p>
        </div>

        <div class="terminal" id="harmainTerminal">
            <div class="terminal-bar">
                <div class="terminal-bar-left">
                    <span class="terminal-dot r"></span>
                    <span class="terminal-dot y"></span>
                    <span class="terminal-dot g"></span>
                    <span class="terminal-title">HARM<span class="lam">&Lambda;</span>IN OS <span class="sep">//</span> INTERACTIVE CONSOLE</span>
                </div>
                <div class="terminal-bar-right">
                    <span class="meta">SESSION <b>GUEST</b></span>
                    <span class="meta"><i class="pulse"></i>ONLINE</span>
                    <span class="meta meta-hide-sm">MODE <b>READ-ONLY</b></span>
                </div>
            </div>

            <div class="terminal-body" id="terminalBody"></div>

            <div class="terminal-input-row">
                <span class="prompt">guest@harmain:~$</span>
                <input
                    type="text"
                    id="terminalInput"
                    autocomplete="off"
                    spellcheck="false"
                    autocapitalize="off"
                    autocorrect="off"
                    aria-label="Terminal command input"
                >
            </div>
        </div>
    </div>
</section>

<style>
#terminal-section .terminal{
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    font-family: var(--font-mono);
    box-shadow: 0 30px 60px -30px rgba(0,0,0,0.6);
    position: relative;
}

#terminal-section .terminal::before{
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;
    background: repeating-linear-gradient(
        to bottom,
        rgba(255,255,255,0.015) 0px,
        rgba(255,255,255,0.015) 1px,
        transparent 1px,
        transparent 3px
    );
    opacity: 0.4;
    z-index: 2;
}

.terminal-bar{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 16px;
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
}

.terminal-bar-left{
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.terminal-dot{
    width: 11px;
    height: 11px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}
.terminal-dot.r{ background: #ff5f56; }
.terminal-dot.y{ background: #ffbd2e; }
.terminal-dot.g{ background: #27c93f; }

.terminal-title{
    font-size: 12.5px;
    letter-spacing: 0.06em;
    color: var(--muted);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.terminal-title .lam{ color: var(--accent); }
.terminal-title .sep{ color: var(--muted-2); margin: 0 2px; }

.terminal-bar-right{
    display: flex;
    align-items: center;
    gap: 14px;
}

.meta{
    font-size: 10.5px;
    letter-spacing: 0.08em;
    color: var(--muted-2);
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}
.meta b{
    color: var(--muted);
    font-weight: 600;
}

.pulse{
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--accent);
    display: inline-block;
    box-shadow: 0 0 0 0 var(--accent-dim);
    animation: pulseGlow 2s var(--ease) infinite;
}
@keyframes pulseGlow{
    0%   { box-shadow: 0 0 0 0 var(--accent-dim); }
    70%  { box-shadow: 0 0 0 6px transparent; }
    100% { box-shadow: 0 0 0 0 transparent; }
}

@media (max-width: 560px){
    .meta-hide-sm{ display: none; }
    #terminal-section .container { padding-left:20px; padding-right:20px; }
    .terminal-bar { align-items:flex-start; padding:10px 12px; }
    .terminal-bar-left { width:100%; }
    .terminal-bar-right { width:100%; justify-content:flex-start; gap:10px; }
    .terminal-title { font-size:10px; }
    .terminal-title { white-space:normal; overflow-wrap:anywhere; }
    .terminal-body { height:300px; padding:14px 12px 6px; font-size:12px; }
    .terminal-input-row { align-items:flex-start; padding:10px 12px; }
    .terminal-input-row .prompt { max-width:34%; white-space:normal; line-height:1.4; }
    .terminal-input-row input { min-width:0; width:100%; }
    .out-key { min-width:90px; }
}

.terminal-body{
    position: relative;
    z-index: 3;
    padding: 18px 18px 6px;
    height: 380px;
    overflow-y: auto;
    font-size: 13.5px;
    line-height: 1.65;
    scroll-behavior: smooth;
}

.terminal-body::-webkit-scrollbar{ width: 8px; }
.terminal-body::-webkit-scrollbar-track{ background: transparent; }
.terminal-body::-webkit-scrollbar-thumb{
    background: var(--border-strong);
    border-radius: 8px;
}

.terminal-line{
    white-space: pre-wrap;
    word-break: break-word;
    color: var(--text);
    margin-bottom: 2px;
    animation: lineIn 0.18s var(--ease);
}
@keyframes lineIn{
    from{ opacity: 0; transform: translateY(2px); }
    to{ opacity: 1; transform: translateY(0); }
}

.terminal-line.dim{ color: var(--muted); }
.terminal-line.dim2{ color: var(--muted-2); }
.terminal-line.accent{ color: var(--accent); }
.terminal-line.danger{ color: var(--danger); }
.terminal-line.rule{
    color: var(--border-strong);
    letter-spacing: 0;
}
.terminal-line.spacer{ height: 6px; }

.out-heading{
    color: var(--accent);
    font-weight: 700;
    letter-spacing: 0.06em;
}

.out-key{
    display: inline-block;
    min-width: 128px;
    color: var(--muted);
}
.out-val{ color: var(--text); }

.cmd-echo{ color: var(--text); }
.cmd-echo .arg{ color: var(--accent-2); }

.prompt{
    color: var(--accent);
    font-weight: 600;
    margin-right: 8px;
    flex-shrink: 0;
}

.terminal-input-row{
    position: relative;
    z-index: 3;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 18px 16px;
    border-top: 1px solid var(--border);
}

.terminal-input-row input{
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: var(--text);
    font-family: var(--font-mono);
    font-size: 13.5px;
    caret-color: var(--accent);
}
.terminal-input-row input::placeholder{ color: var(--muted-2); }

#terminal-section .proj-idx{ color: var(--accent); font-weight: 700; }
#terminal-section .proj-name{ color: var(--text); font-weight: 700; letter-spacing: 0.03em; }
#terminal-section .proj-tag{ color: var(--muted); }
</style>

<script>
(function(){
    "use strict";

    /* ---------------------------------------------------------------
       DATA SOURCE
       Uses window.portfolioData if it already exists on the page so
       the terminal and the rest of the site never fall out of sync.
       Falls back to this exact dataset (from the live portfolio) if
       portfolioData hasn't been defined yet.
    ----------------------------------------------------------------*/
    var fallbackData = {
        name: "Muhammad Harmain",
        role: "Full Stack Developer",
        location: "Pakistan",
        bio: "Full stack developer focused on PHP and Laravel, building business management systems, dashboards and portals designed for daily, repeated use rather than one-time demos.",
        stack: {
            "Backend": [
                { name: "PHP", desc: "Primary server-side language for every system shipped." },
                { name: "Laravel", desc: "Default framework for routing, ORM, middleware and authentication." },
                { name: "REST APIs", desc: "Endpoints powering dashboard views and portal-to-admin data flow." }
            ],
            "Frontend": [
                { name: "JavaScript", desc: "Keeps dashboard interfaces fast and responsive." },
                { name: "HTML5", desc: "Semantic structure for interfaces." },
                { name: "CSS3", desc: "Layout and theming across dashboards and portals." },
                { name: "Bootstrap", desc: "Component baseline for admin panels and forms." }
            ],
            "Data": [
                { name: "MySQL", desc: "Relational schema underneath the systems." },
                { name: "Schema Design", desc: "Normalized structures designed before screens." },
                { name: "Query Optimization", desc: "Keeps reporting fast as data volume grows." }
            ],
            "Applied": [
                { name: "AI Integration", desc: "Layering assistants and automation on top of existing dashboards." },
                { name: "Dashboard Development", desc: "Admin and analytics dashboards built around real decisions." },
                { name: "Auth & Roles", desc: "Role-based middleware separating admin and client access." }
            ]
        },
        projects: [
            {
                name: "Union Enterprises",
                tagline: "Import & export logistics management system",
                description: "A two-sided platform replacing spreadsheet-based tracking with a single operational source of truth for shipments, invoices and documents.",
                tech: ["Laravel", "MySQL", "REST API", "Role-Based Access"],
                metrics: { "DB Tables": 14, "User Roles": 2, "REST Endpoints": 22, "Dashboards": 2 },
                architecture: "Laravel MVC structure with role-based middleware separating admin and client access, REST endpoints powering dynamic dashboard views.",
                database: "Normalized MySQL schema linking shipments, invoices, and documents to clients — built to support reporting without duplicating data.",
                result: "Replaced manual status updates with live tracking and centralized invoicing and document management in one place."
            },
            {
                name: "Online Movie Booking System",
                tagline: "Full-stack cinema ticket booking platform",
                description: "A web-based platform for browsing movies, selecting showtimes and seats, and completing online ticket bookings.",
                tech: ["PHP", "MySQL", "Bootstrap", "jQuery"],
                metrics: { "Key Features": 14, "User Roles": 2, "Booking Flow": 1, "Admin Dashboard": 1 },
                architecture: "PHP application with session-based booking flows, validated forms, and separate customer and administrator experiences.",
                database: "MySQL schema linking movies, screens, seats, showtimes, users, and customer bookings.",
                result: "Streamlined movie discovery, interactive seat selection, and cinema booking management in one system."
            },
            {
                name: "Jewelry Website",
                tagline: "Product-focused business website",
                description: "A product-focused website for a jewelry business, built around clean product presentation and straightforward navigation.",
                tech: ["PHP", "Bootstrap", "JavaScript"],
                metrics: { "Pages": 8, "Product Categories": 6, "Modules": 2, "Roles": 1 },
                architecture: "PHP-driven templating with a lightweight product catalog structure.",
                database: "Simple relational structure for products and categories.",
                result: "A working catalog presence for the business's product line."
            },
            {
                name: "Aniwear — Digital Wardrobe + AI Stylist",
                tagline: "Live digital wardrobe and AI styling platform",
                description: "A fashion-tech application for managing clothing collections, creating outfits, and receiving personalized AI styling recommendations.",
                tech: ["Laravel", "PHP", "MySQL", "AI API"],
                metrics: { "Key Features": 14, "User Roles": 1, "AI Stylist": 1, "Wardrobe Data": 1 },
                architecture: "Laravel application with authenticated dashboards, structured wardrobe data, outfit management, and an AI knowledge base.",
                database: "MySQL schema linking users, wardrobe items, clothing categories, outfits, and saved styling data.",
                result: "A live personal styling platform that turns a user's wardrobe into actionable outfit recommendations."
            }
        ],
        services: [
            "Business Management Systems",
            "Dashboard Development",
            "Client Portals",
            "API Development",
            "Database Architecture",
            "AI-Assisted Features"
        ],
        contact: {
            email: "mharmainfarooq@gmail.com",
            availability: ["Freelance", "Internship", "Full-Time", "Remote"],
            preferred: "Email",
            responseTime: "Within 24 hours",
            location: "Pakistan"
        }
    };

    var data = (typeof window.portfolioData === "object" && window.portfolioData !== null)
        ? window.portfolioData
        : fallbackData;

    /* ---------------------------------------------------------------
       DOM REFS
    ----------------------------------------------------------------*/
    var body = document.getElementById("terminalBody");
    var input = document.getElementById("terminalInput");
    var termWrap = document.getElementById("harmainTerminal");

    if (!body || !input) return;

    /* ---------------------------------------------------------------
       OUTPUT HELPERS
    ----------------------------------------------------------------*/
    function line(text, cls){
        var el = document.createElement("div");
        el.className = "terminal-line" + (cls ? " " + cls : "");
        el.textContent = text === undefined ? "" : text;
        body.appendChild(el);
        return el;
    }

    function html(markup, cls){
        var el = document.createElement("div");
        el.className = "terminal-line" + (cls ? " " + cls : "");
        el.innerHTML = markup;
        body.appendChild(el);
        return el;
    }

    function spacer(){ html("&nbsp;", "spacer"); }

    function rule(len){
        line((new Array((len || 42) + 1)).join("─"), "rule dim2");
    }

    function heading(text){
        line(text, "out-heading");
    }

    function kv(key, val){
        html('<span class="out-key">' + escapeHtml(key) + '</span><span class="out-val">' + escapeHtml(val) + '</span>');
    }

    function escapeHtml(str){
        return String(str)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");
    }

    function scrollToBottom(){
        body.scrollTop = body.scrollHeight;
    }

    function echoCommand(raw){
        html('<span class="prompt">guest@harmain:~$</span><span class="cmd-echo">' + escapeHtml(raw) + '</span>');
    }

    /* ---------------------------------------------------------------
       COMMAND IMPLEMENTATIONS
    ----------------------------------------------------------------*/
    var COMMANDS = ["help","about","whoami","projects","skills","services","github","contact","resume","hire","status","date","neofetch","clear"];

    function cmdHelp(){
        heading("AVAILABLE COMMANDS");
        rule(48);
        spacer();
        kv("about", "About Harmain");
        kv("whoami", "Current session information");
        kv("projects", "View selected projects (add a number for detail)");
        kv("skills", "View technical stack");
        kv("services", "View available services");
        kv("github", "GitHub information");
        kv("contact", "Contact information");
        kv("resume", "Resume information");
        kv("hire", "Availability for work");
        kv("status", "System status");
        kv("date", "Current date/time");
        kv("neofetch", "Portfolio system information");
        kv("clear", "Clear terminal");
        spacer();
        line("TIP", "dim2");
        line("Use ↑ / ↓ to navigate command history. Press Tab to autocomplete.", "dim");
    }

    function cmdAbout(){
        heading("ABOUT");
        rule(38);
        spacer();
        line(data.name + " — " + (data.role || "Full Stack Developer"), "accent");
        spacer();
        line(data.bio, "dim");
    }

    function cmdWhoami(){
        heading("USER");
        rule(24);
        spacer();
        line("guest@harmain");
        spacer();
        heading("ACCESS LEVEL");
        rule(24);
        spacer();
        line("GUEST");
        spacer();
        heading("ENVIRONMENT");
        rule(24);
        spacer();
        line("HARM\u039BIN PORTFOLIO SYSTEM");
    }

    function cmdProjects(arg){
        var list = data.projects || [];
        if (arg){
            var n = parseInt(arg, 10);
            var p = list[n - 1];
            if (!p){
                line('Project ' + arg + ' not found. Type "projects" to view the list.', "danger");
                return;
            }
            heading(("0" + n).slice(-2) + "  " + p.name.toUpperCase());
            rule(48);
            spacer();
            line(p.tagline, "accent");
            spacer();
            line(p.description, "dim");
            spacer();
            kv("TECH", (p.tech || []).join(" • "));
            spacer();
            if (p.metrics){
                heading("METRICS");
                rule(24);
                Object.keys(p.metrics).forEach(function(k){
                    kv(k, String(p.metrics[k]));
                });
                spacer();
            }
            if (p.architecture){
                heading("ARCHITECTURE");
                rule(24);
                line(p.architecture, "dim");
                spacer();
            }
            if (p.database){
                heading("DATABASE");
                rule(24);
                line(p.database, "dim");
                spacer();
            }
            if (p.result){
                heading("RESULT");
                rule(24);
                line(p.result, "dim");
            }
            return;
        }

        heading("PROJECT MATRIX");
        rule(48);
        spacer();
        list.forEach(function(p, i){
            html('<span class="proj-idx">' + ("0" + (i + 1)).slice(-2) + '</span>  <span class="proj-name">' + escapeHtml(p.name.toUpperCase()) + '</span>');
            html('&nbsp;&nbsp;&nbsp;&nbsp;<span class="proj-tag">' + escapeHtml(p.tagline) + '</span>');
            spacer();
        });
        line('Type "projects <number>" for full detail, e.g. projects 1', "dim2");
    }

    function cmdSkills(){
        var stack = data.stack || {};
        heading("TECHNICAL STACK");
        rule(48);
        spacer();
        Object.keys(stack).forEach(function(cat){
            line(cat.toUpperCase(), "accent");
            (stack[cat] || []).forEach(function(item){
                var nm = item.name || item;
                var desc = item.desc;
                if (desc){
                    kv("  " + nm, desc);
                } else {
                    line("  " + nm, "dim");
                }
            });
            spacer();
        });
    }

    function cmdServices(){
        heading("SERVICES");
        rule(40);
        spacer();
        (data.services || []).forEach(function(s, i){
            line("  " + ("0" + (i + 1)).slice(-2) + "  " + s, "dim");
        });
    }

    function cmdGithub(){
        heading("GITHUB");
        rule(30);
        spacer();
        line("See the GitHub Activity section above — enter a username there to load live data.", "dim");
    }

    function cmdContact(){
        var c = data.contact || {};
        heading("CONTACT");
        rule(30);
        spacer();
        kv("EMAIL", c.email || "");
        kv("LOCATION", c.location || "");
        kv("AVAILABILITY", (c.availability || []).join(", "));
        kv("PREFERRED", c.preferred || "");
        kv("RESPONSE TIME", c.responseTime || "");
        spacer();
        line("Use the Contact section to send a message.", "dim2");
    }

    function cmdResume(){
        heading("RESUME");
        rule(30);
        spacer();
        html('<a class="terminal-resume-link" href="Muhammad_Harmain_NovExa_Executive_CV.pdf" download="Harmain_Resume.pdf">Download Harmain_Resume.pdf</a>');
        spacer();
        line("Resume PDF ready for download as Harmain_Resume.pdf.", "dim2");
    }

    function cmdHire(){
        var c = data.contact || {};
        heading("AVAILABILITY");
        rule(34);
        spacer();
        line("Available for: " + (c.availability || []).join(", ") + ".", "dim");
        line("Use \"contact\" to start a conversation.", "dim2");
    }

    function cmdStatus(){
        heading("SYSTEM STATUS");
        rule(34);
        spacer();
        kv("CORE SYSTEM", "ONLINE");
        kv("PORTFOLIO", "ONLINE");
        kv("PROJECT MATRIX", "ONLINE");
        kv("TERMINAL", "ONLINE");
        spacer();
        line("SYSTEM HEALTH   100%", "accent");
        spacer();
        line("(Simulated status for this portfolio interface — not a live infrastructure check.)", "dim2");
    }

    function cmdDate(){
        line(new Date().toString());
    }

    function cmdNeofetch(){
        html('<span class="accent" style="color:var(--accent)">        HARM\u039BIN</span>');
        spacer();
        kv("OS", "HARM\u039BIN PORTFOLIO");
        kv("KERNEL", "WEB");
        kv("SHELL", "JAVASCRIPT");
        kv("MODE", "DEVELOPER");
        kv("STACK", "PHP / MYSQL");
        kv("STATUS", "ONLINE");
    }

    function cmdClear(){
        body.innerHTML = "";
    }

    function cmdUnknown(raw){
        line('Command not found: ' + raw, "danger");
        var guess = closestCommand(raw);
        if (guess){
            spacer();
            line('Did you mean: ' + guess + '?', "dim");
        }
        spacer();
        line('Type "help" to view available commands.', "dim2");
    }

    /* ---------------------------------------------------------------
       DISPATCH
    ----------------------------------------------------------------*/
    function run(raw){
        var trimmed = raw.trim();
        if (!trimmed) return;

        var parts = trimmed.split(/\s+/);
        var cmd = parts[0].toLowerCase();
        var arg = parts[1];

        if (/^(download|get|open)\s+(my\s+)?(resume|cv)$|^(resume|cv)\s*(download|pdf)?$/i.test(trimmed)) {
            cmd = "resume";
            arg = undefined;
        }

        echoCommand(raw);

        switch (cmd){
            case "help": cmdHelp(); break;
            case "about": cmdAbout(); break;
            case "whoami": cmdWhoami(); break;
            case "projects": cmdProjects(arg); break;
            case "skills": cmdSkills(); break;
            case "services": cmdServices(); break;
            case "github": cmdGithub(); break;
            case "contact": cmdContact(); break;
            case "resume": cmdResume(); break;
            case "hire": cmdHire(); break;
            case "status": cmdStatus(); break;
            case "date": cmdDate(); break;
            case "neofetch": cmdNeofetch(); break;
            case "clear": cmdClear(); return;
            default: cmdUnknown(trimmed);
        }

        spacer();
        scrollToBottom();
    }

    /* ---------------------------------------------------------------
       "DID YOU MEAN" — simple Levenshtein distance
    ----------------------------------------------------------------*/
    function levenshtein(a, b){
        var m = a.length, n = b.length;
        var d = [];
        for (var i = 0; i <= m; i++) d[i] = [i];
        for (var j = 0; j <= n; j++) d[0][j] = j;
        for (i = 1; i <= m; i++){
            for (j = 1; j <= n; j++){
                d[i][j] = Math.min(
                    d[i - 1][j] + 1,
                    d[i][j - 1] + 1,
                    d[i - 1][j - 1] + (a[i - 1] === b[j - 1] ? 0 : 1)
                );
            }
        }
        return d[m][n];
    }

    function closestCommand(word){
        var best = null, bestDist = 3;
        COMMANDS.forEach(function(c){
            var dist = levenshtein(word.toLowerCase(), c);
            if (dist < bestDist){
                bestDist = dist;
                best = c;
            }
        });
        return best;
    }

    /* ---------------------------------------------------------------
       BOOT SEQUENCE
    ----------------------------------------------------------------*/
    function boot(){
        var lines = [
            { text: "HARM\u039BIN OS v2.0", cls: "accent" },
            { text: "Interactive Developer Console", cls: "dim" },
            { text: "────────────────────────────────", cls: "dim2" },
            { text: "" },
            { text: "Session established.", cls: "dim" },
            { text: "Access level: GUEST", cls: "dim" },
            { text: "System status: ONLINE", cls: "dim" },
            { text: "" },
            { text: 'Type "help" to view available commands.', cls: "dim2" }
        ];
        var i = 0;
        function next(){
            if (i >= lines.length){
                spacer();
                scrollToBottom();
                return;
            }
            var l = lines[i];
            if (l.text === "") { spacer(); } else { line(l.text, l.cls); }
            i++;
            scrollToBottom();
            setTimeout(next, 55);
        }
        next();
    }

    boot();

    /* ---------------------------------------------------------------
       INPUT HANDLING: history, tab-complete, enter
    ----------------------------------------------------------------*/
    var history = [];
    var historyIndex = -1;

    input.addEventListener("keydown", function(e){
        if (e.key === "Enter"){
            var val = input.value;
            if (val.trim()){
                history.push(val);
                historyIndex = history.length;
            }
            run(val);
            input.value = "";
        } else if (e.key === "ArrowUp"){
            e.preventDefault();
            if (history.length){
                historyIndex = Math.max(0, historyIndex - 1);
                input.value = history[historyIndex] || "";
                moveCaretToEnd();
            }
        } else if (e.key === "ArrowDown"){
            e.preventDefault();
            if (history.length){
                historyIndex = Math.min(history.length, historyIndex + 1);
                input.value = history[historyIndex] || "";
                moveCaretToEnd();
            }
        } else if (e.key === "Tab"){
            e.preventDefault();
            var current = input.value.trim().toLowerCase();
            if (!current) return;
            var matches = COMMANDS.filter(function(c){ return c.indexOf(current) === 0; });
            if (matches.length === 1){
                input.value = matches[0] + " ";
            } else if (matches.length > 1){
                echoCommand(input.value);
                line(matches.join("   "), "dim");
                spacer();
                scrollToBottom();
            }
        }
    });

    function moveCaretToEnd(){
        var v = input.value;
        input.value = "";
        input.value = v;
    }

    /* Click anywhere in the terminal focuses the input */
    if (termWrap){
        termWrap.addEventListener("click", function(){
            input.focus();
        });
    }

})();
</script>