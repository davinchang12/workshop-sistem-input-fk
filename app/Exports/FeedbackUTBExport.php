<?php

namespace App\Exports;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\JenisFeedbackUTB;

class FeedbackUTBExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $request = request();
        
        $dosen = User::where('id', '=', auth()->user()->id)->value('name');
        $ujians= DB::table('nilai_ujians')
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
        ->get();

        $utbs= DB::table('jenis_feedback_u_t_b_s')
        ->join('feedback_u_t_b_s', 'jenis_feedback_u_t_b_s.feedback_utb_id', '=', 'feedback_u_t_b_s.id')
        ->join('hasil_nilai_ujians', 'hasil_nilai_ujians.id', '=', 'feedback_u_t_b_s.hasil_ujians_id')
        ->join('nilai_ujians', 'nilai_ujians.id', '=', 'hasil_nilai_ujians.nilai_ujian_id')
        ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        ->where('users.role', 'mahasiswa')
        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
        ->get();
       
        
        // dd($nilaitugas);
        return view('dashboard.nilai.dosen.export.feedbackutb', [
            'ujians' => $ujians,
            'utbs' => $utbs,
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
