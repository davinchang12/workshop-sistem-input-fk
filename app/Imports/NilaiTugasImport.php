<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
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
        $this->nilai = Nilai::select('id')->get();
        $this->nilaitugas = NilaiTugas::all();
        $this->rinciantugas = RincianNilaiTugas::all();
        $this->dosen = auth()->user()->id;
        
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
            
            
            $nilai = $this->nilai->where('matkul_id', $matkul)->where('user_id', $user)->first() ??
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
            $sql = "INSERT INTO nilai_tugas (rincian_nilai_tugas_id, nilaitugas, keterangantugas) VALUES ($nilaitugas->rincian_nilai_tugas_id , $row[3],
            $row[6])";
                
                    $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
                    NilaiTugas::firstOrCreate(
                        ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id ],
                        [
                            'nilaitugas' => $row[3],
                            'keterangantugas' => $row[6]
                            ]
                        );
                        $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
                        ->where('keterangantugas', null)->update(['keterangantugas' => $row[6] ?? null]);
                        $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
                        ->where('nilaitugas', null)->update(['nilaitugas' => $row[3] ?? null]);
                    
                    dd($nilaitugas);
                
            // if ($row[4] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[4]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[4] ?? null]);
            //     }
            // if ($row[5] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[5]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[5] ?? null]);
            //     }
            // if ($row[6] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[6]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[6] ?? null]);
            //     }
            // if ($row[7] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[7]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[7] ?? null]);
            //     }
            // if ($row[8] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[8]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[8] ?? null]);
            //     }
            // if ($row[9] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[9]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[9] ?? null]);
            //     }
            // if ($row[10] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[10]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[10] ?? null]);
            //     }
            // if ($row[11] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[11]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[11] ?? null]);
            //     }
            // if ($row[12] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[12]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[12] ?? null]);
            //     }
            // if ($row[13] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[13]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[13] ?? null]);
            //     }
            // if ($row[14] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[14]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[14] ?? null]);
            //     }
            // if ($row[15] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[15]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[15] ?? null]);
            //     }
            // if ($row[16] != null) {
            //         $nilaitugas = $this->nilaitugas->where('rincian_nilai_tugas_id', $rinciantugas->id)->first() ?? 
            //         NilaiTugas::firstOrCreate(
            //             ['rincian_nilai_tugas_id' => $nilaitugas->rincian_nilai_tugas_id],
            //             [
            //                 'nilaitugas' => $row[16]
            //                 ]
            //         );
            //         $nilaitugas->where('rincian_nilai_tugas_id', $nilaitugas->rincian_nilai_tugas_id)
            //         ->where('nilaitugas', null)->update(['nilaitugas' => $row[16] ?? null]);
            //     }
           
            }
    }
}


