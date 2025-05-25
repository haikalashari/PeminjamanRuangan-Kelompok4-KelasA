<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusRuangan>
 */
class StatusRuanganFactory extends Factory
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
            'status' => $this->faker->randomElement(['Tersedia', 'Dipinjam', 'Diperbaiki']),
            'created_at' => fake()->dateTimeThisMonth(),
            'updated_at' => fake()->dateTimeThisMonth(),
        ];
    }
}
