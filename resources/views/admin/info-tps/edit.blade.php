@extends('layouts.admin')
@section('title', 'Info TPS')
@section('page-title', 'Informasi TPS')

@section('content')
<div class="max-w-2xl">
    <div class="card p-6">
        <h2 class="text-base font-bold text-gray-800 mb-1">Edit Informasi TPS</h2>
        <p class="text-sm text-gray-500 mb-6">Data ini tampil di halaman publik profil TPS.</p>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.info-tps.update') }}" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="form-label">Nama TPS *</label>
                    <input type="text" name="nama" value="{{ old('nama', $info->nama) }}" class="form-input @error('nama') border-red-400 @enderror" required>
                </div>
                <div>
                    <label class="form-label">Kelurahan *</label>
                    <input type="text" name="kelurahan" value="{{ old('kelurahan', $info->kelurahan) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Kota *</label>
                    <input type="text" name="kota" value="{{ old('kota', $info->kota) }}" class="form-input" required>
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label">Alamat Lengkap *</label>
                    <textarea name="alamat" rows="2" class="form-input" required>{{ old('alamat', $info->alamat) }}</textarea>
                </div>
                <div>
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $info->telepon) }}" class="form-input" placeholder="0321-123456">
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $info->email) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Jam Operasional</label>
                    <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $info->jam_operasional) }}" class="form-input" placeholder="Senin–Sabtu, 07.00–16.00">
                </div>
                <div>
                    <label class="form-label">Kepala TPS</label>
                    <input type="text" name="kepala_tps" value="{{ old('kepala_tps', $info->kepala_tps) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Tahun Berdiri</label>
                    <input type="number" name="berdiri_sejak" value="{{ old('berdiri_sejak', $info->berdiri_sejak) }}" class="form-input" min="1900" max="{{ date('Y') }}" placeholder="2015">
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="form-input" maxlength="2000">{{ old('deskripsi', $info->deskripsi) }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">Maksimal 2000 karakter. Tag HTML tidak diperbolehkan.</p>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
