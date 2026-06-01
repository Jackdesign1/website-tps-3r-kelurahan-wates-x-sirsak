@extends('layouts.public')
@section('title', 'Data Sampah — TPS Wates')

@section('content')
<section class="bg-gradient-to-br from-green-800 to-emerald-900 py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-2">Data Sampah</h1>
        <p class="text-green-300">Transparansi data penerimaan dan pilah sampah TPS Kelurahan Wates</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Filter --}}
    <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-5 mb-8 flex flex-wrap gap-4 items-end shadow-sm">
        <div>
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-input w-36" onchange="this.form.submit()">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month((int) $m)->isoFormat('MMMM') }}
                    </option>
                @endfor
            </select>
        </div>
        <div>
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-input w-28" onchange="this.form.submit()">
                @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <p class="text-sm text-gray-500 flex-1">
            Menampilkan data {{ \Carbon\Carbon::create()->month((int) $bulan)->isoFormat('MMMM') }} {{ $tahun }}
        </p>
    </form>

    {{-- Sampah Masuk --}}
    <div class="mb-10">
        <h2 class="text-xl font-extrabold text-gray-900 mb-4">📥 Sampah Masuk TPS</h2>
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <table class="tbl">
                <thead><tr><th>Tanggal</th><th>Total (kg)</th><th>Keterangan</th></tr></thead>
                <tbody>
                @forelse($masuk as $item)
                    <tr>
                        <td class="font-medium">{{ $item->tanggal->isoFormat('D MMMM YYYY') }}</td>
                        <td class="font-bold text-blue-700">{{ number_format($item->total_kg, 2, ',', '.') }} kg</td>
                        <td class="text-gray-500">{{ $item->keterangan ?: '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-10 text-gray-400">Belum ada data masuk untuk periode ini</td></tr>
                @endforelse
                </tbody>
            </table>
            {{ $masuk->links("components.admin.pagination") }}
        </div>
    </div>

    {{-- Hasil Pilah per Jenis --}}
    <div class="mb-10">
        <h2 class="text-xl font-extrabold text-gray-900 mb-4">♻️ Hasil Pilah per Jenis</h2>
        @if(count($pilahPerJenis) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <canvas id="chartPilah" height="250"></canvas>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <table class="tbl">
                    <thead><tr><th>Jenis</th><th>Berat (kg)</th><th>Nilai (Rp)</th></tr></thead>
                    <tbody>
                    @foreach($pilahPerJenis as $item)
                        <tr>
                            <td>
                                <span class="inline-flex items-center gap-1.5 text-sm font-medium">
                                    <span class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $item->warna }}"></span>
                                    {{ $item->nama }}
                                </span>
                            </td>
                            <td class="font-bold text-blue-700">{{ number_format($item->total_berat, 2, ',', '.') }}</td>
                            <td class="font-semibold text-green-700">{{ number_format($item->total_nilai, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-200 p-10 text-center text-gray-400 shadow-sm">
            Belum ada data pilah untuk periode ini
        </div>
        @endif
    </div>

    {{-- Daftar Harga --}}
    <div>
        <h2 class="text-xl font-extrabold text-gray-900 mb-4">💰 Daftar Harga Sampah</h2>
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <table class="tbl">
                <thead><tr><th>Nama Sampah</th><th>Jenis</th><th>Harga/kg</th></tr></thead>
                <tbody>
                @forelse($hargaList as $item)
                    <tr>
                        <td class="font-semibold">{{ $item->namaSampah?->nama ?? '—' }}</td>
                        <td>
                            @if($item->namaSampah?->jenisSampah)
                                <span class="text-xs px-2 py-0.5 rounded-full font-medium"
                                      style="background-color: {{ $item->namaSampah->jenisSampah->warna }}22; color: {{ $item->namaSampah->jenisSampah->warna }}">
                                    {{ $item->namaSampah->jenisSampah->nama }}
                                </span>
                            @endif
                        </td>
                        <td class="font-bold text-green-700">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-10 text-gray-400">Belum ada data harga</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@push('scripts')
@if(count($pilahPerJenis) > 0)
<script>
window.addEventListener('DOMContentLoaded', function() {
    if (!window.Chart) {
        console.warn('Chart.js belum tersedia.');
        return;
    }
    const data = @json($pilahPerJenis);
    const ctx = document.getElementById('chartPilah');
    if (!ctx) {
        return;
    }
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(d => d.nama),
            datasets: [{
                label: 'Berat (kg)',
                data: data.map(d => parseFloat(d.total_berat)),
                backgroundColor: data.map(d => d.warna + 'cc'),
                borderColor: data.map(d => d.warna),
                borderWidth: 1.5,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, title: { display: true, text: 'Berat Pilah per Jenis (kg)' } },
            scales: { y: { beginAtZero: true, grid: { color: '#f3f4f6' } }, x: { grid: { display: false } } }
        }
    });
});
</script>
@endif
@endpush
@endsection
