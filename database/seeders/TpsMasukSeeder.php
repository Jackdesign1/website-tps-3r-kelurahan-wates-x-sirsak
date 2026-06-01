<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TpsMasuk;
use App\Models\User;

class TpsMasukSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;
        $data = [];
        for ($i = 9; $i >= 0; $i--) {
            $data[] = [
                'tanggal'    => now()->subDays($i)->format('Y-m-d'),
                'total_kg'   => rand(200, 800) + (rand(0, 99) / 100),
                'keterangan' => 'Sampah masuk dari warga sekitar',
                'user_id'    => $userId,
            ];
        }
        foreach ($data as $item) { TpsMasuk::create($item); }
    }
}
