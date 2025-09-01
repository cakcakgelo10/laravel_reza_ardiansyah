<?php 

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
use App\Models\RumahSakit;

class RumahSakitSeeder extends Seeder
{
    public function run(): void
    {
        RumahSakit::create(['nama_rs' => 'RS Harapan Bunda', 'alamat' => 'Jl. Sehat No. 1', 'email' => 'info@rshb.com', 'telepon' => '022123456']);
        RumahSakit::create(['nama_rs' => 'RS Medika Utama', 'alamat' => 'Jl. Sembuh No. 2', 'email' => 'kontak@rsmu.com', 'telepon' => '021789123']);
    }
}