<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaSampah;
use App\Models\NamaSampah;
use App\Http\Requests\Admin\StoreHargaSampahRequest;
use App\Http\Requests\Admin\UpdateHargaSampahRequest;

class HargaSampahController extends Controller
{
    public function index()
    {
        $data = HargaSampah::with(['namaSampah.jenisSampah'])->orderByDesc('updated_at')->paginate(20);
        $namaSampahList = NamaSampah::aktif()
            ->whereDoesntHave('hargaSampah')
            ->with('jenisSampah')->orderBy('nama')->get();
        return view('admin.master.harga-sampah.index', compact('data', 'namaSampahList'));
    }

    public function store(StoreHargaSampahRequest $request)
    {
        HargaSampah::create($request->validated());
        session()->flash('success', 'Harga sampah berhasil ditambahkan.');
        return redirect()->route('admin.harga-sampah.index');
    }

    public function edit(HargaSampah $hargaSampah)
    {
        return response()->json($hargaSampah->load('namaSampah.jenisSampah'));
    }

    public function update(UpdateHargaSampahRequest $request, HargaSampah $hargaSampah)
    {
        $hargaSampah->update($request->validated());
        session()->flash('success', 'Harga sampah berhasil diperbarui.');
        return redirect()->route('admin.harga-sampah.index');
    }

    public function destroy(HargaSampah $hargaSampah)
    {
        $hargaSampah->delete();
        session()->flash('success', 'Harga sampah berhasil dihapus.');
        return redirect()->route('admin.harga-sampah.index');
    }
}
