<?php

namespace Database\Seeders;

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

        User::create([
            'name' => 'Davin Chang',
            'email' => '19k10005@student.unika.ac.id',
            'password' => bcrypt('davin')
        ]);

        User::create([
            'name' => 'Davin 2',
            'email' => 'davinchang12@gmail.com',
            'password' => bcrypt('davin')
        ]);
        User::create([
            'name' => 'Jevon Carla',
            'email' => '19k10017@student.unika.ac.id',
            'password' => bcrypt('123')
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@unika.ac.id',
            'password' => bcrypt('admin')
        ]);
    }
}
