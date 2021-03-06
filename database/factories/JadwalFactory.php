<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    // $table->foreignId('user_id');
    // $table->foreignId('matkul_id');
    // $table->dateTime('tanggal');
    // $table->time('jammasuk');
    // $table->time('jamselesai');
    // $table->text('ruangan')->nullable();
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'matkul_id' => $this->faker->numberBetween(1, 53),
            'tanggal' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'jammasuk' => $this->faker->time(),
            'jamselesai' => $this->faker->time(),
            'ruangan' => 'R' . $this->faker->numberBetween(1, 5)
        ];
    }
}
