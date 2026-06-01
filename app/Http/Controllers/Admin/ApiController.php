<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NamaSampah;
use App\Models\HargaSampah;

class ApiController extends Controller
{
    public function namaSampah()
    {
        $jenisId = request('jenis_id');
        if (!$jenisId) return response()->json([]);

        $data = NamaSampah::aktif()
            ->where('jenis_sampah_id', $jenisId)
            ->select(['id','nama'])
            ->orderBy('nama')
            ->get();

        return response()->json($data);
    }

    public function hargaSampah()
    {
        $namaId = request('nama_id');
        if (!$namaId) return response()->json(null);

        $harga = HargaSampah::where('nama_sampah_id', $namaId)
            ->where('aktif', true)
            ->select(['id','nama_sampah_id','harga_per_kg'])
            ->first();

        return response()->json($harga);
    }
}
