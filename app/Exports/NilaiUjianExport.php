<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiUjianExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        $students = Nilai::select('nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $checkujian = Nilai::select('nilai_ujians.nilai_id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        if ($checkujian->isEmpty()) {
            foreach ($students as $nilai) {
                DB::table('nilai_ujians')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.deleted_at', null)
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['nilai_ujians.nilai_id' => $nilai->id]);
            }
        }

        $ujians = Nilai::select('nilai_ujians.*')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_ujians', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $checkhasil = DB::table('hasil_nilai_ujians')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('hasil_nilai_ujians.nilai_ujian_id')
            ->get();

        if ($checkhasil->isEmpty()) {
            $j = 0;
            foreach ($ujians as $ujian) {
                $ujianid = DB::table('nilai_ujians')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->pluck('nilai_ujians.id');

                DB::table('hasil_nilai_ujians')
                    ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.deleted_at', null)
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
            ->where('nilais.deleted_at', null)
            ->get();

        $checkuabs = DB::table('feedback_u_a_b_s')
            ->join('hasil_nilai_ujians', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('nilai_ujians.nilai_id')->get();

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
                    ->where('nilais.deleted_at', null)
                    ->pluck('hasil_nilai_ujians.id');

                DB::table('feedback_u_a_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
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
            ->where('nilais.deleted_at', null)
            ->get();

        $checkjenisuabs =   DB::table('jenis_feedback_u_a_b_s')
            ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('jenis_feedback_u_a_b_s.feedback_uab_id')
            ->get();

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
                    ->where('nilais.deleted_at', null)
                    ->pluck('feedback_u_a_b_s.id');

                DB::table('jenis_feedback_u_a_b_s')
                    ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->insert(['jenis_feedback_u_a_b_s.feedback_uab_id' => $utbid[$l]]);
                $l++;
            }
        }

        $checkutbs = DB::table('feedback_u_t_b_s')
            ->join('hasil_nilai_ujians', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('nilai_ujians.nilai_id')
            ->get();

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
                    ->where('nilais.deleted_at', null)
                    ->pluck('hasil_nilai_ujians.id');

                DB::table('feedback_u_t_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
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
            ->where('nilais.deleted_at', null)
            ->get();

        $checkjenisutbs =   DB::table('jenis_feedback_u_t_b_s')
            ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('jenis_feedback_u_t_b_s.feedback_utb_id')
            ->get();

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
                    ->where('nilais.deleted_at', null)
                    ->pluck('feedback_u_t_b_s.id');

                DB::table('jenis_feedback_u_t_b_s')
                    ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->insert(['jenis_feedback_u_t_b_s.feedback_utb_id' => $utbid[$l]]);
                $l++;
            }
        }

        foreach ($students as $student) {
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
                ->where('nilais.deleted_at', null)
                ->sum('jenis_feedback_u_t_b_s.skor');

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
                ->where('nilais.deleted_at', null)
                ->sum('jenis_feedback_u_a_b_s.skor');


            DB::table('feedback_u_t_b_s')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
                ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->where('nilais.deleted_at', null)
                ->update(['feedback_u_t_b_s.total' => $skor_utbs]);


            DB::table('feedback_u_a_b_s')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->where('nilais.deleted_at', null)
                ->update(['feedback_u_a_b_s.total' => $skor_uabs]);

            DB::table('hasil_nilai_ujians')
                ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->where('nilais.deleted_at', null)
                ->update(['hasil_nilai_ujians.utb' => $skor_utbs]);

            DB::table('hasil_nilai_ujians')
                ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('nilais.id', $student->id)
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->where('nilais.deleted_at', null)
                ->update(['hasil_nilai_ujians.uab' => $skor_uabs]);
        }

        DB::table('jenis_feedback_u_t_b_s')
            ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
            ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->get();

        $dosen = User::where('id', '=', auth()->user()->id)->value('name');
        $ujians = DB::table('nilai_ujians')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->get();

        if ($ujians->isEmpty()) {
            $ujians = DB::table('nilai_ujians')
                ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
                ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
                ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
                ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->where('nilais.deleted_at', null)
                ->get();

            return view('dashboard.nilai.dosen.export.nilaiujiana', [
                'ujians' => $ujians,
                'namamatkul' => Matkul::where('id', $request->matkul_dipilih)->value('namamatkul'),
                'dosen' => $dosen
            ]);
        }

        return view('dashboard.nilai.dosen.export.nilaiujianb', [
            'ujians' => $ujians,
            'namamatkul' => Matkul::where('id', $request->matkul_dipilih)->value('namamatkul'),
            'dosen' => $dosen
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:P1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A2:P2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A3:P3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        ];
    }
}
