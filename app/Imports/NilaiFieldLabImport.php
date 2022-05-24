<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\NilaiSemesterFieldLab;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiFieldLabImport implements ToCollection, WithStartRow
{
    public function __construct()
    {
        $this->fieldlab = DB::table('nilai_fieldlabs')
            ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->select('users.nim as nim', 'nilai_fieldlabs.id as id')
            ->get();
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 4;
    }

    public function collection(Collection $rows)
    {
       foreach($rows as $row) {
            $fieldlab = $this->fieldlab->where('nim', $row[4])->first();

            if ($row[7] == 0 || $row[7] == null) {
                $nilai_akhir = ((float)$row[5] * 0.5) + ((float)$row[6] * 0.5);
            } else {
                $nilai_akhir = ((float)$row[5] * 0.5) + ((float)$row[6] * 0.25) + ((float)$row[7] * 0.25);
            }
            
            if ($row[8] == null) {
                $keterangan = $nilai_akhir >= 80 ? "LULUS" : "TIDAK LULUS";
            } else {
                $keterangan = $row[8] >= 80 ? "LULUS" : "TIDAK LULUS";
            }
            
            NilaiSemesterFieldLab::firstOrCreate([
                'nilai_field_lab_id' => $fieldlab->id,
                'total_nilai_dosbing' => $row[5],
                'total_nilai_penguji' => $row[6],
                'total_nilai_penguji_2' => $row[7] ?? 0,
                'nilai_akhir' => $row[8] ?? $nilai_akhir,
                'keterangan_akhir' => $row[9] ?? $keterangan
            ]);
       }
    }
}
