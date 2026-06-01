<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin TPS Wates',
            'email'    => 'admin@tps-wates.test',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);
    }
}
