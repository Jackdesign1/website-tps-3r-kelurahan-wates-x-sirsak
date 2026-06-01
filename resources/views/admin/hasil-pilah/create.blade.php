@extends('layouts.admin')
@section('title', 'Input Hasil Pilah Sampah')
@section('page-title', 'Input Hasil Pilah Sampah')

@section('content')
<script>
    window._jenisSampahData = @json($jenisList);
</script>

<div x-data="createHasilPilah()" class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-5">
        <div>
            <a href="{{ route('admin.hasil-pilah.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium mb-1 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Data Hasil Pilah
            </a>
            <p class="text-sm text-gray-500 mt-2">Input data hasil pemilahan sampah harian secara multi-item.</p>
        </div>
    </div>

    <div class="card p-6">
        <form method="POST" action="{{ route('admin.hasil-pilah.store') }}">
            @csrf
            
            <div class="mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                <label class="form-label font-bold text-gray-800">Tanggal Pemilahan <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal" x-model="addForm.tanggal" class="form-input max-w-xs bg-white" required>
            </div>

            <div class="space-y-4 mb-4">
                <template x-for="(item, idx) in addForm.items" :key="idx">
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm relative">
                        <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                            <span class="text-sm font-bold text-gray-700 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-xs" x-text="idx + 1"></span>
                                Item Sampah
                            </span>
                            <button type="button" @click="removeItem(idx)"
                                    x-show="addForm.items.length > 1"
                                    class="text-red-500 hover:text-red-700 text-xs font-semibold bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                ✕ Hapus Item
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="form-label text-sm">Jenis Sampah</label>
                                <select x-model="item.jenis_id"
                                        @change="onJenisChangeAdd(idx, item.jenis_id)"
                                        class="form-input">
                                    <option value="">-- Pilih Jenis --</option>
                                    <template x-for="j in jenisList" :key="j.id">
                                        <option :value="j.id" x-text="j.nama"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="form-label text-sm">Nama Sampah *</label>
                                <select :name="'items[' + idx + '][nama_sampah_id]'"
                                        x-model="item.nama_id"
                                        @change="onNamaChangeAdd(idx, item.nama_id)"
                                        class="form-input" required>
                                    <option value="">-- Pilih Nama --</option>
                                    <template x-for="n in item.namaList" :key="n.id">
                                        <option :value="n.id" x-text="n.nama"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="form-label text-sm">Berat (kg) *</label>
                                <input type="number"
                                       :name="'items[' + idx + '][berat_kg]'"
                                       x-model="item.berat"
                                       step="0.01" min="0.01"
                                       class="form-input"
                                       placeholder="0.00" required>
                            </div>
                            <div>
                                <label class="form-label text-sm">Harga/kg (otomatis)</label>
                                <div class="form-input bg-gray-50 text-gray-600 flex items-center h-[42px]"
                                     x-text="item.harga > 0 ? 'Rp ' + item.harga.toLocaleString('id-ID') : '—'"></div>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-gray-50 flex justify-end items-center gap-3">
                            <span class="text-sm text-gray-500">Subtotal Nilai: </span>
                            <span class="text-lg font-bold text-green-700 bg-green-50 px-3 py-1 rounded-lg"
                                  x-text="'Rp ' + ((parseFloat(item.berat)||0) * item.harga).toLocaleString('id-ID', {maximumFractionDigits:0})"></span>
                        </div>
                    </div>
                </template>
            </div>

            <button type="button" @click="addItem()"
                    class="w-full py-3 mb-6 border-2 border-dashed border-green-300 text-green-700 text-sm font-bold rounded-xl hover:bg-green-50 transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Item Sampah Lainnya
            </button>

            <div class="p-5 bg-gradient-to-r from-green-600 to-green-700 rounded-xl flex items-center justify-between text-white shadow-lg mb-6">
                <span class="text-base font-medium opacity-90">Grand Total Estimasi Nilai:</span>
                <span class="text-2xl font-extrabold tracking-tight"
                      x-text="'Rp ' + grandTotal().toLocaleString('id-ID', {maximumFractionDigits:0})"></span>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-primary flex-1 justify-center py-3 text-base shadow-lg shadow-green-500/30">
                    💾 Simpan Semua Data
                </button>
                <a href="{{ route('admin.hasil-pilah.index') }}" class="btn-secondary px-8 flex items-center justify-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('createHasilPilah', () => ({
        jenisList: window._jenisSampahData || [],
        
        addForm: {
            tanggal: new Date().toISOString().split('T')[0],
            items: [{ jenis_id: '', nama_id: '', berat: '', harga: 0, namaList: [] }]
        },

        addItem() {
            this.addForm.items.push({ jenis_id: '', nama_id: '', berat: '', harga: 0, namaList: [] });
        },

        removeItem(idx) {
            if (this.addForm.items.length > 1) this.addForm.items.splice(idx, 1);
        },

        async onJenisChangeAdd(idx, jenisId) {
            this.addForm.items[idx].nama_id = '';
            this.addForm.items[idx].harga = 0;
            this.addForm.items[idx].namaList = [];
            if (!jenisId) return;
            const res = await fetch('/admin/api/nama-sampah?jenis_id=' + jenisId);
            this.addForm.items[idx].namaList = await res.json();
        },

        async onNamaChangeAdd(idx, namaId) {
            if (!namaId) { this.addForm.items[idx].harga = 0; return; }
            const res = await fetch('/admin/api/harga-sampah?nama_id=' + namaId);
            const d = await res.json();
            this.addForm.items[idx].harga = d ? parseFloat(d.harga_per_kg) : 0;
        },

        grandTotal() {
            return this.addForm.items.reduce((s, i) => s + (parseFloat(i.berat) || 0) * i.harga, 0);
        }
    }));
});
</script>
@endpush
@endsection
