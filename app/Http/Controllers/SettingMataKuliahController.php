<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\NilaiPBL;
use Illuminate\Http\Request;
use App\Models\NilaiPBLSkenario;
use App\Models\NilaiPBLSkenarioDiskusi;
use App\Models\NilaiPBLSkenarioDiskusiNilai;
use Illuminate\Support\Facades\DB;

class SettingMataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkuls = DB::table('matkuls')
            ->orderBy('keterangan', 'ASC')
            ->get();

        return view('dashboard.matkul.admin.index', [
            'matkuls' => $matkuls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.matkul.admin.create');
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
            'kodematkul' => 'required|unique:matkuls',
            'namamatkul' => 'required|max:255',
            'keterangan' => 'required',
            'tahun_ajaran' => 'required',
            'bobot_sks' => 'required',
            'blok' => 'nullable',
            'kinerja' => 'nullable'
        ]);
        Matkul::create($validatedData);

        return redirect('/dashboard/settingmatakuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function show(Matkul $settingmatakuliah)
    {
        return view('dashboard.matkul.admin.show', [
            'matkul' => $settingmatakuliah
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function edit(Matkul $settingmatakuliah)
    {
        return view('dashboard.matkul.admin.edit', [
            'matkul' => $settingmatakuliah
        ]);
    }

    public function editMahasiswa(Matkul $settingmatakuliah)
    {
        $angkatans = DB::table('users')
            ->select('angkatan')
            ->where('angkatan', '!=', null)
            ->groupBy('angkatan')
            ->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.nim', 'users.angkatan')
            ->where('users.role', 'mahasiswa')
            ->get();

        return view('dashboard.matkul.admin.mahasiswa.edit', [
            'matkul' => $settingmatakuliah,
            'angkatans' => $angkatans,
            'users' => $users
        ]);
    }

    public function storeEditMahasiswa(Request $request)
    {

        $matkul_kodematkul = $request->input('matkul_kodematkul');
        $matkul_id = $request->input('matkul_id');
        $user_ids = $request->input('user_id');

        $nilais = DB::table('nilais')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkul_id', $matkul_id)
            ->where('users.role', 'mahasiswa')
            ->get();

        $jadwals = DB::table('jadwals')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->where('matkul_id', $matkul_id)
            ->where('users.role', 'mahasiswa')
            ->get();

        foreach ($user_ids as $user_id) {
            if (!Nilai::where('user_id', $user_id)->where('matkul_id', $matkul_id)->exists()) {
                Nilai::create([
                    'user_id' => $user_id,
                    'matkul_id' => $matkul_id
                ]);
            }

            if (!Jadwal::where('user_id', $user_id)->where('matkul_id', $matkul_id)->exists()) {
                Jadwal::create([
                    'user_id' => $user_id,
                    'matkul_id' => $matkul_id
                ]);
            }
        }

        foreach ($nilais as $nilai) {
            if (!in_array($nilai->user_id, $user_ids)) {
                Nilai::where('user_id', $nilai->user_id)
                    ->delete();
            }
        }

        foreach ($jadwals as $jadwal) {
            if (!in_array($jadwal->user_id, $user_ids)) {
                Jadwal::where('user_id', $jadwal->user_id)
                    ->delete();
            }
        }

        return redirect('/dashboard/settingmatakuliah/' . $matkul_kodematkul . '/');
    }

    public function kelompokPBL(Matkul $settingmatakuliah)
    {
        $nilais = DB::table('nilais')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->select('users.name', 'kelompok')
            ->get();

        $kelompoks = $skenarios->pluck('kelompok')->unique();

        return view('dashboard.matkul.admin.pbl.index', [
            'matkul' => $settingmatakuliah,
            'nilais' => $nilais,
            'kelompoks' => $kelompoks,
            'skenarios' => $skenarios
        ]);
    }

    public function createKelompokPBL(Matkul $settingmatakuliah)
    {

        $angkatans = DB::table('users')
            ->select('angkatan')
            ->where('angkatan', '!=', null)
            ->groupBy('angkatan')
            ->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.nim', 'users.angkatan')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->select('users.id', 'users.name', 'kelompok')
            ->get();

        $kelompoks = $skenarios->pluck('kelompok')->unique();

        return view('dashboard.matkul.admin.pbl.create', [
            'matkul' => $settingmatakuliah,
            'users' => $users,
            'angkatans' => $angkatans,
            'skenarios' => $skenarios,
            'kelompoks' => $kelompoks
        ]);
    }
    public function storeKelompokPBL(Request $request)
    {
        $user_ids = $request->input('user_id');
        $matkul_kodematkul = $request->input('matkul_kodematkul');
        $matkul_id = $request->input('matkul_id');
        $skenario_input = $request->input('skenario');

        $nilais = DB::table('nilais')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkul_id', $matkul_id)
            ->where('users.role', 'mahasiswa')
            ->select('nilais.id as nilai_id', 'nilais.user_id as user_id')
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $matkul_id)
            ->select('users.id as user_id', 'nilai_p_b_l_s.id as nilaipbl_id', 'users.name', 'kelompok')
            ->get();

        $kelompoks = $skenarios->pluck('kelompok')->unique();

        foreach ($user_ids as $user_id) {
            $check = $skenarios->where('user_id', $user_id)->first();
            if (!$check) {

                $nilai_id = $nilais->where('user_id', $user_id)->first()->nilai_id;

                $nilaipbl = NilaiPBL::create([
                    'nilai_id' => $nilai_id
                ]);

                $nilaipblskenario = NilaiPBLSkenario::create([
                    'nilaipbl_id' => $nilaipbl->id,
                    'skenario' => $skenario_input,
                    'kelompok' => $kelompoks->count() + 1
                ]);

                NilaiPBLSkenarioDiskusi::create([
                    'nilaipblskenario_id' => $nilaipblskenario->id,
                    'diskusi' => 1
                ]);

                NilaiPBLSkenarioDiskusi::create([
                    'nilaipblskenario_id' => $nilaipblskenario->id,
                    'diskusi' => 2
                ]);
            }

        }
        return redirect('/dashboard/settingmatakuliah/' . $matkul_kodematkul . '/settingkelompokpbl');
    }

    public function deleteKelompokPBL(Request $request)
    {
        // dd($request);

        $kodematkul = $request->input('kodematkul');
        $matkul_id = $request->input('matkul_id');
        $kelompok = $request->input('kelompok');

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $matkul_id)
            ->where('nilai_p_b_l_skenarios.kelompok', $kelompok)
            ->select('users.id as user_id', 'nilai_p_b_l_s.id as nilaipbl_id', 'nilai_p_b_l_skenarios.id as nilaipblskenario_id', 'users.name', 'kelompok')
            ->get();

        // dd($skenarios);

        foreach ($skenarios as $skenario) {
            // dd($skenario);
            $skenarioDiskusis = NilaiPBLSkenarioDiskusi::where('nilaipblskenario_id', $skenario->nilaipblskenario_id);

            $skenarioDiskusisCheck = $skenarioDiskusis->get();
            foreach ($skenarioDiskusisCheck as $skenarioDiskusi) {
                NilaiPBLSkenarioDiskusiNilai::where('nilaipblskenariodiskusi_id', $skenarioDiskusi->id)
                    ->delete();
            }

            $skenarioDiskusis->delete();

            NilaiPBLSkenario::where('id', $skenario->nilaipblskenario_id)
                ->delete();

            NilaiPBL::where('id', $skenario->nilaipbl_id)
                ->delete();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingkelompokpbl');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matkul $settingmatakuliah)
    {

        $rules = [
            'namamatkul' => 'required|max:255',
            'keterangan' => 'required',
            'tahun_ajaran' => 'required',
            'bobot_sks' => 'required',
            'blok' => 'nullable',
            'kinerja' => 'nullable'
        ];

        if ($request->kodematkul != $settingmatakuliah->kodematkul) {
            $rules['kodematkul'] = 'required|unique:matkuls';
        }

        $validatedData = $request->validate($rules);

        Matkul::where('id', $settingmatakuliah->id)
            ->update($validatedData);

        return redirect('/dashboard/settingmatakuliah')->with('success', 'Mata kuliah berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matkul $settingmatakuliah)
    {
        Matkul::destroy($settingmatakuliah->id);

        return redirect('/dashboard/settingmatakuliah')->with('success', 'Mata kuliah berhasil dihapus!');
    }

    public function checkBlok(Request $request)
    {
        $blok = substr($request->kodematkul, -2);
        $blok = $blok[0] . "." . $blok[1];
        return response()->json(['blok' => $blok]);
    }
}
