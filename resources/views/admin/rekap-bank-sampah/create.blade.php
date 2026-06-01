@extends('layouts.admin')
@section('title', 'Tambah Rekap Bank Sampah')
@section('page-title', 'Tambah Rekap Bank Sampah')

@section('content')
<div x-data="createRekap()" class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-5">
        <div>
            <a href="{{ route('admin.rekap-bank-sampah.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium mb-1 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Data Rekap
            </a>
            <p class="text-sm text-gray-500 mt-2">Input rekap penyerahan sampah ke bank sampah mitra</p>
        </div>
    </div>

    <div class="card p-6">
        <form method="POST" action="{{ route('admin.rekap-bank-sampah.store') }}" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-2">
                <div>
                    <label class="form-label font-bold text-gray-700">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" x-model="form.tanggal" class="form-input bg-gray-50" required>
                </div>
                <div>
                    <label class="form-label font-bold text-gray-700">Bank Sampah Mitra <span class="text-red-500">*</span></label>
                    <select name="bank_sampah_mitra_id" x-model="form.bank_sampah_mitra_id" class="form-input" required>
                        <option value="">-- Pilih Bank Mitra --</option>
                        @foreach($mitraList as $m)
                            <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->kode }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="p-5 bg-gray-50 rounded-xl border border-gray-200">
                <h4 class="text-sm font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">Detail Sampah yang Diserahkan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label text-sm">Jenis Sampah (Opsional filter)</label>
                        <select x-model="form.jenis_id" @change="onJenisChange(form.jenis_id)" class="form-input text-sm">
                            <option value="">-- Semua Jenis --</option>
                            @foreach($jenisList as $j)
                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label text-sm font-bold text-gray-700">Nama Sampah <span class="text-red-500">*</span></label>
                        <select name="nama_sampah_id" x-model="form.nama_sampah_id"
                                @change="onNamaChange(form.nama_sampah_id)" class="form-input text-sm" required>
                            <option value="">-- Pilih Nama --</option>
                            <template x-for="n in namaList" :key="n.id">
                                <option :value="n.id" x-text="n.nama"></option>
                            </template>
                        </select>
                    </div>
                    <div class="md:col-span-2 mt-2">
                        <label class="form-label text-sm font-bold text-gray-700">Berat Timbangan (kg) <span class="text-red-500">*</span></label>
                        <input type="number" name="berat_kg" x-model="form.berat_kg"
                               step="0.01" min="0.01" class="form-input text-lg max-w-xs" placeholder="0.00" required>
                    </div>
                </div>
            </div>

            <div class="p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-100 mt-6">
                <div class="flex justify-between items-center text-sm mb-2">
                    <span class="text-gray-600 font-medium">Harga satuan/kg (Otomatis):</span>
                    <span class="font-bold text-gray-800 bg-white px-3 py-1 rounded-lg shadow-sm"
                          x-text="harga > 0 ? 'Rp ' + harga.toLocaleString('id-ID') : '—'"></span>
                </div>
                <div class="flex justify-between items-center mt-3 pt-3 border-t border-green-200">
                    <span class="text-gray-700 font-bold">Estimasi Total Pemasukan:</span>
                    <span class="text-2xl font-extrabold text-green-700"
                          x-text="'Rp ' + getTotal().toLocaleString('id-ID', {maximumFractionDigits:0})"></span>
                </div>
            </div>

            <div class="flex gap-4 mt-6 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary flex-1 justify-center py-3 text-base shadow-lg shadow-green-500/30">
                    💾 Simpan Rekap
                </button>
                <a href="{{ route('admin.rekap-bank-sampah.index') }}" class="btn-secondary px-8 flex items-center justify-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('createRekap', () => ({
        form: {
            tanggal: new Date().toISOString().split('T')[0],
            bank_sampah_mitra_id: '',
            jenis_id: '',
            nama_sampah_id: '',
            berat_kg: ''
        },
        namaList: [],
        harga: 0,
        
        init() {
            // Load semua nama sampah by default jika jenis tidak dipilih
            this.onJenisChange('');
        },

        async onJenisChange(jenisId) {
            this.form.nama_sampah_id = '';
            this.harga = 0;
            this.namaList = [];
            const r = await fetch('/admin/api/nama-sampah' + (jenisId ? '?jenis_id=' + jenisId : ''));
            this.namaList = await r.json();
        },

        async onNamaChange(namaId) {
            if (!namaId) { this.harga = 0; return; }
            const r = await fetch('/admin/api/harga-sampah?nama_id=' + namaId);
            const d = await r.json();
            this.harga = d ? parseFloat(d.harga_per_kg) : 0;
        },

        getTotal() {
            return (parseFloat(this.form.berat_kg) || 0) * this.harga;
        }
    }));
});
</script>
@endpush
@endsection
