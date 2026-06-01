@extends('layouts.public')
@section('title', 'Beranda — TPS 3R Kelurahan Wates')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap');

:root {
    --forest:   #0f2d16;
    --g9:       #166534;
    --g8:       #15803d;
    --g7:       #16a34a;
    --g6:       #22c55e;
    --g5:       #4ade80;
    --lime:     #a3e635;
    --lime-lt:  #bef264;
    --cream:    #fafaf9;
    --earth:    #f3f2ed;
    --sand:     #eae8e0;
    --dark:     #1a2e1c;
    --muted:    #6b7a65;
    --sirsak:   #16a34a;
}

.hp {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--cream);
    color: var(--dark);
}

/* ════════════════════════════════════════
   HERO
════════════════════════════════════════ */
.hero {
    background: #166534; /* Soft green */
    position: relative;
    overflow: hidden;
    min-height: calc(100vh - 66px);
    display: flex;
    align-items: flex-start;
    padding-top: 2rem;
}
.hero-bg {
    position: absolute; inset: 0;
    background: url("{{ asset('background.jpeg') }}") center 40% / cover;
    background-repeat: no-repeat;
    background-size: cover;
    opacity: 1;
}
.hero-overlay {
    position: absolute; inset: 0;
    /* lighter overlay so background image remains visible */
    background: linear-gradient(180deg, rgba(6,8,10,.18) 0%, rgba(6,8,10,.12) 50%, rgba(6,8,10,.18) 100%);
}
/* Grid mesh texture */
.hero-mesh {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(132,204,22,.01) 1px, transparent 1px),
        linear-gradient(90deg, rgba(132,204,22,.01) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
}
/* Radial glow */
.hero-glow {
    position: absolute;
    right: -200px; top: 50%;
    transform: translateY(-50%);
    width: 800px; height: 800px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(132,204,22,.07) 0%, transparent 65%);
    pointer-events: none;
}
.hero-glow-left {
    position: absolute;
    left: -150px; bottom: -100px;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(22,163,74,.06) 0%, transparent 70%);
    pointer-events: none;
}

/* Animated orbs */
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    pointer-events: none;
    animation: orbFloat 18s ease-in-out infinite alternate;
}
.orb1 { width:350px;height:350px;background:rgba(132,204,22,.05);top:-80px;right:5%; animation-duration:20s; }
.orb2 { width:250px;height:250px;background:rgba(22,163,74,.04);bottom:5%;left:5%; animation-duration:15s; animation-direction:alternate-reverse; }
@keyframes orbFloat {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(20px, 15px) scale(1.05); }
}

.hero-inner {
    position: relative; z-index: 10;
    width: 100%; max-width: 1280px;
    margin: 0 auto; padding: 4rem 2rem;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 4rem;
    align-items: center;
}

/* Eyebrow chip */
.hero-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(163,230,53,.1);
    border: 1px solid rgba(163,230,53,.3);
    color: #bef264;
    font-size: .68rem; font-weight: 700;
    letter-spacing: .15em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 100px;
    margin-bottom: 1.75rem; width: fit-content;
}
.chip-dot {
    width: 5px; height: 5px; border-radius: 50%;
    background: #bef264;
    animation: blink 2s infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.25} }

.hero-h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(3rem, 5.5vw, 5.5rem);
    line-height: .95;
    letter-spacing: -.025em;
    color: #fff;
    margin-bottom: 1.5rem;
}
.hero-h1 em { font-style: italic; color: #bef264; }
.hero-h1 span { display: block; }

.hero-desc {
    color: rgba(255,255,255,.88);
    font-size: .95rem; line-height: 1.8;
    font-weight: 300; max-width: 440px;
    margin-bottom: 2.25rem;
}

.hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
.btn-lime {
    display: inline-flex; align-items: center; gap: 9px;
    background: linear-gradient(135deg, #4ade80, #22c55e);
    color: #052e16; font-weight: 700; font-size: .875rem;
    padding: 14px 28px; border-radius: 100px;
    text-decoration: none; transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 20px rgba(74,222,128,.35);
}
.btn-lime:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(74,222,128,.45); }
.btn-ghost {
    display: inline-flex; align-items: center; gap: 9px;
    background: transparent; color: rgba(255,255,255,.6);
    font-weight: 500; font-size: .875rem;
    padding: 14px 24px; border-radius: 100px;
    border: 1px solid rgba(255,255,255,.15);
    text-decoration: none; transition: all .2s;
}
.btn-ghost:hover { border-color: rgba(255,255,255,.45); color: #fff; }

/* Hero right panel — kolaborasi card */
.hero-collab {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.collab-main-card {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(20px);
}
.collab-label {
    font-size: .65rem; font-weight: 700;
    letter-spacing: .15em; text-transform: uppercase;
    color: #bef264; margin-bottom: 1.25rem;
    display: flex; align-items: center; gap: 8px;
}
.collab-label::after {
    content: ''; flex: 1; height: 1px;
    background: linear-gradient(to right, rgba(163,230,53,.35), transparent);
}
.collab-logos {
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
.collab-logo-wrap {
    background: rgba(255,255,255,.92);
    border-radius: 14px; padding: 12px 16px;
    display: flex; align-items: center; justify-content: center;
    border: 1px solid rgba(255,255,255,.15);
    flex: 1 1 0;
    min-width: 0;
}
.collab-logo-wrap img {
    width: 100%;
    height: auto !important;
    max-height: 72px;
    object-fit: contain;
}
.collab-plus {
    font-size: 1.4rem; color: rgba(255,255,255,.25); font-weight: 300;
}
.collab-tagline {
    font-size: .82rem; color: rgba(255,255,255,.5);
    line-height: 1.65; font-weight: 300;
}
.collab-tagline strong { color: rgba(255,255,255,.85); font-weight: 600; }

/* Stats mini row */
.hero-stats {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;
}
.hero-stat-card {
    background: #ffffff;
    border: 1px solid rgba(6,78,59,.06);
    border-radius: 14px; padding: 1.25rem 1rem;
    text-align: center;
    transition: transform .15s, box-shadow .2s;
    box-shadow: 0 8px 22px rgba(6,78,59,.04);
}
.hero-stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(6,78,59,.08);
}
.hero-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem; color: var(--g9);
    line-height: 1; margin-bottom: 4px; font-weight: 700;
}
.hero-stat-lbl { font-size: .65rem; color: var(--g9); font-weight: 700; text-transform: uppercase; letter-spacing: .06em; }

/* Scroll cue */
.scroll-cue {
    position: absolute; bottom: 2rem; left: 2rem;
    z-index: 10; display: flex; align-items: center; gap: 10px;
    color: rgba(255,255,255,.2); font-size: .6rem;
    letter-spacing: .14em; text-transform: uppercase;
}
.scroll-line {
    width: 36px; height: 1px;
    background: linear-gradient(to right, rgba(255,255,255,.3), transparent);
    animation: scrollAnim 2.5s ease-in-out infinite;
}
@keyframes scrollAnim {
    0%   { transform: scaleX(0); transform-origin: left; }
    50%  { transform: scaleX(1); transform-origin: left; }
    51%  { transform: scaleX(1); transform-origin: right; }
    100% { transform: scaleX(0); transform-origin: right; }
}

/* ════════════════════════════════════════
   KOLABORASI SIRSAK — HERO SECTION BAWAH
════════════════════════════════════════ */
.sirsak-band {
    background: linear-gradient(135deg, #166534 0%, #064e3b 100%);
    padding: 4rem 2rem;
    position: relative; overflow: hidden;
}
.sirsak-band::before {
    content: '';
    position: absolute; inset: 0;
    background: repeating-linear-gradient(
        -45deg,
        rgba(163,230,53,.018) 0px,
        rgba(163,230,53,.018) 1px,
        transparent 1px,
        transparent 12px
    );
}
.sirsak-inner {
    max-width: 1280px; margin: 0 auto;
    position: relative; z-index: 2;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 3.5rem; align-items: center;
}
.sirsak-logos-wrap {
    display: flex; flex-direction: column; gap: 8px; align-items: center;
}
.sirsak-logo-box {
    background: rgba(255,255,255,.92);
    border-radius: 16px; padding: 14px 20px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 8px 24px rgba(0,0,0,.2);
    flex: 1 1 0;
    min-width: 0;
}
.sirsak-logo-box img {
    width: 100%;
    height: auto !important;
    max-height: 72px;
    object-fit: contain;
}
.sirsak-x {
    font-size: .75rem; color: rgba(255,255,255,.3);
    font-weight: 700; letter-spacing: .1em; text-align: center;
}

.sirsak-content {}
.sirsak-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(163,230,53,.1); border: 1px solid rgba(163,230,53,.25);
    color: #bef264; font-size: .65rem; font-weight: 700;
    letter-spacing: .15em; text-transform: uppercase;
    padding: 5px 12px; border-radius: 100px; margin-bottom: 1rem;
}
.sirsak-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    color: #fff; line-height: 1.1; margin-bottom: .85rem;
}
.sirsak-h2 em { font-style: italic; color: #bef264; }
.sirsak-p {
    color: rgba(255,255,255,.48); font-size: .9rem;
    line-height: 1.75; font-weight: 300; max-width: 580px;
    margin-bottom: 1.75rem;
}
.sirsak-features {
    display: flex; flex-wrap: wrap; gap: 10px;
}
.sirsak-feat {
    display: flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 100px; padding: 7px 14px;
    font-size: .78rem; color: rgba(255,255,255,.65);
    font-weight: 500; transition: all .25s;
}
.sirsak-feat:hover {
    background: rgba(163,230,53,.1);
    border-color: rgba(163,230,53,.28);
    color: #bef264;
}
.sirsak-feat svg { color: #bef264; flex-shrink: 0; }

/* ════════════════════════════════════════
   TENTANG
════════════════════════════════════════ */
.about-sec { background: var(--cream); padding: 6.5rem 2rem; }
.about-wrap {
    max-width: 1280px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;
}
.section-tag {
    font-size: .65rem; font-weight: 700; letter-spacing: .17em; text-transform: uppercase;
    color: #22c55e; margin-bottom: 1rem;
    display: flex; align-items: center; gap: 10px;
}
.section-tag::before {
    content: ''; display: block; width: 24px; height: 2px; background: #22c55e;
    border-radius: 2px;
}
.about-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 3.5vw, 3rem); line-height: 1.05;
    color: #1a2e1c; margin-bottom: 1.25rem;
}
.about-h2 em { font-style: italic; color: #16a34a; }
.about-p { color: #5a6655; font-size: .93rem; line-height: 1.85; font-weight: 300; margin-bottom: 2rem; }

.stats-row { display: flex; gap: 2rem; margin-bottom: 2.25rem; }
.stat-item {}
.stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 2.4rem; color: #22c55e; line-height: 1;
    font-weight: 700;
}
.stat-lbl { font-size: .7rem; color: #6b7a65; margin-top: 4px; font-weight: 500; }
.stat-div { width: 1px; background: #ddd8ce; align-self: stretch; }

.link-arrow {
    display: inline-flex; align-items: center; gap: 9px;
    color: #16a34a; font-weight: 700; font-size: .875rem;
    text-decoration: none;
    border-bottom: 2px solid #16a34a; padding-bottom: 3px;
    transition: gap .2s;
}
.link-arrow:hover { gap: 15px; }

/* Collage photo */
.collage { position: relative; height: 480px; }
.col-main {
    position: absolute; top: 0; left: 0; width: 72%; height: 78%;
    border-radius: 1.75rem; overflow: hidden;
    box-shadow: 0 30px 70px rgba(0,0,0,.14);
}
.col-accent {
    position: absolute; bottom: 0; right: 0; width: 50%; height: 52%;
    border-radius: 1.4rem; overflow: hidden;
    box-shadow: 0 14px 40px rgba(0,0,0,.11);
    border: 5px solid var(--cream);
}
.col-badge {
    position: absolute; top: 43%; left: 58%; z-index: 10;
    background: linear-gradient(135deg, #4ade80, #22c55e);
    color: #052e16; border-radius: 1rem; padding: 13px 16px;
    font-size: .7rem; font-weight: 800; line-height: 1.4;
    text-align: center; min-width: 92px;
    box-shadow: 0 12px 32px rgba(74,222,128,.4);
}
.col-badge big { display: block; font-size: 1.75rem; margin-bottom: 3px; }
.collage img { width: 100%; height: 100%; object-fit: cover; }

/* ════════════════════════════════════════
   DIGITALISASI BANK SAMPAH (NEW SECTION)
════════════════════════════════════════ */
.digital-sec {
    background: #f3f2ed;
    padding: 6.5rem 2rem;
    position: relative; overflow: hidden;
}
.digital-sec::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, transparent, #22c55e, #86efac, #22c55e, transparent);
}
.digital-inner { max-width: 1280px; margin: 0 auto; }
.digital-header {
    display: grid; grid-template-columns: 1fr auto; align-items: flex-end;
    gap: 2rem; margin-bottom: 3.5rem; flex-wrap: wrap;
}
.digital-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 2.75rem);
    color: var(--dark); line-height: 1.08;
}
.digital-h2 em { font-style: italic; color: var(--g7); }
.digital-count-badge {
    display: flex; flex-direction: column; align-items: center;
    background: linear-gradient(135deg, #15803d, #166534);
    color: #fff; border-radius: 1.25rem; padding: 1.25rem 1.75rem;
    text-align: center; box-shadow: 0 12px 30px rgba(21,128,61,.25);
    flex-shrink: 0;
}
.digital-count-num {
    font-family: 'Playfair Display', serif;
    font-size: 3rem; line-height: 1; color: #86efac; font-weight: 700;
}
.digital-count-lbl { font-size: .65rem; color: rgba(255,255,255,.6); font-weight: 600; letter-spacing: .1em; text-transform: uppercase; margin-top: 4px; }

/* Feature cards grid */
.digital-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
    margin-bottom: 3rem;
}
.digital-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,.07);
    border-radius: 1.5rem; padding: 2rem;
    transition: transform .3s, box-shadow .3s, border-color .3s;
    position: relative; overflow: hidden;
}
.digital-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--g6), var(--lime));
    opacity: 0; transition: opacity .3s;
}
.digital-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.09); border-color: rgba(22,163,74,.2); }
.digital-card:hover::before { opacity: 1; }
.dc-icon {
    width: 52px; height: 52px; border-radius: 14px;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border: 1px solid rgba(34,197,94,.18);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin-bottom: 1.25rem;
}
.dc-title { font-size: .95rem; font-weight: 700; color: var(--dark); margin-bottom: .5rem; }
.dc-desc { font-size: .82rem; color: #6b7a65; line-height: 1.7; font-weight: 300; }
.dc-num { position: absolute; top: 1.5rem; right: 1.75rem; font-size: .6rem; color: rgba(0,0,0,.12); font-weight: 700; letter-spacing: .08em; }

/* Map / bank sampah visual */
.digital-map-row {
    display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;
}
.map-card {
    background: linear-gradient(135deg, #166534, #064e3b);
    border-radius: 1.5rem; padding: 2.5rem;
    position: relative; overflow: hidden; color: #fff;
}
.map-card::after {
    content: '';
    position: absolute; inset: 0;
    background: repeating-linear-gradient(
        45deg,
        rgba(132,204,22,.02) 0px, rgba(132,204,22,.02) 1px,
        transparent 1px, transparent 10px
    );
}
.map-content { position: relative; z-index: 2; }
.map-h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem; margin-bottom: .75rem; color: #fff;
}
.map-h3 em { font-style: italic; color: #86efac; }
.map-p { font-size: .85rem; color: rgba(255,255,255,.45); line-height: 1.7; font-weight: 300; margin-bottom: 1.5rem; }
.bank-chips {
    display: flex; flex-wrap: wrap; gap: 6px;
}
.bank-chip {
    background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1);
    border-radius: 100px; padding: 4px 11px;
    font-size: .68rem; color: rgba(255,255,255,.55); font-weight: 500;
}

/* Sirsak system card */
.sirsak-sys-card {
    background: #fff; border-radius: 1.5rem; padding: 2.5rem;
    border: 1px solid rgba(0,0,0,.07);
}
.ssc-header { display: flex; align-items: center; gap: 14px; margin-bottom: 1.5rem; }
.ssc-logo { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 8px 14px; }
.ssc-logo img { height: 32px; object-fit: contain; }
.ssc-title { font-size: 1.05rem; font-weight: 700; color: var(--dark); }
.ssc-sub { font-size: .75rem; color: var(--muted); font-weight: 500; }
.ssc-features { display: flex; flex-direction: column; gap: 10px; }
.ssc-feat {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 14px;
    background: #f9fafb; border-radius: 10px;
    font-size: .82rem; color: #374151; font-weight: 500;
}
.ssc-feat-icon {
    width: 32px; height: 32px; border-radius: 8px;
    background: #dcfce7; display: flex; align-items: center; justify-content: center;
    font-size: .9rem; flex-shrink: 0;
}

/* ════════════════════════════════════════
   LAYANAN
════════════════════════════════════════ */
.svc-sec {
    background: #166534;
    padding: 6.5rem 2rem;
    position: relative; overflow: hidden;
}
.svc-watermark {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
    font-family: 'Playfair Display', serif; font-size: 20vw;
    color: rgba(255,255,255,.015); white-space: nowrap;
    pointer-events: none; user-select: none;
}
.svc-wrap { max-width: 1280px; margin: 0 auto; position: relative; z-index: 2; }
.svc-top {
    display: flex; align-items: flex-end; justify-content: space-between;
    margin-bottom: 3rem; gap: 2rem; flex-wrap: wrap;
}
.svc-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 4vw, 3rem); color: #fff; line-height: 1.05;
}
.svc-h2 em { font-style: italic; color: #86efac; }
.svc-sub { color: rgba(255,255,255,.3); font-size: .85rem; max-width: 220px; font-weight: 300; }
.svc-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 2px; background: rgba(255,255,255,.04);
    border-radius: 1.5rem; overflow: hidden;
}
.svc-card {
    background: #ffffff;
    padding: 1.75rem 1.5rem;
    position: relative; transition: box-shadow .2s, transform .15s;
    color: var(--g9);
    border: 1px solid rgba(22,101,52,.06);
}
.svc-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(6,78,59,.06); }
.svc-n {
    position: absolute; top: 1rem; right: 1.25rem;
    font-size: .58rem; color: rgba(22,101,52,.18); font-weight: 700; letter-spacing: .1em;
}
.svc-card-head { display:flex; align-items:center; gap:12px; margin-bottom:12px; }
.svc-ico {
    width: 48px; height: 48px; border-radius: 12px;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border: 1px solid rgba(34,197,94,.12);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; flex-shrink: 0;
}
.svc-name { color: var(--g9); font-size: 1rem; font-weight: 800; margin: 0; }
.svc-desc { color: rgba(26,46,28,.68); font-size: .86rem; line-height: 1.6; font-weight: 400; margin-top: .6rem; }

/* ════════════════════════════════════════
   KOLABORASI SIRSAK FULL SECTION
════════════════════════════════════════ */
.partner-sec {
    background: var(--cream);
    padding: 6.5rem 2rem;
}
.partner-inner { max-width: 1280px; margin: 0 auto; }
.partner-top {
    text-align: center; margin-bottom: 4rem;
}
.partner-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3.25rem);
    color: #1a2e1c; line-height: 1.05; margin-bottom: 1rem;
}
.partner-h2 em { font-style: italic; color: #16a34a; }
.partner-desc { color: var(--muted); font-size: .95rem; line-height: 1.8; max-width: 600px; margin: 0 auto; font-weight: 300; }

/* Partner banner */
.partner-banner {
    background: linear-gradient(135deg, #166534 0%, #064e3b 100%);
    border-radius: 2rem; padding: 3.5rem;
    display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;
    align-items: center; position: relative; overflow: hidden;
    margin-bottom: 2rem;
}
.partner-banner::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2384cc16' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.partner-banner-content { position: relative; z-index: 2; }
.pb-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(163,230,53,.1); border: 1px solid rgba(163,230,53,.25);
    color: #bef264; font-size: .65rem; font-weight: 700;
    letter-spacing: .15em; text-transform: uppercase;
    padding: 5px 12px; border-radius: 100px; margin-bottom: 1.25rem;
}
.pb-h3 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 2.5vw, 2.25rem);
    color: #fff; line-height: 1.1; margin-bottom: 1rem;
}
.pb-h3 em { font-style: italic; color: #bef264; }
.pb-p { color: rgba(255,255,255,.45); font-size: .88rem; line-height: 1.75; font-weight: 300; }

.partner-banner-visual { position: relative; z-index: 2; }
.pb-logo-stack {
    display: flex; flex-direction: column; gap: 12px;
}
.pb-logo-card {
    background: rgba(255,255,255,.93);
    border-radius: 16px; padding: 16px 24px;
    display: flex; align-items: center; gap: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,.2);
    transition: transform .3s;
}
.pb-logo-card:hover { transform: translateX(6px); }
.pb-logo-card img { object-fit: contain; }
.pb-logo-card .lc-name { font-size: .9rem; font-weight: 800; color: var(--dark); line-height: 1.2; }
.pb-logo-card .lc-sub { font-size: .7rem; color: var(--muted); font-weight: 500; margin-top: 2px; }
.pb-connector {
    text-align: center; font-size: .7rem; font-weight: 700;
    color: rgba(255,255,255,.25); letter-spacing: .1em;
    padding: 2px 0;
}
.pb-connector span {
    background: rgba(163,230,53,.1); border: 1px solid rgba(163,230,53,.22);
    color: #bef264; padding: 3px 12px; border-radius: 100px;
    font-size: .6rem;
}

/* ════════════════════════════════════════
   GALERI
════════════════════════════════════════ */
.gal-sec { padding: 6.5rem 2rem; background: #f3f2ed; }
.gal-wrap { max-width: 1280px; margin: 0 auto; }
.gal-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 2.5rem; gap: 2rem; flex-wrap: wrap; }
.gal-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 2.75rem); color: var(--dark);
}
.gal-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: 220px; gap: 12px;
}
.gal-item { border-radius: 1.1rem; overflow: hidden; position: relative; }
.gal-item:first-child { grid-column: span 2; }
.gal-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s; }
.gal-item:hover img { transform: scale(1.07); }
.gal-over {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,40,18,.8) 0%, transparent 55%);
    opacity: 0; transition: opacity .3s;
    display: flex; align-items: flex-end; padding: 1.25rem;
}
.gal-item:hover .gal-over { opacity: 1; }
.gal-over span { color: #fff; font-size: .8rem; font-weight: 600; }
.gal-more { margin-top: 2.25rem; text-align: center; }
.btn-outline {
    display: inline-flex; align-items: center; gap: 9px;
    border: 2px solid #16a34a; color: #16a34a;
    font-weight: 700; font-size: .875rem;
    padding: 12px 28px; border-radius: 100px; text-decoration: none;
    transition: background .2s, color .2s;
}
.btn-outline:hover { background: #16a34a; color: #fff; }

/* ════════════════════════════════════════
   CTA
════════════════════════════════════════ */
.cta-sec { padding: 0 2rem 6rem; background: #f3f2ed; }
.cta-box {
    max-width: 1280px; margin: 0 auto;
    background: linear-gradient(135deg, #15803d, #166534);
    border-radius: 2rem; padding: 5rem 4rem;
    position: relative; overflow: hidden;
    display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 3rem;
}
.cta-box::before {
    content: '';
    position: absolute; inset: 0;
    background: url('https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=1200&q=60&auto=format&fit=crop') center / cover;
    opacity: .04;
}
.cta-content { position: relative; z-index: 2; }
.cta-eyebrow {
    font-size: .65rem; font-weight: 700; letter-spacing: .17em; text-transform: uppercase;
    color: #86efac; margin-bottom: 1.1rem;
}
.cta-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 2.75rem); color: #fff; line-height: 1.07; margin-bottom: 1rem;
}
.cta-h2 em { font-style: italic; color: rgba(255,255,255,.4); }
.cta-p { color: rgba(255,255,255,.4); font-size: .9rem; font-weight: 300; }
.btn-cta {
    position: relative; z-index: 2;
    display: inline-flex; align-items: center; gap: 10px;
    background: linear-gradient(135deg, #4ade80, #22c55e);
    color: #052e16; font-weight: 800; font-size: .9rem;
    padding: 16px 32px; border-radius: 100px; text-decoration: none; white-space: nowrap;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 6px 24px rgba(74,222,128,.4);
}
.btn-cta:hover { transform: translateY(-3px); box-shadow: 0 12px 36px rgba(74,222,128,.5); }

/* ════════════════════════════════════════
   AOS Animate on scroll
════════════════════════════════════════ */
.aos { opacity: 0; transform: translateY(28px); transition: opacity .7s ease, transform .7s ease; }
.aos.d1 { transition-delay: .1s; }
.aos.d2 { transition-delay: .2s; }
.aos.d3 { transition-delay: .33s; }
.aos.d4 { transition-delay: .46s; }
.aos.in  { opacity: 1; transform: translateY(0); }

/* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
@media (max-width: 1024px) {
    .hero-inner { grid-template-columns: 1fr; gap: 3rem; }
    .hero-collab { display: none; }
    .sirsak-inner { grid-template-columns: 1fr; }
    .sirsak-logos-wrap { flex-direction: row; justify-content: flex-start; }
    .digital-grid { grid-template-columns: repeat(2, 1fr); }
    .digital-map-row { grid-template-columns: 1fr; }
    .partner-banner { grid-template-columns: 1fr; }
    .svc-grid { grid-template-columns: repeat(2, 1fr); }
    .about-wrap { grid-template-columns: 1fr; gap: 3rem; }
    .collage { height: 340px; }
    .digital-header { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    .hero-inner { padding: 2.5rem 1.25rem; }
    .hero-h1 { font-size: 2.75rem; }
    .about-sec, .digital-sec, .svc-sec, .gal-sec, .cta-sec, .partner-sec { padding-left: 1.25rem; padding-right: 1.25rem; }
    .cta-box { grid-template-columns: 1fr; padding: 3rem 1.75rem; }
    .digital-grid { grid-template-columns: 1fr; }
    .gal-grid { grid-template-columns: repeat(2,1fr); grid-auto-rows: 150px; }
    .gal-item:first-child { grid-column: span 2; }
    .hero-stats { grid-template-columns: repeat(3,1fr); gap: 6px; }
    .hero-stat-num { font-size: 1.5rem; }
    .svc-grid { grid-template-columns: 1fr; }
    .stats-row { gap: 1.25rem; }
    .partner-banner { padding: 2.25rem 1.75rem; }
    .sirsak-band { padding: 3rem 1.25rem; }
}
</style>

<div class="hp">

{{-- ═══ HERO ══════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-mesh"></div>
    <div class="hero-glow"></div>
    <div class="hero-glow-left"></div>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <div class="hero-inner">
        {{-- LEFT: Text --}}
        <div>
            <h1 class="hero-h1">
                <span>Kelola</span>
                <span>Sampah,</span>
                <em>Bersama.</em>
            </h1>

            <p class="hero-desc">
                Pusat pengelolaan sampah terpadu berbasis komunitas — mendigitalisasi <strong style="color:rgba(255,255,255,.75);font-weight:600;">25 Bank Sampah Unit</strong> Kelurahan Wates bersama sistem digital <strong style="color:rgba(255,255,255,.75);font-weight:600;">S-POP (Sirsak Point of Purchase)</strong>sistem pencatatan bank sampah & <strong style="color:rgba(255,255,255,.75);font-weight:600;">Sirsak Apps</strong>  sebagai buku tabungan digital nasabah.
            </p>

            <div class="hero-btns">
                <a href="{{ route('public.profil') }}" class="btn-lime">
                    Tentang Kami
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('public.bank-sampah') }}" class="btn-ghost">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3"/>
                    </svg>
                    Bank Sampah
                </a>
            </div>
        </div>

        {{-- RIGHT: Collaboration Card --}}
        <div class="hero-collab">
            <div class="collab-main-card">
                <div class="collab-label">Kemitraan Strategis</div>
                <div class="collab-logos">
                    <div class="collab-logo-wrap">
                        <img src="{{ asset('logo_wates.png') }}" alt="TPS Wates" style="height:48px;">
                    </div>
                    <span class="collab-plus">×</span>
                    <div class="collab-logo-wrap">
                        <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak" style="height:40px;">
                    </div>
                </div>
                <p class="collab-tagline">
                    <strong>TPS 3R Kelurahan Wates</strong> bermitra dengan
                    <strong>PT Sirkular Saka Indonesia (SIRSAK)</strong>untuk mendigitalisasi pengelolaan Bank Sampah Unit(BSU) melalui platform <strong>S-POP (Sirsak Point of Purchase)</strong> & <strong>Sirsak Apps</strong> sebagai buku tabungan digital nasabah.
                </p>
            </div>

            {{-- Mini stats --}}
            <div class="hero-stats">
                <div class="hero-stat-card">
                    <div class="hero-stat-num">25</div>
                    <div class="hero-stat-lbl">Bank Sampah Unit</div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-num">3R</div>
                    <div class="hero-stat-lbl">Reduce Reuse Recycle</div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-num">100%</div>
                    <div class="hero-stat-lbl">Digital Sirsak</div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-cue">
        <div class="scroll-line"></div>
        <span>Scroll</span>
    </div>
</section>

{{-- ═══ SIRSAK PARTNERSHIP BAND ════════════════════ --}}
<section class="sirsak-band">
    <div class="sirsak-inner">
        {{-- Logos --}}
        <div class="sirsak-logos-wrap">
            <div class="sirsak-logo-box">
                <img src="{{ asset('logo_wates.png') }}" alt="TPS Wates" style="height:52px;">
            </div>
            <div class="sirsak-x">× MITRA</div>
            <div class="sirsak-logo-box">
                <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak" style="height:44px;">
            </div>
        </div>

        {{-- Content --}}
        <div class="sirsak-content">
            <div class="sirsak-eyebrow">
                <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                Didukung Sistem Digital SIRSAK
            </div>
            <h2 class="sirsak-h2">
                25 Bank Sampah Unit <em>Terdigitalisasi</em><br>di Kelurahan Wates
            </h2>
            <p class="sirsak-p">
                TPS 3R Wates bekerja sama dengan <strong style="color:rgba(255,255,255,.8)">PT Sirkular Saka Indonesia (SIRSAK)</strong> untuk mengimplementasikan sistem pencatatan digital bagi seluruh 25 bank sampah unit di Kelurahan Wates. Nasabah kini memiliki buku tabungan digital, saldo real-time, dan transaksi yang tercatat otomatis.
            </p>
            <div class="sirsak-features">
                <span class="sirsak-feat">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Buku Tabungan Digital
                </span>
                <span class="sirsak-feat">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    Saldo Nasabah Real-time
                </span>
                <span class="sirsak-feat">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pencatatan Otomatis
                </span>
                <span class="sirsak-feat">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Laporan & Rekap Data
                </span>
                <span class="sirsak-feat">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Manajemen Nasabah
                </span>
            </div>
        </div>
    </div>
</section>

{{-- ═══ TENTANG ═════════════════════════════════════ --}}
<section class="about-sec">
    <div class="about-wrap">
        <div>
            <p class="section-tag aos">Tentang TPS 3R Wates</p>
            <h2 class="about-h2 aos d1">
                Lebih dari sekadar<br>
                tempat <em>buang sampah</em>
            </h2>
            <p class="about-p aos d2">
                Kami adalah pusat pengelolaan sampah berbasis komunitas yang mengutamakan pemilahan, daur ulang, dan kemitraan dengan 25 bank sampah unit di Kelurahan Wates. Didukung sistem digital SIRSAK, setiap kilogram sampah yang masuk tercatat dan menjadi nilai ekonomi nyata bagi warga.
            </p>
            <div class="stats-row aos d3">
                <div>
                    <div class="stat-num">25</div>
                    <div class="stat-lbl">Bank Sampah Unit</div>
                </div>
                <div class="stat-div"></div>
                <div>
                    <div class="stat-num">6+</div>
                    <div class="stat-lbl">Jenis Sampah</div>
                </div>
                <div class="stat-div"></div>
                <div>
                    <div class="stat-num">2015</div>
                    <div class="stat-lbl">Berdiri Sejak</div>
                </div>
            </div>
            <a href="{{ route('public.profil') }}" class="link-arrow aos d4">
                Baca Profil Lengkap
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="collage aos d2">
            <div class="col-main">
                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=800&q=80&auto=format&fit=crop"
                     alt="Kegiatan TPS 3R Wates" loading="lazy">
            </div>
            <div class="col-accent">
                <img src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?w=600&q=80&auto=format&fit=crop"
                     alt="Pemilahan Sampah" loading="lazy">
            </div>
            <div class="col-badge"><big>♻️</big>Pilah &<br>Daur Ulang</div>
        </div>
    </div>
</section>

{{-- ═══ DIGITALISASI BANK SAMPAH ═══════════════════ --}}
<section class="digital-sec">
    <div class="digital-inner">
        <div class="digital-header aos">
            <div>
                <p class="section-tag">Digitalisasi Bank Sampah</p>
                <h2 class="digital-h2">
                    Sistem Digital <em>SIRSAK</em><br>untuk 25 Bank Sampah Unit
                </h2>
            </div>
            <div class="digital-count-badge">
                <div class="digital-count-num">25</div>
                <div class="digital-count-lbl">Bank Sampah<br>Terdigitalisasi</div>
            </div>
        </div>

        {{-- Feature cards --}}
        <div class="digital-grid">
            @php $dcards = [
                ['💳', 'Buku Tabungan Digital', 'Setiap nasabah memiliki buku tabungan digital yang mencatat seluruh transaksi setor sampah dan penarikan saldo secara otomatis.', '01'],
                ['💰', 'Saldo Nasabah Real-time', 'Saldo nasabah diperbarui secara real-time setiap kali melakukan setoran sampah. Cek saldo kapan saja, di mana saja.', '02'],
                ['📝', 'Pencatatan Transaksi', 'Sistem pencatatan digital SIRSAK menggantikan buku manual, meminimalisir kesalahan dan mempermudah audit data bank sampah.', '03'],
                ['📊', 'Laporan & Rekap Otomatis', 'Dashboard laporan bulanan, rekap setoran per nasabah, dan analitik operasional bank sampah tersedia secara otomatis.', '04'],
                ['👥', 'Manajemen Nasabah', 'Data nasabah, riwayat transaksi, dan profil lengkap terkelola terpusat dalam sistem SIRSAK yang terintegrasi.', '05'],
                ['🔗', 'Integrasi TPS Wates', 'Seluruh 25 bank sampah unit terhubung ke pusat data TPS 3R Wates untuk pemantauan dan koordinasi yang efisien.', '06'],
            ]; @endphp
            @foreach($dcards as $i => $dc)
            <div class="digital-card aos" style="transition-delay:{{ $i * 0.08 }}s">
                <span class="dc-num">{{ $dc[3] }}</span>
                <div class="dc-icon">{{ $dc[0] }}</div>
                <p class="dc-title">{{ $dc[1] }}</p>
                <p class="dc-desc">{{ $dc[2] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Map & System Row --}}
        <div class="digital-map-row aos d2">
            <div class="map-card">
                <div class="map-content">
                    <p class="section-tag" style="color:rgba(255,255,255,.4)">Sebaran Wilayah</p>
                    <h3 class="map-h3">25 Bank Sampah Unit<br>di <em>Kelurahan Wates</em></h3>
                    <p class="map-p">
                        Seluruh bank sampah unit yang tersebar di Kelurahan Wates kini terhubung dalam satu ekosistem digital yang dikelola melalui platform SIRSAK dan dipantau langsung oleh TPS 3R Wates.
                    </p>
                    <div class="bank-chips">
                        @for($i = 1; $i <= 10; $i++)
                        <span class="bank-chip">BSU {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</span>
                        @endfor
                        <span class="bank-chip">+15 lainnya</span>
                    </div>
                </div>
            </div>

            <div class="sirsak-sys-card">
                <div class="ssc-header">
                    <div class="ssc-logo">
                        <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak" style="height:28px;">
                    </div>
                    <div>
                        <p class="ssc-title">Sistem Digital SIRSAK</p>
                        <p class="ssc-sub">PT Sirkular Saka Indonesia</p>
                    </div>
                </div>
                <div class="ssc-features">
                    @php $sscFeats = [
                        ['📱', 'Aplikasi Mobile untuk Pengurus BSU'],
                        ['💳', 'Kartu Anggota Digital Nasabah'],
                        ['🔄', 'Sinkronisasi Data Real-time'],
                        ['📈', 'Dashboard Monitoring TPS Wates'],
                        ['🔐', 'Keamanan Data Nasabah Terjamin'],
                        ['📋', 'Cetak Laporan & Rekap Bulanan'],
                    ]; @endphp
                    @foreach($sscFeats as $sf)
                    <div class="ssc-feat">
                        <div class="ssc-feat-icon">{{ $sf[0] }}</div>
                        {{ $sf[1] }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ LAYANAN ══════════════════════════════════════ --}}
<section class="svc-sec">
    <div class="svc-watermark">3R</div>
    <div class="svc-wrap">
        <div class="svc-top">
            <div>
                <p class="section-tag aos" style="color:rgba(132,204,22,.7)">Layanan Kami</p>
                <h2 class="svc-h2 aos d1">Apa yang<br>kami <em>lakukan</em></h2>
            </div>
            <p class="svc-sub aos d1">Empat pilar layanan utama TPS 3R Kelurahan Wates</p>
        </div>
        <div class="svc-grid">
            @php $svcs = [
                ['🗑️','Penerimaan Sampah','Menerima sampah dari warga setiap hari kerja dengan sistem yang tertib dan terorganisir berbasis pencatatan digital.','01'],
                ['🔄','Pemilahan & Sortir','Memilah organik, anorganik, dan B3 secara sistematis untuk memaksimalkan nilai guna dan efisiensi daur ulang.','02'],
                ['🏦','Kemitraan Bank Sampah','Berkoordinasi dengan 25 bank sampah unit di Kelurahan Wates yang terdigitalisasi penuh melalui sistem SIRSAK.','03'],
                ['📊','Data Transparan','Seluruh data operasional dipublikasikan secara terbuka. Nasabah dapat memantau saldo tabungan digital kapan saja.','04'],
            ]; @endphp
            @foreach($svcs as $i => $s)
            <div class="svc-card aos" style="transition-delay:{{ $i * 0.1 }}s">
                <span class="svc-n">{{ $s[3] }}</span>
                <div class="svc-card-head">
                    <div class="svc-ico">{{ $s[0] }}</div>
                    <div>
                        <p class="svc-name">{{ $s[1] }}</p>
                    </div>
                </div>
                <p class="svc-desc">{{ $s[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ PARTNER SIRSAK FULL ══════════════════════════ --}}
<section class="partner-sec">
    <div class="partner-inner">
        <div class="partner-top aos">
            <p class="section-tag" style="justify-content:center;">Kemitraan & Dukungan</p>
            <h2 class="partner-h2">
                Didukung oleh <em>PT Sirkular Saka Indonesia</em>
            </h2>
            <p class="partner-desc">
                SIRSAK hadir sebagai platform digitalisasi pengelolaan bank sampah unit, menghadirkan teknologi modern untuk tata kelola sampah yang lebih efisien, akuntabel, dan berdampak bagi masyarakat Kelurahan Wates.
            </p>
        </div>

        <div class="partner-banner aos d1">
            <div class="partner-banner-content">
                <div class="pb-eyebrow">
                    <svg width="8" height="8" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                    Kolaborasi Resmi 2024
                </div>
                <h3 class="pb-h3">
                    Bersama SIRSAK,<br>
                    Bank Sampah <em>Makin Modern</em>
                </h3>
                <p class="pb-p">
                    Dengan sistem digital SIRSAK, pengurus bank sampah unit dapat mencatat transaksi nasabah, mengelola saldo tabungan, dan menghasilkan laporan bulanan secara otomatis — tanpa kertas, tanpa ribet. TPS 3R Wates memantau seluruh aktivitas 25 BSU dalam satu dashboard terpadu.
                </p>
            </div>
            <div class="partner-banner-visual">
                <div class="pb-logo-stack">
                    <div class="pb-logo-card">
                        <img src="{{ asset('logo_wates.png') }}" alt="TPS Wates" style="height:50px;width:50px;border-radius:50%;">
                        <div>
                            <p class="lc-name">TPS 3R Kelurahan Wates</p>
                            <p class="lc-sub">KPP Wates Berseri · Kota Mojokerto</p>
                        </div>
                    </div>
                    <div class="pb-connector">
                        <span>× BERMITRA DENGAN ×</span>
                    </div>
                    <div class="pb-logo-card">
                        <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak" style="height:36px;width:80px;object-fit:contain;">
                        <div>
                            <p class="lc-name">PT Sirkular Saka Indonesia</p>
                            <p class="lc-sub">Platform Digitalisasi Bank Sampah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ GALERI ═══════════════════════════════════════ --}}
@if($recentGaleri->count() > 0)
<section class="gal-sec">
    <div class="gal-wrap">
        <div class="gal-header">
            <div>
                <div class="section-tag aos">Galeri Kegiatan</div>
                <h2 class="gal-h2 aos d1">Momen yang kami abadikan</h2>
            </div>
            <a href="{{ route('public.galeri') }}" class="btn-outline aos d1">
                Lihat Semua
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="gal-grid aos d2">
            @foreach($recentGaleri->take(5) as $foto)
            <a href="{{ route('public.galeri') }}" class="gal-item">
                <img src="{{ $foto->foto_url }}" alt="{{ $foto->judul }}" loading="lazy"
                     onerror="this.src='https://picsum.photos/800/600?random={{ $loop->index + 20 }}'">
                <div class="gal-over"><span>{{ $foto->judul }}</span></div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ CTA ═══════════════════════════════════════════ --}}
<section class="cta-sec">
    <div class="cta-box aos">
        <div class="cta-bg"></div>
        <div class="cta-content">
            <p class="cta-eyebrow">Bergabung Sekarang</p>
            <h2 class="cta-h2">Sampah Anda<br>punya <em>nilai</em></h2>
            <p class="cta-p">Daftar ke bank sampah unit terdekat dan nikmati buku tabungan digital SIRSAK — ubah sampah rumah tangga menjadi manfaat nyata bagi keluarga Anda.</p>
        </div>
        <a href="{{ route('public.bank-sampah') }}" class="btn-cta">
            Temukan Bank Sampah
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</section>

</div>

@push('scripts')
<script>
// Animate on scroll
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('in'); obs.unobserve(e.target); }
    });
}, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });
document.querySelectorAll('.aos').forEach(el => obs.observe(el));
</script>
@endpush
@endsection
