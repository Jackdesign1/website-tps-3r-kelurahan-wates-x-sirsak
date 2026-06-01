@extends('layouts.public')
@section('title', 'Profil — TPS Kelurahan Wates')

@section('content')
<section class="bg-gradient-to-br from-green-800 to-emerald-900 py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-2">Profil TPS</h1>
        <p class="text-green-300">Tempat Penampungan Sementara Kelurahan Wates, Kota Mojokerto</p>
    </div>
</section>

<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Info Card --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-24">
                <div class="w-16 h-16 rounded-2xl bg-green-600 flex items-center justify-center mb-4">
                    <span class="text-3xl">🏗️</span>
                </div>
                <h2 class="text-lg font-bold text-gray-900">{{ $info->nama }}</h2>
                <p class="text-sm text-green-600 font-medium mb-4">{{ $info->kelurahan }}, {{ $info->kota }}</p>

                <div class="space-y-3 text-sm">
                    @if($info->alamat)
                    <div class="flex gap-3">
                        <span class="text-lg flex-shrink-0">📍</span>
                        <span class="text-gray-600">{{ $info->alamat }}</span>
                    </div>
                    @endif
                    @if($info->telepon)
                    <div class="flex gap-3">
                        <span class="text-lg">📞</span>
                        <span class="text-gray-600">{{ $info->telepon }}</span>
                    </div>
                    @endif
                    @if($info->email)
                    <div class="flex gap-3">
                        <span class="text-lg">📧</span>
                        <span class="text-gray-600">{{ $info->email }}</span>
                    </div>
                    @endif
                    @if($info->jam_operasional)
                    <div class="flex gap-3">
                        <span class="text-lg">⏰</span>
                        <span class="text-gray-600">{{ $info->jam_operasional }}</span>
                    </div>
                    @endif
                    @if($info->kepala_tps)
                    <div class="flex gap-3">
                        <span class="text-lg">👤</span>
                        <div>
                            <p class="text-xs text-gray-400">Kepala TPS</p>
                            <p class="text-gray-700 font-semibold">{{ $info->kepala_tps }}</p>
                        </div>
                    </div>
                    @endif
                    @if($info->berdiri_sejak)
                    <div class="flex gap-3">
                        <span class="text-lg">📅</span>
                        <div>
                            <p class="text-xs text-gray-400">Berdiri Sejak</p>
                            <p class="text-gray-700 font-semibold">Tahun {{ $info->berdiri_sejak }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="lg:col-span-2 space-y-6">
            @if($info->deskripsi)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Tentang TPS Kami</h3>
                <p class="text-gray-600 leading-relaxed">{{ $info->deskripsi }}</p>
            </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Visi & Misi</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                        <p class="text-sm font-bold text-green-800 mb-1">🎯 Visi</p>
                        <p class="text-sm text-green-700">Menjadi pusat pengelolaan sampah terpadu yang modern, transparan, dan berdampak positif bagi lingkungan serta ekonomi masyarakat Kelurahan Wates.</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800 mb-2">📌 Misi</p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex gap-2"><span class="text-green-500 flex-shrink-0">✓</span> Menyediakan layanan penerimaan sampah yang terjadwal dan tertib</li>
                            <li class="flex gap-2"><span class="text-green-500 flex-shrink-0">✓</span> Melakukan pemilahan sampah secara sistematis untuk memaksimalkan nilai ekonomis</li>
                            <li class="flex gap-2"><span class="text-green-500 flex-shrink-0">✓</span> Membangun kemitraan aktif dengan bank sampah dan unit usaha daur ulang</li>
                            <li class="flex gap-2"><span class="text-green-500 flex-shrink-0">✓</span> Menyajikan data pengelolaan sampah secara transparan kepada publik</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
