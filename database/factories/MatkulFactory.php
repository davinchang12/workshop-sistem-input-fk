<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MatkulFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'namamatkul' => 'matkul ' . $this->faker->numberBetween(1,8),
            'keterangan' => 'matkul ke-' . $this->faker->numberBetween(1,8),
            'tahun_ajaran' => $this->faker->randomElement(['2021/2022', '2020/2021', '2019/2020'])
        ];
    }
}
