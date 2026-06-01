<?php
namespace App\Http\Controllers;

use App\Models\InfoTps;
use App\Models\TpsMasuk;
use App\Models\HasilPilah;
use App\Models\JenisSampah;
use App\Models\BankSampahMitra;
use App\Models\Galeri;
use App\Models\HargaSampah;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        $info         = InfoTps::getInstance();
        $totalMasuk   = TpsMasuk::sum('total_kg');
        $totalPilah   = HasilPilah::sum('berat_kg');
        $totalNilai   = HasilPilah::sum('total_harga');
        $jumlahMitra  = BankSampahMitra::aktif()->count();
        $recentGaleri = Galeri::orderBy('urutan')->orderByDesc('tanggal')->limit(6)->get();

        $recentMasuk = TpsMasuk::select(['tanggal','total_kg'])
            ->orderByDesc('tanggal')->limit(5)->get();

        return view('public.index', compact('info','totalMasuk','totalPilah','totalNilai','jumlahMitra','recentGaleri','recentMasuk'));
    }

    public function profil()
    {
        $info = InfoTps::getInstance();
        return view('public.profil', compact('info'));
    }

    public function dataSampah()
    {
        $bulan = intval(request('bulan', now()->month));
        if ($bulan < 1 || $bulan > 12) {
            $bulan = now()->month;
        }
        $tahun = intval(request('tahun', now()->year));

        $masuk = TpsMasuk::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->select(['tanggal','total_kg','keterangan'])
            ->orderByDesc('tanggal')->paginate(15)->withQueryString();

        $pilahPerJenis = DB::select("
            SELECT j.nama, j.warna, SUM(hp.berat_kg) as total_berat, SUM(hp.total_harga) as total_nilai
            FROM hasil_pilah hp
            JOIN nama_sampah ns ON hp.nama_sampah_id = ns.id
            JOIN jenis_sampah j ON ns.jenis_sampah_id = j.id
            WHERE YEAR(hp.tanggal) = ? AND MONTH(hp.tanggal) = ?
            GROUP BY j.id, j.nama, j.warna
            ORDER BY total_berat DESC
        ", [$tahun, $bulan]);

        $hargaList = HargaSampah::aktif()
            ->with(['namaSampah.jenisSampah'])
            ->orderBy('harga_per_kg', 'desc')
            ->get();

        return view('public.data-sampah', compact('masuk','pilahPerJenis','hargaList','bulan','tahun'));
    }

    public function bankSampah()
    {
        $mitra = BankSampahMitra::aktif()->orderBy('nama')->get();
        return view('public.bank-sampah', compact('mitra'));
    }

    public function galeri()
    {
        $galeri = Galeri::orderBy('urutan')->orderByDesc('tanggal')->paginate(12);
        return view('public.galeri', compact('galeri'));
    }
}
