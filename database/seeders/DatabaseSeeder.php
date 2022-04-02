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

        // Matkul::factory(50)->create();
        Matkul::create([
            'kodematkul' => 'FKS011B11',
            'namamatkul' => 'Pendidikan Kedokteran dan Humaniora',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS021B12',
            'namamatkul' => 'Sel, Biomolekuler dan Jaringan',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS031B13',
            'namamatkul' => 'Sistem Kulit, Tulang dan Otot',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSO11B01',
            'namamatkul' => 'Keterampilan Klinik 1',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'UKS103',
            'namamatkul' => 'Kewarganegaraan',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKS042B21',
            'namamatkul' => 'Sistem Jantung, Pembuluh Darah dan Pernafasan',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS052B22',
            'namamatkul' => 'Sistem Saraf dan INdra',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS062B23',
            'namamatkul' => 'Sistem Gastrointestinal, Hepatobilier, Pankreas, Ginjal, Saluran Kemih dan Endokrin',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSO12B02',
            'namamatkul' => 'Keterampilan Klinik II',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'UKS102',
            'namamatkul' => 'Pancasila',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKS071B31',
            'namamatkul' => 'Siklus Hidup',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS081B32',
            'namamatkul' => 'Mekanisme Penyakit Dasar dan Penatalaksanaannya',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS091B33',
            'namamatkul' => 'Gangguan Sistem Endokrin dan Nutrisi',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSL031B03',
            'namamatkul' => 'Keterampilan Klinik III',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'UKS101',
            'namamatkul' => 'Religiusitas',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKS102B41',
            'namamatkul' => 'Gangguan Sistem Hemato-Imunologi',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS112B42',
            'namamatkul' => 'Gangguan Sistem Kulit, Tulang dan Otot',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS122B43',
            'namamatkul' => 'Gangguan Jantung, Pembuluh Darah dan Pernafasan',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSL042B04',
            'namamatkul' => 'Keterampilan Klinik IV',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FK101',
            'namamatkul' => 'Bahasa Inggris',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);
        


        Jadwal::factory(100)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@unika.ac.id',
            'password' =>  bcrypt('admin')
        ]);

    }
}
