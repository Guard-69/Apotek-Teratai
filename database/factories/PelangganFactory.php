<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    public function definition(): array
    {
        $kota = $this->faker->randomElement(['Lhokseumawe', 'Banda Aceh', 'Langsa', 'Sigli', 'Bireuen', 'Lhoksukon', 'Takengon', 'Meulaboh']);

        return [
            'nama' => $this->faker->name(),
            'alamat' => 'Jl. ' . $this->faker->streetName() . ' No. ' . $this->faker->numberBetween(1, 99) . ', ' . $kota,
            'no_hp' => $this->faker->numerify('08##########'),
        ];
    }
}
