<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiTugasExport implements FromView
{
    public function view(): View
    {
        $nilaitugas['list_tugas'] = Nilai::where('nilais.user_id', 'users.user_id')->where('nilais.matkul_id', 'matkuls.matkul_id')->get();
        return view('dashboard.nilai.dosen.export.tugas', $nilaitugas);
    }
}
