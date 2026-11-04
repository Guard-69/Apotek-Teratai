<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Staf;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Data contoh agar daftar, pencarian, dan pagination bisa diuji
        Pelanggan::factory()->count(12)->create();
        Staf::factory()->count(8)->create();
        Obat::factory()->count(15)->create();
    }
}
