<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangan')->insert([
            ['nama' => 'INF-1', 'kapasitas' => 10],
            ['nama' => 'INF-2', 'kapasitas' => 15],
            ['nama' => 'INF-3', 'kapasitas' => 20],
            ['nama' => 'INF-4', 'kapasitas' => 25],
            ['nama' => 'INF-5', 'kapasitas' => 10],
        ]);
    }
}
