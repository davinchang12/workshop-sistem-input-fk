<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiTugasExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $request = request();
        
        $dosen = User::where('id', '=', auth()->user()->id)->value('name');
        $nilaitugas= DB::table('nilai_tugas')
        ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.id', '=', 'nilai_tugas.rincian_nilai_tugas_id')
        ->join('nilais', 'nilais.id', '=', 'rincian_nilai_tugas.nilai_id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
        ->get();
        // dd($nilaitugas);
        return view('dashboard.nilai.dosen.export.tugas', [
            'nilaitugas' => $nilaitugas,
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
