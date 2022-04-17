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
            $fieldlab = $this->fieldlab->where('nim', $row[2])->first();
            $keterangan = $row[6] >= 80 ? "LULUS" : "TIDAK LULUS";
            
            NilaiSemesterFieldLab::firstOrCreate([
                'nilai_field_lab_id' => $fieldlab->id,
                'total_nilai_dosbing' => $row[3],
                'total_nilai_penguji' => $row[4],
                'total_nilai_penguji_2' => $row[5] ?? 0,
                'nilai_akhir' => $row[6],
                'keterangan' => $row[7] ?? $keterangan
            ]);
       }
    }
}
