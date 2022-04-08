<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\NilaiPBL;
use App\Models\NilaiPraktikum;
use App\Models\NilaiPBLSkenario;
use App\Models\NilaiQuizPraktikum;
use App\Models\NilaiJenisPraktikum;
use Illuminate\Support\Collection; 
use App\Models\NilaiLaporanPraktikum;
use App\Models\NilaiPBLSkenarioDiskusi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiPraktikumTugasImport implements ToCollection, WithStartRow
{
    private $matkul, $nilai, $praktikum;
    public function __construct()
    {
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilai = Nilai::select('id')->get();

        $this->praktikum = NilaiPraktikum::select('id', 'nilai_id', 'namapraktikum')->get();
        $this->jenispraktikum = NilaiJenisPraktikum::select('id', 'nilai_praktikum_id', 'jenispraktikum')->get();
    }
    
    public function startRow(): int
    {
        return 4;
    }
    
    public function collection(Collection $rows)
    {
        $matkul = $this->matkul->where('namamatkul', $rows[0][3])->first();

        // dd($matkul->id);
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

            $jenispraktikum = $this->praktikum->where('nilai_praktikum_id', $praktikum->id)->where('jenispraktikum', $row[5])->first() ?? 
                NilaiJenisPraktikum::firstOrCreate([
                    'nilai_praktikum_id' => $praktikum->id,
                    'jenispraktikum' => $row[5]
                ]);

            
            $laporan = NilaiLaporanPraktikum::firstOrCreate(
                ['nilai_jenis_praktikum_id' => $jenispraktikum->id],
                ['nilai_laporan' => $row[6] ?? null]
            );

            $laporan->where('nilai_jenis_praktikum_id', $jenispraktikum->id)->where('nilai_laporan', null)->update(['nilai_laporan' => $row[6] ?? null]);


            $quiz = NilaiQuizPraktikum::firstOrCreate(
                ['nilai_jenis_praktikum_id' => $jenispraktikum->id],
                ['nilai_quiz' => $row[7] ?? null]
            );

            $quiz->where('nilai_jenis_praktikum_id', $jenispraktikum->id)->where('nilai_quiz', null)->update(['nilai_quiz' => $row[7] ?? null]);
        }
    }
}
