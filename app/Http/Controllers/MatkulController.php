<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use App\Models\NilaiTugas;
use Illuminate\Http\Request;
use App\Models\NilaiJenisSOCA;
use Illuminate\Support\Facades\DB;
use App\Models\NilaiPBLSkenarioDiskusi;

class MatkulController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilais = Nilai::where('user_id', auth()->user()->id)->get();
        
        return view('dashboard.matkul.index', [
            'nilais' => $nilais,
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
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function show(Matkul $matkul)
    {
        $this->authorize('dosen');
        $checkUserAndMatkul = [
            'user_id' => auth()->user()->id,
            'matkul_id' => $matkul->id 
        ];
        // dd($matkul->namamatkul);
        // $nilaitugas=  DB::table('nilai_tugas')
        // ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.id', '=', 'rincian_nilai_tugas_id')
        // ->join('nilais', 'nilais.id', '=', 'rincian_nilai_tugas.nilai_id')
        // ->join('users', 'users.id', '=', 'nilais.user_id')
        // ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        // ->where('matkul_id', '=', $matkul->id )
        // ->get();

        $nilaitugas = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
        ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
        ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
        ->where('users.role', 'mahasiswa')
        ->where('matkuls.id', $matkul->id)
        ->get();

        $socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $matkul->id)
            ->where('users.role', 'mahasiswa')
            ->select('name', 'nim')
            ->get();
      
        $osces = DB::table('nilai_o_s_c_e_s')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->select('name', 'nim')
            ->get();
            
        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where($checkUserAndMatkul)
            ->get();
      
//         $fieldlabs = DB::table('nilai_semester_field_labs')
//             ->join('nilai_fieldlabs', 'nilai_semester_field_labs.nilai_field_lab_id', '=', 'nilai_fieldlabs.id')
        $fieldlabs = DB::table('nilai_fieldlabs')
            ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
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
        ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
        ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
        ->where('users.role', 'mahasiswa')
        ->where('matkuls.id', $matkul->id)
        ->get();
        // dd($ujians);
        $checkpraktikumujians = Jadwal::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*' , 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
        ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
        ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
        ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
        ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
        ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
        ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
        ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
        ->where('users.role', 'mahasiswa')
        ->where('matkuls.id', $matkul->id)
        ->get();
        // dd($checkpraktikumujians->isEmpty());$checkpraktikumujians->isEmpty()
       if($checkpraktikumujians->isEmpty()){
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
        ->where('users.role', 'mahasiswa')
        ->where('matkuls.id', $matkul->id)
        ->get();
        }
        $nilai = Nilai::where($checkUserAndMatkul)->first();
        $skenarios = $nilai->pbl->pblskenario ?? null;
      
        return view('dashboard.nilai.dosen.index', [
            'kelompoks' => Kelompok::where($checkUserAndMatkul)->get(),
            'praktikums' => $praktikums,
            'nilaitugas' => $nilaitugas,
            'dosen' => auth()->user()->id,
            'namamatkul' => Matkul::where('id', $matkul->id)->pluck('namamatkul'),
            'socas' => $socas,
            'osces' => $osces,
            'fieldlabs' => $fieldlabs,
            'matkul' => $matkul,
            'skenarios' => $skenarios,
            'ujians' => $ujians,
            'checkpraktikumujians' => $checkpraktikumujians
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function edit(Matkul $matkul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matkul $matkul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matkul $matkul)
    {
        //
    }
}
