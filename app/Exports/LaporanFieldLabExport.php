<?php

namespace App\Exports;

use App\Models\NilaiFieldlab;
use App\Models\RincianNilaiTugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanFieldLabExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        // $fieldlabs = DB::table('nilai_semester_field_labs')
        //     ->join('nilai_fieldlabs', 'nilai_semester_field_labs.nilai_field_lab_id', '=', 'nilai_fieldlabs.id')
        //     ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
        //     ->join('users', 'nilai_lains.user_id', 'users.id')
        //     ->where('nilai_fieldlabs.semester', $request->semester)
        //     ->get();

        $fieldlabs = DB::table('nilai_fieldlabs')
            ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', 'users.id')
            ->where('nilai_fieldlabs.deleted_at', null)
            ->where('nilai_fieldlabs.semester', $request->semester)
            ->where('users.role', 'mahasiswa')
            ->select('nilai_fieldlabs.id', 'users.name', 'users.nim')
            ->get();

        $name = array();
        $nim = array();
        $nilai_dosbing = array();
        $nilai_penguji = array();
        $nilai_penguji_2 = array();
        $nilai_akhir = array();
        $keterangan_akhir = array();

        $len = 0;

        foreach($fieldlabs as $fieldlab) {
            $temp = NilaiFieldlab::find($fieldlab->id);

            if($temp->nilaisemester->first() != null) {
                array_push($name, $fieldlab->name);
                array_push($nim, $fieldlab->nim);
                array_push($nilai_dosbing, $temp->nilaisemester->first()->total_nilai_dosbing);
                array_push($nilai_penguji, $temp->nilaisemester->first()->total_nilai_penguji);
                array_push($nilai_penguji_2, $temp->nilaisemester->first()->total_nilai_penguji_2);
                array_push($nilai_akhir, $temp->nilaisemester->first()->nilai_akhir);
                array_push($keterangan_akhir, $temp->nilaisemester->first()->keterangan_akhir);
            } else {
                array_push($name, $fieldlab->name);
                array_push($nim, $fieldlab->nim);
                array_push($nilai_dosbing, "BELUM DIISI");
                array_push($nilai_penguji, "BELUM DIISI");
                array_push($nilai_penguji_2, "BELUM DIISI");
                array_push($nilai_akhir, "BELUM DIISI");
                array_push($keterangan_akhir, "BELUM DIISI");
            }

            $len += 1;
        }

        return view('dashboard.laporannilailain.export.fieldlab', [
            'semester' => $request->semester,
            'name' => $name,
            'nim' => $nim,
            'nilai_dosbing' => $nilai_dosbing,
            'nilai_penguji' => $nilai_penguji,
            'nilai_penguji_2' => $nilai_penguji_2,
            'nilai_akhir' => $nilai_akhir,
            'keterangan_akhir' => $keterangan_akhir,
            'len' => $len,
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
