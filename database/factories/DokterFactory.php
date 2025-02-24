<?php

namespace Database\Factories;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idDokter' => strtoupper($this->faker->unique()->lexify('DOK-???')),
            'namaDokter' => $this->faker->name,
            'tanggalLahir' => $this->faker->date(),
            'spesialisasi' => $this->faker->randomElement([
                'Poli Umum', 'Poli Bedah', 'Poli Kardiologi', 'Poli Ortopedi', 'Poli Pediatri', 'Poli Gigi', 'Poli Saraf'
            ]),
            'lokasiPraktik' => function () {
                $ruangan = Ruangan::inRandomOrder()->first();
                return $ruangan ? $ruangan->namaRuangan : 'Ruangan Default';
            },
            'jamPraktik' => $this->faker->randomElement([
                '08:00 - 12:00', '13:00 - 17:00', '18:00 - 22:00'
            ]),
        ];
    }
}
