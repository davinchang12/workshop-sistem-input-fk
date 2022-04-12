<?php

namespace App\Exports;

use App\Models\Jadwal;
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

        $praktikums = Jadwal::select('users.name', 'users.nim', 'matkuls.namamatkul')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request['matkul_dipilih'])
            ->where('users.role', 'mahasiswa')
            ->get();

        return view('dashboard.nilai.dosen.export.praktikum', [
            'praktikums' => $praktikums
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:M1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A2:M2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A3:M3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A4:M4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        ];
    }
}
