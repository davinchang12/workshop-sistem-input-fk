<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\NilaiPBL;
use Illuminate\Http\Request;
use App\Models\NilaiPBLSkenario;
use Illuminate\Support\Facades\DB;
use App\Models\NilaiPBLSkenarioDiskusi;
use App\Models\NilaiPBLSkenarioDiskusiNilai;
use Illuminate\Validation\ValidationException;

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

        return redirect('/dashboard/settingmatakuliah/' . $matkul_kodematkul . '/')->with('success', 'Mahasiswa berhasil diubah!');
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
            'skenarios' => $skenarios->unique()
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

                for ($i = 1; $i <= 4; $i++) {
                    $nilaipblskenario = NilaiPBLSkenario::create([
                        'nilaipbl_id' => $nilaipbl->id,
                        'skenario' => $i,
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
        }
        return redirect('/dashboard/settingmatakuliah/' . $matkul_kodematkul . '/settingkelompokpbl')->with('success', 'Kelompok berhasil ditambahkan!');
    }

    public function deleteKelompokPBL(Request $request)
    {
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

        foreach ($skenarios as $skenario) {
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

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingkelompokpbl')->with('success', 'Kelompok berhasil dihapus!');
    }

    public function dosenPBL(Matkul $settingmatakuliah) {

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->select('users.name', 'kelompok', 'nilai_p_b_l_skenarios.skenario', 'nilai_p_b_l_skenarios.id')
            ->get();

        $diskusis = DB::table('nilai_p_b_l_skenario_diskusis')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->select('nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', 'nilai_p_b_l_skenario_diskusis.id as id', 'nilai_p_b_l_skenario_diskusis.diskusi', 'nilai_p_b_l_skenario_diskusis.tanggal_pelaksanaan')
            ->get();

        return view('dashboard.matkul.admin.pbl.dosen.index', [
            'matkul' => $settingmatakuliah,
            'skenarios' => $skenarios->unique(),
            'diskusis' => $diskusis
        ]);
    }

    public function createDosenPBL(Matkul $settingmatakuliah) {

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

        $users = User::where('role', 'dosen')->get();

        return view('dashboard.matkul.admin.pbl.dosen.create', [
            'matkul' => $settingmatakuliah,
            'kelompoks' => $kelompoks,
            'users' => $users
        ]);
    }

    public function storeDosenPBL(Request $request) {

        $validatedData = $request->validate([
            'kelompok' => 'required',
            'user_id' => 'required',
            'skenario' => 'required|integer',
            'tanggal1' => 'required',
            'tanggal2' => 'required',
        ]);

        $nilais = DB::table('nilais')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkul_id', $request->matkul_id)
            ->where('users.role', 'dosen')
            ->select('nilais.id as nilai_id', 'nilais.user_id as user_id')
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'dosen')
            ->where('matkuls.id', $request->matkul_id)
            ->where('nilai_p_b_l_skenarios.kelompok', $validatedData['kelompok'])
            ->where('nilai_p_b_l_skenarios.skenario', $validatedData['skenario'])
            ->select('users.id as user_id', 'nilai_p_b_l_s.id as nilaipbl_id', 'users.name', 'nilai_p_b_l_skenarios.kelompok')
            ->get();
            
        $check = $skenarios->where('user_id', $validatedData['user_id'])->first();

        if (!$check) {

            $nilai_id = $nilais->where('user_id', $validatedData['user_id'])->first()->nilai_id ?? 
                Nilai::create([
                    'user_id' => $validatedData['user_id'],
                    'matkul_id' => $request->matkul_id
                ])->id;

            $nilaipbl = NilaiPBL::create([
                'nilai_id' => $nilai_id
            ]);

            $nilaipblskenario = NilaiPBLSkenario::create([
                'nilaipbl_id' => $nilaipbl->id,
                'skenario' => $validatedData['skenario'],
                'kelompok' => $validatedData['kelompok']
            ]);

            NilaiPBLSkenarioDiskusi::create([
                'nilaipblskenario_id' => $nilaipblskenario->id,
                'diskusi' => 1,
                'tanggal_pelaksanaan' => $validatedData['tanggal1']
            ]);

            NilaiPBLSkenarioDiskusi::create([
                'nilaipblskenario_id' => $nilaipblskenario->id,
                'diskusi' => 2,
                'tanggal_pelaksanaan' => $validatedData['tanggal2']
            ]);
        } else {
            throw ValidationException::withMessages(['errorJam' => 'Dosen sudah ada di skenario '.$validatedData['skenario'].', kelompok '.$validatedData['kelompok'].'!']);
        }

        return redirect('/dashboard/settingmatakuliah/' . $request->kodematkul . '/settingkelompokpbl/editdosen')->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function deleteDosenPBL(Request $request) {
        
        $diskusis = $request->input('diskusi');
        $skenario = $request->input('skenario');

        foreach($diskusis as $diskusi) {
            NilaiPBLSkenarioDiskusi::where('id', $diskusi)
                ->delete();
        }

        $getSkenario = NilaiPBLSkenario::where('id', $skenario);

        $idPBL = $getSkenario->first()->pbl->id;

        $getSkenario->delete();

        NilaiPBL::where('id', $idPBL)
            ->delete();

        return redirect('/dashboard/settingmatakuliah/' . $request->kodematkul . '/settingkelompokpbl/editdosen')->with('success', 'Dosen berhasil dihapus!');
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

    public function jenisPraktikum(Matkul $settingmatakuliah) {

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->select('nilai_praktikums.namapraktikum')
            ->get()
            ->unique();

        return view('dashboard.matkul.admin.praktikum.index', [
            'matkul' => $settingmatakuliah,
            'praktikums' => $praktikums
        ]);
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
