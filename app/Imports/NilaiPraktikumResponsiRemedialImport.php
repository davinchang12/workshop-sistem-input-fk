<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\NilaiPraktikum;
use App\Models\RemedialPraktikum;
use App\Models\ResponsiPraktikum;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiPraktikumResponsiRemedialImport implements ToCollection, WithStartRow
{
    private $matkul, $nilai, $praktikum;
    public function __construct()
    {
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilai = Nilai::select('id')->get();

        $this->praktikum = NilaiPraktikum::select('id', 'nilai_id', 'namapraktikum')->get();
    }
    
    public function startRow(): int
    {
        return 4;
    }
    
    public function collection(Collection $rows)
    {
        $matkul = $this->matkul->where('namamatkul', $rows[0][3])->first();

        foreach($rows as $row) {
            $user = $this->users->where('name', $row[2])->first();
            

            $nilai = $this->nilai->where('matkul_id', $matkul)->where('user_id', $user)->first() ??
                Nilai::firstOrCreate([
                    'matkul_id' => $matkul->id,
                    'user_id' => $user->id
                ]);
            
            $praktikum = $this->praktikum->where('nilai_id', $nilai->id)->first() ?? 
                NilaiPraktikum::firstOrCreate([
                'nilai_id' => $nilai->id,
                'namapraktikum' => $row[4]
                ]);

            $responsi = ResponsiPraktikum::firstOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                ['responsi' => $row[5] ?? null]
            );

            $responsi->where('nilai_praktikum_id', $praktikum->id)->where('responsi', null)->update(['responsi' => $row[5] ?? null]);
            
            $Remedial = RemedialPraktikum::firstOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                ['remedial' => $row[6] ?? null]
            );

            $Remedial->where('nilai_praktikum_id', $praktikum->id)->where('remedial', null)->update(['remedial' => $row[6] ?? null]);
        }
    }
}
