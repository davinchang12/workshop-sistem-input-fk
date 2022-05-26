<?php

namespace App\Exports;

use App\Models\RincianNilaiAkhir;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanNilaiAkhirExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        $validatedData = $request->validate([
            'pbl' => 'required',
            'utb' => 'required',
            'uab' => 'required',
        ]);

        $validatedData['tugas'] = $request->tugas;

        if ($validatedData['tugas'] != null) {
            $tugas = DB::table('rincian_nilai_tugas')
                ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->where('matkuls.id', $request->matkul_dipilih)
                ->select('users.name', 'users.nim', 'rincian_nilai_tugas.rataratatugas as rata_rata')
                ->get();
        }

        $pbls = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
            ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->groupBy('users.name')
            ->selectRaw('users.name, users.nim, AVG(rata_rata) rata_rata')
            ->get();

        $ujians = DB::table('nilai_ujians')
            ->join('nilais', 'nilai_ujians.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->select('users.name', 'users.nim', 'sintakutb', 'sintakuab')
            ->get();

        $nilais = array();

        foreach ($ujians as $key => $ujian) {

            if ($validatedData['tugas'] != null) {
                $sintak_utb_view = (float)$ujian->sintakutb / ((float)$validatedData['utb'] / 100);
                $sintak_uab_view = (float)$ujian->sintakuab / ((float)$validatedData['uab'] / 100);

                if ($pbls->where('nim', $ujian->nim)->first()) {
                    $total_komponen_tugas = ((float)$tugas->where('nim', $ujian->nim)->first()->rata_rata * (float)$validatedData['tugas']) + ((float)$pbls->where('nim', $ujian->nim)->first()->rata_rata * (float)$validatedData['pbl']);

                    $total_komponen_tugas_view = $total_komponen_tugas / (((float)$validatedData['tugas'] + (float)$validatedData['pbl']) / 100);

                    $sum = $total_komponen_tugas + $ujian->sintakutb + $ujian->sintakuab;
                    array_push($nilais, array($ujian->name, $ujian->nim, $total_komponen_tugas, $total_komponen_tugas_view, $ujian->sintakutb, $sintak_utb_view, $ujian->sintakuab, $sintak_uab_view, $sum));
                } else {
                    $sum = $ujian->sintakutb + $ujian->sintakuab;
                    array_push($nilais, array($ujian->name, $ujian->nim, "BELUM DIISI", "BELUM DIISI", $ujian->sintakutb, $sintak_utb_view, $ujian->sintakuab, $sintak_uab_view, $sum));
                }
            } else {
                $sintak_utb_view = (float)$ujian->sintakutb / ((float)$validatedData['utb'] / 100);
                $sintak_uab_view = (float)$ujian->sintakuab / ((float)$validatedData['uab'] / 100);
                if ($pbls->where('nim', $ujian->nim)->first()) {
                    $total_komponen_tugas = ((float)$pbls->where('nim', $ujian->nim)->first()->rata_rata * ((float)$validatedData['pbl']) / 100);

                    $total_komponen_tugas_view = $total_komponen_tugas / ((float)$validatedData['pbl'] / 100);

                    $sum = $total_komponen_tugas + $ujian->sintakutb + $ujian->sintakuab;
                    array_push($nilais, array($ujian->name, $ujian->nim, $total_komponen_tugas, $total_komponen_tugas_view, $ujian->sintakutb, $sintak_utb_view, $ujian->sintakuab, $sintak_uab_view, $sum));
                } else {
                    $sum = $ujian->sintakutb + $ujian->sintakuab;
                    array_push($nilais, array($ujian->name, $ujian->nim, "BELUM DIISI", "BELUM DIISI", $ujian->sintakutb, $sintak_utb_view, $ujian->sintakuab, $sintak_uab_view, $sum));
                }
            }
        }

        
        foreach($nilais as $key => $nilai) {

            if($nilai[8] >= 80) {
                $keterangan = "A";
            } elseif ($nilai[8] >= 75 && $nilai[8] < 80) {
                $keterangan = "AB";
            } elseif ($nilai[8] >= 70 && $nilai[8] < 75) {
                $keterangan = "B";
            } elseif ($nilai[8] >= 65 && $nilai[8] < 70) {
                $keterangan = "BC";
            } elseif ($nilai[8] >= 55 && $nilai[8] < 65) {
                $keterangan = "C";
            } elseif ($nilai[8] >= 50 && $nilai[8] < 55) {
                $keterangan = "CD";
            } elseif ($nilai[8] >= 40 && $nilai[8] < 50) {
                $keterangan = "D";
            } elseif ($nilai[8] < 40) {
                $keterangan = "E";
            };

            $getNilaiId = DB::table('nilais')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('matkuls.id', $request->matkul_dipilih)
                ->where('users.nim', $nilai[1])
                ->select('nilais.id')
                ->first()->id;
            
            RincianNilaiAkhir::updateOrCreate([
                'nilai_id' => $getNilaiId,
            ], [
                'tugas' => $nilai[3],
                'utb' => $nilai[5],
                'uab' => $nilai[7],
                'nilai_akhir' => $nilai[8],
                'keterangan' => $keterangan,
            ]);
            
            array_push($nilais[$key], $keterangan);
        }

        return view('dashboard.laporannilai.export.nilaiakhir', [
            'nilais' => $nilais,
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
