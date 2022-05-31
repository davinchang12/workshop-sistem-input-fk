<?php

namespace App\Exports;

use App\Models\RincianNilaiTugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanSOCAExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        $socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilai_s_o_c_a_s.deleted_at', null)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('nilai_s_o_c_a_s.keterangan', $request->keterangan)
            ->select('nilai_s_o_c_a_s.namasoca', 'nilai_s_o_c_a_s.nama_penguji', 'nilai_s_o_c_a_s.id', 'nilai_s_o_c_a_s.keterangan', 'nilai_s_o_c_a_s.nilaisocas', 'users.name', 'users.nim')
            ->get();

        return view('dashboard.laporannilailain.export.soca', [
            'socas' => $socas,
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
