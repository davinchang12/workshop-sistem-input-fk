<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\HasilNilaiUjian;
use App\Models\FeedbackUTB;
use App\Models\JenisFeedbackUTB;
use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class FeedbackUTBImport implements ToCollection, WithStartRow
{
    private $matkul, $user, $nilais, $nilaiujian, $hasilujians, $jenisfeedbackutbs, $feedbackutbs, $dosen;
    
    public function __construct()
    {
        
        $this->matkul = Matkul::select('id', 'namamatkul')->get();
        $this->users = User::select('id', 'name')->get();
        $this->nilaiujian = NilaiUjian::all();
        $this->hasilujians = HasilNilaiUjian::all();
        $this->feedbackutbs = FeedbackUTB::all();
        $this->jenisfeedbackutbs = JenisFeedbackUTB::all();
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
        // dd($matkul);
        
        foreach($rows as $row) {
            $user = $this->users->where('name', $row[1])->first();
            
            $nilai = $this->nilais->where('matkul_id', $matkul->id)->where('user_id', $user->id)->first() ??
            Nilai::firstOrCreate([
                'matkul_id' => $matkul->id,
                'user_id' => $user->id
            ]);
            
            // dd($nilai);

            
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
                    
                    $feedbackutbs = $this->feedbackutbs->where('hasil_ujians_id', $hasilujians->id)->first() ??
                    FeedbackUTB::firstOrCreate(
                        ['hasil_ujians_id' => $hasilujians->id],
                        [
                            'total' => null
                            ]
                        );

                        $jenisfeedbacksutbs = $this->jenisfeedbackutbs->where('feedback_utb_id', $feedbackutbs->id)->first();
                        // dd($jenisfeedbacksutbs);
                        if( $jenisfeedbacksutbs->topik != null){
                            JenisFeedbackUTB::firstOrCreate(
                                [
                                    'topik' => $topik , 
                                    'feedback_utb_id' => $feedbackutbs->id,
                                    'skor' => $row[3]
                                    ]
                                );
                            }
                            else{
                                $jenisfeedbacksutbs = $this->jenisfeedbackutbs->where('feedback_utb_id', $feedbackutbs->id)->first() ??
                                JenisFeedbackUTB::firstOrCreate(
                                    ['topik' => $topik , 'feedback_utb_id' => $feedbackutbs->id],
                                    [
                                        
                                        'skor' => $row[3]
                                        ]
                                    );
                                    $jenisfeedbacksutbs->where('feedback_utb_id', $feedbackutbs->id)
                                    ->where('skor', null)->update(['skor' => $row[3] ?? null]);
                                    $jenisfeedbacksutbs->where('feedback_utb_id', $feedbackutbs->id)
                                    ->where('topik', null)->update(['topik' => $topik ?? null]);
                                }                         

            }
    }
}
