@extends('layouts.admin')
@section('title', 'Nama Sampah')
@section('page-title', 'Master — Nama Sampah')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    form: { id: null, jenis_sampah_id: '', nama: '' },
    openAdd() {
        this.editMode = false;
        this.form = { id: null, jenis_sampah_id: '', nama: '' };
        this.showModal = true;
    },
    openEdit(data) {
        this.editMode = true;
        this.form = { id: data.id, jenis_sampah_id: data.jenis_sampah_id, nama: data.nama };
        this.showModal = true;
    }
}">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola nama-nama sampah berdasarkan jenisnya</p>
    <button @click="openAdd()" class="btn-primary">+ Tambah Nama</button>
</div>

<div class="card overflow-hidden">
    <table class="tbl">
        <thead><tr><th>No</th><th>Nama Sampah</th><th>Jenis</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($data as $i => $item)
            <tr>
                <td class="text-gray-400">{{ $data->firstItem() + $i }}</td>
                <td class="font-semibold">{{ $item->nama }}</td>
                <td>
                    @if($item->jenisSampah)
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium"
                              style="background-color: {{ $item->jenisSampah->warna }}22; color: {{ $item->jenisSampah->warna }}">
                            {{ $item->jenisSampah->nama }}
                        </span>
                    @endif
                </td>
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
                                    jenis_sampah_id: {{ $item->jenis_sampah_id }},
                                    nama: '{{ addslashes($item->nama) }}'
                                })"
                                class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 font-medium">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.nama-sampah.toggle', $item) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-xs px-2 py-1 rounded font-medium {{ $item->aktif ? 'bg-orange-50 text-orange-700' : 'bg-green-50 text-green-700' }}">
                                {{ $item->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.nama-sampah.destroy', $item) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus nama sampah ini?')"
                                    class="text-xs px-2 py-1 bg-red-50 text-red-700 rounded hover:bg-red-100 font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center py-12 text-gray-400">Belum ada nama sampah</td></tr>
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
            <h3 class="font-bold text-gray-900" x-text="editMode ? 'Edit Nama Sampah' : 'Tambah Nama Sampah'"></h3>
            <button @click="showModal = false" class="text-gray-400">✕</button>
        </div>

        {{-- FORM TAMBAH --}}
        <form x-show="!editMode" method="POST" action="{{ route('admin.nama-sampah.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="form-label">Jenis Sampah *</label>
                <select name="jenis_sampah_id" x-model="form.jenis_sampah_id" class="form-input" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Nama Sampah *</label>
                <input type="text" name="nama" x-model="form.nama" class="form-input" required>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

        {{-- FORM EDIT --}}
        <form x-show="editMode" method="POST" :action="'/admin/master/nama-sampah/' + form.id" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">Jenis Sampah *</label>
                <select name="jenis_sampah_id" x-model="form.jenis_sampah_id" class="form-input" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Nama Sampah *</label>
                <input type="text" name="nama" x-model="form.nama" class="form-input" required>
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
