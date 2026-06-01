@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    @php
    $cards = [
        ['label' => 'Masuk Hari Ini', 'value' => number_format($sampahMasukHariIni, 2, ',', '.') . ' kg', 'icon' => '📥', 'color' => '#3b82f6'],
        ['label' => 'Total Hasil Pilah', 'value' => number_format($totalHasilPilah, 2, ',', '.') . ' kg', 'icon' => '♻️', 'color' => '#16a34a'],
        ['label' => 'Total Nilai', 'value' => 'Rp ' . number_format($totalNilai, 0, ',', '.'), 'icon' => '💰', 'color' => '#d97706'],
        ['label' => 'Jenis Sampah', 'value' => $jumlahJenis . ' jenis', 'icon' => '🗂️', 'color' => '#7c3aed'],
        ['label' => 'Bank Mitra', 'value' => $jumlahMitra . ' mitra', 'icon' => '🏦', 'color' => '#ea580c'],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="card p-4">
        <div class="text-2xl mb-2">{{ $card['icon'] }}</div>
        <p class="text-xs text-gray-500 font-medium">{{ $card['label'] }}</p>
        <p class="text-base font-bold text-gray-900 mt-0.5 leading-tight">{{ $card['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="card p-5">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Hasil Pilah per Jenis (Bulan Ini)</h3>
        <canvas id="chartPilahJenis" height="200"></canvas>
        @if(empty($chartPilahPerJenis))
            <p class="text-center text-gray-400 text-sm py-8">Belum ada data bulan ini</p>
        @endif
    </div>
    <div class="card p-5">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Tren Sampah Masuk (7 Hari Terakhir)</h3>
        <canvas id="chartTrendMasuk" height="200"></canvas>
    </div>
</div>

{{-- Recent Tables --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-gray-800">Sampah Masuk Terbaru</h3>
            <a href="{{ route('admin.tps-masuk.index') }}" class="text-xs text-green-600 hover:underline">Lihat semua →</a>
        </div>
        <table class="tbl">
            <thead><tr><th>Tanggal</th><th>Total (kg)</th><th>Keterangan</th></tr></thead>
            <tbody>
            @forelse($recentMasuk as $item)
                <tr>
                    <td class="font-medium">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="font-semibold text-blue-700">{{ number_format($item->total_kg, 2, ',', '.') }}</td>
                    <td class="text-gray-500 max-w-32 truncate">{{ $item->keterangan ?: '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-8 text-gray-400 text-sm">Belum ada data</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-gray-800">Hasil Pilah Terbaru</h3>
            <a href="{{ route('admin.hasil-pilah.index') }}" class="text-xs text-green-600 hover:underline">Lihat semua →</a>
        </div>
        <table class="tbl">
            <thead><tr><th>Tanggal</th><th>Sampah</th><th>Berat</th><th>Nilai</th></tr></thead>
            <tbody>
            @forelse($recentPilah as $item)
                <tr>
                    <td class="font-medium">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $item->namaSampah?->nama ?? '—' }}</td>
                    <td>{{ number_format($item->berat_kg, 2, ',', '.') }} kg</td>
                    <td class="font-semibold text-green-700">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-8 text-gray-400 text-sm">Belum ada data</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pilahData = @json($chartPilahPerJenis);
    const trendData = @json($trendMasuk);

    // Generate 7 hari terakhir
    const days = [];
    const dayLabels = [];
    for (let i = 6; i >= 0; i--) {
        const d = new Date();
        d.setDate(d.getDate() - i);
        const key = d.toISOString().split('T')[0];
        days.push(key);
        dayLabels.push(d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric' }));
    }

    const trendMap = {};
    trendData.forEach(function(d) { trendMap[d.tgl] = parseFloat(d.total); });
    const trendValues = days.map(function(d) { return trendMap[d] || 0; });

    // Bar chart pilah per jenis
    if (pilahData.length > 0) {
        new Chart(document.getElementById('chartPilahJenis'), {
            type: 'bar',
            data: {
                labels: pilahData.map(function(d) { return d.nama; }),
                datasets: [{
                    label: 'Berat (kg)',
                    data: pilahData.map(function(d) { return parseFloat(d.total_berat); }),
                    backgroundColor: pilahData.map(function(d) { return d.warna + 'cc'; }),
                    borderColor: pilahData.map(function(d) { return d.warna; }),
                    borderWidth: 1.5,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Line chart tren masuk
    new Chart(document.getElementById('chartTrendMasuk'), {
        type: 'line',
        data: {
            labels: dayLabels,
            datasets: [{
                label: 'Total Masuk (kg)',
                data: trendValues,
                borderColor: '#16a34a',
                backgroundColor: 'rgba(22,163,74,0.08)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#16a34a',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
@endpush
