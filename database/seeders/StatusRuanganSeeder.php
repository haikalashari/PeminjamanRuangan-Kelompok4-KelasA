<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusRuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_ruangan')->insert([
            ['ruangan_id' => 1, 'status' => 'tidak tersedia'],
            ['ruangan_id' => 2, 'status' => 'tidak tersedia'],
            ['ruangan_id' => 3, 'status' => 'tidak tersedia'],
            ['ruangan_id' => 4, 'status' => 'tersedia'],
            ['ruangan_id' => 5, 'status' => 'diperbaiki'],
        ]);
    }
}
