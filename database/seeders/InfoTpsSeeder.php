<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InfoTps;

class InfoTpsSeeder extends Seeder
{
    public function run(): void
    {
        InfoTps::create([
            'nama'            => 'TPS Kelurahan Wates',
            'kelurahan'       => 'Wates',
            'kota'            => 'Mojokerto',
            'alamat'          => 'Jl. Raya Wates No. 12, Kelurahan Wates, Kota Mojokerto',
            'telepon'         => '0321-123456',
            'email'           => 'tps.wates@mojokerto.go.id',
            'jam_operasional' => 'Senin–Sabtu, 07.00–16.00 WIB',
            'kepala_tps'      => 'Bapak Slamet Raharjo',
            'deskripsi'       => 'TPS Kelurahan Wates adalah tempat penampungan sampah sementara yang melayani warga Kelurahan Wates dan sekitarnya. Kami berkomitmen mengelola sampah secara bertanggung jawab dengan sistem pilah dan daur ulang untuk menjaga kebersihan lingkungan Kota Mojokerto.',
            'berdiri_sejak'   => 2015,
        ]);
    }
}
