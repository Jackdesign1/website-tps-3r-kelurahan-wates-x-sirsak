@extends('layouts.public')
@section('title', 'Bank Sampah Mitra — TPS Wates')

@section('content')
<section class="bg-gradient-to-br from-green-800 to-emerald-900 py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-2">Bank Sampah Mitra</h1>
        <p class="text-green-300">Jaringan bank sampah yang bermitra dengan TPS Kelurahan Wates</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($mitra->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($mitra as $item)
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-2xl">🏦</span>
                </div>
                <code class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-mono">{{ $item->kode }}</code>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">{{ $item->nama }}</h3>
            @if($item->ketua)
                <p class="text-sm text-gray-500 mb-3">Ketua: <span class="text-gray-700 font-medium">{{ $item->ketua }}</span></p>
            @endif
            <div class="space-y-1.5 text-sm text-gray-600">
                @if($item->alamat)
                    <div class="flex gap-2"><span>📍</span><span>{{ $item->alamat }}</span></div>
                @endif
                @if($item->telepon)
                    <div class="flex gap-2"><span>📞</span><span>{{ $item->telepon }}</span></div>
                @endif
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="inline-flex items-center gap-1.5 text-xs text-green-700 bg-green-50 px-2.5 py-1 rounded-full font-medium">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                    Aktif Bermitra
                </span>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20">
        <div class="text-6xl mb-4">🏦</div>
        <h3 class="text-xl font-bold text-gray-700">Belum Ada Mitra</h3>
        <p class="text-gray-400 mt-2">Bank sampah mitra sedang dalam proses pendaftaran.</p>
    </div>
    @endif
</section>
@endsection
