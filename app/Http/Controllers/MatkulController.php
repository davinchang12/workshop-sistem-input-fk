<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
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
        $nilais = Nilai::where('user_id', auth()->user()->id)->groupBy('matkul_id')->get();

        $mhs_rincian_nilai_akhir = DB::table('rincian_nilai_akhirs')
            ->join('nilais', 'rincian_nilai_akhirs.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('nilais.deleted_at', null)
            ->where('users.id', auth()->user()->id)
            ->select('rincian_nilai_akhirs.keterangan', 'matkuls.bobot_sks')
            ->get();

        $poin = 0;
        $total_bobot_sks = 0;
        $ip = "";
        if (count($mhs_rincian_nilai_akhir) > 0) {
            foreach ($mhs_rincian_nilai_akhir as $rincian) {
                if ($rincian->keterangan == "A") {
                    $poin += ($rincian->bobot_sks * 4);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "AB") {
                    $poin += ($rincian->bobot_sks * 3.5);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "B") {
                    $poin += ($rincian->bobot_sks * 3);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "BC") {
                    $poin += ($rincian->bobot_sks * 2.5);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "C") {
                    $poin += ($rincian->bobot_sks * 2);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "CD") {
                    $poin += ($rincian->bobot_sks * 1.5);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "D") {
                    $poin += ($rincian->bobot_sks * 1);
                    $total_bobot_sks += $rincian->bobot_sks;
                } elseif ($rincian->keterangan == "E") {
                    $poin += 0;
                    $total_bobot_sks += $rincian->bobot_sks;
                }
            }
            $ip = $poin / $total_bobot_sks;
        }

        return view('dashboard.matkul.index', [
            'nilais' => $nilais,
            'ip' => $ip,
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

        $nilaitugas = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $matkul->id)
            ->get();

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkul_id', $matkul->id)
            ->where('nilai_praktikums.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->groupBy('nilai_praktikums.namapraktikum')
            ->get();

        $ujians = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
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
            ->where('nilais.deleted_at', null)
            ->get();

        $checkpraktikumujians = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
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
            ->where('nilais.deleted_at', null)
            ->get();

        if ($checkpraktikumujians->isEmpty()) {
            $ujians = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                ->where('users.role', 'mahasiswa')
                ->where('matkuls.id', $matkul->id)
                ->where('nilais.deleted_at', null)
                ->get();
        }

        $skenarios = DB::table('nilai_p_b_l_skenario_diskusis')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where($checkUserAndMatkul)
            ->where('nilais.deleted_at', null)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->select('nilai_p_b_l_skenario_diskusis.diskusi', 'nilai_p_b_l_skenarios.kelompok', 'nilai_p_b_l_skenarios.skenario', 'nilai_p_b_l_skenario_diskusis.tanggal_pelaksanaan', 'matkuls.keterangan', 'matkuls.tahun_ajaran', 'nilai_p_b_l_skenario_diskusis.id as diskusi_id')
            ->get();

        return view('dashboard.nilai.dosen.index', [
            'praktikums' => $praktikums,
            'nilaitugas' => $nilaitugas,
            'dosen' => auth()->user()->id,
            'namamatkul' => Matkul::where('id', $matkul->id)->pluck('namamatkul'),
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
