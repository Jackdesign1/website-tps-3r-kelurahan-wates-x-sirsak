<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TpsMasuk;
use App\Http\Requests\Admin\StoreTpsMasukRequest;
use App\Http\Requests\Admin\UpdateTpsMasukRequest;

class TpsMasukController extends Controller
{
    public function index()
    {
        $bulan = request('bulan', now()->month);
        $tahun = request('tahun', now()->year);
        $search = request('search', '');

        $query = TpsMasuk::with('user')
            ->select(['id','tanggal','total_kg','keterangan','user_id','created_at'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderByDesc('tanggal')->orderByDesc('id');

        if ($search) {
            $query->where('keterangan', 'like', "%{$search}%");
        }

        $data       = $query->paginate(20)->withQueryString();
        $totalBulan = TpsMasuk::bulan($bulan, $tahun)->sum('total_kg');

        return view('admin.tps-masuk.index', compact('data', 'totalBulan', 'bulan', 'tahun', 'search'));
    }

    public function store(StoreTpsMasukRequest $request)
    {
        TpsMasuk::create([
            ...$request->validated(),
            'keterangan' => strip_tags($request->keterangan ?? ''),
            'user_id'    => auth()->id(),
        ]);

        session()->flash('success', 'Data sampah masuk berhasil ditambahkan.');
        return redirect()->route('admin.tps-masuk.index');
    }

    public function edit(TpsMasuk $tpsMasuk)
    {
        return response()->json($tpsMasuk);
    }

    public function update(UpdateTpsMasukRequest $request, TpsMasuk $tpsMasuk)
    {
        $tpsMasuk->update([
            ...$request->validated(),
            'keterangan' => strip_tags($request->keterangan ?? ''),
        ]);

        session()->flash('success', 'Data sampah masuk berhasil diperbarui.');
        return redirect()->route('admin.tps-masuk.index');
    }

    public function destroy(TpsMasuk $tpsMasuk)
    {
        $tpsMasuk->delete();
        session()->flash('success', 'Data sampah masuk berhasil dihapus.');
        return redirect()->route('admin.tps-masuk.index');
    }
}
