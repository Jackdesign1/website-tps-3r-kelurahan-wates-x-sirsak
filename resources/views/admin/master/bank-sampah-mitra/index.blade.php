@extends('layouts.admin')
@section('title', 'Bank Sampah Mitra')
@section('page-title', 'Master — Bank Sampah Mitra')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    form: { id: null, kode: '', nama: '', ketua: '', alamat: '', telepon: '' },
    openAdd() {
        this.editMode = false;
        this.form = { id: null, kode: '', nama: '', ketua: '', alamat: '', telepon: '' };
        this.showModal = true;
    },
    openEdit(data) {
        this.editMode = true;
        this.form = { id: data.id, kode: data.kode, nama: data.nama, ketua: data.ketua || '', alamat: data.alamat || '', telepon: data.telepon || '' };
        this.showModal = true;
    }
}">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola bank sampah yang bermitra dengan TPS</p>
    <button @click="openAdd()" class="btn-primary">+ Tambah Mitra</button>
</div>

<div class="card overflow-hidden">
    <table class="tbl">
        <thead><tr><th>No</th><th>Kode</th><th>Nama</th><th>Ketua</th><th>Telepon</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($data as $i => $item)
            <tr>
                <td class="text-gray-400">{{ $data->firstItem() + $i }}</td>
                <td><code class="text-xs bg-gray-100 px-1.5 py-0.5 rounded">{{ $item->kode }}</code></td>
                <td>
                    <div class="font-semibold">{{ $item->nama }}</div>
                    <div class="text-xs text-gray-400 truncate max-w-xs">{{ $item->alamat }}</div>
                </td>
                <td class="text-sm">{{ $item->ketua ?: '—' }}</td>
                <td class="text-sm text-gray-600">{{ $item->telepon ?: '—' }}</td>
                <td>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                 {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="flex gap-1.5 flex-wrap">
                        <button @click="openEdit({
                                    id: {{ $item->id }},
                                    kode: '{{ $item->kode }}',
                                    nama: '{{ addslashes($item->nama) }}',
                                    ketua: '{{ addslashes($item->ketua) }}',
                                    alamat: '{{ addslashes($item->alamat) }}',
                                    telepon: '{{ $item->telepon }}'
                                })"
                                class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 font-medium">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.bank-sampah-mitra.toggle', $item) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-xs px-2 py-1 rounded font-medium {{ $item->aktif ? 'bg-orange-50 text-orange-700' : 'bg-green-50 text-green-700' }}">
                                {{ $item->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        @if($item->rekap_bank_sampah_count === 0)
                        <form method="POST" action="{{ route('admin.bank-sampah-mitra.destroy', $item) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus mitra ini?')"
                                    class="text-xs px-2 py-1 bg-red-50 text-red-700 rounded hover:bg-red-100 font-medium">
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-12 text-gray-400">Belum ada mitra</td></tr>
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
            <h3 class="font-bold text-gray-900" x-text="editMode ? 'Edit Bank Mitra' : 'Tambah Bank Mitra'"></h3>
            <button @click="showModal = false" class="text-gray-400">✕</button>
        </div>

        {{-- FORM TAMBAH --}}
        <form x-show="!editMode" method="POST" action="{{ route('admin.bank-sampah-mitra.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="form-label">Kode *</label>
                    <input type="text" name="kode" x-model="form.kode" class="form-input" required maxlength="20">
                </div>
                <div>
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" x-model="form.telepon" class="form-input" maxlength="20">
                </div>
            </div>
            <div>
                <label class="form-label">Nama Bank Sampah *</label>
                <input type="text" name="nama" x-model="form.nama" class="form-input" required maxlength="150">
            </div>
            <div>
                <label class="form-label">Ketua</label>
                <input type="text" name="ketua" x-model="form.ketua" class="form-input" maxlength="100">
            </div>
            <div>
                <label class="form-label">Alamat</label>
                <textarea name="alamat" x-model="form.alamat" rows="2" class="form-input" maxlength="500"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

        {{-- FORM EDIT --}}
        <form x-show="editMode" method="POST" :action="'/admin/master/bank-sampah-mitra/' + form.id" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="form-label">Kode *</label>
                    <input type="text" name="kode" x-model="form.kode" class="form-input" required maxlength="20">
                </div>
                <div>
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" x-model="form.telepon" class="form-input" maxlength="20">
                </div>
            </div>
            <div>
                <label class="form-label">Nama Bank Sampah *</label>
                <input type="text" name="nama" x-model="form.nama" class="form-input" required maxlength="150">
            </div>
            <div>
                <label class="form-label">Ketua</label>
                <input type="text" name="ketua" x-model="form.ketua" class="form-input" maxlength="100">
            </div>
            <div>
                <label class="form-label">Alamat</label>
                <textarea name="alamat" x-model="form.alamat" rows="2" class="form-input" maxlength="500"></textarea>
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
