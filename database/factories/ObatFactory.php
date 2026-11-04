<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode_obat' => $this->faker->unique()->numerify('OBT-####'),
            'nama_obat' => $this->faker->randomElement([
                'Paracetamol 500 mg', 'Amoxicillin 500 mg', 'Ibuprofen 400 mg', 'Vitamin C 500 mg',
                'Antasida Doen', 'Cetirizine 10 mg', 'Loratadine 10 mg', 'Omeprazole 20 mg',
                'Metformin 500 mg', 'Salbutamol Sirup', 'Oralit', 'Betadine 30 ml',
            ]),
            'stok' => $this->faker->numberBetween(0, 200),
            'tanggal_kadaluarsa' => $this->faker->dateTimeBetween('-2 months', '+3 years')->format('Y-m-d'),
        ];
    }
}
