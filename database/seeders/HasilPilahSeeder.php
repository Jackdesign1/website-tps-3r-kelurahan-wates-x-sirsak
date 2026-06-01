<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HasilPilah;
use App\Models\NamaSampah;
use App\Models\HargaSampah;
use App\Models\User;

class HasilPilahSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;
        $namaSampahList = NamaSampah::with('hargaSampah')->get();

        for ($i = 9; $i >= 0; $i--) {
            $namaSampah = $namaSampahList->random();
            $harga = $namaSampah->hargaSampah;
            $hargaPerKg = $harga ? $harga->harga_per_kg : 0;
            $berat = rand(5, 100) + (rand(0, 99) / 100);

            HasilPilah::create([
                'tanggal'        => now()->subDays($i)->format('Y-m-d'),
                'nama_sampah_id' => $namaSampah->id,
                'berat_kg'       => $berat,
                'harga_per_kg'   => $hargaPerKg,
                'total_harga'    => $hargaPerKg * $berat,
                'user_id'        => $userId,
            ]);
        }
    }
}
