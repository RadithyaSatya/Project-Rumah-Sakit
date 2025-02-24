<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ruangan>
 */
class RuanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kodeRuangan' => strtoupper($this->faker->unique()->lexify('R-???')),
            'namaRuangan' => $this->faker->sentence(2),
            'dayaTampung' => $this->faker->numberBetween(10, 100),
            'lokasi' => $this->faker->address,
        ];
    }
}
