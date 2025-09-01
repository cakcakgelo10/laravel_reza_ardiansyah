<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user lama jika ada (opsional, tapi bagus untuk konsistensi)
        User::truncate();

        // Buat user baru
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => Hash::make('password'), // Passwordnya adalah "password"
        ]);
    }
}