<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TPS 3R Kelurahan Wates') — Kota Mojokerto</title>
    <meta name="description" content="TPS 3R Kelurahan Wates Kota Mojokerto — Pengelolaan sampah terpadu bersama 25 Bank Sampah Unit didukung sistem digital SIRSAK.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ═══ NAVBAR STYLES — tidak bergantung pada Tailwind ═══ */
        #mainNav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 9999;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(74,222,128,0.15);
            transition: box-shadow .3s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        #mainNav.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,.07); }

        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 66px;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .nav-logo-img {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }
        .nav-brand-name {
            font-size: .875rem;
            font-weight: 800;
            color: #166534;
            line-height: 1.2;
            letter-spacing: -.01em;
            display: block;
        }
        .nav-brand-sub {
            font-size: .67rem;
            color: #22c55e;
            font-weight: 500;
            letter-spacing: .03em;
            display: block;
        }

        /* Desktop menu */
        .nav-desktop {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-link {
            display: inline-flex;
            align-items: center;
            padding: 7px 13px;
            font-size: .825rem;
            font-weight: 500;
            color: #4b5563;
            border-radius: 8px;
            text-decoration: none;
            transition: background .2s, color .2s;
            white-space: nowrap;
        }
        .nav-link:hover { background: #f0fdf4; color: #16a34a; }
        .nav-link.active { background: #dcfce7; color: #15803d; font-weight: 600; }

        .nav-divider {
            width: 1px; height: 20px;
            background: #e5e7eb;
            margin: 0 6px;
            flex-shrink: 0;
        }
        .nav-sirsak-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 11px 4px 5px;
            background: #f0fdf4;
            border: 1px solid rgba(34,197,94,.25);
            border-radius: 100px;
            font-size: .64rem;
            color: #16a34a;
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .nav-sirsak-badge img {
            height: 20px;
            width: auto;
            object-fit: contain;
            display: block;
        }
        .nav-login {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            font-size: .825rem;
            font-weight: 700;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
            border-radius: 100px;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 2px 12px rgba(34,197,94,.25);
            white-space: nowrap;
            margin-left: 8px;
            flex-shrink: 0;
        }
        .nav-login:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(34,197,94,.38); }

        /* Mobile burger */
        .nav-burger {
            display: none;
            padding: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            color: #374151;
            border-radius: 8px;
            flex-shrink: 0;
        }
        .nav-burger:hover { background: #f3f4f6; }

        /* Mobile drawer */
        .nav-mobile {
            display: none;
            border-top: 1px solid #f0fdf4;
            background: #fff;
            padding: 10px 16px 14px;
        }
        .nav-mobile.open { display: block; }
        .nav-mobile-link {
            display: block;
            padding: 10px 12px;
            font-size: .875rem;
            font-weight: 500;
            color: #374151;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 2px;
            transition: background .15s;
        }
        .nav-mobile-link:hover { background: #f9fafb; }
        .nav-mobile-link.active { background: #f0fdf4; color: #15803d; }
        .nav-mobile-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #f3f4f6;
        }
        .nav-mobile-sirsak {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-mobile-sirsak img { height: 20px; object-fit: contain; }
        .nav-mobile-sirsak span { font-size: .7rem; color: #16a34a; font-weight: 600; }
        .nav-mobile-login { font-size: .825rem; font-weight: 700; color: #15803d; text-decoration: none; }

        /* Responsive breakpoint */
        @media (max-width: 900px) {
            .nav-desktop { display: none !important; }
            .nav-burger   { display: flex !important; }
        }

        /* ═══ MAIN CONTENT PADDING ═══ */
        #pageMain { padding-top: 66px; }

        /* ═══ FOOTER STYLES ═══ */
        #pageFooter {
            background: linear-gradient(180deg, #0a1f0e 0%, #0d2b14 100%);
            color: #9ca3af;
            margin-top: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3.5rem 1.5rem 2rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2.5rem;
        }
        .footer-logo-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.1rem;
        }
        .footer-logo-row img {
            height: 44px;
            width: 44px;
            object-fit: contain;
            background: #fff;
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }
        .footer-brand-name { color: #fff; font-weight: 800; font-size: .92rem; line-height: 1.25; display: block; }
        .footer-brand-sub  { color: #4ade80; font-size: .7rem; font-weight: 500; margin-top: 2px; display: block; }
        .footer-desc { font-size: .83rem; line-height: 1.75; color: #6b7280; margin-bottom: 1.1rem; }
        .footer-sirsak-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            border: 1px solid rgba(22,101,59,.12);
            border-radius: 14px;
            padding: 10px 16px;
            box-shadow: 0 14px 30px rgba(0,0,0,.06);
        }
        .footer-sirsak-badge img { height: 24px; object-fit: contain; filter: none; }
        .footer-sirsak-lbl1 { font-size: .62rem; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: .08em; display: block; }
        .footer-sirsak-lbl2 { font-size: .76rem; color: #4ade80; font-weight: 700; display: block; }
        .footer-nav-title { color: #fff; font-weight: 700; font-size: .875rem; margin-bottom: 1.1rem; display: block; }
        .footer-nav-list { list-style: none; padding: 0; margin: 0; }
        .footer-nav-list li { margin-bottom: 8px; }
        .footer-nav-link { color: #9ca3af; font-size: .83rem; text-decoration: none; transition: color .2s; }
        .footer-nav-link:hover { color: #4ade80; }
        .footer-contact-row { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px; }
        .footer-contact-row span { font-size: .82rem; line-height: 1.55; color: #9ca3af; }
        .footer-bottom {
            border-top: 1px solid rgba(34,197,94,.12);
            padding-top: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .75rem;
        }
        .footer-bottom p { font-size: .73rem; color: #6b7280; margin: 0; }

        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
</head>
<body style="background-color:#fafaf9;font-family:'Plus Jakarta Sans',sans-serif;">

{{-- ══════════════ NAVBAR ══════════════ --}}
<nav id="mainNav">
    <div class="nav-inner">
        <div class="nav-bar">

            {{-- Brand --}}
            <a href="{{ route('public.index') }}" class="nav-brand">
                <img src="{{ asset('logo_wates.png') }}" alt="TPS 3R Wates" class="nav-logo-img">
                <div>
                    <span class="nav-brand-name">TPS 3R Kelurahan Wates</span>
                    <span class="nav-brand-sub">KPP Wates Berseri · Kota Mojokerto</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="nav-desktop" id="navDesktop">
                @php
                    $navLinks = [
                        ['Beranda',     'public.index'],
                        ['Profil',      'public.profil'],
                        ['Data Sampah', 'public.data-sampah'],
                        ['Bank Sampah', 'public.bank-sampah'],
                        ['Galeri',      'public.galeri'],
                    ];
                @endphp
                @foreach($navLinks as [$label, $route])
                    <a href="{{ route($route) }}"
                       class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach

                <span class="nav-divider"></span>

                <div class="nav-sirsak-badge">
                    <span>Powered by</span>
                    <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak">
                </div>

                <a href="{{ route('login') }}" class="nav-login">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                    </svg>
                    Login Admin
                </a>
            </div>

            {{-- Mobile Burger --}}
            <button class="nav-burger" id="navBurger" aria-label="Menu" type="button">
                <svg id="iconOpen"  width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="iconClose" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Drawer --}}
    <div class="nav-mobile" id="navMobile">
        @foreach($navLinks as [$label, $route])
            <a href="{{ route($route) }}"
               class="nav-mobile-link {{ request()->routeIs($route) ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
        <div class="nav-mobile-bottom">
            <div class="nav-mobile-sirsak">
                <span>Powered by</span>
                <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak">
            </div>
            <a href="{{ route('login') }}" class="nav-mobile-login">Login Admin →</a>
        </div>
    </div>
</nav>

{{-- MAIN CONTENT --}}
<main id="pageMain">
    @yield('content')
</main>

{{-- ══════════════ FOOTER ══════════════ --}}
<footer id="pageFooter">
    <div class="footer-inner">
        <div class="footer-grid">

            {{-- Brand Col --}}
            <div>
                <div class="footer-logo-row">
                    <img src="{{ asset('logo_wates.png') }}" alt="TPS Wates">
                    <div>
                        <span class="footer-brand-name">TPS 3R Kelurahan Wates</span>
                        <span class="footer-brand-sub">KPP Wates Berseri · Kota Mojokerto</span>
                    </div>
                </div>
                <p class="footer-desc">
                    Tempat Penampungan Sampah Sementara 3R yang melayani warga Kelurahan Wates dengan sistem pilah, daur ulang, dan kemitraan 25 Bank Sampah Unit.
                </p>
                <div class="footer-sirsak-badge">
                    <img src="{{ asset('logo_sirsak.png') }}" alt="Sirsak">
                    <div>
                        <span class="footer-sirsak-lbl1">Partner Sistem Digital</span>
                        <span class="footer-sirsak-lbl2">PT Sirkular Saka Indonesia</span>
                    </div>
                </div>
            </div>

            {{-- Nav Col --}}
            <div>
                <span class="footer-nav-title">Navigasi</span>
                <ul class="footer-nav-list">
                    @foreach($navLinks as [$label, $route])
                        <li>
                            <a href="{{ route($route) }}" class="footer-nav-link">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Kontak Col --}}
            <div>
                <span class="footer-nav-title">Kontak</span>
                <div class="footer-contact-row">
                    <span style="flex-shrink:0;">📍</span>
                    <span>Kel. Wates, Kecamatan Wates<br>Kota Mojokerto, Jawa Timur</span>
                </div>
                <div class="footer-contact-row">
                    <span>📞</span>
                    <span>(0321) 123456</span>
                </div>
                <div class="footer-contact-row">
                    <span>⏰</span>
                    <span>Senin–Sabtu, 07.00–16.00</span>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="footer-bottom">
            <p>© {{ date('Y') }} TPS 3R Kelurahan Wates · Kota Mojokerto. Sistem Pengelolaan Sampah Terpadu.</p>
            <p>Digitalisasi oleh <strong style="color:#4ade80;font-weight:600;">Sirsak (PT Sirkular Saka Indonesia)</strong></p>
        </div>
    </div>
</footer>

<script>
    // Navbar scroll shadow
    window.addEventListener('scroll', function() {
        document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 10);
    });

    // Mobile menu toggle — vanilla JS, tidak butuh Alpine
    var burger  = document.getElementById('navBurger');
    var drawer  = document.getElementById('navMobile');
    var iconOpen  = document.getElementById('iconOpen');
    var iconClose = document.getElementById('iconClose');
    burger.addEventListener('click', function() {
        var isOpen = drawer.classList.toggle('open');
        iconOpen.style.display  = isOpen ? 'none' : 'block';
        iconClose.style.display = isOpen ? 'block' : 'none';
    });
</script>

@stack('scripts')
</body>
</html>
