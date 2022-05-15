<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use App\Models\NilaiPBL;
use App\Models\JenisOSCE;
use App\Models\JenisSOCA;
use App\Models\NilaiLain;
use App\Models\NilaiOSCE;
use App\Models\NilaiSOCA;
use App\Models\NilaiTugas;
use App\Models\NilaiUjian;
use App\Models\FeedbackUAB;
use App\Models\FeedbackUTB;
use App\Models\FeedbackUjian;
use App\Models\NilaiFieldlab;
use App\Models\NilaiJenisOSCE;
use App\Models\NilaiJenisSOCA;
use App\Models\HasilNilaiUjian;
use Illuminate\Database\Seeder;
use App\Models\JenisFeedbackUAB;
use App\Models\JenisFeedbackUTB;
use App\Models\NilaiPBLSkenario;
use App\Models\RincianNilaiTugas;
use App\Models\JenisFeedbackUjian;
use App\Models\NilaiPBLSkenarioDiskusi;
use App\Models\NilaiPraktikum;

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
            'role' => 'admin',
            'email' => 'admin@unika.ac.id',
            'password' =>  bcrypt('admin') 
        ]);

        User::create([
            'name' => 'A',
            'role' => 'mahasiswa',
            'email' => '21p10001@unika.ac.id',
            'nim' => '21.P1.0001',
            'angkatan' => '2021',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'B',
            'role' => 'mahasiswa',
            'email' => '21p10002@unika.ac.id',
            'nim' => '21.P1.0002',
            'angkatan' => '2021',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'C',
            'role' => 'mahasiswa',
            'email' => '21p10003@unika.ac.id',
            'nim' => '21.P1.0003',
            'angkatan' => '2021',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'D',
            'role' => 'mahasiswa',
            'email' => '21p10010@unika.ac.id',
            'nim' => '21.P1.0010',
            'angkatan' => '2021',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'E',
            'role' => 'mahasiswa',
            'email' => '21p10011@unika.ac.id',
            'nim' => '21.P1.0011',
            'angkatan' => '2021',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'F',
            'role' => 'mahasiswa',
            'email' => '19p10001@unika.ac.id',
            'nim' => '19.P1.0001',
            'angkatan' => '2019',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'G',
            'role' => 'mahasiswa',
            'email' => '19p10002@unika.ac.id',
            'nim' => '19.P1.0002',
            'angkatan' => '2019',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'dr. A',
            'role' => 'dosen',
            'email' => 'dosen1@unika.ac.id',
            'password' =>  bcrypt('admin')
        ]);

        User::create([
            'name' => 'dr. B',
            'role' => 'dosen',
            'email' => 'dosen2@unika.ac.id',
            'password' =>  bcrypt('admin')
        ]);
        // $max = 10;
        // for($i=1;$i<=$max;$i++){
        //     NilaiTugas::factory()->create();
        // }

        // RincianNilaiTugas::create([
        //     'nilai_id' => 1,
        // ]);
        // RincianNilaiTugas::create([
        //     'nilai_id' => 2,
        // ]);
        // RincianNilaiTugas::create([
        //     'nilai_id' => 3,
        // ]);
        // RincianNilaiTugas::create([
        //     'nilai_id' => 4,
        // ]);
        // RincianNilaiTugas::create([
        //     'nilai_id' => 5,
        // ]);
        // RincianNilaiTugas::create([
        //     'nilai_id' => 6,
        // ]);
        // RincianNilaiTugas::create([
        //     'nilai_id' => 7,
        // ]);
        Nilai::create([
            'user_id' => 8,
            'matkul_id' => 1,
        ]);
        Nilai::create([
            'user_id' => 2,
            'matkul_id' => 1,
        ]);
        Nilai::create([
            'user_id' => 3,
            'matkul_id' => 1,
        ]);
        Nilai::create([
            'user_id' => 4,
            'matkul_id' => 1,
        ]);
        Nilai::create([
            'user_id' => 5,
            'matkul_id' => 1,
        ]);
        Nilai::create([
            'user_id' => 6,
            'matkul_id' => 1,
        ]);
        Nilai::create([
            'user_id' => 7,
            'matkul_id' => 2,
        ]);

        Kelompok::create([
            'user_id' => 2,
            'matkul_id' => 1,
            'kodekelompok' => 'KKFK1'
        ]);

        Kelompok::create([
            'user_id' => 3,
            'matkul_id' => 1,
            'kodekelompok' => 'KKFK1'
        ]);

        Kelompok::create([
            'user_id' => 4,
            'matkul_id' => 1,
            'kodekelompok' => 'KKFK1'
        ]);

        Kelompok::create([
            'user_id' => 5,
            'matkul_id' => 1,
            'kodekelompok' => 'KKFK1'
        ]);

        Kelompok::create([
            'user_id' => 6,
            'matkul_id' => 1,
            'kodekelompok' => 'KKFK1'
        ]);

        Kelompok::create([
            'user_id' => 7,
            'matkul_id' => 2,
            'kodekelompok' => 'KKFK2'
        ]);

        Kelompok::create([
            'user_id' => 8,
            'matkul_id' => 2,
            'kodekelompok' => 'KKFK2'
        ]);

        Kelompok::create([
            'user_id' => 9,
            'matkul_id' => 1,
            'kodekelompok' => 'KKFK1'
        ]);

        Kelompok::create([
            'user_id' => 10,
            'matkul_id' => 2,
            'kodekelompok' => 'KKFK2'
        ]);

        // Jadwal::create([
        //     'user_id' => 2,
        //     'matkul_id' => 1,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        // Jadwal::create([
        //     'user_id' => 3,
        //     'matkul_id' => 1,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);
        
        // Jadwal::create([
        //     'user_id' => 4,
        //     'matkul_id' => 1,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        // Jadwal::create([
        //     'user_id' => 5,
        //     'matkul_id' => 1,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        // Jadwal::create([
        //     'user_id' => 6,
        //     'matkul_id' => 1,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        // Jadwal::create([
        //     'user_id' => 7,
        //     'matkul_id' => 2,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        // Jadwal::create([
        //     'user_id' => 8,
        //     'matkul_id' => 2,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        Jadwal::create([
            'user_id' => 9,
            'matkul_id' => 1,
            'materi' => 'test 1',
            'tanggal' => '2022-03-29',
            'jammasuk' => '08:00',
            'jamselesai' => '12:00',
            'ruangan' => 'R2'
        ]);
        Jadwal::create([
            'user_id' => 10,
            'matkul_id' => 1,
            'materi' => 'test 2',
            'tanggal' => '2022-03-29 07:48:06',
            'jammasuk' => '08:00',
            'jamselesai' => '12:00',
            'ruangan' => 'R2'
        ]);

        // Jadwal::create([
        //     'user_id' => 2,
        //     'matkul_id' => 9,
        //     'tanggal' => '2022-03-29 07:48:06',
        //     'jammasuk' => '08:00',
        //     'jamselesai' => '12:00',
        //     'ruangan' => 'R2'
        // ]);

        Matkul::create([
            'kodematkul' => 'FKS011B11',
            'namamatkul' => 'Pendidikan Kedokteran dan Humaniora',
        'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "1.1"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS021B12',
            'namamatkul' => 'Sel, Biomolekuler dan Jaringan',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "1.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS031B13',
            'namamatkul' => 'Sistem Kulit, Tulang dan Otot',
            'keterangan' => 'Semester 1',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "1.3"
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
            'bobot_sks' => 5,
            'blok' => "2.1"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS052B22',
            'namamatkul' => 'Sistem Saraf dan Indra',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "2.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS062B23',
            'namamatkul' => 'Sistem Gastrointestinal, Hepatobilier, Pankreas, Ginjal, Saluran Kemih dan Endokrin',
            'keterangan' => 'Semester 2',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "2.3"
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
            'bobot_sks' => 5,
            'blok' => "3.1"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS081B32',
            'namamatkul' => 'Mekanisme Penyakit Dasar dan Penatalaksanaannya',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "3.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS091B33',
            'namamatkul' => 'Gangguan Sistem Endokrin dan Nutrisi',
            'keterangan' => 'Semester 3',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "3.3"
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
            'bobot_sks' => 5,
            'blok' => "4.1"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS112B42',
            'namamatkul' => 'Gangguan Sistem Kulit, Tulang dan Otot',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "4.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS122B43',
            'namamatkul' => 'Gangguan Jantung, Pembuluh Darah dan Pernafasan',
            'keterangan' => 'Semester 4',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "4.3"
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
            'bobot_sks' => 5,
            'blok' => "5.1"
        ]);
        
        Matkul::create([
            'kodematkul' => 'FKS141B52',
            'namamatkul' => 'Gangguan Sistem Gastrointestinal dan Bilier',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "5.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS151B53',
            'namamatkul' => 'Gangguan Sistem Indera',
            'keterangan' => 'Semester 5',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "5.3"
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
            'bobot_sks' => 5,
            'blok' => "6.1"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS172B62',
            'namamatkul' => 'Gangguan Sistem Reproduksi',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "6.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS182B63',
            'namamatkul' => 'Ilmu Kedokteran Keluarga dan Komunitas',
            'keterangan' => 'Semester 6',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "6.3"
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
            'bobot_sks' => 5,
            'blok' => "7.1"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS201B72',
            'namamatkul' => 'Kegawatdaruratan dan Medikolegal',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "7.2"
        ]);

        Matkul::create([
            'kodematkul' => 'FKS211B73',
            'namamatkul' => 'Elektif',
            'keterangan' => 'Semester 7',
            'tahun_ajaran' => '2021/2022',
            'bobot_sks' => 5,
            'blok' => "7.3"
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

        Nilai::create([
            'user_id' => 9,
            'matkul_id' => 1
        ]);

        NilaiPBL::create([
            'nilai_id' => 1,
        ]);
        NilaiPBL::create([
            'nilai_id' => 2,
        ]);
        NilaiPBL::create([
            'nilai_id' => 3,
        ]);
        NilaiPBL::create([
            'nilai_id' => 4,
        ]);
        NilaiPBL::create([
            'nilai_id' => 5,
        ]);
        NilaiPBL::create([
            'nilai_id' => 8,
        ]);

        NilaiPBLSkenario::create([
            'nilaipbl_id' => 1,
            'skenario' => 1,
            'kelompok' => 1
        ]);
        NilaiPBLSkenario::create([
            'nilaipbl_id' => 2,
            'skenario' => 1,
            'kelompok' => 1
        ]);
        NilaiPBLSkenario::create([
            'nilaipbl_id' => 3,
            'skenario' => 1,
            'kelompok' => 1
        ]);
        NilaiPBLSkenario::create([
            'nilaipbl_id' => 4,
            'skenario' => 1,
            'kelompok' => 1
        ]);
        NilaiPBLSkenario::create([
            'nilaipbl_id' => 5,
            'skenario' => 1,
            'kelompok' => 1
        ]);
        NilaiPBLSkenario::create([
            'nilaipbl_id' => 6,
            'skenario' => 1,
            'kelompok' => 1
        ]);

        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 1,
            'diskusi' => 1,
            'tanggal_pelaksanaan' => '2022-03-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 2,
            'diskusi' => 1,
            'tanggal_pelaksanaan' => '2022-03-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 3,
            'diskusi' => 1,
            'tanggal_pelaksanaan' => '2022-03-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 4,
            'diskusi' => 1,
            'tanggal_pelaksanaan' => '2022-03-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 5,
            'diskusi' => 1,
            'tanggal_pelaksanaan' => '2022-03-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 6,
            'diskusi' => 1,
            'tanggal_pelaksanaan' => '2022-03-29'
        ]);

        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 1,
            'diskusi' => 2,
            'tanggal_pelaksanaan' => '2022-04-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 2,
            'diskusi' => 2,
            'tanggal_pelaksanaan' => '2022-04-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 3,
            'diskusi' => 2,
            'tanggal_pelaksanaan' => '2022-04-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 4,
            'diskusi' => 2,
            'tanggal_pelaksanaan' => '2022-04-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 5,
            'diskusi' => 2,
            'tanggal_pelaksanaan' => '2022-04-29'
        ]);
        NilaiPBLSkenarioDiskusi::create([
            'nilaipblskenario_id' => 6,
            'diskusi' => 2,
            'tanggal_pelaksanaan' => '2022-04-29'
        ]);

        NilaiPraktikum::create([
            'nilai_id' => 2,
            'namapraktikum' => 'Histiologi'
        ]);
        NilaiPraktikum::create([
            'nilai_id' => 3,
            'namapraktikum' => 'Histiologi'
        ]);
        NilaiPraktikum::create([
            'nilai_id' => 4,
            'namapraktikum' => 'Histiologi'
        ]);
        NilaiPraktikum::create([
            'nilai_id' => 5,
            'namapraktikum' => 'Histiologi'
        ]);
        NilaiPraktikum::create([
            'nilai_id' => 8,
            'namapraktikum' => 'Histiologi'
        ]);

        NilaiSOCA::create([
            'nilai_lain_id' => 1,
            'namasoca' => "SKA",
            'nama_penguji' => "dr. A"
        ]);

        NilaiSOCA::create([
            'nilai_lain_id' => 3,
            'namasoca' => "SKA",
            'nama_penguji' => "dr. A"
        ]);

        NilaiJenisSOCA::create([
            'nilaisoca_id' => 1,
            'namaanalisis' => "Kemampuan analisa masalah"
        ]);
        NilaiJenisSOCA::create([
            'nilaisoca_id' => 1,
            'namaanalisis' => "Kemampuan mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan terjadinya penyakit  sesuai dengan skenario)"
        ]);
        NilaiJenisSOCA::create([
            'nilaisoca_id' => 1,
            'namaanalisis' => "Keterampilan saat presentasi"
        ]);
        NilaiJenisSOCA::create([
            'nilaisoca_id' => 1,
            'namaanalisis' => "Hasil Penilaian Keterampilan presentasi & sikap"
        ]);

        JenisSOCA::create([
            'nilaijenissoca_id' => 1,
            "keterangan_soca" => "Overview Masalah",
            "bobot" => 2,
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);

        JenisSOCA::create([
            'nilaijenissoca_id' => 1,
            "keterangan_soca" => "Analisis Masalah",
            "bobot" => 4,
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);



        JenisSOCA::create([
            'nilaijenissoca_id' => 2,
            "keterangan_soca" => "Fisiologi",
            "bobot" => 2,
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        JenisSOCA::create([
            'nilaijenissoca_id' => 2,
            "keterangan_soca" => "Patofisiologi SKA",
            "bobot" => 2,
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        JenisSOCA::create([
            'nilaijenissoca_id' => 2,
            "keterangan_soca" => "Gejala klinis dan pemeriksaan fisik",
            "bobot" => 2,
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        JenisSOCA::create([
            'nilaijenissoca_id' => 3,
            "keterangan_soca" => "Sikap",
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        JenisSOCA::create([
            'nilaijenissoca_id' => 3,
            "keterangan_soca" => "Kemampuan berkomunikasi",
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        JenisSOCA::create([
            'nilaijenissoca_id' => 3,
            "keterangan_soca" => "Sistematika penyajian",
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        JenisSOCA::create([
            'nilaijenissoca_id' => 4,
            "keterangan_soca" => "Hasil Penilaian Keterampilan presentasi & sikap",
            "skor_soca" => 0,
            "kepuasan_presentasi" => ""
        ]);
        NilaiOSCE::create([
            'nilai_lain_id' => 2,
            'namaosce' => "PEMERIKSAAN FISIK PADA PAYUDARA",
            'nama_penguji' => "dr. A"
        ]);
        NilaiOSCE::create([
            'nilai_lain_id' => 3,
            'namaosce' => "PEMERIKSAAN FISIK PADA PAYUDARA",
            'nama_penguji' => "dr. A"
        ]);

        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Memperkenalkan diri, menjelaskan prosedur dan meminta ijin melakukan pemeriksaan",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menanyakan Keluhan utama dan riwayat penyakit sekarang",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menanyakan riwayat penyakit sebelumnya dan riwayat penyakit keluarga",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menanyakan faktor resiko",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Mencuci tangan 6 langkah sebelum pemeriksaan",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan hasil pemeriksaan inspeksi (pasien posisi duduk)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan pemeriksaan palpasi (Pasien posisi berbaring)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan hasil pemeriksaan palpasi limfonodi aksila (pasien posisi duduk)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan hasil pemeriksaan palpasi limfonodi supraclavicula (pasien duduk, pemeriksa dari belakang)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Mencuci tangan 6 langkah",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menjelaskan hasil pemeriksaan kepada pasien",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 1,
            'bobot' => 1,
            'aspekdinilaiosce' => "Edukasi untuk sadari",
            
        ]);
        


        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Memperkenalkan diri, menjelaskan prosedur dan meminta ijin melakukan pemeriksaan",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menanyakan Keluhan utama dan riwayat penyakit sekarang",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menanyakan riwayat penyakit sebelumnya dan riwayat penyakit keluarga",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menanyakan faktor resiko",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Mencuci tangan 6 langkah sebelum pemeriksaan",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan hasil pemeriksaan inspeksi (pasien posisi duduk)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan pemeriksaan palpasi (Pasien posisi berbaring)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan hasil pemeriksaan palpasi limfonodi aksila (pasien posisi duduk)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 2,
            'aspekdinilaiosce' => "Melakukan dan melaporkan hasil pemeriksaan palpasi limfonodi supraclavicula (pasien duduk, pemeriksa dari belakang)",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Mencuci tangan 6 langkah",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Menjelaskan hasil pemeriksaan kepada pasien",
            
        ]);
        NilaiJenisOSCE::create([
            'nilaiosce_id' => 2,
            'bobot' => 1,
            'aspekdinilaiosce' => "Edukasi untuk sadari",
            
        ]);


        


        NilaiLain::create([
            'user_id' => 1
        ]);
        NilaiLain::create([
            'user_id' => 2
        ]);
        NilaiLain::create([
            'user_id' => 3
        ]);
        NilaiLain::create([
            'user_id' => 4
        ]);
        NilaiLain::create([
            'user_id' => 5
        ]);

        NilaiFieldlab::create([
            'nilai_lain_id' => 1,
            'kelompok' => 1,
            'keterangan' => '2021/2022',
            'semester' => "Semester 2"
        ]);
        NilaiFieldlab::create([
            'nilai_lain_id' => 2,
            'kelompok' => 1,
            'keterangan' => '2021/2022',
            'semester' => "Semester 2"
        ]);
        NilaiFieldlab::create([
            'nilai_lain_id' => 3,
            'kelompok' => 1,
            'keterangan' => '2021/2022',
            'semester' => "Semester 2"
        ]);
        NilaiFieldlab::create([
            'nilai_lain_id' => 4,
            'kelompok' => 1,
            'keterangan' => '2021/2022',
            'semester' => "Semester 2"
        ]);
        NilaiFieldlab::create([
            'nilai_lain_id' => 5,
            'kelompok' => 1,
            'keterangan' => '2021/2022',
            'semester' => "Semester 2"
        ]);

        // NilaiUjian::create([
        //     'nilai_id' => 1,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 2,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 3,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 4,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 5,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 6,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 7,
        // ]);
        // NilaiUjian::create([
        //     'nilai_id' => 8,
        // ]);


        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 1,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 2,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 3,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 4,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 5,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 6,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 7,
        // ]);
        // HasilNilaiUjian::create([
        //     'nilai_ujian_id' => 8,
        // ]);

        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 1,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 2,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 3,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 4,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 5,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 6,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 7,
        // ]);
        // FeedbackUTB::create([
        //     'hasil_ujians_id' => 8,
        // ]);

        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 1,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 2,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 3,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 4,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 5,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 6,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 7,
        // ]);
        // FeedbackUAB::create([
        //     'hasil_ujians_id' => 8,
        // ]);

        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 1,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 2,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 3,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 4,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 5,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 6,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 7,
        // ]);
        // JenisFeedbackUTB::create([
        //     'feedback_utb_id' => 8,
        // ]);

        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 1,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 2,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 3,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 4,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 5,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 6,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 7,
        // ]);
        // JenisFeedbackUAB::create([
        //     'feedback_uab_id' => 8,
        // ]);
        // Jadwal::factory(100)->create();
        // Kelompok::factory(50)->create();
    }
}
