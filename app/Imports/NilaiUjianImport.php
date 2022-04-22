<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\HasilNilaiUjian;
use App\Models\FeedbackUjian;
use App\Models\JenisFeedbackUjian;
use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class NilaiUjianImport implements ToCollection, WithStartRow
{
    private $matkul, $user, $nilais, $nilaiujian, $dosen;
    
    public function __construct()
    {
        
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilaiujian = NilaiUjian::all();
        $this->dosen = auth()->user()->id;
        $this->nilais = Jadwal::select('nilais.id', 'users.name', 'users.role', 'matkuls.namamatkul', 'users.nim')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
        ->where('users.role', 'mahasiswa')
        ->get();
        
        // dd(NilaiUjian::all());
    }

    public function startRow(): int
    {
        return 7;
    }
    
    public function collection(Collection $rows)
    {
        $matkul = $this->matkul->where('namamatkul', $rows[0][12])->first();
        
        foreach($rows as $row) {
            $user = $this->users->where('name', $row[1])->first();
            
            
            
            $nilai = $this->nilais->where('matkul_id', $matkul->id)->where('user_id', $user->id)->first() ??
            Nilai::firstOrCreate([
                'matkul_id' => $matkul->id,
                'user_id' => $user->id
            ]);
            
        //    dd($nilai);;

            
                    $nilaiujian = $this->nilaiujian->where('nilai_id', $nilai->id)->first() ?? 
                    NilaiUjian::firstOrCreate(
                        ['nilai_id' => $nilai->id],
                        [
                            'sintakutb' => $row[8],
                            'sintakuab' => $row[9],
                            'finalcbt' => $row[7]
                            ]
                        );

                        $nilaiujian->where('nilai_id', $nilai->id)
                        ->where('sintakutb', null)->update(['sintakutb' => $row[8] ?? null]);
                        $nilaiujian->where('nilai_id', $nilai->id)
                        ->where('sintakuab', null)->update(['sintakuab' => $row[9] ?? null]);
                        $nilaiujian->where('nilai_id', $nilai->id)
                        ->where('finalcbt', null)->update(['finalcbt' => $row[7] ?? null]);
                    
                
                
           
           
            }
    }
}
