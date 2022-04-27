<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\NilaiUjian;
use App\Models\JenisFeedbackUTB;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiUjianExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {   
         $request = request();
         $students = Jadwal::select('nilais.id')
         ->join('users', 'jadwals.user_id', '=', 'users.id')
         ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
         ->join('nilais', 'nilais.user_id', '=', 'users.id')
         ->orderBy('nilais.id')
         ->where('users.role', 'mahasiswa')
         ->where('matkuls.id', $request->matkul_dipilih)
         ->get();
        // dd($students);
        $checkujian = Jadwal::select('nilai_ujians.nilai_id')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
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
        if($checkujian->isEmpty()){
            foreach( $students as $nilai ){
                
                DB::table('nilai_ujians')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['nilai_ujians.nilai_id'=> $nilai->id]);
            }
            // dd();
        }

        $ujians= Jadwal::select('nilai_ujians.*')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
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
        if($checkhasil->isEmpty()){
            $j = 0;
            foreach( $ujians as $ujian ){
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
                        ->insert(['hasil_nilai_ujians.nilai_ujian_id'=> $ujianid[$j]]);
               $j++;
               
            }
        }
        $hasilujians= DB::table('hasil_nilai_ujians')
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
        if($checkuabs->isEmpty()){
            $k = 0;
            foreach( $hasilujians as $hasilujian ){
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
                    ->insert(['feedback_u_a_b_s.hasil_ujians_id'=> $hasilujianid[$k]]);
               $k++;
               
            }
        }
        
        $uabs= DB::table('feedback_u_a_b_s')
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
        if($checkjenisuabs->isEmpty()){
            $l = 0;
            foreach( $uabs as $uab ){
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
                ->insert(['jenis_feedback_u_a_b_s.feedback_uab_id'=> $utbid[$l]]);
               $l++;
               
            }
        }
        
        $jenisuabs= DB::table('jenis_feedback_u_a_b_s')
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
        if($checkutbs->isEmpty()){
            $k = 0;
            foreach( $hasilujians as $hasilujian ){
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
                    ->insert(['feedback_u_t_b_s.hasil_ujians_id'=> $hasilujianid[$k]]);
               $k++;
               
            }
        }
        
        $utbs= DB::table('feedback_u_t_b_s')
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
        if($checkjenisutbs->isEmpty()){
            $l = 0;
            foreach( $utbs as $utb ){
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
                ->insert(['jenis_feedback_u_t_b_s.feedback_utb_id'=> $utbid[$l]]);
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
            
            foreach( $students as $student ){
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
                    ->update(['feedback_u_t_b_s.total'=> $skor_utbs]);
                
                    
                    $totaluab = DB::table('feedback_u_a_b_s')
                    ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
                    ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('nilais.id', $student->id)
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->update(['feedback_u_a_b_s.total'=> $skor_uabs]);
                
                    DB::table('hasil_nilai_ujians')
                    ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('nilais.id', $student->id)
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->update(['hasil_nilai_ujians.utb'=> $skor_utbs]);
                    DB::table('hasil_nilai_ujians')
                    ->join('nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('nilais.id', $student->id)
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->update(['hasil_nilai_ujians.uab'=> $skor_uabs]);
                    
                
            }
            // dd($skor_uabs);
        
        $jenisutbs= DB::table('jenis_feedback_u_t_b_s')
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
        
        $dosen = User::where('id', '=', auth()->user()->id)->value('name');
        $ujians= DB::table('nilai_ujians')
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
        ->get();
       if($ujians->isEmpty()){
            $ujians= DB::table('nilai_ujians')
            ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.nilai_ujian_id', '=', 'nilai_ujians.id')
            ->join('feedback_u_t_b_s', 'feedback_u_t_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
            ->join('feedback_u_a_b_s', 'feedback_u_a_b_s.hasil_ujians_id', '=', 'hasil_nilai_ujians.id')
            ->join('jenis_feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            // ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            // ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
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
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:P1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A2:P2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A3:P3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        ];
    }
}
