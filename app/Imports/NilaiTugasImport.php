<?php

namespace App\Imports;

use App\Models\NilaiTugas;
use Maatwebsite\Excel\Concerns\ToModel;

class NilaiTugasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $nilaiid;
    public function __construct(){
        $this->nilaiid = Nilai::select('id')-get();
    }
    public function model(array $row)
    {
        $nilai=DB::table('nilai')
        ->select('id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->where('users.name', '=', $row[2] )
        ->get();
        return new NilaiTugas([
            'nama' => NilaiTugas::where('nilai_id', ($nilai)),
            'tugas_1' => $row[3],
            'tugas_2'=> $row[4],
            'tugas_3'=> $row[5],
            'tugas_4'=> $row[6],
            'tugas_5'=> $row[7],
            'tugas_6'=> $row[8],
            'tugas_7'=> $row[9],
            'tugas_8'=> $row[10],
            'tugas_9'=> $row[11],
            'tugas_10'=> $row[12],
            'tugas_11'=> $row[13],
            'tugas_12'=> $row[14],
            'tugas_13'=> $row[15],
            'tugas_14'=> $row[16],
            'total' => $row[17],
            'rata-rata' => $row[18]
        ]);
    }
}
