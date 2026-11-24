<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Kasir
        User::create([
            'name' => 'Kasir Laundry',
            'email' => 'kasir@laundry.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        // 3. Buat Data Layanan Laundry Utama[cite: 1]
        Layanan::create([
            'nama_layanan' => 'Reguler',
            'harga_per_kg' => 7000,
            'estimasi_waktu' => '3-4 hari',
        ]);

        Layanan::create([
            'nama_layanan' => 'Ekspres',
            'harga_per_kg' => 12000,
            'estimasi_waktu' => '1-2 hari',
        ]);

        Layanan::create([
            'nama_layanan' => 'Superkilat',
            'harga_per_kg' => 25000,
            'estimasi_waktu' => '5 jam selesai',
        ]);
    }
}