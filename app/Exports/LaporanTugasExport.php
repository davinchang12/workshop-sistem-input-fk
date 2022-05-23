<?php

namespace App\Exports;

use App\Models\RincianNilaiTugas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanTugasExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        $nilaitugas_dosen = RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->orderBy('nilais.id')
            ->orderBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $topik_tugas =  RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->groupBy('nilai_tugas.keterangantugas')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        return view('dashboard.laporannilai.export.tugas', [
            'topik_tugas' => $topik_tugas,
            'nilaitugas_dosen' => $nilaitugas_dosen,
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
