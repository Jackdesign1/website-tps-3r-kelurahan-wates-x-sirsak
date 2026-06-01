<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPilah;
use App\Models\JenisSampah;
use App\Models\NamaSampah;
use App\Models\HargaSampah;
use App\Http\Requests\Admin\StoreHasilPilahRequest;
use App\Http\Requests\Admin\UpdateHasilPilahRequest;
use Illuminate\Support\Facades\DB;

class HasilPilahController extends Controller
{
    public function index()
    {
        $bulan  = request('bulan', now()->month);
        $tahun  = request('tahun', now()->year);
        $jenis  = request('jenis_id', '');

        $query = HasilPilah::with(['namaSampah.jenisSampah'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderByDesc('tanggal')->orderByDesc('id');

        if ($jenis) {
            $query->whereHas('namaSampah', fn($q) => $q->where('jenis_sampah_id', $jenis));
        }

        $data        = $query->paginate(20)->withQueryString();
        $jenisList   = JenisSampah::aktif()->orderBy('nama')->get();
        $totalBerat  = HasilPilah::bulan($bulan, $tahun)->sum('berat_kg');
        $totalNilai  = HasilPilah::bulan($bulan, $tahun)->sum('total_harga');

        return view('admin.hasil-pilah.index', compact('data','jenisList','totalBerat','totalNilai','bulan','tahun','jenis'));
    }

    public function create()
    {
        $jenisList = JenisSampah::aktif()->orderBy('nama')->get();
        return view('admin.hasil-pilah.create', compact('jenisList'));
    }

    public function store(StoreHasilPilahRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated) {
                foreach ($validated['items'] as $item) {
                    // Re-fetch harga dari DB, jangan percaya client
                    $harga = HargaSampah::where('nama_sampah_id', $item['nama_sampah_id'])
                        ->where('aktif', true)->first();

                    $hargaPerKg = $harga ? $harga->harga_per_kg : 0;
                    $totalHarga = $hargaPerKg * $item['berat_kg'];

                    HasilPilah::create([
                        'tanggal'        => $validated['tanggal'],
                        'nama_sampah_id' => $item['nama_sampah_id'],
                        'berat_kg'       => $item['berat_kg'],
                        'harga_per_kg'   => $hargaPerKg,
                        'total_harga'    => $totalHarga,
                        'user_id'        => auth()->id(),
                    ]);
                }
            });

            session()->flash('success', 'Data hasil pilah berhasil disimpan (' . count($validated['items']) . ' item).');
        } catch (\Throwable $e) {
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('admin.hasil-pilah.index');
    }

    public function edit(HasilPilah $hasilPilah)
    {
        return response()->json($hasilPilah->load('namaSampah.jenisSampah'));
    }

    public function update(UpdateHasilPilahRequest $request, HasilPilah $hasilPilah)
    {
        $harga = HargaSampah::where('nama_sampah_id', $request->nama_sampah_id)
            ->where('aktif', true)->first();

        $hargaPerKg = $harga ? $harga->harga_per_kg : $hasilPilah->harga_per_kg;
        $totalHarga = $hargaPerKg * $request->berat_kg;

        $hasilPilah->update([
            'tanggal'        => $request->tanggal,
            'nama_sampah_id' => $request->nama_sampah_id,
            'berat_kg'       => $request->berat_kg,
            'harga_per_kg'   => $hargaPerKg,
            'total_harga'    => $totalHarga,
        ]);

        session()->flash('success', 'Data hasil pilah berhasil diperbarui.');
        return redirect()->route('admin.hasil-pilah.index');
    }

    public function destroy(HasilPilah $hasilPilah)
    {
        $hasilPilah->delete();
        session()->flash('success', 'Data hasil pilah berhasil dihapus.');
        return redirect()->route('admin.hasil-pilah.index');
    }
}
