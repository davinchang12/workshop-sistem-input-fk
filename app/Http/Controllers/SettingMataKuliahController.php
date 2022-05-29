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
use App\Models\NilaiPraktikum;
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
            ->where('matkuls.deleted_at', '=', null)
            ->orderBy('keterangan', 'ASC')
            ->get();

        return view('dashboard.matkul.admin.index', [
            'matkuls' => $matkuls
        ]);
    }
    public function trashbin()
    {
        $matkuls = DB::table('matkuls')
            ->where('matkuls.deleted_at', '!=', null)
            ->orderBy('keterangan', 'ASC')
            ->get();

        return view('dashboard.matkul.admin.trashbin', [
            'matkuls' => $matkuls
        ]);
    }
    public function restore(Request $request)
    {
        Matkul::where('kodematkul', '=', $request->kodematkul)->restore();
        return redirect('/dashboard/settingmatakuliah/trashbin')->with('success', 'Matakuliah berhasil direstore!');
    }
    public function forceDelete(Request $request)
    {
        Matkul::where('kodematkul', '=', $request->kodematkul)->forceDelete();
        return redirect('/dashboard/settingmatakuliah/trashbin')->with('success', 'Matakuliah berhasil dihapus!');
    }
    public function emptyTrash(Request $request)
    {
        Matkul::where('deleted_at', '!=', null)->ForceDelete();
        return redirect('/dashboard/settingmatakuliah/trashbin')->with('success', 'Semua matakuliah di trashbin berhasil dihapus!');
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
            ->where('nilais.deleted_at', null)
            ->get();

        $jadwals = DB::table('jadwals')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->where('matkul_id', $matkul_id)
            ->where('users.role', 'mahasiswa')
            ->where('jadwals.deleted_at', null)
            ->get();

        if ($user_ids != null) {
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
        } else {
            $user_ids = array();

            $pbls = DB::table('nilai_p_b_l_s')
                ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('matkul_id', $matkul_id)
                ->where('users.role', 'dosen')
                ->where('nilais.deleted_at', null)
                ->select('nilai_p_b_l_s.id')
                ->get();
            
            foreach($pbls as $pbl) {
                NilaiPBL::where('id', $pbl->id)
                    ->delete();
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
            ->where('nilais.deleted_at', null)
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilai_p_b_l_skenarios.deleted_at', '=', null)
            ->where('nilais.deleted_at', null)
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

    public function trashbinkelompokPBL(Matkul $settingmatakuliah)
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
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            ->select('users.name', 'kelompok')
            ->get();

        $kelompoks = $skenarios->pluck('kelompok')->unique();

        return view('dashboard.matkul.admin.pbl.trashbin', [
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
            ->where('nilais.deleted_at', null)
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('nilais.deleted_at', null)
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

        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);

        $user_ids = $request->input('user_id');
        $matkul_kodematkul = $request->input('matkul_kodematkul');
        $matkul_id = $request->input('matkul_id');

        $nilais = DB::table('nilais')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkul_id', $matkul_id)
            ->where('users.role', 'mahasiswa')
            ->select('nilais.id as nilai_id', 'nilais.user_id as user_id')
            ->where('nilais.deleted_at', null)
            ->get();

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $matkul_id)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->select('users.id as user_id', 'nilai_p_b_l_s.id as nilaipbl_id', 'users.name', 'kelompok')
            ->get();

        $kelompoks = $skenarios->pluck('kelompok')->unique();

        $kelompok = 1;

        for ($i = 1; $i <= 10; $i++) {
            if (!in_array($i, $kelompoks->toArray())) {
                $kelompok = $i;
                break;
            }
        }

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
                        'kelompok' => $kelompok
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
            ->where('nilais.deleted_at', null)
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

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingkelompokpbl')->with('success', 'Kelompok berhasil dihapus sementara!');
    }
    public function forcedeleteKelompokPBL(Request $request)
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
                    ->forcedelete();
            }

            $skenarioDiskusis->forcedelete();

            NilaiPBLSkenario::where('id', $skenario->nilaipblskenario_id)
                ->forcedelete();

            NilaiPBL::where('id', $skenario->nilaipbl_id)
                ->forcedelete();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingkelompokpbl')->with('success', 'Kelompok berhasil dihapus!');
    }
    public function emptyKelompokPBL(Request $request)
    {
        $kodematkul = $request->input('kodematkul');
        $matkul_id = $request->input('matkul_id');
        // $kelompok = $request->input('kelompok');

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $matkul_id)
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            // ->where('nilai_p_b_l_skenarios.kelompok', $kelompok)
            ->select('users.id as user_id', 'nilai_p_b_l_s.id as nilaipbl_id', 'nilai_p_b_l_skenarios.id as nilaipblskenario_id', 'users.name', 'kelompok')
            ->get();

        foreach ($skenarios as $skenario) {
            $skenarioDiskusis = NilaiPBLSkenarioDiskusi::where('nilaipblskenario_id', $skenario->nilaipblskenario_id);

            $skenarioDiskusisCheck = $skenarioDiskusis->get();
            foreach ($skenarioDiskusisCheck as $skenarioDiskusi) {
                NilaiPBLSkenarioDiskusiNilai::where('nilaipblskenariodiskusi_id', $skenarioDiskusi->id)
                    ->forcedelete();
            }

            $skenarioDiskusis->forcedelete();

            NilaiPBLSkenario::where('id', $skenario->nilaipblskenario_id)
                ->forcedelete();

            NilaiPBL::where('id', $skenario->nilaipbl_id)
                ->forcedelete();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingkelompokpbl')->with('success', 'Kelompok berhasil dihapus!');
    }
    public function restoredeleteKelompokPBL(Request $request)
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
                    ->restore();
            }

            $skenarioDiskusis->restore();

            NilaiPBLSkenario::where('id', $skenario->nilaipblskenario_id)
                ->restore();

            NilaiPBL::where('id', $skenario->nilaipbl_id)
                ->restore();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingkelompokpbl')->with('success', 'Kelompok berhasil direstore!');
    }

    public function dosenPBL(Matkul $settingmatakuliah)
    {

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilai_p_b_l_skenarios.deleted_at', '=', null)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('nilais.deleted_at', null)
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

    public function trashbindosenPBL(Matkul $settingmatakuliah)
    {

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            ->select('users.name', 'kelompok', 'nilai_p_b_l_skenarios.skenario', 'nilai_p_b_l_skenarios.id')
            ->get();

        $diskusis = DB::table('nilai_p_b_l_skenario_diskusis')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->select('nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', 'nilai_p_b_l_skenario_diskusis.id as id', 'nilai_p_b_l_skenario_diskusis.diskusi', 'nilai_p_b_l_skenario_diskusis.tanggal_pelaksanaan')
            ->get();

        return view('dashboard.matkul.admin.pbl.dosen.trashbin', [
            'matkul' => $settingmatakuliah,
            'skenarios' => $skenarios->unique(),
            'diskusis' => $diskusis
        ]);
    }

    public function createDosenPBL(Matkul $settingmatakuliah)
    {

        $skenarios = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilais.deleted_at', null)
            ->where('nilai_p_b_l_s.deleted_at', null)
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

    public function storeDosenPBL(Request $request)
    {

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
            ->where('nilais.deleted_at', null)
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
            ->where('nilais.deleted_at', null)
            ->where('nilai_p_b_l_s.deleted_at', null)
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
            throw ValidationException::withMessages(['errorJam' => 'Dosen sudah ada di skenario ' . $validatedData['skenario'] . ', kelompok ' . $validatedData['kelompok'] . '!']);
        }

        return redirect('/dashboard/settingmatakuliah/' . $request->kodematkul . '/settingkelompokpbl/editdosen')->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function deleteDosenPBL(Request $request)
    {

        $diskusis = $request->input('diskusi');
        $skenario = $request->input('skenario');
        foreach ($diskusis as $diskusi) {
            NilaiPBLSkenarioDiskusi::where('id', $diskusi)
                ->delete();
        }

        $getSkenario = NilaiPBLSkenario::where('id', $skenario);
        $idPBL = $getSkenario->first()->pbl->id;

        $getSkenario->delete();

        NilaiPBL::where('id', $idPBL)
            ->delete();

        return redirect('/dashboard/settingmatakuliah/' . $request->kodematkul . '/settingkelompokpbl/editdosen')->with('success', 'Dosen berhasil dihapus sementara!');
    }
    public function forcedeleteDosenPBL(Request $request)
    {

        $diskusis = $request->input('diskusi');
        $skenario = $request->input('skenario');

        foreach ($diskusis as $diskusi) {
            NilaiPBLSkenarioDiskusi::where('deleted_at', '!=', null)->where('id', $diskusi)
                ->forcedelete();
        }

        $getSkenario = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('nilai_p_b_l_skenarios.id', $skenario)
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            ->select('users.name', 'kelompok', 'nilai_p_b_l_skenarios.skenario', 'nilai_p_b_l_skenarios.*', 'nilai_p_b_l_s.id')
            ->get();
        // $getSkenario = NilaiPBLSkenario::where('deleted_at', '!=', null)->where('id', $skenario);

        $idPBL = $getSkenario->first()->id;

        $getSkenario = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('nilai_p_b_l_skenarios.id', $skenario)
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            ->delete();

        NilaiPBL::where('deleted_at', '!=', null)->where('id', $idPBL)
            ->forcedelete();

        return redirect('/dashboard/settingmatakuliah/' . $request->kodematkul . '/settingkelompokpbl/editdosen')->with('success', 'Dosen berhasil dihapus!');
    }

    public function restoreDosenPBL(Request $request)
    {

        $diskusis = $request->input('diskusi');
        $skenario = $request->input('skenario');

        foreach ($diskusis as $diskusi) {
            NilaiPBLSkenarioDiskusi::where('deleted_at', '!=', null)->where('id', $diskusi)
                ->restore();
        }

        $getSkenario = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('nilai_p_b_l_skenarios.id', $skenario)
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            ->select('users.name', 'kelompok', 'nilai_p_b_l_skenarios.skenario', 'nilai_p_b_l_skenarios.*', 'nilai_p_b_l_s.id')
            ->get();
        // $getSkenario = NilaiPBLSkenario::where('deleted_at', '!=', null)->where('id', $skenario);

        $idPBL = $getSkenario->first()->id;

        $getSkenario = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('nilai_p_b_l_skenarios.id', $skenario)
            ->where('nilai_p_b_l_skenarios.deleted_at', '!=', null)
            ->update(['nilai_p_b_l_skenarios.deleted_at' => null]);

        NilaiPBL::where('deleted_at', '!=', null)->where('id', $idPBL)
            ->restore();

        // dd($skenario);
        return redirect('/dashboard/settingmatakuliah/' . $request->kodematkul . '/settingkelompokpbl/editdosen')->with('success', 'Dosen berhasil direstore!');
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

    public function jenisPraktikum(Matkul $settingmatakuliah)
    {

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilai_praktikums.deleted_at', '=', null)
            ->where('nilais.deleted_at', null)
            ->select('nilai_praktikums.namapraktikum')
            ->get()
            ->unique();

        return view('dashboard.matkul.admin.praktikum.index', [
            'matkul' => $settingmatakuliah,
            'praktikums' => $praktikums
        ]);
    }
    public function trashbinPraktikum(Matkul $settingmatakuliah)
    {
        // dd($settingmatakuliah->id);
        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $settingmatakuliah->id)
            ->where('nilai_praktikums.deleted_at', '!=', null)
            ->select('nilai_praktikums.namapraktikum')
            ->get()
            ->unique();

        return view('dashboard.matkul.admin.praktikum.trashbin', [
            'matkul' => $settingmatakuliah,
            'praktikums' => $praktikums
        ]);
    }

    public function restoreJenisPraktikum(Request $request)
    {
        // dd($request);
        $kodematkul = $request->kodematkul;
        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_id)
            ->where('nilai_praktikums.namapraktikum', $request->namapraktikum)
            ->where('nilai_praktikums.deleted_at', '!=', null)
            ->update(['nilai_praktikums.deleted_at' => null]);

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingpraktikum')->with('success', 'Praktikum berhasil direstore!');
    }

    public function createJenisPraktikum(Matkul $settingmatakuliah)
    {

        return view('dashboard.matkul.admin.praktikum.create', [
            'matkul' => $settingmatakuliah
        ]);
    }

    public function storeJenisPraktikum(Request $request)
    {
        $jenispraktikum = $request->input('jenispraktikum');
        $matkul_id = $request->input('matkul_id');
        $kodematkul = $request->input('kodematkul');

        $nilais = DB::table('nilais')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $matkul_id)
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->select('nilais.id')
            ->get();

        foreach ($nilais as $nilai) {
            NilaiPraktikum::create([
                'nilai_id' => $nilai->id,
                'namapraktikum' => $jenispraktikum
            ]);
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingpraktikum')->with('success', 'Praktikum berhasil dihapus!');
    }

    public function deleteJenisPraktikum(Request $request)
    {
        $matkul_id = $request->input('matkul_id');
        $kodematkul = $request->input('kodematkul');
        $namapraktikum = $request->input('namapraktikum');

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $matkul_id)
            ->where('nilai_praktikums.namapraktikum', $namapraktikum)
            ->where('nilais.deleted_at', null)
            ->where('nilai_praktikums.deleted_at', null)
            ->select('nilai_praktikums.id as praktikum_id', 'nilais.id as nilai_id')
            ->get();

        foreach ($praktikums as $praktikum) {
            NilaiPraktikum::where('id', $praktikum->praktikum_id)
                ->delete();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingpraktikum')->with('success', 'Praktikum berhasil dihapus sementara!');
    }
    public function forcedeleteJenisPraktikum(Request $request)
    {
        $matkul_id = $request->input('matkul_id');
        $kodematkul = $request->input('kodematkul');
        $namapraktikum = $request->input('namapraktikum');

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $matkul_id)
            ->where('nilai_praktikums.namapraktikum', $namapraktikum)
            ->where('nilai_praktikums.deleted_at', '!=', null)
            ->select('nilai_praktikums.id as praktikum_id', 'nilais.id as nilai_id')
            ->get();

        foreach ($praktikums as $praktikum) {
            NilaiPraktikum::where('id', $praktikum->praktikum_id)
                ->forcedelete();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingpraktikum')->with('success', 'Praktikum berhasil dihapus!');
    }
    public function emptyPraktikum(Request $request)
    {
        $matkul_id = $request->input('matkul_id');
        $kodematkul = $request->input('kodematkul');
        $namapraktikum = $request->input('namapraktikum');

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $matkul_id)
            ->where('nilai_praktikums.deleted_at', '!=', null)
            ->select('nilai_praktikums.id as praktikum_id', 'nilais.id as nilai_id')
            ->get();

        foreach ($praktikums as $praktikum) {
            NilaiPraktikum::where('id', $praktikum->praktikum_id)
                ->forcedelete();
        }

        return redirect('/dashboard/settingmatakuliah/' . $kodematkul . '/settingpraktikum')->with('success', 'Trashbin berhasil dikosongkan!');
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
