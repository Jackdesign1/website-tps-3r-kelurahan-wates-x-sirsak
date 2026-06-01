@extends('layouts.admin')
@section('title', 'Sampah Masuk TPS')
@section('page-title', 'Sampah Masuk TPS')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    form: { id: null, tanggal: '{{ now()->format('Y-m-d') }}', total_kg: '', keterangan: '' },
    openAdd() {
        this.editMode = false;
        this.form = { id: null, tanggal: '{{ now()->format('Y-m-d') }}', total_kg: '', keterangan: '' };
        this.showModal = true;
    },
    openEdit(data) {
        this.editMode = true;
        this.form = { id: data.id, tanggal: data.tanggal, total_kg: data.total_kg, keterangan: data.keterangan || '' };
        this.showModal = true;
    }
}">

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Kelola data sampah yang masuk ke TPS</p>
    <button @click="openAdd()" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Data
    </button>
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
        <div class="flex-1 min-w-48">
            <label class="form-label">Cari</label>
            <input type="text" name="search" value="{{ $search }}" class="form-input" placeholder="Ketik keterangan...">
        </div>
        <button type="submit" class="btn-secondary">Filter</button>
        <a href="{{ route('admin.tps-masuk.index') }}" class="btn-secondary">Reset</a>
    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
    <div class="card p-4 flex items-center gap-4">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-xl">📥</div>
        <div>
            <p class="text-xs text-gray-500">Total Masuk Bulan Ini</p>
            <p class="text-xl font-bold text-gray-900">{{ number_format($totalBulan, 2, ',', '.') }} <span class="text-sm font-normal text-gray-500">kg</span></p>
        </div>
    </div>
    <div class="card p-4 flex items-center gap-4">
        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-xl">📋</div>
        <div>
            <p class="text-xs text-gray-500">Jumlah Transaksi</p>
            <p class="text-xl font-bold text-gray-900">{{ $data->total() }} <span class="text-sm font-normal text-gray-500">data</span></p>
        </div>
    </div>
</div>

<div class="card overflow-hidden">
    <table class="tbl">
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Total (kg)</th><th>Keterangan</th><th>Diinput</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($data as $i => $item)
            <tr>
                <td class="text-gray-400">{{ $data->firstItem() + $i }}</td>
                <td class="font-medium">{{ $item->tanggal->isoFormat('D MMM YYYY') }}</td>
                <td class="font-bold text-blue-700">{{ number_format($item->total_kg, 2, ',', '.') }}</td>
                <td class="text-gray-500 max-w-xs truncate">{{ $item->keterangan ?: '—' }}</td>
                <td class="text-gray-400 text-xs">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="flex items-center gap-2">
                        <button @click="openEdit({
                                    id: {{ $item->id }},
                                    tanggal: '{{ $item->tanggal->format('Y-m-d') }}',
                                    total_kg: '{{ $item->total_kg }}',
                                    keterangan: '{{ addslashes($item->keterangan) }}'
                                })"
                                class="text-xs px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 font-medium">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.tps-masuk.destroy', $item) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus data tanggal {{ $item->tanggal->format('d/m/Y') }}?')"
                                    class="text-xs px-2.5 py-1 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-12 text-gray-400">
                    <div class="text-4xl mb-2">📭</div>
                    Belum ada data sampah masuk untuk periode ini
                </td>
            </tr>
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

        <div class="flex items-center justify-between mb-5">
            <h3 class="text-base font-bold text-gray-900"
                x-text="editMode ? 'Edit Data Masuk' : 'Tambah Data Masuk'"></h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- FORM TAMBAH — hanya tampil saat !editMode --}}
        <form x-show="!editMode" method="POST" action="{{ route('admin.tps-masuk.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="form-label">Tanggal *</label>
                    <input type="date" name="tanggal" x-model="form.tanggal" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Total Berat (kg) *</label>
                    <input type="number" name="total_kg" x-model="form.total_kg"
                           step="0.01" min="0.01" class="form-input" placeholder="0.00" required>
                </div>
                <div>
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" x-model="form.keterangan"
                              rows="3" class="form-input" placeholder="Opsional..."></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

        {{-- FORM EDIT — hanya tampil saat editMode --}}
        <form x-show="editMode" method="POST" :action="'/admin/tps-masuk/' + form.id">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="form-label">Tanggal *</label>
                    <input type="date" name="tanggal" x-model="form.tanggal" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Total Berat (kg) *</label>
                    <input type="number" name="total_kg" x-model="form.total_kg"
                           step="0.01" min="0.01" class="form-input" placeholder="0.00" required>
                </div>
                <div>
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" x-model="form.keterangan"
                              rows="3" class="form-input" placeholder="Opsional..."></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn-primary flex-1 justify-center">Update</button>
                <button type="button" @click="showModal = false" class="btn-secondary flex-1 justify-center">Batal</button>
            </div>
        </form>

    </div>
</div>

</div>
@endsection
