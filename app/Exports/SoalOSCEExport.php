<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use App\Models\NilaiOSCE;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class SoalOSCEExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $request = request();
        $osces = $osces = DB::table('nilai_jenis_o_s_c_e_s')
        ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
        ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
        ->join('users', 'nilais.user_id', '=', 'users.id')
        ->where('matkuls.id', $request->matkul_dipilih)
        ->where('users.name', $request->mahasiswa_dipilih)
        ->get();
        $dosen = User::where('id', '=', auth()->user()->id)->value('name');
        
        return view('dashboard.nilai.dosen.export.soalosce', [
            // 'osces' => $osces,
            // 'namamatkul' => Matkul::where('id', $request->matkul_dipilih)->pluck('namamatkul'),
            // 'dosen' => $dosen
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
