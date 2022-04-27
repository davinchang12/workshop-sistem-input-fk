<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use App\Models\NilaiTugas;
use Illuminate\Http\Request;
use App\Models\NilaiPraktikum;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        
        $pbl_dosens = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
            ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        
        $pbls = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
            ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $check_pbl = DB::table('nilai_p_b_l_s')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'nilais.id')
            ->get();

        $praktikum_dosens = DB::table('nilai_jenis_praktikums')
            ->join('nilai_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $praktikums = DB::table('nilai_jenis_praktikums')
            ->join('nilai_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $check_praktikum = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->get();

        $nilaitugas_dosen = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->orderBy('nilais.id')
            ->orderBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        $listtugas = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->groupBy('nilais.id')
            ->orderBy('nilais.id')
            ->orderBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        // dd($listtugas);
        foreach($listtugas as $tugas){
            // dd($tugas->rincian_nilai_tugas_id);
            $avgtugas = Jadwal::select('nilai_tugas.nilaitugas')
                ->join('users', 'jadwals.user_id', '=', 'users.id')
                ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
                ->join('nilais', 'nilais.user_id', '=', 'users.id')
                ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                // ->orderBy('nilais.id')
                // ->orderBy('nilai_tugas.keterangantugas')
                ->where('users.role', 'mahasiswa')
                ->where('rincian_nilai_tugas.id', $tugas->rincian_nilai_tugas_id)
                ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                ->where('matkuls.id', $request->matkul_dipilih)
                ->avg('nilai_tugas.nilaitugas');
            $avgtugas2 = Jadwal::select('nilai_tugas.nilaitugas')
                ->join('users', 'jadwals.user_id', '=', 'users.id')
                ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
                ->join('nilais', 'nilais.user_id', '=', 'users.id')
                ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                // ->orderBy('nilais.id')
                // ->orderBy('nilai_tugas.keterangantugas')
                ->where('users.role', 'mahasiswa')
                ->where('rincian_nilai_tugas.nilai_id', $tugas->nilai_id)
                ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                ->where('matkuls.id', $request->matkul_dipilih)
                ->update(['rincian_nilai_tugas.rataratatugas' => $avgtugas]);
            // dd($avgtugas);
        }
        // dd($nilaitugas_dosen);
        
        $topik_tugas = Jadwal::select('nilai_tugas.keterangantugas', 'nilai_tugas.nilaitugas')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            // ->groupBy('users.id')
            ->groupBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        // dd($topik_tugas);
        $nilaitugas = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->where('users.id', auth()->user()->id)
            // ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        $ujiandosens = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*' , 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        $ujians = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*' , 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->where('users.id', auth()->user()->id)
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
            // $ujians= DB::table('nilai_ujians')->select('nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
            // ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            // ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            // ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            // ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            // ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            // ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            // // ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            // // ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            // ->join('users', 'users.id', '=', 'nilais.user_id')
            // ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            // ->where('users.id', auth()->user()->id)
            // ->where('users.role', 'mahasiswa')
            // ->where('matkuls.id', $request->matkul_dipilih)
            // ->get();
            // dd($ujians);
        return view('dashboard.nilai.index', [
            'pbl_dosens' => $pbl_dosens,
            'nilaitugas_dosen' => $nilaitugas_dosen,
            'ujian_dosens' => $ujiandosens,
            'ujians' => $ujians,
            'nilaitugas' => $nilaitugas,
            'topik_tugas' => $topik_tugas,
            'pbls' => $pbls,
            'check_pbl_dosen' => $check_pbl->contains('name', auth()->user()->name),
            'praktikum_dosens' => $praktikum_dosens,
            'praktikums' => $praktikums,
            'check_praktikum_dosen' => $check_praktikum->contains('name', auth()->user()->name)
        ]);
    }
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }    
}
