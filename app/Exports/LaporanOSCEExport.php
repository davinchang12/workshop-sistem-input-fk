<?php

namespace App\Exports;

use App\Models\RincianNilaiTugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanOSCEExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        $mhs_osces = DB::table('nilai_o_s_c_e_s')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilai_o_s_c_e_s.deleted_at', null)
            ->select('nilai_o_s_c_e_s.namaosce', 'nilai_o_s_c_e_s.nama_penguji', 'nilai_o_s_c_e_s.id', 'nilai_o_s_c_e_s.nilaiosce', 'users.name', 'users.nim')
            ->get();

        return view('dashboard.laporannilailain.export.osce', [
            'mhs_osces' => $mhs_osces,
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
