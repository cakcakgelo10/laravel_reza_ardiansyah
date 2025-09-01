<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        Pasien::create(['nama_pasien' => 'Budi Santoso', 'alamat' => 'Jl. Mawar No. 10', 'telepon' => '081234567890', 'rumah_sakit_id' => 1]);
        Pasien::create(['nama_pasien' => 'Siti Aminah', 'alamat' => 'Jl. Melati No. 5', 'telepon' => '087654321098', 'rumah_sakit_id' => 2]);
        Pasien::create(['nama_pasien' => 'Joko Susilo', 'alamat' => 'Jl. Kamboja No. 12', 'telepon' => '081112233445', 'rumah_sakit_id' => 1]);
    }
}