@extends('layouts.admin')
@section('title', 'Rekap Bank Sampah')
@section('page-title', 'Rekap Bank Sampah')

@section('content')
<div x-data="rekapBankSampah()">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola rekap penyerahan sampah ke bank sampah mitra</p>
    <a href="{{ route('admin.rekap-bank-sampah.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Rekap
    </a>
</div>

<div class="card p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div>
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-input w-36" onchange="this.form.submit()">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->isoFormat('MMMM') }}
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
        <a href="{{ route('admin.rekap-bank-sampah.index') }}" class="btn-secondary">Reset</a>
    </form>
</div>

<div class="card p-4 mb-5 flex items-center gap-4">
    <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center text-xl">💰</div>
    <div>
        <p class="text-xs text-gray-500">Total Nilai Rekap Bulan Ini</p>
        <p class="text-xl font-bold text-gray-900">Rp {{ number_format($totalNilai, 0, ',', '.') }}</p>
    </div>
</div>

<div class="card overflow-hidden">
    <table class="tbl">
        <thead><tr>
            <th>No</th><th>Tanggal</th><th>Bank Mitra</th><th>Nama Sampah</th>
            <th>Berat (kg)</th><th>Harga/kg</th><th>Total</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        @forelse($data as $i => $item)
            <tr>
                <td class="text-gray-400">{{ $data->firstItem() + $i }}</td>
                <td class="font-medium">{{ $item->tanggal->isoFormat('D MMM YYYY') }}</td>
                <td>
                    <div class="font-medium text-sm">{{ $item->bankSampahMitra?->nama ?? '—' }}</div>
                    <div class="text-xs text-gray-400">{{ $item->bankSampahMitra?->kode }}</div>
                </td>
                <td>
                    <div class="font-medium">{{ $item->namaSampah?->nama ?? '—' }}</div>
                    @if($item->namaSampah?->jenisSampah)
                        <span class="text-xs text-gray-400">{{ $item->namaSampah->jenisSampah->nama }}</span>
                    @endif
                </td>
                <td class="font-bold text-blue-700">{{ number_format($item->berat_kg, 2, ',', '.') }}</td>
                <td class="text-gray-500">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                <td class="font-bold text-green-700">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                <td>
                    <div class="flex gap-2">
                        <button
                            @click="openEdit({{ json_encode([
                                'id'                  => $item->id,
                                'tanggal'             => $item->tanggal->format('Y-m-d'),
                                'bank_sampah_mitra_id'=> $item->bank_sampah_mitra_id,
                                'jenis_sampah_id'     => $item->namaSampah?->jenis_sampah_id ?? 0,
                                'nama_sampah_id'      => $item->nama_sampah_id,
                                'berat_kg'            => (string) $item->berat_kg,
                            ]) }})"
                            class="text-xs px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 font-medium">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.rekap-bank-sampah.destroy', $item) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus rekap ini?')"
                                    class="text-xs px-2.5 py-1 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center py-12 text-gray-400">
                <div class="text-4xl mb-2">📭</div>Belum ada rekap
            </td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $data->links() }}
</div>



{{-- MODAL EDIT --}}
<div x-show="showModal && editMode" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50" @click="showModal = false"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6"
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0 scale-95">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-base font-bold">Edit Rekap Bank Sampah</h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form method="POST" :action="'/admin/rekap-bank-sampah/' + form.id" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">Tanggal *</label>
                <input type="date" name="tanggal" x-model="form.tanggal" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Bank Sampah Mitra *</label>
                <select name="bank_sampah_mitra_id" x-model="form.bank_sampah_mitra_id" class="form-input" required>
                    <option value="">-- Pilih Bank Mitra --</option>
                    @foreach($mitraList as $m)
                        <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->kode }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Jenis Sampah</label>
                <select x-model="form.jenis_id" @change="onJenisChange(form.jenis_id)" class="form-input">
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Nama Sampah *</label>
                <select name="nama_sampah_id" x-model="form.nama_sampah_id"
                        @change="onNamaChange(form.nama_sampah_id)" class="form-input" required>
                    <option value="">-- Pilih Nama --</option>
                    <template x-for="n in namaList" :key="n.id">
                        <option :value="n.id" x-text="n.nama"
                                :selected="n.id == form.nama_sampah_id"></option>
                    </template>
                </select>
            </div>
            <div>
                <label class="form-label">Berat (kg) *</label>
                <input type="number" name="berat_kg" x-model="form.berat_kg"
                       step="0.01" min="0.01" class="form-input" required>
            </div>
            <p class="text-xs text-gray-400 bg-gray-50 p-3 rounded-lg">
                💡 Harga per kg diambil otomatis dari database saat disimpan.
            </p>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 justify-center">Update</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>
    </div>
</div>

</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('rekapBankSampah', () => ({
        showModal: false,
        editMode: false,
        form: {
            id: null,
            tanggal: new Date().toISOString().split('T')[0],
            bank_sampah_mitra_id: '',
            jenis_id: '',
            nama_sampah_id: '',
            berat_kg: ''
        },
        namaList: [],
        harga: 0,

        async onJenisChange(jenisId) {
            this.form.nama_sampah_id = '';
            this.harga = 0;
            this.namaList = [];
            if (!jenisId) return;
            const r = await fetch('/admin/api/nama-sampah?jenis_id=' + jenisId);
            this.namaList = await r.json();
        },

        async onNamaChange(namaId) {
            if (!namaId) { this.harga = 0; return; }
            const r = await fetch('/admin/api/harga-sampah?nama_id=' + namaId);
            const d = await r.json();
            this.harga = d ? parseFloat(d.harga_per_kg) : 0;
        },



        openEdit(data) {
            this.editMode = true;
            this.form = {
                id: data.id,
                tanggal: data.tanggal,
                bank_sampah_mitra_id: data.bank_sampah_mitra_id,
                jenis_id: data.jenis_sampah_id || '',
                nama_sampah_id: data.nama_sampah_id,
                berat_kg: data.berat_kg
            };
            this.namaList = [];
            this.harga = 0;
            if (this.form.jenis_id) this.onJenisChange(this.form.jenis_id);
            this.showModal = true;
        },


    }));
});
</script>
@endpush
@endsection
