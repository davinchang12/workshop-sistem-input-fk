<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'keterangan' => 'tugas ' . $this->faker->numberBetween(1,8),
            'matkul_id' => $this->faker->numberBetween(1,53),
            'nilai_mhs' => $this->faker->numberBetween(60, 90)
        ];
    }
}
