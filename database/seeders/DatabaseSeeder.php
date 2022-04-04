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

        // User::factory(50)->create();
        User::create([
            'name' => 'Admin',
            'role' => 'superadmin',
            'email' => 'admin@unika.ac.id',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'A',
            'role' => 'mahasiswa',
            'email' => '21p10001@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'B',
            'role' => 'mahasiswa',
            'email' => '21p10002@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'C',
            'role' => 'mahasiswa',
            'email' => '21p10003@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'D',
            'role' => 'mahasiswa',
            'email' => '21p10010@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'E',
            'role' => 'mahasiswa',
            'email' => '21p10011@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'F',
            'role' => 'mahasiswa',
            'email' => '19p10001@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'G',
            'role' => 'mahasiswa',
            'email' => '19p10002@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'dr. A',
            'role' => 'dosen',
            'email' => 'dosen1@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        User::create([
            'name' => 'dr. B',
            'role' => 'dosen',
            'email' => 'dosen2@unika.ac.id',
            'password' =>  bcrypt('password')
        ]);

        // Nilai::factory(50)->create();
        Nilai::create([
            'user_id' => 2,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 1,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 2,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 1,
            'nilai_mhs' => 90
        ]);

        Nilai::create([
            'user_id' => 3,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 1,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 3,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 1,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 4,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 1,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 4,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 1,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 5,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 5,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 6,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 6,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 7,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 7,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 8,
            'keterangan' => 'Tugas 1',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

        Nilai::create([
            'user_id' => 8,
            'keterangan' => 'Tugas 2',
            'matkul_id' => 2,
            'nilai_mhs' => 85
        ]);

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

        Matkul::create([
            'kodematkul' => 'FKS131B51',
            'namamatkul' => 'Gangguan Sistem Saraf dan Psikiatri',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);
        
        Matkul::create([
            'kodematkul' => 'FKS141B52',
            'namamatkul' => 'Gangguan Sistem Gastrointestinal dan Bilier',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS151B53',
            'namamatkul' => 'Gangguan Sistem Indera',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSL051B05',
            'namamatkul' => 'Keterampilan Klinik V',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FK102',
            'namamatkul' => 'Metodologi Penelitian dan Etika Peneltian',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FK104',
            'namamatkul' => 'Bahasa Indonesia',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKS162B61',
            'namamatkul' => 'Gangguan Sistem Ginjal dan Saluran Kemih',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS172B62',
            'namamatkul' => 'Gangguan Sistem Reproduksi',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS182B63',
            'namamatkul' => 'Ilmu Kedokteran Keluarga dan Komunitas',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSL062B06',
            'namamatkul' => 'Keterampilan Klinik VI',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FK103',
            'namamatkul' => 'Statistika',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FK105',
            'namamatkul' => 'Skripsi',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 4
        ]);

        Matkul::create([
            'kodematkul' => 'FKS191B71',
            'namamatkul' => 'Kedokteran DTPK',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS201B72',
            'namamatkul' => 'Kegawatdaruratan dan Medikolegal',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKS211B73',
            'namamatkul' => 'Elektif',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKSL071B01',
            'namamatkul' => 'Keterampilan Klinik VII',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'UKS410',
            'namamatkul' => 'KKN',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKD501',
            'namamatkul' => 'Ilmu Penyakit Dalam',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKB502',
            'namamatkul' => 'Ilmu Bedah',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKA503',
            'namamatkul' => 'Ilmu Kesehatan Anak',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKOG505',
            'namamatkul' => 'Ilmu Kebidanan dan Penyakit Kandungan',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKS301',
            'namamatkul' => 'Ilmu Penyakit Saraf',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKJ302',
            'namamatkul' => 'Ilmu Kesehatan Jiwa',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKDV303',
            'namamatkul' => 'Ilmu Kesehatan Kulit dan Kelamin',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKM304',
            'namamatkul' => 'Ilmu Kesehatan Mata',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKT305',
            'namamatkul' => 'Ilmu Kesehatan THT-KL',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKSA201',
            'namamatkul' => 'Anestesiologi dan Terapi Intensif',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKF306',
            'namamatkul' => 'Ilmu Kedokteran Forensik dan Medikolegal',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKR202',
            'namamatkul' => 'Ilmu Radiologi',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 2
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKRM203',
            'namamatkul' => 'Ilmu Kedokteran Fisik dan Rehabilitasi',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKGK101',
            'namamatkul' => 'Ilmu Gizi Klinik',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 1
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKPK102',
            'namamatkul' => 'Ilmu Patologi Klinik',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 1
        ]);

        Matkul::create([
            'kodematkul' => 'FKKKKM307',
            'namamatkul' => 'Ilmu Kesehatan Masyarakat',
            'keterangan' => 'Tahap Profesi',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 3
        ]);

        // Jadwal::factory(100)->create();
        // Kelompok::factory(50)->create();
    }
}
