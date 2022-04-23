<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\NilaiTugas;
use App\Models\RincianNilaiTugas;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiTugasImport implements ToCollection, WithStartRow
{
    private $matkul, $user, $nilai, $rinciantugas, $nilaitugas, $dosen;
    public function __construct()
    {
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilaitugas = NilaiTugas::all();
        $this->rinciantugas = RincianNilaiTugas::all();
        $this->dosen = auth()->user()->id;
        $this->nilai = Jadwal::select('nilais.id', 'users.name', 'users.role', 'matkuls.namamatkul', 'users.nim')
        ->join('users', 'jadwals.user_id', '=', 'users.id')
        ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        ->join('nilais', 'nilais.user_id', '=', 'users.id')
        ->where('users.role', 'mahasiswa')
        ->get();
        
    }
    
    public function startRow(): int
    {
        return 5;
    }
    
    public function collection(Collection $rows)
    {
        $matkul = $this->matkul->where('namamatkul', $rows[0][5])->first();
        // dd($rows[0][5]);
        foreach($rows as $row) {
            $user = $this->users->where('name', $row[1])->first();
            
            // dd($matkul->id);
            
            $nilai = $this->nilai->where('matkul_id', $matkul->id)->where('user_id', $user->id)->first() ??
            Nilai::firstOrCreate([
                'matkul_id' => $matkul->id,
                'user_id' => $user->id
            ]);
            
            $dosen =  $this->dosen;
            $rinciantugas = $this->rinciantugas->where('nilai_id', $nilai->id)->first() ?? 
            RincianNilaiTugas::firstOrCreate([
                ['nilai_id' => $nilai->id],
                ['user_id' => $dosen]
            ]);
            $rinciantugas->where('nilai_id', $nilai->id)
                        ->where('user_id', null)->update(['user_id' => $dosen ?? null]);
            
            $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first();
            if( $nilaitugas->nilaitugas != null){
                NilaiTugas::firstOrCreate(
                    ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id,
                        'nilaitugas' => $row[3],
                        'keterangantugas' => $row[6]
                        ]
                    );
                }
                else{
                    $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
                    NilaiTugas::firstOrCreate(
                        ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
                        [
                            'nilaitugas' => $row[3],
                            'keterangantugas' => $row[6]
                            ]
                        );
                        $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
                        ->where('keterangantugas', null)->update(['keterangantugas' => $row[6] ?? null]);
                        $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
                        ->where('nilaitugas', null)->update(['nilaitugas' => $row[3] ?? null]);
                    }
                    // dd($nilaitugas);
                
           
           
            }
    }
}


