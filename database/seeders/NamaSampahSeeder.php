<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampah;
use App\Models\NamaSampah;

class NamaSampahSeeder extends Seeder
{
    public function run(): void
    {
        $mapping = [
            'Plastik'    => ['Botol PET', 'Plastik HDPE', 'Kantong Plastik', 'Ember Plastik'],
            'Kertas'     => ['Kardus Bekas', 'Kertas HVS', 'Koran/Majalah'],
            'Kaca'       => ['Botol Kaca', 'Pecahan Kaca'],
            'Logam'      => ['Kaleng Aluminium', 'Besi Tua', 'Tembaga'],
            'Organik'    => ['Sisa Makanan', 'Daun Kering'],
            'Elektronik' => ['Baterai Bekas', 'Kabel Bekas'],
        ];

        foreach ($mapping as $jenis => $names) {
            $jenisSampah = JenisSampah::where('nama', $jenis)->first();
            foreach ($names as $nama) {
                NamaSampah::create(['jenis_sampah_id' => $jenisSampah->id, 'nama' => $nama]);
            }
        }
    }
}
