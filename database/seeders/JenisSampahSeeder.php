<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampah;

class JenisSampahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'PLT', 'nama' => 'Plastik',    'warna' => '#3b82f6'],
            ['kode' => 'KRT', 'nama' => 'Kertas',     'warna' => '#f59e0b'],
            ['kode' => 'KCA', 'nama' => 'Kaca',       'warna' => '#06b6d4'],
            ['kode' => 'LGM', 'nama' => 'Logam',      'warna' => '#6b7280'],
            ['kode' => 'ORG', 'nama' => 'Organik',    'warna' => '#16a34a'],
            ['kode' => 'ELK', 'nama' => 'Elektronik', 'warna' => '#dc2626'],
        ];

        foreach ($data as $item) {
            JenisSampah::create($item);
        }
    }
}
