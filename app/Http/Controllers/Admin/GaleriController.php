<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Http\Requests\Admin\StoreGaleriRequest;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $data = Galeri::orderBy('urutan')->orderByDesc('tanggal')->paginate(20);
        return view('admin.galeri.index', compact('data'));
    }

    public function store(StoreGaleriRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
            $data['url_foto'] = $path;
        }

        $data['urutan'] = $data['urutan'] ?? 0;
        Galeri::create($data);

        session()->flash('success', 'Foto galeri berhasil ditambahkan.');
        return redirect()->route('admin.galeri.index');
    }

    public function edit(Galeri $galeri)
    {
        return response()->json($galeri);
    }

    public function update(StoreGaleriRequest $request, Galeri $galeri)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan URL eksternal
            if (!str_starts_with($galeri->url_foto, 'http')) {
                Storage::disk('public')->delete($galeri->url_foto);
            }
            $path = $request->file('foto')->store('galeri', 'public');
            $data['url_foto'] = $path;
        } elseif (empty($data['url_foto'])) {
            unset($data['url_foto']);
        }

        $data['urutan'] = $data['urutan'] ?? 0;
        $galeri->update($data);

        session()->flash('success', 'Foto galeri berhasil diperbarui.');
        return redirect()->route('admin.galeri.index');
    }

    public function destroy(Galeri $galeri)
    {
        if (!str_starts_with($galeri->url_foto, 'http')) {
            Storage::disk('public')->delete($galeri->url_foto);
        }
        $galeri->delete();
        session()->flash('success', 'Foto galeri berhasil dihapus.');
        return redirect()->route('admin.galeri.index');
    }
}
