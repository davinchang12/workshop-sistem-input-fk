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
  
    // public function model(array $row)
    // {
        
    // }

        private $matkul, $user, $nilai, $pbl, $skenario, $diskusi;
        public function __construct()
        {
            $this->matkul = Matkul::select('id', 'namamatkul')->get();
            $this->users = User::select('id', 'name')->get();
            $this->nilai = Nilai::select('id')->get();
            $this->tugas = NilaiTugas::all();
        }

        /**
         * return int
         */
        // public function startRow(): int
        // {
        //     return 4;
        // }

        public function collection(Collection $rows)
        {
            
            $matkul = $this->matkul->where('namamatkul', $rows[19])->first();
            foreach ($rows as $row) 
            {
                $user = $this->users->where('name', $row[1])->first();
                $nilai = $this->nilai->where('matkul_id', $matkul)->where('user_id', $user)->first() ??
                    Nilai::firstOrCreate([
                        'matkul_id' => $matkul->id,
                        'user_id' => $user->id
                    ]);
                
                $tugas = $this->tugas->where('nilai_id', $nilai->id)->first() ?? 
                    NilaiTugas::firstOrCreate([
                        'nilai_id' => $nilai->id,
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
}
