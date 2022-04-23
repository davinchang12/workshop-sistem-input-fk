<?php

namespace App\Exports;

namespace App\Exports;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\JenisFeedbackUAB;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FeedbackUABExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $request = request();
        
        $dosen = User::where('id', '=', auth()->user()->id)->value('name');
        $students = DB::table('nilais')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->get();
        // dd($students);
        $checkujian = DB::table('nilai_ujians')
        ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        ->where('users.role', 'mahasiswa')
        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
        ->select('nilai_ujians.nilai_id')->get();
        // dd($checkujian->isEmpty());
        if($checkujian->isEmpty()){
            $i = 0;
            foreach( $students as $nilai ){
                $nilaiid = DB::table('nilais')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->pluck('nilais.id');
                
                DB::table('nilai_ujians')
                    ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->insert(['nilai_ujians.nilai_id'=> $nilaiid[$i]]);
               $i++;
            }
        }

        $ujians= DB::table('nilai_ujians')
        ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        ->where('users.role', 'mahasiswa')
        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
        ->get();
        // dd($ujians);

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

        $checkjenisutbs =   DB::table('jenis_feedback_u_a_b_s')
        ->join('feedback_u_a_b_s', 'jenis_feedback_u_a_b_s.feedback_uab_id', '=', 'feedback_u_a_b_s.id')
        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_a_b_s.hasil_ujians_id')
        ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
        ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        ->where('users.role', 'mahasiswa')
        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
        ->select('jenis_feedback_u_a_b_s.feedback_uab_id')->get();
        // dd($checkjenisutbs->isEmpty());
        if($checkjenisutbs->isEmpty()){
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
        return view('dashboard.nilai.dosen.export.feedbackuab', [
            'ujians' => $ujians,
            'uabs' => $jenisuabs,
            'namamatkul' => Matkul::where('id', $request->matkul_dipilih)->pluck('namamatkul'),
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

