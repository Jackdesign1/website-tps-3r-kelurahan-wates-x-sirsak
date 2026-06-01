<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NamaSampah;
use App\Models\HargaSampah;

class HargaSampahSeeder extends Seeder
{
    public function run(): void
    {
        $harga = [
            'Botol PET'         => 3500,
            'Plastik HDPE'      => 2000,
            'Kantong Plastik'   => 500,
            'Ember Plastik'     => 1500,
            'Kardus Bekas'      => 1800,
            'Kertas HVS'        => 1200,
            'Koran/Majalah'     => 800,
            'Botol Kaca'        => 600,
            'Pecahan Kaca'      => 200,
            'Kaleng Aluminium'  => 12000,
            'Besi Tua'          => 3000,
            'Tembaga'           => 65000,
            'Sisa Makanan'      => 100,
            'Daun Kering'       => 50,
            'Baterai Bekas'     => 500,
            'Kabel Bekas'       => 8000,
        ];

        foreach ($harga as $nama => $hargaPerKg) {
            $namaSampah = NamaSampah::where('nama', $nama)->first();
            if ($namaSampah) {
                HargaSampah::create(['nama_sampah_id' => $namaSampah->id, 'harga_per_kg' => $hargaPerKg]);
            }
        }
    }
}
