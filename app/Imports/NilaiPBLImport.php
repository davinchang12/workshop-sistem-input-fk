<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\NilaiPBL;
use App\Models\NilaiPBLSkenario;
use Illuminate\Support\Collection; 
use App\Models\NilaiPBLSkenarioDiskusi;
use App\Models\NilaiPBLSkenarioDiskusiNilai;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiPBLImport implements ToCollection, WithStartRow
{

    private $matkul, $user, $nilai, $pbl, $skenario, $diskusi;
    public function __construct()
    {
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilai = Nilai::select('id')->get();

        $this->pbl = NilaiPBL::select('id', 'nilai_id')->get();
        $this->skenario = NilaiPBLSkenario::select('id', 'nilaipbl_id', 'skenario')->get();
        $this->diskusi = NilaiPBLSkenarioDiskusi::select('id', 'nilaipblskenario_id', 'diskusi')->get();
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
        
        $matkul = $this->matkul->where('namamatkul', $rows[0][3])->first();
        foreach ($rows as $row) 
        {
            $user = $this->users->where('name', $row[1])->first();
            $nilai = $this->nilai->where('matkul_id', $matkul)->where('user_id', $user)->first() ??
                Nilai::firstOrCreate([
                    'matkul_id' => $matkul->id,
                    'user_id' => $user->id
                ]);
            
            $pbl = $this->pbl->where('nilai_id', $nilai->id)->first() ?? 
                NilaiPBL::firstOrCreate([
                    'nilai_id' => $nilai->id,
                ]);
            
            $skenario = $this->skenario->where('nilaipbl_id', $pbl->id)->where('skenario', $row[5])->first() ?? 
                NilaiPBLSkenario::firstOrCreate([
                    'nilaipbl_id' => $pbl->id,
                    'skenario' => $row[5],
                ]);

            $diskusi = $this->diskusi->where('nilaipblskenario_id', $skenario->id)->where('diskusi', $row[6])->first() ?? 
                NilaiPBLSkenarioDiskusi::firstOrCreate([
                    'nilaipblskenario_id' => $skenario->id,
                    'diskusi' => $row[6]
                ]);

            NilaiPBLSkenarioDiskusiNilai::firstOrCreate([
                'nilaipblskenariodiskusi_id' => $diskusi->id,
                'kehadiran' => $row[9],
                'aktivitas_diskusi_relevansi_pembicaraan' => $row[10],
                'keterampilan_berkomunikasi' => $row[11],
                'laporan_sementara' => $row[12],
                'laporan_resmi' => $row[13],
                'catatan_kesan_kegiatan_diskusi_tutorial' => $row[14],
            ]);
        }
    }
}
