<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin TPS') — TPS Wates</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50" style="font-family: 'Plus Jakarta Sans', sans-serif;" x-data="{ sidebarOpen: false }">

{{-- Mobile Overlay --}}
<div class="fixed inset-0 bg-black/50 z-20 lg:hidden"
     x-show="sidebarOpen"
     x-transition:enter="transition-opacity duration-200"
     x-transition:leave="transition-opacity duration-200"
     x-cloak
     @click="sidebarOpen = false"></div>

{{-- Sidebar --}}
<aside class="sidebar fixed top-0 left-0 h-full w-64 z-30 flex flex-col
              -translate-x-full lg:translate-x-0 transition-transform duration-200"
       :class="sidebarOpen ? '!translate-x-0' : ''">

    {{-- Logo --}}
    <div class="px-5 py-5" style="border-bottom: 1px solid rgba(34,197,94,0.2)">
        <div class="flex items-center gap-3">
            <img src="{{ asset('logo_wates.png') }}" alt="TPS Wates" class="w-10 h-10 rounded-lg bg-white p-1 shadow-sm flex-shrink-0">
            <div>
                <p class="text-white text-sm font-bold leading-tight">TPS Wates</p>
                <p class="text-green-400 text-xs">Admin Panel</p>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-0.5">
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest px-4 pt-4 pb-1">TPS Operasional</p>

        <a href="{{ route('admin.tps-masuk.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.tps-masuk*') ? 'active' : '' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H7m0 0l5-5m-5 5l5 5"/>
            </svg>
            Sampah Masuk TPS
        </a>

        <a href="{{ route('admin.hasil-pilah.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.hasil-pilah*') ? 'active' : '' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Hasil Pilah Sampah
        </a>

        <a href="{{ route('admin.rekap-bank-sampah.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.rekap-bank-sampah*') ? 'active' : '' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            Rekap Bank Sampah
        </a>

        <a href="{{ route('admin.galeri.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Galeri
        </a>

        {{-- Master Data collapsible --}}
        <div x-data="{ open: {{ request()->routeIs('admin.jenis-sampah*','admin.nama-sampah*','admin.harga-sampah*','admin.bank-sampah-mitra*') ? 'true' : 'false' }} }">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest px-4 pt-4 pb-1">Master Data</p>
            <button @click="open = !open" class="sidebar-link w-full justify-between">
                <span class="flex items-center gap-3">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Master Data
                </span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="ml-4 mt-1 space-y-0.5">
                <a href="{{ route('admin.bank-sampah-mitra.index') }}"
                   class="sidebar-link text-xs {{ request()->routeIs('admin.bank-sampah-mitra*') ? 'active' : '' }}">
                    Bank Sampah Mitra
                </a>
                <a href="{{ route('admin.jenis-sampah.index') }}"
                   class="sidebar-link text-xs {{ request()->routeIs('admin.jenis-sampah*') ? 'active' : '' }}">
                    Jenis Sampah
                </a>
                <a href="{{ route('admin.nama-sampah.index') }}"
                   class="sidebar-link text-xs {{ request()->routeIs('admin.nama-sampah*') ? 'active' : '' }}">
                    Nama Sampah
                </a>
                <a href="{{ route('admin.harga-sampah.index') }}"
                   class="sidebar-link text-xs {{ request()->routeIs('admin.harga-sampah*') ? 'active' : '' }}">
                    Harga Sampah
                </a>
            </div>
        </div>

        <a href="{{ route('admin.info-tps.edit') }}"
           class="sidebar-link {{ request()->routeIs('admin.info-tps*') ? 'active' : '' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Info TPS
        </a>
    </nav>

    {{-- User bottom --}}
    <div class="px-4 py-4" style="border-top: 1px solid rgba(34,197,94,0.2)">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-green-400 text-xs">Administrator</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors" title="Logout">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Main Wrapper --}}
<div class="lg:ml-64 min-h-screen flex flex-col">

    {{-- Topbar --}}
    <header class="sticky top-0 z-10 bg-white border-b border-gray-200 px-4 lg:px-6 h-14 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-1.5 rounded-lg hover:bg-gray-100 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h1 class="text-sm font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-gray-400 hidden sm:block">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="hidden sm:inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                Admin
            </span>
            <a href="{{ route('public.index') }}" target="_blank"
               class="text-xs text-gray-500 hover:text-gray-700 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Publik
            </a>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show"
             x-init="setTimeout(() => show = false, 3500)"
             x-transition
             class="mx-4 lg:mx-6 mt-4 p-3 bg-green-50 border border-green-200 rounded-lg flex items-center gap-2 text-sm text-green-800">
            <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show"
             x-init="setTimeout(() => show = false, 5000)"
             x-transition
             class="mx-4 lg:mx-6 mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2 text-sm text-red-800">
            <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Page Content --}}
    <main class="flex-1 p-4 lg:p-6">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
