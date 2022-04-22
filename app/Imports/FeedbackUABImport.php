<?php

namespace App\Imports;


use App\Models\User;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\HasilNilaiUjian;
use App\Models\FeedbackUAB;
use App\Models\JenisFeedbackUAB;
use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FeedbackUABImport implements ToCollection, WithStartRow
{
    private $matkul, $user, $nilais, $nilaiujian, $hasilujians, $jenisfeedbackutbs, $feedbackuabs, $dosen;
    
    public function __construct()
    {
        
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilaiujian = NilaiUjian::all();
        $this->hasilujians = HasilNilaiUjian::all();
        $this->feedbackuabs = FeedbackUAB::all();
        $this->jenisfeedbackutbs = JenisFeedbackUAB::all();
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
        return 3;
    }
    
    public function collection(Collection $rows)
    {
        $matkul = $this->matkul->where('namamatkul', $rows[0][4])->first();
        $topik = $rows[0][5];
        
        // dd($rows[0][5]);

        foreach($rows as $row) {
            $user = $this->users->where('name', $row[1])->first();
            
            
            $nilai = $this->nilais->where('matkul_id', $matkul->id)->where('user_id', $user->id)->first() ??
            Nilai::firstOrCreate([
                'matkul_id' => $matkul->id,
                'user_id' => $user->id
            ]);
            

            
                    $nilaiujian = $this->nilaiujian->where('nilai_id', $nilai->id)->first() ?? 
                    NilaiUjian::firstOrCreate(
                        ['nilai_id' => $nilai->id],
                        [
                            'sintakutb' => null,
                            'sintakuab' => null,
                            'finalcbt' => null
                            ]
                        );
                    
                    $hasilujians = $this->hasilujians->where('nilai_ujian_id', $nilaiujian->id)->first() ??
                    HasilNilaiUjian::firstOrCreate(
                        ['nilai_ujian_id' => $nilaiujian->id],
                        [
                            'utb' => null,
                            'uab' => null,
                            'remediujian' => null
                            ]
                        );
                    
                    $feedbackuabs = $this->feedbackuabs->where('hasil_ujians_id', $hasilujians->id)->first() ??
                    FeedbackUAB::firstOrCreate(
                        ['hasil_ujians_id' => $hasilujians->id],
                        [
                            'total' => null
                            ]
                        );
                    $jenisfeedbackuabs = $this->jenisfeedbackutbs->where('feedback_uab_id', $feedbackuabs->id)->first() ??
                    JenisFeedbackUAB::firstOrCreate(
                        ['feedback_uab_id' => $feedbackuabs->id],
                        [   
                            'topik' => $topik,
                            'skor' => $row[3]
                            ]
                        );
                        $jenisfeedbackuabs->where('feedback_uab_id', $feedbackuabs->id)
                        ->where('skor', null)->update(['skor' => $row[3] ?? null]);
                        $jenisfeedbackuabs->where('feedback_uab_id', $feedbackuabs->id)
                        ->where('topik', null)->update(['topik' => $topik ?? null]);
            }
    }
}



