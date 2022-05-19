<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use App\Models\FeedbackUjian;
use App\Models\AksesEditNilai;
use App\Models\HasilNilaiUjian;
use App\Exports\NilaiUjianExport;
use App\Imports\NilaiUjianImport;
use App\Exports\FeedbackUABExport;
use App\Exports\FeedbackUTBExport;
use App\Imports\FeedbackUABImport;
use App\Imports\FeedbackUTBImport;
use App\Models\JenisFeedbackUjian;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Http\Requests\StoreNilaiUjianRequest;
use App\Http\Requests\UpdateNilaiUjianRequest;

class NilaiUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreNilaiUjianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('dosen');
        // dd($request);
        $students = Nilai::select('nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        // dd($students);
        $checkujian = Nilai::select('nilai_ujians.nilai_id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        // DB::table('nilai_ujians')
        // ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
        // ->join('users', 'users.id', '=', 'nilais.user_id')
        // ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        // ->where('users.role', 'mahasiswa')
        // ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
        // ->select('nilai_ujians.nilai_id')->get();
        // dd($checkujian->isEmpty());
        if ($checkujian->isEmpty()) {
            foreach ($students as $nilai) {

                DB::table('nilai_ujians')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['nilai_ujians.nilai_id' => $nilai->id]);
            }
            // dd();
        }

        $ujians = Nilai::select('nilai_ujians.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $checkhasil = DB::table('hasil_nilai_ujians')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->select('hasil_nilai_ujians.nilai_ujian_id')->get();
        // dd($checkhasil->isEmpty());
        if ($checkhasil->isEmpty()) {
            $j = 0;
            foreach ($ujians as $ujian) {
                $ujianid = DB::table('nilai_ujians')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->pluck('nilai_ujians.id');
                // dd($ujianid);
                DB::table('hasil_nilai_ujians')
                    ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['hasil_nilai_ujians.nilai_ujian_id' => $ujianid[$j]]);
                $j++;
            }
        }
        $hasilujians = DB::table('hasil_nilai_ujians')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->get();
        // dd($hasilujians);
        $checkuabs = DB::table('feedback_u_a_b_s')
            ->join('hasil_nilai_ujians', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->select('nilai_ujians.nilai_id')->get();
        // dd($checkuabs->isEmpty());
        if ($checkuabs->isEmpty()) {
            $k = 0;
            foreach ($hasilujians as $hasilujian) {
                $hasilujianid = DB::table('hasil_nilai_ujians')
                    ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->pluck('hasil_nilai_ujians.id');
                // dd($ujianid);
                DB::table('feedback_u_a_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['feedback_u_a_b_s.hasil_ujians_id' => $hasilujianid[$k]]);
                $k++;
            }
        }

        $uabs = DB::table('feedback_u_a_b_s')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->get();
        // dd($uabs);

        $checkjenisuabs =   DB::table('jenis_feedback_u_a_b_s')
            ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->select('jenis_feedback_u_a_b_s.feedback_uab_id')->get();
        // dd($checkjenisuabs->isEmpty());
        if ($checkjenisuabs->isEmpty()) {
            $l = 0;
            foreach ($uabs as $uab) {
                $utbid = DB::table('feedback_u_a_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->pluck('feedback_u_a_b_s.id');
                // dd($utbid);
                DB::table('jenis_feedback_u_a_b_s')
                    ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['jenis_feedback_u_a_b_s.feedback_uab_id' => $utbid[$l]]);
                $l++;
            }
        }

        $jenisuabs = DB::table('jenis_feedback_u_a_b_s')
            ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->get();
        // dd($jenisuabs);
        $checkutbs = DB::table('feedback_u_t_b_s')
            ->join('hasil_nilai_ujians', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->select('nilai_ujians.nilai_id')->get();
        // dd($checkutbs->isEmpty());
        if ($checkutbs->isEmpty()) {
            $k = 0;
            foreach ($hasilujians as $hasilujian) {
                $hasilujianid = DB::table('hasil_nilai_ujians')
                    ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->pluck('hasil_nilai_ujians.id');
                // dd($ujianid);
                DB::table('feedback_u_t_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['feedback_u_t_b_s.hasil_ujians_id' => $hasilujianid[$k]]);
                $k++;
            }
        }

        $utbs = DB::table('feedback_u_t_b_s')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->get();
        // dd($utbs);

        $checkjenisutbs =   DB::table('jenis_feedback_u_t_b_s')
            ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->select('jenis_feedback_u_t_b_s.feedback_utb_id')->get();
        // dd($checkjenisutbs->isEmpty());
        if ($checkjenisutbs->isEmpty()) {
            $l = 0;
            foreach ($utbs as $utb) {
                $utbid = DB::table('feedback_u_t_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->pluck('feedback_u_t_b_s.id');
                // dd($utbid);
                DB::table('jenis_feedback_u_t_b_s')
                    ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['jenis_feedback_u_t_b_s.feedback_utb_id' => $utbid[$l]]);
                $l++;
            }
        }


        $nilaiids = DB::table('nilais')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->select(['nilais.id'])->get();
        // dd($students);

        foreach ($students as $student) {
            // dd($student->id);
            $skor_utbs =  DB::table('jenis_feedback_u_t_b_s')
                ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->sum('jenis_feedback_u_t_b_s.skor');
            // dd($skor_utbs);
            $skor_uabs =  DB::table('jenis_feedback_u_a_b_s')
                ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->sum('jenis_feedback_u_a_b_s.skor');
            // dd($skor_uabs);


            $totalutb = DB::table('feedback_u_t_b_s')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->update(['feedback_u_t_b_s.total' => $skor_utbs]);


            $totaluab = DB::table('feedback_u_a_b_s')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->update(['feedback_u_a_b_s.total' => $skor_uabs]);

            DB::table('hasil_nilai_ujians')
                ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->update(['hasil_nilai_ujians.utb' => $skor_utbs]);
            DB::table('hasil_nilai_ujians')
                ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->update(['hasil_nilai_ujians.uab' => $skor_uabs]);
        }
        // dd($skor_uabs);

        $jenisutbs = DB::table('jenis_feedback_u_t_b_s')
            ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->get();
        // dd($jenisutbs);

        $persenutb = $request->persenutb / 100;
        $persenuab = $request->persenuab / 100;
        $persenpraktikum = $request->persenpraktikum / 100;
        $rataminimal = $request->ratamin;
        $persenfinalcbt = $request->persenfinalcbt / 100;
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
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        $praktikumujians = Nilai::select('nilai_praktikums.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            // ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->groupBy('nilai_praktikums.namapraktikum')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', $request->matkul_dipilih)->get();
        $jumlahpraktikums = (count($praktikumujians));
        // dd($checkpraktikumujians->isnotEmpty());

        if ($checkpraktikumujians->isnotEmpty()) {
            $ujians = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                ->where('matkuls.id', $request->matkul_dipilih)
                ->get();
            foreach ($ujians as $ujian) {
                // dd($ujian->nilai_id);
                $sumpraktikum = Nilai::join('users', 'nilais.user_id', '=', 'users.id')
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
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->sum('nilai_jenis_praktikums.nilai_akhir');

                $ratapraktikum = $sumpraktikum / $jumlahpraktikums;
                $utb = $ujian->utb;
                $uab = $ujian->uab;
                $remedi = $ujian->remediujian;
                $uabcombined = ($uab * $persenuab) + ($ratapraktikum * $persenpraktikum);
                $sintakutb = ($utb * $persenutb);
                $sintakuab = ($uab * $persenuab);
                $ratarata = ($utb + $uab) / 2;
                $rataratas = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['hasil_nilai_ujians.ratarataujian' => $ratarata]);
                $sintakutbs = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.sintakutb' => $sintakutb]);
                $sintakuabs = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.sintakuab' => $sintakuab]);
                $ratarataminimal = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.ratamin' => $rataminimal]);
                $uabc = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.uabcombined' => $uabcombined]);


                if ($ujian->remediujian >= $ujian->ratarataujian) {
                    $cbtfinal = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                        ->where('nilais.id', $ujian->nilai_id)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->update(['nilai_ujians.finalcbt' => $ujian->remediujian]);
                    $uabcombinedremed = ($ujian->finalcbt * $persenfinalcbt) + ($ratapraktikum * $persenpraktikum);
                    $uabd = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                        ->where('nilais.id', $ujian->nilai_id)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->update(['nilai_ujians.uabcombinedremedial' => $uabcombinedremed]);
                } else {
                    $cbtfinal = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'nilai_praktikums.*', 'nilai_jenis_praktikums.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
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
                        ->where('nilais.id', $ujian->nilai_id)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->update(['nilai_ujians.finalcbt' => $ujian->ratarataujian]);
                }
            }
        } else {
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
                ->where('matkuls.id', $request->matkul_dipilih)
                ->get();
            foreach ($ujians as $ujian) {
                // dd($ujian->nilai_id);
                $utb = $ujian->utb;
                $uab = $ujian->uab;
                $remedi = $ujian->remediujian;
                $uabcombined = ($uab * $persenuab);
                $sintakutb = ($utb * $persenutb);
                $sintakuab = ($uab * $persenuab);
                $ratarata = ($utb + $uab) / 2;
                $rataratas = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['hasil_nilai_ujians.ratarataujian' => $ratarata]);
                $sintakutbs = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.sintakutb' => $sintakutb]);
                $sintakuabs = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.sintakuab' => $sintakuab]);
                $ratarataminimal = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.ratamin' => $rataminimal]);
                $uabc = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                    ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.id', $ujian->nilai_id)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['nilai_ujians.uabcombined' => $uabcombined]);
                if ($ujian->remediujian >= $ujian->ratarataujian) {
                    $cbtfinal = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                        ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                        ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                        ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                        ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilais.id', $ujian->nilai_id)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->update(['nilai_ujians.finalcbt' => $ujian->remediujian]);
                    $uabcombinedremed = ($ujian->finalcbt * $persenfinalcbt);
                    $uabd = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                        ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                        ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                        ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                        ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilais.id', $ujian->nilai_id)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->update(['nilai_ujians.uabcombinedremedial' => $uabcombinedremed]);
                } else {
                    $cbtfinal = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_ujians.*', 'hasil_nilai_ujians.*', 'feedback_u_t_b_s.*', 'feedback_u_a_b_s.*', 'jenis_feedback_u_t_b_s.*', 'jenis_feedback_u_a_b_s.*')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                        ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                        ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                        ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                        ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilais.id', $ujian->nilai_id)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->update(['nilai_ujians.finalcbt' => $ujian->ratarataujian]);
                }
            }
        }


        return redirect('/dashboard/matkul/' . $request->kodematkul);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiUjian $nilaiUjian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiUjian $nilaiUjian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiUjianRequest  $request
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiUjianRequest $request, NilaiUjian $nilaiUjian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiUjian $nilaiUjian)
    {
        //
    }
    public function import_ujian(Request $request)
    {
        $this->authorize('dosen');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('nilai_ujian', $nama_file);

        Excel::import(new NilaiUjianImport, public_path('/nilai_ujian/' . $nama_file));

        Session::flash('sukses', 'Nilai Ujian Berhasil Diimport!');

        File::delete(public_path('/nilai_ujian/' . $nama_file));

        return redirect('/dashboard/matkul');
    }
    public function export_ujian()
    {
        $this->authorize('dosen');
        return Excel::download(new NilaiUjianExport, 'nilaiujian.xlsx');
    }

    public function import_utb(Request $request)
    {
        $this->authorize('dosen');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('feedback_utb', $nama_file);

        Excel::import(new FeedbackUTBImport, public_path('/feedback_utb/' . $nama_file));

        Session::flash('sukses', 'Nilai Feedback UTB Berhasil Diimport!');

        File::delete(public_path('/feedback_utb/' . $nama_file));

        return redirect('/dashboard/matkul');
    }
    public function export_utb()
    {
        $this->authorize('dosen');
        return Excel::download(new FeedbackUTBExport, 'feedbackutb.xlsx');
    }

    public function import_uab(Request $request)
    {
        $this->authorize('dosen');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('feedback_uab', $nama_file);

        Excel::import(new FeedbackUABImport, public_path('/feedback_uab/' . $nama_file));

        Session::flash('sukses', 'Feedback UAB Berhasil Diimport!');

        File::delete(public_path('/feedback_uab/' . $nama_file));

        return redirect('/dashboard/matkul');
    }
    public function export_uab()
    {
        $this->authorize('dosen');
        return Excel::download(new FeedbackUABExport, 'feedbackuab.xlsx');
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'UJIAN')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("ujian", true);

                    $ujians = Nilai::select('nilai_ujians.*')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                        ->orderBy('nilais.id')
                        ->where('users.role', 'mahasiswa')
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->get();

                    $jenisutbs = DB::table('jenis_feedback_u_t_b_s')
                        ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                        ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                        ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                        ->join('users', 'users.id', '=', 'nilais.user_id')
                        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                        ->get();

                    $dosen = User::where('id', '=', auth()->user()->id)->value('name');

                    return view('dashboard.nilai.dosen.export.ujian', [
                        'ujians' => $ujians,
                        'utbs' => $jenisutbs,
                        'namamatkul' => Matkul::where('id', $request->matkul_dipilih)->pluck('namamatkul'),
                        'dosen' => $dosen
                    ]);
                }
            }
        } else {
            return back()->with('fail', 'Password edit salah!');
        }
    }

    public function simpan(Request $request)
    {

        AksesEditNilai::where('jenisnilai', 'UJIAN')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/matkul/' . $request->input('kodematkul'))->with('success', 'Nilai Feedback UTB berhasil diedit!');
    }
}
