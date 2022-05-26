<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\HasilNilaiUjian;
use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class NilaiUjianImport implements ToCollection, WithStartRow
{
    private $matkul, $user, $nilais, $nilaiujian, $dosen, $hasilnilaiujian;
    
    public function __construct()
    {
        
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilaiujian = NilaiUjian::all();
        $this->hasilnilaiujian = HasilNilaiUjian::all();
        $this->dosen = auth()->user()->id;
        $this->nilais = Jadwal::select('nilais.id', 'users.name', 'users.role', 'matkuls.namamatkul', 'users.nim')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
        ->where('users.role', 'mahasiswa')
        ->get();
        
        
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
            // dd($matkul);
            
            
            
            $nilai = $this->nilais->where('matkul_id', $matkul->id)->where('user_id', $user->id)->first() ??
            Nilai::firstOrCreate([
                'matkul_id' => $matkul->id,
                'user_id' => $user->id
            ]);
            
        //    dd($nilai);

            
                    $nilaiujian = $this->nilaiujian->where('nilai_id', $nilai->id)->first() ?? 
                    NilaiUjian::firstOrCreate(
                        ['nilai_id' => $nilai->id],
                        [
                            'sintakutb' => 0,
                            'sintakuab' => 0,
                            'finalcbt' => 0
                            ]
                        );
                        
                        $hasilnilaiujian = $this->hasilnilaiujian->where('nilai_ujian_id', $nilaiujian->id)->first();                            
                        $hasilnilaiujian->where('nilai_ujian_id', $nilaiujian->id)
                                ->where('remediujian', null)->update(['remediujian' => $row[11] ?? null]);
                            
                        
                        // dd($row[11]);
                        
                
                
           
                    }
                    
    }
}
