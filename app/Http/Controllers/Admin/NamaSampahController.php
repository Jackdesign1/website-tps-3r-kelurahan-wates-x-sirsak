<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NamaSampah;
use App\Models\JenisSampah;
use App\Http\Requests\Admin\StoreNamaSampahRequest;

class NamaSampahController extends Controller
{
    public function index()
    {
        $data = NamaSampah::with('jenisSampah')->orderBy('nama')->paginate(20);
        $jenisList = JenisSampah::aktif()->orderBy('nama')->get();
        return view('admin.master.nama-sampah.index', compact('data', 'jenisList'));
    }

    public function store(StoreNamaSampahRequest $request)
    {
        NamaSampah::create($request->validated());
        session()->flash('success', 'Nama sampah berhasil ditambahkan.');
        return redirect()->route('admin.nama-sampah.index');
    }

    public function edit(NamaSampah $namaSampah)
    {
        return response()->json($namaSampah->load('jenisSampah'));
    }

    public function update(StoreNamaSampahRequest $request, NamaSampah $namaSampah)
    {
        $namaSampah->update($request->validated());
        session()->flash('success', 'Nama sampah berhasil diperbarui.');
        return redirect()->route('admin.nama-sampah.index');
    }

    public function destroy(NamaSampah $namaSampah)
    {
        if ($namaSampah->hasilPilah()->count() > 0) {
            session()->flash('error', 'Nama sampah tidak dapat dihapus karena sudah digunakan dalam data hasil pilah.');
            return redirect()->route('admin.nama-sampah.index');
        }
        $namaSampah->delete();
        session()->flash('success', 'Nama sampah berhasil dihapus.');
        return redirect()->route('admin.nama-sampah.index');
    }

    public function toggle(NamaSampah $namaSampah)
    {
        $namaSampah->update(['aktif' => !$namaSampah->aktif]);
        $status = $namaSampah->aktif ? 'diaktifkan' : 'dinonaktifkan';
        session()->flash('success', "Nama sampah berhasil {$status}.");
        return redirect()->route('admin.nama-sampah.index');
    }
}
