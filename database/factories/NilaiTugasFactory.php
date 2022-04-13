<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiTugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rincian_nilai_tugas_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
