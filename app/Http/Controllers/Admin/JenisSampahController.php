<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Http\Requests\Admin\StoreJenisSampahRequest;
use App\Http\Requests\Admin\UpdateJenisSampahRequest;

class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::withCount('namaSampah')->orderBy('nama')->paginate(20);
        return view('admin.master.jenis-sampah.index', compact('data'));
    }

    public function store(StoreJenisSampahRequest $request)
    {
        JenisSampah::create($request->validated());
        JenisSampah::clearCache();
        session()->flash('success', 'Jenis sampah berhasil ditambahkan.');
        return redirect()->route('admin.jenis-sampah.index');
    }

    public function edit(JenisSampah $jenisSampah)
    {
        return response()->json($jenisSampah);
    }

    public function update(UpdateJenisSampahRequest $request, JenisSampah $jenisSampah)
    {
        $jenisSampah->update($request->validated());
        JenisSampah::clearCache();
        session()->flash('success', 'Jenis sampah berhasil diperbarui.');
        return redirect()->route('admin.jenis-sampah.index');
    }

    public function destroy(JenisSampah $jenisSampah)
    {
        if ($jenisSampah->namaSampah()->count() > 0) {
            session()->flash('error', 'Jenis sampah tidak dapat dihapus karena masih memiliki nama sampah.');
            return redirect()->route('admin.jenis-sampah.index');
        }
        $jenisSampah->delete();
        JenisSampah::clearCache();
        session()->flash('success', 'Jenis sampah berhasil dihapus.');
        return redirect()->route('admin.jenis-sampah.index');
    }

    public function toggle(JenisSampah $jenisSampah)
    {
        $jenisSampah->update(['aktif' => !$jenisSampah->aktif]);
        JenisSampah::clearCache();
        $status = $jenisSampah->aktif ? 'diaktifkan' : 'dinonaktifkan';
        session()->flash('success', "Jenis sampah berhasil {$status}.");
        return redirect()->route('admin.jenis-sampah.index');
    }
}
