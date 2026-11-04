<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staf>
 */
class StafFactory extends Factory
{
    public function definition(): array
    {
        $kota = $this->faker->randomElement(['Lhokseumawe', 'Banda Aceh', 'Langsa', 'Sigli', 'Bireuen', 'Lhoksukon', 'Takengon', 'Meulaboh']);

        return [
            'nama' => $this->faker->name(),
            'alamat' => 'Jl. ' . $this->faker->streetName() . ' No. ' . $this->faker->numberBetween(1, 99) . ', ' . $kota,
            'tanggal_lahir' => $this->faker->dateTimeBetween('-45 years', '-22 years')->format('Y-m-d'),
            'tempat_lahir' => $this->faker->randomElement(['Lhokseumawe', 'Banda Aceh', 'Langsa', 'Sigli', 'Bireuen', 'Lhoksukon', 'Takengon', 'Meulaboh']),
            'no_hp' => $this->faker->numerify('08##########'),
        ];
    }
}
