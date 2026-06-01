<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Kegiatan Pilah Sampah Bersama Warga', 'urutan' => 1, 'w' => 800, 'h' => 600],
            ['judul' => 'Sosialisasi Pengelolaan Sampah Organik', 'urutan' => 2, 'w' => 800, 'h' => 600],
            ['judul' => 'Bank Sampah Bulanan', 'urutan' => 3, 'w' => 800, 'h' => 600],
            ['judul' => 'Pelatihan Daur Ulang Plastik', 'urutan' => 4, 'w' => 800, 'h' => 600],
            ['judul' => 'Gotong Royong Kebersihan TPS', 'urutan' => 5, 'w' => 800, 'h' => 600],
            ['judul' => 'Penyerahan Hasil Pilah ke Mitra', 'urutan' => 6, 'w' => 800, 'h' => 600],
        ];

        foreach ($data as $i => $item) {
            Galeri::create([
                'judul'     => $item['judul'],
                'deskripsi' => 'Dokumentasi kegiatan TPS Kelurahan Wates.',
                'url_foto'  => "https://picsum.photos/{$item['w']}/{$item['h']}?random=" . ($i + 1),
                'tanggal'   => now()->subDays($i * 7)->format('Y-m-d'),
                'urutan'    => $item['urutan'],
            ]);
        }
    }
}
