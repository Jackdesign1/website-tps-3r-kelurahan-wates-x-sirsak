@extends('layouts.public')
@section('title', 'Galeri — TPS Wates')

@section('content')
<section class="bg-gradient-to-br from-green-800 to-emerald-900 py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-2">Galeri Kegiatan</h1>
        <p class="text-green-300">Dokumentasi aktivitas pengelolaan sampah TPS Kelurahan Wates</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16"
         x-data="{ lightbox: false, src: '', title: '', desc: '' }">

    @if($galeri->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($galeri as $item)
        <div class="group cursor-pointer"
             @click="lightbox = true; src = '{{ $item->foto_url }}'; title = '{{ addslashes($item->judul) }}'; desc = '{{ addslashes($item->deskripsi) }}'">
            <div class="rounded-2xl overflow-hidden aspect-video bg-gray-100 relative shadow-sm">
                <img src="{{ $item->foto_url }}" alt="{{ $item->judul }}"
                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <div>
                        <p class="text-white font-bold text-sm">{{ $item->judul }}</p>
                        <p class="text-white/70 text-xs mt-0.5">🔍 Klik untuk lihat penuh</p>
                    </div>
                </div>
            </div>
            <div class="mt-3 px-1">
                <p class="font-semibold text-gray-800 text-sm">{{ $item->judul }}</p>
                <p class="text-gray-400 text-xs mt-0.5">{{ $item->tanggal->isoFormat('D MMMM YYYY') }}</p>
                @if($item->deskripsi)
                    <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">{{ $galeri->links("components.admin.pagination") }}</div>
    @else
    <div class="text-center py-20">
        <div class="text-6xl mb-4">🖼️</div>
        <h3 class="text-xl font-bold text-gray-700">Galeri Kosong</h3>
        <p class="text-gray-400 mt-2">Belum ada foto yang diunggah.</p>
    </div>
    @endif

    {{-- Lightbox --}}
    <div x-show="lightbox" x-cloak
         class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0"
         @click.self="lightbox = false"
         @keydown.escape.window="lightbox = false">
        <div class="relative max-w-4xl w-full">
            <button @click="lightbox = false"
                    class="absolute -top-10 right-0 text-white/70 hover:text-white text-2xl font-light">✕</button>
            <img :src="src" :alt="title" class="w-full rounded-xl shadow-2xl max-h-[80vh] object-contain">
            <div class="mt-4 text-center">
                <p class="text-white font-bold text-lg" x-text="title"></p>
                <p class="text-white/60 text-sm mt-1" x-text="desc"></p>
            </div>
        </div>
    </div>
</section>
@endsection
