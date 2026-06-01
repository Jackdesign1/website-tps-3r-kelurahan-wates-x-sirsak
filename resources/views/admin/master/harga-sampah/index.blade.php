@extends('layouts.admin')
@section('title', 'Harga Sampah')
@section('page-title', 'Master — Harga Sampah')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    form: { id: null, nama_sampah_id: '', harga_per_kg: '' },
    openAdd() {
        this.editMode = false;
        this.form = { id: null, nama_sampah_id: '', harga_per_kg: '' };
        this.showModal = true;
    },
    openEdit(data) {
        this.editMode = true;
        this.form = { id: data.id, nama_sampah_id: data.nama_sampah_id, harga_per_kg: data.harga_per_kg };
        this.showModal = true;
    }
}">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola harga jual per kg untuk setiap nama sampah</p>
    <button @click="openAdd()" class="btn-primary">+ Tetapkan Harga</button>
</div>

<div class="card overflow-hidden">
    <table class="tbl">
        <thead><tr><th>No</th><th>Nama Sampah</th><th>Jenis</th><th>Harga/kg</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($data as $i => $item)
            <tr>
                <td class="text-gray-400">{{ $data->firstItem() + $i }}</td>
                <td class="font-semibold">{{ $item->namaSampah?->nama ?? '—' }}</td>
                <td>
                    @if($item->namaSampah?->jenisSampah)
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium"
                              style="background-color: {{ $item->namaSampah->jenisSampah->warna }}22; color: {{ $item->namaSampah->jenisSampah->warna }}">
                            {{ $item->namaSampah->jenisSampah->nama }}
                        </span>
                    @endif
                </td>
                <td class="font-bold text-green-700 text-base">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                <td>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                 {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="flex gap-1.5">
                        <button @click="openEdit({
                                    id: {{ $item->id }},
                                    nama_sampah_id: {{ $item->nama_sampah_id }},
                                    harga_per_kg: {{ $item->harga_per_kg }}
                                })"
                                class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 font-medium">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.harga-sampah.destroy', $item) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus harga ini?')"
                                    class="text-xs px-2 py-1 bg-red-50 text-red-700 rounded hover:bg-red-100 font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center py-12 text-gray-400">Belum ada harga sampah</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $data->links() }}
</div>

{{-- Modal --}}
<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50" @click="showModal = false"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6"
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0 scale-95">

        <div class="flex justify-between items-center mb-5">
            <h3 class="font-bold text-gray-900" x-text="editMode ? 'Edit Harga Sampah' : 'Tetapkan Harga'"></h3>
            <button @click="showModal = false" class="text-gray-400">✕</button>
        </div>

        {{-- FORM TAMBAH --}}
        <form x-show="!editMode" method="POST" action="{{ route('admin.harga-sampah.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="form-label">Nama Sampah *</label>
                <select name="nama_sampah_id" x-model="form.nama_sampah_id" class="form-input" required>
                    <option value="">-- Pilih --</option>
                    @foreach($namaSampahList as $n)
                        <option value="{{ $n->id }}">{{ $n->nama }} ({{ $n->jenisSampah?->nama }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Harga per kg (Rp) *</label>
                <input type="number" name="harga_per_kg" x-model="form.harga_per_kg"
                       step="1" min="0" class="form-input" required>
                <p class="text-xs text-gray-400 mt-1" x-show="form.harga_per_kg">
                    = Rp <span x-text="parseFloat(form.harga_per_kg || 0).toLocaleString('id-ID')"></span>
                </p>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

        {{-- FORM EDIT --}}
        <form x-show="editMode" method="POST" :action="'/admin/master/harga-sampah/' + form.id" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">Nama Sampah</label>
                <div class="form-input bg-gray-50 text-gray-500">
                    @foreach($data as $d)
                        <span x-show="form.nama_sampah_id == {{ $d->nama_sampah_id }}">
                            {{ $d->namaSampah?->nama ?? '—' }}
                        </span>
                    @endforeach
                </div>
                <input type="hidden" name="nama_sampah_id" x-model="form.nama_sampah_id">
            </div>
            <div>
                <label class="form-label">Harga per kg (Rp) *</label>
                <input type="number" name="harga_per_kg" x-model="form.harga_per_kg"
                       step="1" min="0" class="form-input" required>
                <p class="text-xs text-gray-400 mt-1" x-show="form.harga_per_kg">
                    = Rp <span x-text="parseFloat(form.harga_per_kg || 0).toLocaleString('id-ID')"></span>
                </p>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 justify-center">Update</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

    </div>
</div>
</div>
@endsection
