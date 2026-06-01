<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — TPS Wates</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center p-4"
      style="font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #14532d 0%, #166534 50%, #065f46 100%);">

<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center mx-auto mb-4 shadow-lg overflow-hidden">
            <img src="{{ asset('logo_wates.png') }}" alt="TPS Wates" class="w-10 h-10 object-contain">
        </div>
        <h1 class="text-2xl font-extrabold text-white">TPS Kelurahan Wates</h1>
        <p class="text-green-300 text-sm mt-1">Panel Admin — Kota Mojokerto</p>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-lg font-bold text-gray-900 mb-1">Selamat Datang</h2>
        <p class="text-sm text-gray-500 mb-6">Masuk ke panel admin untuk mengelola data TPS.</p>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf

            <div>
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="form-input @error('email') border-red-400 @enderror"
                       placeholder="admin@tps-wates.test"
                       required autocomplete="email">
            </div>

            <div>
                <label class="form-label" for="password">Password</label>
                <div class="relative" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'"
                           id="password" name="password"
                           class="form-input"
                           placeholder="••••••••"
                           required autocomplete="current-password">
                    <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn-primary w-full justify-center py-2.5">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-gray-100">
            <a href="{{ route('public.index') }}" class="text-sm text-gray-500 hover:text-green-600 transition-colors">
                ← Kembali ke halaman publik
            </a>
        </div>
    </div>
</div>

</body>
</html>
