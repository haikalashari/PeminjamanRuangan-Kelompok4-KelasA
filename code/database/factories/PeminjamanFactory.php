<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ruangan_id' => $this->faker->numberBetween(1, 20),
            'mahasiswa_nim' => Mahasiswa::factory(),
            // 'tgl_mulai' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'tgl_mulai' => $this->faker->dateTimeBetween('first day of this month', 'last day of this month')->format('Y-m-d H:i:s'),
            'tgl_selesai' => $this->faker->dateTimeBetween('first day of this month', 'last day of this month')->format('Y-m-d H:i:s'),
            'jam_mulai' => $this->faker->time(),
            'jam_selesai' => $this->faker->time(),
            'tujuan' => $this->faker->sentence(),

        ];
    }
}
