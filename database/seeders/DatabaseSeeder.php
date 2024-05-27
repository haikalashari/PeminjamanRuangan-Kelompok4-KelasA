<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Models\StatusRuangan;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdminSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\RuanganSeeder;
use Database\Seeders\MahasiswaSeeder;
use Database\Seeders\PeminjamanSeeder;
use Database\Seeders\StatusRuanganSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            MahasiswaSeeder::class,
            AdminSeeder::class,
            RuanganSeeder::class,
            StatusRuanganSeeder::class,
            PeminjamanSeeder::class
        ]);

        User::factory(10)->create();
        Ruangan::factory(20)->create();
        StatusRuangan::factory(20)->create();
        Mahasiswa::factory(10)->create();
        Peminjaman::factory(10)->create();
        
    }
}
