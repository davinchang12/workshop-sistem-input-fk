<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\NilaiTugas;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiTugasImport implements ToCollection, WithStartRow
{
    private $matkul, $user, $nilai, $nilaitugas;
    public function __construct()
    {
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilai = Nilai::select('id')->get();
        $this->nilaitugas = NilaiTugas::select('nilai_id')->get();

    }
    
    public function startRow(): int
    {
        return 5;
    }
    
    public function collection(Collection $rows)
    {
        $matkul = $this->matkul->where('namamatkul', $rows[0][19])->first();
        
        foreach($rows as $row) {
            $user = $this->users->where('name', $row[1])->first();
            
            
            $nilai = $this->nilai->where('matkul_id', $matkul)->where('user_id', $user)->first() ??
            Nilai::firstOrCreate([
                'matkul_id' => $matkul->id,
                'user_id' => $user->id
            ]);
            
            $nilaitugas = $this->nilaitugas->where('nilai_id', $nilai->id)->first() ?? 
              dd($nilaitugas);
                NilaiTugas::firstOrCreate(
                    ['nilai_id' => $nilaitugas->nilai_id],
                    [
                        'tugas_1' => $row[3] ?? null,
                        'tugas_2'=> $row[4] ?? null,
                        'tugas_3'=> $row[5] ?? null,
                        'tugas_4'=> $row[6] ?? null,
                        'tugas_5'=> $row[7] ?? null,
                        'tugas_6'=> $row[8] ?? null,
                        'tugas_7'=> $row[9] ?? null,
                        'tugas_8'=> $row[10] ?? null,
                        'tugas_9'=> $row[11] ?? null,
                        'tugas_10'=> $row[12] ?? null,
                        'tugas_11'=> $row[13] ?? null,
                        'tugas_12'=> $row[14] ?? null,
                        'tugas_13'=> $row[15] ?? null,
                        'tugas_14'=> $row[16] ?? null
                    ]
                );
                
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_1', null)->update(['tugas_1' => $row[3] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_2', null)->update(['tugas_2' => $row[4] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_3', null)->update(['tugas_3' => $row[5] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_4', null)->update(['tugas_4' => $row[6] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_5', null)->update(['tugas_5' => $row[7] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_6', null)->update(['tugas_6' => $row[8] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_7', null)->update(['tugas_7' => $row[9] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_8', null)->update(['tugas_8' => $row[10] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_9', null)->update(['tugas_9' => $row[11] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_10', null)->update(['tugas_10' => $row[12] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_11', null)->update(['tugas_11' => $row[13] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_12', null)->update(['tugas_12' => $row[14] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_13', null)->update(['tugas_13' => $row[15] ?? null]);
                $nilaitugas->where('nilai_id', $nilai->id)
                ->where('tugas_14', null)->update(['tugas_14' => $row[16] ?? null]);
            }
    }
}