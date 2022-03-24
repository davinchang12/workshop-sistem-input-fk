<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Kelompok;
use App\Models\Matkul;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory(10)->create();
        Nilai::factory(50)->create();
        Matkul::factory(50)->create();

        Jadwal::factory(50)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@unika.ac.id',
            'password' =>  bcrypt('admin')
        ]);

    }
}
