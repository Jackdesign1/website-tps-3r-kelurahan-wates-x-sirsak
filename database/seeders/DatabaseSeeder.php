<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            InfoTpsSeeder::class,
            JenisSampahSeeder::class,
            NamaSampahSeeder::class,
            HargaSampahSeeder::class,
            BankSampahMitraSeeder::class,
            TpsMasukSeeder::class,
            HasilPilahSeeder::class,
            GaleriSeeder::class,
        ]);
    }
}
