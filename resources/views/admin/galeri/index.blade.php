@extends('layouts.admin')
@section('title', 'Galeri')
@section('page-title', 'Galeri')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    form: { id: null, judul: '', deskripsi: '', url_foto: '', tanggal: '{{ now()->format('Y-m-d') }}', urutan: 0 },
    uploadMode: 'url',
    previewUrl: '',
    openAdd() {
        this.editMode = false;
        this.form = { id: null, judul: '', deskripsi: '', url_foto: '', tanggal: '{{ now()->format('Y-m-d') }}', urutan: 0 };
        this.uploadMode = 'url';
        this.previewUrl = '';
        this.showModal = true;
    },
    openEdit(data) {
        this.editMode = true;
        this.form = { id: data.id, judul: data.judul, deskripsi: data.deskripsi || '', url_foto: data.url_foto, tanggal: data.tanggal, urutan: data.urutan };
        this.previewUrl = data.url_foto.startsWith('http') ? data.url_foto : '/storage/' + data.url_foto;
        this.uploadMode = data.url_foto.startsWith('http') ? 'url' : 'file';
        this.showModal = true;
    }
}">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola foto dokumentasi kegiatan TPS</p>
    <button @click="openAdd()" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Foto
    </button>
</div>

@if($data->count() > 0)
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-5">
    @foreach($data as $item)
    <div class="card overflow-hidden group">
        <div class="aspect-video overflow-hidden bg-gray-100">
            <img src="{{ $item->foto_url }}" alt="{{ $item->judul }}"
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                 loading="lazy"
                 onerror="this.src='https://picsum.photos/400/300?random=99'">
        </div>
        <div class="p-3">
            <p class="text-sm font-semibold text-gray-800 truncate">{{ $item->judul }}</p>
            <p class="text-xs text-gray-400 mt-0.5">{{ $item->tanggal->isoFormat('D MMM YYYY') }} · Urutan: {{ $item->urutan }}</p>
            @if($item->deskripsi)
                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
            @endif
            <div class="flex gap-2 mt-3">
                <button @click="openEdit({
                            id: {{ $item->id }},
                            judul: '{{ addslashes($item->judul) }}',
                            deskripsi: '{{ addslashes($item->deskripsi) }}',
                            url_foto: '{{ $item->url_foto }}',
                            tanggal: '{{ $item->tanggal->format('Y-m-d') }}',
                            urutan: {{ $item->urutan }}
                        })"
                        class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 font-medium flex-1 text-center">
                    Edit
                </button>
                <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Hapus foto ini?')"
                            class="w-full text-xs px-2 py-1 bg-red-50 text-red-700 rounded hover:bg-red-100 font-medium">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $data->links() }}
@else
<div class="card py-16 text-center">
    <div class="text-5xl mb-3">🖼️</div>
    <p class="text-gray-500">Belum ada foto di galeri</p>
    <button @click="openAdd()" class="btn-primary mt-4">Tambah Foto Pertama</button>
</div>
@endif

{{-- Modal --}}
<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="absolute inset-0 bg-black/50" @click="showModal = false"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md my-4 p-6"
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0 scale-95">

        <div class="flex justify-between items-center mb-5">
            <h3 class="font-bold text-base text-gray-900" x-text="editMode ? 'Edit Foto' : 'Tambah Foto'"></h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        {{-- FORM TAMBAH --}}
        <form x-show="!editMode"
              method="POST"
              action="{{ route('admin.galeri.store') }}"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf
            <div>
                <label class="form-label">Judul *</label>
                <input type="text" name="judul" x-model="form.judul" class="form-input" required maxlength="200">
            </div>
            <div>
                <label class="form-label">Tanggal *</label>
                <input type="date" name="tanggal" x-model="form.tanggal" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" x-model="form.deskripsi" rows="2" class="form-input" maxlength="500"></textarea>
            </div>
            <div>
                <label class="form-label">Urutan</label>
                <input type="number" name="urutan" x-model="form.urutan" class="form-input" min="0">
            </div>
            <div>
                <label class="form-label">Sumber Foto *</label>
                <div class="flex gap-2 mb-3">
                    <button type="button" @click="uploadMode = 'url'"
                            :class="uploadMode === 'url' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600'"
                            class="flex-1 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                        URL Eksternal
                    </button>
                    <button type="button" @click="uploadMode = 'file'"
                            :class="uploadMode === 'file' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600'"
                            class="flex-1 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                        Upload File
                    </button>
                </div>
                <div x-show="uploadMode === 'url'">
                    <input type="url" name="url_foto" x-model="form.url_foto"
                           @input="previewUrl = form.url_foto"
                           class="form-input" placeholder="https://...">
                </div>
                <div x-show="uploadMode === 'file'">
                    <input type="file" name="foto"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           @change="previewUrl = URL.createObjectURL($event.target.files[0])"
                           class="form-input py-1.5">
                    <p class="text-xs text-gray-400 mt-1">Max 2MB. Format: jpg, jpeg, png, webp</p>
                </div>
            </div>
            <div x-show="previewUrl" class="rounded-lg overflow-hidden border border-gray-200">
                <img :src="previewUrl" alt="Preview" class="w-full h-40 object-cover">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

        {{-- FORM EDIT --}}
        <form x-show="editMode"
              method="POST"
              :action="'/admin/galeri/' + form.id"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">Judul *</label>
                <input type="text" name="judul" x-model="form.judul" class="form-input" required maxlength="200">
            </div>
            <div>
                <label class="form-label">Tanggal *</label>
                <input type="date" name="tanggal" x-model="form.tanggal" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" x-model="form.deskripsi" rows="2" class="form-input" maxlength="500"></textarea>
            </div>
            <div>
                <label class="form-label">Urutan</label>
                <input type="number" name="urutan" x-model="form.urutan" class="form-input" min="0">
            </div>
            <div>
                <label class="form-label">Ganti Foto (opsional)</label>
                <div class="flex gap-2 mb-3">
                    <button type="button" @click="uploadMode = 'url'"
                            :class="uploadMode === 'url' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600'"
                            class="flex-1 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                        URL Eksternal
                    </button>
                    <button type="button" @click="uploadMode = 'file'"
                            :class="uploadMode === 'file' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600'"
                            class="flex-1 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                        Upload File
                    </button>
                </div>
                <div x-show="uploadMode === 'url'">
                    <input type="url" name="url_foto" x-model="form.url_foto"
                           @input="previewUrl = form.url_foto"
                           class="form-input" placeholder="https://...">
                </div>
                <div x-show="uploadMode === 'file'">
                    <input type="file" name="foto"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           @change="previewUrl = URL.createObjectURL($event.target.files[0])"
                           class="form-input py-1.5">
                    <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin ganti foto.</p>
                </div>
            </div>
            <div x-show="previewUrl" class="rounded-lg overflow-hidden border border-gray-200">
                <img :src="previewUrl" alt="Preview" class="w-full h-40 object-cover">
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
