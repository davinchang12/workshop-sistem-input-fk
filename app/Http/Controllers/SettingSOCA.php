<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JenisSOCA;
use App\Models\NilaiLain;
use App\Models\NilaiSOCA;
use Illuminate\Http\Request;
use App\Models\NilaiJenisSOCA;
use Illuminate\Support\Facades\DB;

class SettingSOCA extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socas = DB::table('nilai_s_o_c_a_s')
            ->select('nama_penguji', 'namasoca', 'keterangan')
            ->groupBy('nama_penguji', 'namasoca')
            ->get();

        return view('dashboard.soca.admin.index', [
            'socas' => $socas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosens = User::where('role', 'dosen')->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.nim', 'users.angkatan')
            ->where('users.role', 'mahasiswa')
            ->get();

        $angkatans = DB::table('users')
            ->select('angkatan')
            ->where('angkatan', '!=', null)
            ->groupBy('angkatan')
            ->get();

        $socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->select('users.id as user_id')
            ->get();

        return view('dashboard.soca.admin.create', [
            'dosens' => $dosens,
            'users' => $users,
            'angkatans' => $angkatans,
            'socas' => $socas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dosen' => 'required',
            'nama_soca' => 'required',
            'keterangan' => 'required',
            'user_id' => 'required'
        ]);

        $validatedData['nama_soca'] = strtoupper($validatedData['nama_soca']);
        $validatedData['keterangan'] = ucwords($validatedData['keterangan']);

        foreach ($validatedData['user_id'] as $user) {
            $nilai_lain = NilaiLain::where('user_id', $user)->first()->id ??
                NilaiLain::create(['user_id' => $user])->id;

            NilaiSOCA::create([
                'nilai_lain_id' => $nilai_lain,
                'namasoca' => $validatedData['nama_soca'],
                'nama_penguji' => $validatedData['nama_dosen'],
                'keterangan' => $validatedData['keterangan']
            ]);
        }

        return redirect('/dashboard/settingsoca')->with('success', 'Dosen dan mahasiswa berhasil ditambahkan!');
    }

    public function editDosen(Request $request)
    {

        $dosens = User::where('role', 'dosen')->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.nim', 'users.angkatan')
            ->where('users.role', 'mahasiswa')
            ->get();

        $angkatans = DB::table('users')
            ->select('angkatan')
            ->where('angkatan', '!=', null)
            ->groupBy('angkatan')
            ->get();

        $socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nilai_s_o_c_a_s.namasoca', $request['namasoca'])
            ->select('users.id as user_id', 'nilai_s_o_c_a_s.namasoca', 'nilai_s_o_c_a_s.nama_penguji', 'nilai_s_o_c_a_s.keterangan')
            ->get();

        return view('dashboard.soca.admin.editdosen', [
            'dosens' => $dosens,
            'users' => $users,
            'angkatans' => $angkatans,
            'socas' => $socas
        ]);
    }

    public function updateDosen(Request $request)
    {
        $namasoca = $request->input('nama_soca');
        $namadosen = $request->input('nama_dosen');
        $user_ids = $request->input('user_id');
        $keterangan = $request->input('keterangan');

        $nilai_socas = DB::table('nilai_s_o_c_a_s')
            ->where('namasoca', $namasoca)
            ->where('nama_penguji', $namadosen)
            ->where('keterangan', $keterangan)
            ->get();

        $nilai_lain_id = array();
        if ($user_ids != null) {
            foreach ($user_ids as $user_id) {
                $nilai_lain = NilaiLain::where('user_id', $user_id)->first()->id ??
                    NilaiLain::create(['user_id' => $user_id])->id;

                array_push($nilai_lain_id, $nilai_lain);

                if (!NilaiSOCA::where('nilai_lain_id', $nilai_lain)->where('namasoca', $namasoca)->where('nama_penguji', $namadosen)->exists()) {
                    NilaiSOCA::create([
                        'nilai_lain_id' => $nilai_lain,
                        'namasoca' => $namasoca,
                        'nama_penguji' => $namadosen,
                        'keterangan' => $keterangan
                    ]);
                }
            }
        }

        foreach ($nilai_socas as $nilai_soca) {
            if (!in_array($nilai_soca->nilai_lain_id, $nilai_lain_id)) {
                NilaiSOCA::where('nilai_lain_id', $nilai_soca->nilai_lain_id)
                    ->where('namasoca', $namasoca)
                    ->where('nama_penguji', $namadosen)
                    ->where('keterangan', $keterangan)
                    ->delete();
            }
        }

        return redirect('/dashboard/settingsoca')->with('success', 'Data berhasil diupdate!');
    }

    public function deleteDosen(Request $request)
    {
        $namasoca = $request->input('namasoca');
        $nama_penguji = $request->input('nama_penguji');

        NilaiSOCA::where('namasoca', $namasoca)
            ->where('nama_penguji', $nama_penguji)
            ->delete();

        return redirect('/dashboard/settingsoca')->with('success', 'Data berhasil dihapus!');
    }

    public function createSoal()
    {
        $nama_soca = DB::table('nilai_s_o_c_a_s')
            ->select('namasoca')
            ->get()
            ->unique();

        return view('dashboard.soca.admin.createsoal', [
            'namasocas' => $nama_soca
        ]);
    }

    public function tambahSoal(Request $request)
    {
        $validatedData = $request->validate([
            'nama_soca' => 'required',
            'soals' => 'required',
            'bobots' => 'required'
        ]);

        // dd($validatedData);

        $socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nilai_s_o_c_a_s.namasoca', $validatedData['nama_soca'])
            ->select('nilai_s_o_c_a_s.id as id')
            ->get();

        foreach ($socas as $soca) {

            $test = NilaiSOCA::find($soca->id);

            if (!$test->relation) {
                $p1 = NilaiJenisSOCA::create([
                    'nilaisoca_id' => $soca->id,
                    'namaanalisis' => "Kemampuan analisa masalah"
                ]);
                $p2 = NilaiJenisSOCA::create([
                    'nilaisoca_id' => $soca->id,
                    'namaanalisis' => "Kemampuan mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan terjadinya penyakit  sesuai dengan skenario)"
                ]);
                $p3 = NilaiJenisSOCA::create([
                    'nilaisoca_id' => $soca->id,
                    'namaanalisis' => "Keterampilan saat presentasi"
                ]);
                $keterampilansikap = NilaiJenisSOCA::create([
                    'nilaisoca_id' => $soca->id,
                    'namaanalisis' => "Hasil Penilaian Keterampilan presentasi & sikap"
                ]);

                JenisSOCA::create([
                    'nilaijenissoca_id' => $p1->id,
                    "keterangan_soca" => "Overview Masalah",
                    "bobot" => 2,
                    "skor_soca" => 0,
                    "kepuasan_presentasi" => ""
                ]);

                JenisSOCA::create([
                    'nilaijenissoca_id' => $p1->id,
                    "keterangan_soca" => "Analisis Masalah",
                    "bobot" => 4,
                    "skor_soca" => 0,
                    "kepuasan_presentasi" => ""
                ]);

                foreach ($validatedData['soals'] as $key => $soal) {
                    $bobot = $validatedData['bobots'][$key]['bobot'];

                    JenisSOCA::create([
                        'nilaijenissoca_id' => $p2->id,
                        "keterangan_soca" => ucwords($soal['soal']),
                        "bobot" => $bobot,
                        "skor_soca" => 0,
                        "kepuasan_presentasi" => ""
                    ]);
                }

                JenisSOCA::create([
                    'nilaijenissoca_id' => $p3->id,
                    "keterangan_soca" => "Sikap",
                    "skor_soca" => 0,
                    "kepuasan_presentasi" => ""
                ]);
                JenisSOCA::create([
                    'nilaijenissoca_id' => $p3->id,
                    "keterangan_soca" => "Kemampuan berkomunikasi",
                    "skor_soca" => 0,
                    "kepuasan_presentasi" => ""
                ]);
                JenisSOCA::create([
                    'nilaijenissoca_id' => $p3->id,
                    "keterangan_soca" => "Sistematika penyajian",
                    "skor_soca" => 0,
                    "kepuasan_presentasi" => ""
                ]);
                JenisSOCA::create([
                    'nilaijenissoca_id' => $keterampilansikap->id,
                    "keterangan_soca" => "Hasil Penilaian Keterampilan presentasi & sikap",
                    "skor_soca" => 0,
                    "kepuasan_presentasi" => ""
                ]);
            }
        }

        return redirect('/dashboard/settingsoca')->with('success', 'Soal ' . $validatedData['nama_soca'] . ' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiSOCA $nilaiSOCA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiSOCA $nilaiSOCA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiSOCA $nilaiSOCA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSOCA $nilaiSOCA)
    {
        //
    }
}
