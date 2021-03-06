<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\RincianNilaiTugas;
use App\Exports\LaporanPBLExports;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanTugasExport;
use App\Exports\LaporanUjianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPraktikumExport;
use App\Exports\LaporanNilaiAkhirExport;

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

        $check_pbl_dosens = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.id', auth()->user()->id)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->first();

        if ($check_pbl_dosens == null) {
            $pbl_dosens = array();
        } else {
            $pbl_dosens = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
                ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
                ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
                ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
                ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->where('matkuls.id', $request->matkul_dipilih)
                ->where('nilai_p_b_l_skenarios.skenario', $check_pbl_dosens->skenario)
                ->where('nilai_p_b_l_s.deleted_at', null)
                ->where('nilais.deleted_at', null)
                ->get();
        }


        $pbls = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
            ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->get();

        $check_pbl = DB::table('nilai_p_b_l_s')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->get();

        $get_praktikum_dosens = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.id', auth()->user()->id)
            ->where('users.role', '!=', 'mahasiswa')
            ->where('nilai_praktikums.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->select('namapraktikum')
            ->first();

        if ($get_praktikum_dosens == null) {
            $praktikum_dosens = array();
        } else {
            $praktikum_dosens = DB::table('nilai_jenis_praktikums')
                ->join('nilai_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
                ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->where('matkuls.id', $request->matkul_dipilih)
                ->where('nilai_praktikums.deleted_at', null)
                ->where('namapraktikum', $get_praktikum_dosens->namapraktikum)
                ->where('nilais.deleted_at', null)
                ->get();
        }

        $praktikums = DB::table('nilai_jenis_praktikums')
            ->join('nilai_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilai_praktikums.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->get();

        $nilaitugas = RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->where('nilais.user_id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->get();

        $nilaitugas_dosen = RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->orderBy('nilais.id')
            ->orderBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->get();

        $topik_tugas =  RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->groupBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->get();


        $ujiandosens = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->groupBy('nilais.user_id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->get();

        $ujians = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->where('nilais.matkul_id', $request->matkul_dipilih)
            ->where('nilais.user_id', auth()->user()->id)
            ->where('nilais.deleted_at', null)
            ->get();

        return view('dashboard.nilai.index', [
            'pbl_dosens' => $pbl_dosens,
            'nilaitugas_dosen' => $nilaitugas_dosen,
            'ujian_dosens' => $ujiandosens,
            'ujians' => $ujians,
            'nilaitugas' => $nilaitugas->unique(),
            'topik_tugas' => $topik_tugas,
            'pbls' => $pbls,
            'check_pbl_dosen' => $check_pbl->contains('name', auth()->user()->name),
            'praktikum_dosens' => $praktikum_dosens,
            'praktikums' => $praktikums,
        ]);
    }

    public function laporan_index()
    {
        $matkuls = DB::table('matkuls')
            ->where('matkuls.deleted_at', '=', null)
            ->orderBy('keterangan', 'ASC')
            ->get();
        return view('dashboard.laporannilai.index', [
            'matkuls' => $matkuls,
        ]);
    }

    public function laporan_get(Request $request)
    {

        $tugas = DB::table('rincian_nilai_tugas')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->first();

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->groupBy('nilai_praktikums.namapraktikum')
            ->get();

        $pbls = DB::table('nilai_p_b_l_skenarios')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->where('nilai_p_b_l_skenarios.deleted_at', '=', null)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->where('users.role', 'mahasiswa')
            ->groupBy('nilai_p_b_l_skenarios.skenario')
            ->get();

        $ujians = DB::table('nilais')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->first();

        $matkul = DB::table('matkuls')
            ->where('id', $request->matkul_dipilih)
            ->first();

        return view('dashboard.laporannilai.get', [
            'tugas' => $tugas,
            'praktikums' => $praktikums,
            'pbls' => $pbls,
            'ujians' => $ujians,
            'matkul' => $matkul,
        ]);
    }

    public function laporan_get_tugas(Request $request)
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanTugasExport, 'laporannilaitugas.xlsx');
    }

    public function laporan_get_pbl(Request $request)
    {
        $this->authorize('dosen');

        $exportpbls = new LaporanPBLExports();

        return Excel::download($exportpbls, 'laporannilaipbl' . $request->skenario . '.xlsx');
    }

    public function laporan_get_praktikum(Request $request)
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanPraktikumExport, 'laporannilaipraktikum' . $request->namapraktikum . '.xlsx');
    }

    public function laporan_get_ujian()
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanUjianExport, 'laporannilaiujian.xlsx');
    }

    public function laporan_get_nilaiakhir(Request $request)
    {

        return view('dashboard.laporannilai.nilaiakhir', [
            'matkul_dipilih' => $request->matkul_dipilih,
            'namamatkul' => $request->namamatkul,
        ]);
    }

    public function laporan_get_nilaiakhir_export(Request $request)
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanNilaiAkhirExport, 'laporannilaiakhir.xlsx');
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
