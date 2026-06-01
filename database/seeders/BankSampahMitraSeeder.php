<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankSampahMitra;

class BankSampahMitraSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'BSM-001', 'nama' => 'Bank Sampah Hijau Lestari', 'ketua' => 'Ibu Siti Rahayu', 'alamat' => 'Jl. Mawar No. 5, Wates', 'telepon' => '081234567001'],
            ['kode' => 'BSM-002', 'nama' => 'Bank Sampah Bersih Sejahtera', 'ketua' => 'Bapak Ahmad Fauzi', 'alamat' => 'Jl. Melati No. 12, Wates', 'telepon' => '081234567002'],
            ['kode' => 'BSM-003', 'nama' => 'Bank Sampah Peduli Lingkungan', 'ketua' => 'Ibu Dewi Kusuma', 'alamat' => 'Jl. Kenanga No. 3, Wates', 'telepon' => '081234567003'],
            ['kode' => 'BSM-004', 'nama' => 'Bank Sampah Maju Bersama', 'ketua' => 'Bapak Hendra Susilo', 'alamat' => 'Jl. Dahlia No. 8, Wates', 'telepon' => '081234567004'],
            ['kode' => 'BSM-005', 'nama' => 'Bank Sampah Ceria Mandiri', 'ketua' => 'Ibu Yuni Astuti', 'alamat' => 'Jl. Anggrek No. 15, Wates', 'telepon' => '081234567005'],
        ];

        foreach ($data as $item) { BankSampahMitra::create($item); }
    }
}
