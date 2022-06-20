<?php

namespace App\Exports;

use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiPraktikumExport implements FromView, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $request = request();

        $praktikums = DB::table('nilai_praktikums')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.kodematkul', $request['kodematkul'])
            ->where('nilai_praktikums.namapraktikum', $request['jenis_praktikum'])
            ->where('users.role', 'mahasiswa')
            ->where('nilai_praktikums.deleted_at', null)
            ->where('nilais.deleted_at', null)
            ->get();

        return view('dashboard.nilai.dosen.export.praktikum', [
            'praktikums' => $praktikums,
            'keteranganSebelum' => $request['inputKeteranganSebelum'],
            'keteranganSesudah' => $request['inputKeteranganSesudah'],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:T1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A2:T2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A3:T3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A4:T4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        ];
    }
}
