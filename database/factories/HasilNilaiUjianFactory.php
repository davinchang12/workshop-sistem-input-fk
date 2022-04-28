<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HasilNilaiUjianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nilai_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
