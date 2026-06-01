<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TpsMasuk;
use App\Models\HasilPilah;
use App\Models\JenisSampah;
use App\Models\BankSampahMitra;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Stat cards — efficient aggregate queries
        $sampahMasukHariIni = TpsMasuk::whereDate('tanggal', $today)->sum('total_kg');
        $totalHasilPilah    = HasilPilah::sum('berat_kg');
        $totalNilai         = HasilPilah::sum('total_harga');
        $jumlahJenis        = JenisSampah::aktif()->count();
        $jumlahMitra        = BankSampahMitra::aktif()->count();

        // Bar chart: hasil pilah per jenis sampah (bulan ini)
        $chartPilahPerJenis = DB::select("
            SELECT j.nama, j.warna, SUM(hp.berat_kg) as total_berat
            FROM hasil_pilah hp
            JOIN nama_sampah ns ON hp.nama_sampah_id = ns.id
            JOIN jenis_sampah j ON ns.jenis_sampah_id = j.id
            WHERE hp.tanggal >= DATE_FORMAT(NOW(), '%Y-%m-01')
            GROUP BY j.id, j.nama, j.warna
            ORDER BY total_berat DESC
        ");

        // Line chart: tren sampah masuk 7 hari terakhir
        $trendMasuk = DB::select("
            SELECT DATE(tanggal) as tgl, SUM(total_kg) as total
            FROM tps_masuk
            WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY DATE(tanggal)
            ORDER BY tgl ASC
        ");

        // 5 data terbaru
        $recentMasuk = TpsMasuk::with('user')
            ->select(['id','tanggal','total_kg','keterangan','user_id'])
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->limit(5)->get();

        $recentPilah = HasilPilah::with(['namaSampah.jenisSampah'])
            ->select(['id','tanggal','nama_sampah_id','berat_kg','total_harga'])
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->limit(5)->get();

        return view('admin.dashboard.index', compact(
            'sampahMasukHariIni','totalHasilPilah','totalNilai',
            'jumlahJenis','jumlahMitra',
            'chartPilahPerJenis','trendMasuk',
            'recentMasuk','recentPilah'
        ));
    }
}
