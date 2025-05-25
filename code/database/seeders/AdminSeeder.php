<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = User::whereNull('nim')->get();

        foreach ($admins as $user) {
            Admin::create([
                'user_id' => $user->id,
                'approved_at' => now(),
            ]);
        }
    }
}
