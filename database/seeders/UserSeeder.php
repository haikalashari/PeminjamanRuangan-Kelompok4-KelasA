<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Satu',
                'email' => 'admin1@example.com',
                'nim' => null,
                'password' => Hash::make('password1'),
            ],
            [
                'name' => 'Admin Dua',
                'email' => 'admin2@example.com',
                'nim' => null,
                'password' => Hash::make('password2'),
            ],
            [
                'name' => 'Admin Tiga',
                'email' => 'admin3@example.com',
                'nim' => null,
                'password' => Hash::make('password3'),
            ],
            [
                'name' => 'Budi',
                'email' => 'budi@gmail.com',
                'nim' => 'D1041221001',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Cikal',
                'email' => 'cikal@gmail.com',
                'nim' => 'D1041221002',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Fikri',
                'email' => 'fikri@gmail.com',
                'nim' => 'D1041221003',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Zaim',
                'email' => 'zaim@gmail.com',
                'nim' => 'D1041221004',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Rifkal',
                'email' => 'rifkal@gmail.com',
                'nim' => 'D1041221005',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Tirta',
                'email' => 'tirta@gmail.com',
                'nim' => 'D1041221006',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Danil',
                'email' => 'danil@gmail.com',
                'nim' => 'D1041221007',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Bintang',
                'email' => 'bintang@gmail.com',
                'nim' => 'D1041221008',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Fadil',
                'email' => 'fadil@gmail.com',
                'nim' => 'D1041221009',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Raden',
                'email' => 'raden@gmail.com',
                'nim' => 'D1041221010',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
