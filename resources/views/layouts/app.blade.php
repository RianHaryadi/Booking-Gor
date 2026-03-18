<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="GOR Serbaguna — Book lapangan futsal, basket, badminton & voli secara instan. Platform booking olahraga premium Jakarta.">
<title>@yield('title', 'GOR Serbaguna')</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Bebas+Neue&family=Space+Grotesk:wght@300..700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<script src="https://cdn.tailwindcss.com"></script>

<style>
:root {
  --bg:         #050505;
  --bg2:        #0A0A0B;
  --surface:    #0F0F11;
  --border:     rgba(255,255,255,0.04);
  --primary:    #5D5FEF; /* Electric Indigo */
  --accent:     #CCFF00; /* Cyber Lime */
  --accent-rgb: 204, 255, 0;
  --violet:     #8B5CF6;
  --text:       #FFFFFF;
  --muted:      #52525B;
  --panel:      rgba(10, 10, 11, 0.8);
}

*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
  background:var(--bg);
  color:var(--text);
  font-family:'Space Grotesk','Inter',sans-serif;
  min-height:100vh;
  overflow-x:hidden;
  position:relative;
}

/* ── CUSTOM TEXTURE OVERLAYS ── */
body::before {
  content: '';
  position: fixed; inset: 0;
  background-image: 
    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
  background-size: 40px 40px;
  pointer-events: none; z-index: 0;
}

.scanline {
  position: fixed; inset: 0;
  background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.2) 50%);
  background-size: 100% 4px;
  pointer-events: none; z-index: 1000;
  opacity: 0.15;
}

/* ── AMBIENT GLOWS ── */
.ambient{
  position:fixed;pointer-events:none;z-index:0;border-radius:50%;filter:blur(140px);
}
.amb-1{width:700px;height:700px;background:radial-gradient(circle,rgba(93,95,239,0.1),transparent 70%);top:-10%;right:-10%;animation:drift 25s infinite}
.amb-2{width:600px;height:600px;background:radial-gradient(circle,rgba(204,255,0,0.04),transparent 70%);bottom:-10%;left:-10%;animation:drift 30s infinite reverse}

@keyframes drift{
  0%,100%{transform:translate(0,0) scale(1)}
  33%{transform:translate(50px,-60px) scale(1.1)}
  66%{transform:translate(-40px,40px) scale(0.9)}
}

/* ── TYPOGRAPHY ── */
.display{font-family:'Bebas Neue',sans-serif;letter-spacing:0.01em;line-height:.85}
.mono{font-family:'JetBrains Mono',monospace;letter-spacing:-0.02em}

/* ── ELEMENTS ── */
.glass {
  background: var(--panel);
  backdrop-filter: blur(30px);
  -webkit-backdrop-filter: blur(30px);
  border: 1px solid var(--border);
}

.card-raw {
  background: var(--bg2);
  border: 1px solid var(--border);
  transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
  position: relative;
}
.card-raw::after {
  content: '';
  position: absolute; inset: -1px;
  border: 1px solid transparent;
  transition: all 0.4s;
  pointer-events: none;
}
.card-raw:hover {
  background: #0E0E10;
  transform: translateY(-4px);
  border-color: rgba(93,95,239,0.3);
  box-shadow: 0 20px 40px rgba(0,0,0,0.6);
}
.card-raw:hover::after {
  border-color: rgba(var(--accent-rgb), 0.2);
  inset: -5px;
  opacity: 1;
}

/* ── BUTTONS ── */
.btn-cyber {
  background: var(--primary);
  color: #fff;
  padding: 12px 28px;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.1em;
  clip-path: polygon(10% 0, 100% 0, 100% 70%, 90% 100%, 0 100%, 0 30%);
  transition: all 0.3s;
  display: inline-flex; align-items: center; gap: 10px;
  border: none; cursor: pointer;
}
.btn-cyber:hover {
  background: var(--accent);
  color: #000;
  transform: scale(1.05);
}

.btn-outline {
  background: transparent;
  color: #fff;
  padding: 11px 27px;
  border: 1px solid var(--border);
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  font-weight: 700;
  transition: all 0.3s;
  clip-path: polygon(0 0, 90% 0, 100% 30%, 100% 100%, 10% 100%, 0 70%);
}
.btn-outline:hover {
  border-color: var(--accent);
  background: rgba(204, 255, 0, 0.05);
}

/* ── INPUTS ── */
.input-raw {
  background: #0F0F11;
  border: 1px solid var(--border);
  color: #fff;
  padding: 14px 18px;
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.85rem;
  outline: none;
  transition: all 0.3s;
}
.input-raw:focus {
  border-color: var(--primary);
  background: #141417;
  box-shadow: 0 0 20px rgba(93,95,239,0.1);
}

/* ── DECORATIVE ── */
.tag-mono {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.65rem;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--accent);
  background: rgba(var(--accent-rgb), 0.1);
  padding: 4px 10px;
  border: 1px solid rgba(var(--accent-rgb), 0.2);
}

#nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
  height: 70px; display: flex; align-items: center;
  border-bottom: 1px solid var(--border);
}
/* ── ANIMATIONS ── */
@keyframes reveal {
  from { opacity: 0; transform: translateY(30px) skewY(2deg); }
  to { opacity: 1; transform: translateY(0) skewY(0); }
}
.fx-reveal {
  animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; }

/* ── UTILITIES ── */
.dot-pattern {
  background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
  background-size: 20px 20px;
}
.corner-accent {
  position: absolute; width: 10px; height: 10px; border: 1px solid var(--accent);
}
.corner-tl { top: -1px; left: -1px; border-right: none; border-bottom: none; }
.corner-br { bottom: -1px; right: -1px; border-left: none; border-top: none; }

.text-stroke {
  -webkit-text-stroke: 1px rgba(255,255,255,0.1);
  -webkit-text-fill-color: transparent;
}
.text-accent-stroke {
  -webkit-text-stroke: 1px var(--accent);
  -webkit-text-fill-color: transparent;
}
.nav-inner{
  max-width:1200px;margin:0 auto;padding:0 24px;
  height:64px;display:flex;align-items:center;justify-content:space-between;gap:24px;
}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.nav-logo-mark{
  width:36px;height:36px;border-radius:10px;
  background:linear-gradient(135deg,#3B82F6,#7C3AED);
  display:flex;align-items:center;justify-content:center;
  font-size:.95rem;color:#fff;
  box-shadow:0 4px 16px rgba(59,130,246,0.3);
}
.nav-logo-text{font-family:'Bebas Neue',sans-serif;font-size:1.3rem;letter-spacing:.08em;color:#F1F5F9}
.nav-logo-text span{color:#60A5FA}

.nav-links{display:flex;align-items:center;gap:4px;list-style:none}
.nav-links a{
  color:#64748B;font-size:.825rem;font-weight:600;font-family:'Space Grotesk',sans-serif;
  padding:6px 14px;border-radius:10px;text-decoration:none;
  transition:color .2s,background .2s;
  display:flex;align-items:center;gap:6px;
}
.nav-links a:hover{color:#F1F5F9;background:rgba(255,255,255,0.06)}
.nav-links a.act{color:#60A5FA;background:rgba(59,130,246,0.1)}

/* mobile hamburger */
.ham{display:none;flex-direction:column;gap:5px;background:transparent;border:none;cursor:pointer;padding:8px}
.ham span{display:block;width:22px;height:2px;background:#64748B;border-radius:2px;transition:all .3s}
@media(max-width:768px){
  .ham{display:flex}
  .nav-links,.nav-ctas{display:none}
  .nav-links.open,.nav-ctas.open{
    display:flex;flex-direction:column;
    position:fixed;top:64px;left:0;right:0;
    background:rgba(8,12,20,.97);
    backdrop-filter:blur(24px);
    padding:20px 24px;gap:4px;
    border-bottom:1px solid rgba(255,255,255,0.06);
  }
  .nav-ctas.open{flex-direction:row;gap:8px;padding-top:0}
}

/* ── SCROLLBAR ── */
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track{background:var(--bg)}
::-webkit-scrollbar-thumb{background:linear-gradient(#3B82F6,#7C3AED);border-radius:99px}

/* ── ANIMATIONS ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
@keyframes spin-slow{from{transform:rotate(0)}to{transform:rotate(360deg)}}
@keyframes pulse-ring{0%{transform:scale(.9);opacity:.8}70%{transform:scale(1.2);opacity:0}100%{opacity:0}}
@keyframes ticker{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

.fade-up{opacity:0;transform:translateY(24px);transition:opacity .6s ease,transform .6s ease}
.fade-up.visible{opacity:1;transform:none}
</style>

@yield('styles')
</head>
<body>

<!-- Ambient lighting -->
<div class="ambient amb-1"></div>
<div class="ambient amb-2"></div>
<div class="ambient amb-3"></div>

<!-- ═══════════════ NAVBAR ═══════════════ -->
<nav id="nav">
  <div class="nav-inner" style="width:100%; max-width:1400px; margin:0 auto; padding:0 7vw; display:flex; align-items:center; justify-content:space-between">
    <!-- Logo -->
    <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:12px; text-decoration:none">
      <div style="width:32px; height:32px; background:var(--primary); display:flex; align-items:center; justify-content:center; clip-path:polygon(20% 0%, 100% 0%, 100% 80%, 80% 100%, 0% 100%, 0% 20%)">
        <i class="fas fa-bolt" style="color:#fff; font-size:1rem"></i>
      </div>
      <div style="display:flex; flex-direction:column">
        <span class="display" style="font-size:1.2rem; color:#fff; letter-spacing:0.05em">SPORTIVA</span>
        <span class="mono" style="font-size:0.55rem; color:var(--primary); font-weight:700; margin-top:-2px">PREMIER_ELITE</span>
      </div>
    </a>

    <!-- Main Links -->
    <div style="display:flex; align-items:center; gap:40px" class="nav-desktop">
      @foreach([['Home','home'],['Booking','booking.index'],['Tracking','tracking.index'],['Event','event.index']] as [$lbl,$rt])
      <a href="{{ route($rt) }}" class="mono {{ request()->routeIs($rt) ? '' : 'nav-link-inactive' }}" 
         style="color:{{ request()->routeIs($rt) ? 'var(--accent)' : 'var(--muted)' }}; text-decoration:none; font-size:0.7rem; font-weight:700; text-transform:uppercase; transition:color 0.3s">
        {{ $lbl }}
      </a>
      @endforeach
    </div>

    <!-- Right Actions -->
    <div style="display:flex; align-items:center; gap:25px">
      <div class="nav-desktop" style="text-align:right">
        <div class="mono" style="font-size:0.5rem; color:var(--muted)">SYSTEM_CLOCK</div>
        <div id="sys-clock" class="mono" style="font-size:0.75rem; color:#fff; font-weight:700">00:00:00</div>
      </div>
      <a href="{{ route('tracking.index') }}" class="mono nav-desktop" style="font-size:0.7rem; color:var(--muted); text-decoration:none; font-weight:700; border-right:1px solid var(--border); padding-right:20px">TRACK_ARENA</a>
      <a href="{{ route('booking.index') }}" class="btn-cyber" style="padding:8px 20px; font-size:0.65rem">BOOK_NOW</a>
    </div>

    <!-- Mobile Button -->
    <button id="mobile-toggle" style="display:none; background:none; border:none; color:#fff; cursor:pointer">
      <i class="fas fa-bars"></i>
    </button>
  </div>
</nav>

<style>
@media(max-width:768px) {
  .nav-desktop { display:none !important; }
  #mobile-toggle { display:block !important; }
}
.nav-link-inactive:hover { color:#fff !important; }
</style>

<!-- ═══════════════ CONTENT ═══════════════ -->
<main style="min-height:100vh">
  @yield('content')
</main>

<!-- ═══════════════ FOOTER ═══════════════ -->
<footer style="padding:64px 24px 32px;border-top:1px solid var(--border);margin-top:80px">
  <div style="max-width:1200px;margin:0 auto">
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:48px" class="footer-grid">
      <div>
        <div class="nav-logo" style="margin-bottom:16px">
          <div class="nav-logo-mark"><i class="fas fa-bolt"></i></div>
          <span class="nav-logo-text">GOR <span>SERBAGUNA</span></span>
        </div>
        <p style="color:#475569;font-size:.85rem;line-height:1.7;max-width:240px">Platform booking lapangan olahraga premium. Cepat, mudah, real-time.</p>
        <div style="display:flex;gap:10px;margin-top:20px">
          @foreach(['instagram','whatsapp','facebook-f'] as $s)
          <a href="#" style="width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;color:#475569;font-size:.8rem;transition:color .2s,border-color .2s" onmouseover="this.style.color='#60A5FA';this.style.borderColor='rgba(59,130,246,0.4)'" onmouseout="this.style.color='#475569';this.style.borderColor='rgba(255,255,255,0.08)'">
            <i class="fab fa-{{ $s }}"></i>
          </a>
          @endforeach
        </div>
      </div>
      <div>
        <p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#334155;margin-bottom:16px">Navigasi</p>
        <ul style="list-style:none;space-y:12px;display:flex;flex-direction:column;gap:10px">
          @foreach([['Home','home'],['Booking','booking.index'],['Tracking','tracking.index'],['Event','event.index']] as [$lbl,$rt])
          <li><a href="{{ route($rt) }}" style="color:#64748B;font-size:.85rem;text-decoration:none;display:flex;align-items:center;gap:8px;transition:color .2s" onmouseover="this.style.color='#60A5FA'" onmouseout="this.style.color='#64748B'">
            <span style="width:4px;height:4px;background:#3B82F6;border-radius:50%;display:inline-block"></span>
            {{ $lbl }}
          </a></li>
          @endforeach
        </ul>
      </div>
      <div>
        <p style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#334155;margin-bottom:16px">Kontak</p>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:12px">
          @foreach([['fa-map-marker-alt','Jl. Raya PKP, Kelapa Dua, Jakarta Timur'],['fa-phone','(021) 8654-0899'],['fa-clock','Setiap Hari 08:00 – 22:00']] as [$ico,$txt])
          <li style="display:flex;align-items:flex-start;gap:10px;color:#64748B;font-size:.85rem">
            <i class="fas {{ $ico }}" style="color:#3B82F6;margin-top:2px;width:14px;flex-shrink:0"></i>
            {{ $txt }}
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="divider" style="margin:40px 0 24px"></div>
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">
      <p style="color:#334155;font-size:.8rem">© {{ date('Y') }} GOR Serbaguna. All rights reserved.</p>
    </div>
  </div>
</footer>

<style>
@media(max-width:768px){
  .footer-grid{grid-template-columns:1fr!important}
}
</style>

<script>
  // System Clock
  function updateClock() {
    const now = new Date();
    const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                       now.getMinutes().toString().padStart(2, '0') + ':' + 
                       now.getSeconds().toString().padStart(2, '0');
    const el = document.getElementById('sys-clock');
    if(el) el.innerText = timeString;
  }
  setInterval(updateClock, 1000);
  updateClock();

// Navbar scroll
window.addEventListener('scroll',()=>{
  document.getElementById('nav').classList.toggle('scrolled',window.scrollY>30)
})

// Mobile menu
const ham=document.getElementById('ham-btn')
const links=document.getElementById('nav-links')
const ctas=document.getElementById('nav-ctas')
const h1=document.getElementById('h1'),h2=document.getElementById('h2'),h3=document.getElementById('h3')
let open=false
ham.addEventListener('click',()=>{
  open=!open
  links.classList.toggle('open',open)
  ctas.classList.toggle('open',open)
  if(open){h1.style.transform='rotate(45deg) translate(5px,5px)';h2.style.opacity='0';h3.style.transform='rotate(-45deg) translate(5px,-5px)'}
  else{h1.style.transform='';h2.style.opacity='1';h3.style.transform=''}
})

// Scroll fade-up observer
const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')})
},{threshold:.12})
document.querySelectorAll('.fade-up').forEach(el=>obs.observe(el))
</script>

@yield('scripts')
</body>
</html>