@extends('layouts.admin')
@section('title', 'Jenis Sampah')
@section('page-title', 'Master — Jenis Sampah')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    form: { id: null, kode: '', nama: '', warna: '#16a34a' },
    openAdd() {
        this.editMode = false;
        this.form = { id: null, kode: '', nama: '', warna: '#16a34a' };
        this.showModal = true;
    },
    openEdit(data) {
        this.editMode = true;
        this.form = { id: data.id, kode: data.kode, nama: data.nama, warna: data.warna };
        this.showModal = true;
    }
}">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola kategori/jenis sampah yang dikelola TPS</p>
    <button @click="openAdd()" class="btn-primary">+ Tambah Jenis</button>
</div>

<div class="card overflow-hidden">
    <table class="tbl">
        <thead><tr><th>No</th><th>Kode</th><th>Nama</th><th>Warna</th><th>Nama Sampah</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($data as $i => $item)
            <tr>
                <td class="text-gray-400">{{ $data->firstItem() + $i }}</td>
                <td><code class="text-xs bg-gray-100 px-1.5 py-0.5 rounded">{{ $item->kode }}</code></td>
                <td class="font-semibold">{{ $item->nama }}</td>
                <td>
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full border border-gray-200 inline-block"
                              style="background-color: {{ $item->warna }}"></span>
                        <span class="text-xs text-gray-500">{{ $item->warna }}</span>
                    </div>
                </td>
                <td><span class="text-sm">{{ $item->nama_sampah_count }} item</span></td>
                <td>
                    @if($item->aktif)
                        <span class="text-xs px-2 py-0.5 bg-green-100 text-green-700 rounded-full font-medium">Aktif</span>
                    @else
                        <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full font-medium">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center gap-1.5">
                        <button @click="openEdit({
                                    id: {{ $item->id }},
                                    kode: '{{ $item->kode }}',
                                    nama: '{{ addslashes($item->nama) }}',
                                    warna: '{{ $item->warna }}'
                                })"
                                class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 font-medium">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.jenis-sampah.toggle', $item) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-xs px-2 py-1 rounded font-medium {{ $item->aktif ? 'bg-orange-50 text-orange-700 hover:bg-orange-100' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
                                {{ $item->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        @if($item->nama_sampah_count === 0)
                        <form method="POST" action="{{ route('admin.jenis-sampah.destroy', $item) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus jenis {{ $item->nama }}?')"
                                    class="text-xs px-2 py-1 bg-red-50 text-red-700 rounded hover:bg-red-100 font-medium">
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-12 text-gray-400"><div class="text-4xl mb-2">📋</div>Belum ada jenis sampah</td></tr>
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
            <h3 class="font-bold text-gray-900" x-text="editMode ? 'Edit Jenis Sampah' : 'Tambah Jenis Sampah'"></h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        {{-- FORM TAMBAH --}}
        <form x-show="!editMode" method="POST" action="{{ route('admin.jenis-sampah.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="form-label">Kode * <span class="text-xs text-gray-400">(maks 10 karakter)</span></label>
                <input type="text" name="kode" x-model="form.kode" class="form-input uppercase" maxlength="10" required>
            </div>
            <div>
                <label class="form-label">Nama Jenis *</label>
                <input type="text" name="nama" x-model="form.nama" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Warna *</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="warna" x-model="form.warna"
                           class="w-12 h-10 rounded-lg border border-gray-300 cursor-pointer p-0.5">
                    <input type="text" x-model="form.warna" class="form-input flex-1"
                           placeholder="#16a34a" readonly>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

        {{-- FORM EDIT --}}
        <form x-show="editMode" method="POST" :action="'/admin/master/jenis-sampah/' + form.id" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">Kode * <span class="text-xs text-gray-400">(maks 10 karakter)</span></label>
                <input type="text" name="kode" x-model="form.kode" class="form-input uppercase" maxlength="10" required>
            </div>
            <div>
                <label class="form-label">Nama Jenis *</label>
                <input type="text" name="nama" x-model="form.nama" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Warna *</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="warna" x-model="form.warna"
                           class="w-12 h-10 rounded-lg border border-gray-300 cursor-pointer p-0.5">
                    <input type="text" x-model="form.warna" class="form-input flex-1"
                           placeholder="#16a34a" readonly>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary flex-1 justify-center">Update</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

    </div>
</div>
</div>
@endsection
