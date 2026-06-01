<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekapBankSampah;
use App\Models\BankSampahMitra;
use App\Models\JenisSampah;
use App\Models\HargaSampah;
use App\Http\Requests\Admin\StoreRekapBankSampahRequest;

class RekapBankSampahController extends Controller
{
    public function index()
    {
        $bulan  = request('bulan', now()->month);
        $tahun  = request('tahun', now()->year);

        $data = RekapBankSampah::with(['bankSampahMitra','namaSampah.jenisSampah'])
            ->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->paginate(20)->withQueryString();

        $mitraList = BankSampahMitra::aktif()->orderBy('nama')->get();
        $jenisList = JenisSampah::aktif()->with(['namaSampah' => fn($q) => $q->aktif()])->orderBy('nama')->get();
        $totalNilai = RekapBankSampah::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->sum('total_harga');

        return view('admin.rekap-bank-sampah.index', compact('data','mitraList','jenisList','totalNilai','bulan','tahun'));
    }

    public function create()
    {
        $mitraList = BankSampahMitra::aktif()->orderBy('nama')->get();
        $jenisList = JenisSampah::aktif()->with(['namaSampah' => fn($q) => $q->aktif()])->orderBy('nama')->get();
        
        return view('admin.rekap-bank-sampah.create', compact('mitraList', 'jenisList'));
    }

    public function store(StoreRekapBankSampahRequest $request)
    {
        $harga = HargaSampah::where('nama_sampah_id', $request->nama_sampah_id)->where('aktif', true)->first();
        $hargaPerKg = $harga ? $harga->harga_per_kg : 0;

        RekapBankSampah::create([
            ...$request->validated(),
            'harga_per_kg' => $hargaPerKg,
            'total_harga'  => $hargaPerKg * $request->berat_kg,
            'user_id'      => auth()->id(),
        ]);

        session()->flash('success', 'Rekap bank sampah berhasil ditambahkan.');
        return redirect()->route('admin.rekap-bank-sampah.index');
    }

    public function edit(RekapBankSampah $rekapBankSampah)
    {
        return response()->json($rekapBankSampah->load(['bankSampahMitra','namaSampah.jenisSampah']));
    }

    public function update(StoreRekapBankSampahRequest $request, RekapBankSampah $rekapBankSampah)
    {
        $harga = HargaSampah::where('nama_sampah_id', $request->nama_sampah_id)->where('aktif', true)->first();
        $hargaPerKg = $harga ? $harga->harga_per_kg : $rekapBankSampah->harga_per_kg;

        $rekapBankSampah->update([
            ...$request->validated(),
            'harga_per_kg' => $hargaPerKg,
            'total_harga'  => $hargaPerKg * $request->berat_kg,
        ]);

        session()->flash('success', 'Rekap bank sampah berhasil diperbarui.');
        return redirect()->route('admin.rekap-bank-sampah.index');
    }

    public function destroy(RekapBankSampah $rekapBankSampah)
    {
        $rekapBankSampah->delete();
        session()->flash('success', 'Rekap bank sampah berhasil dihapus.');
        return redirect()->route('admin.rekap-bank-sampah.index');
    }
}
