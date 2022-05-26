<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\RincianNilaiTugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiTugasExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $request = request();

        $students = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->get();

        $dosen = User::where('id', '=', auth()->user()->id)->value('name');

        $checkrincian = DB::table('rincian_nilai_tugas')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('rincian_nilai_tugas.nilai_id')->get();

        if ($checkrincian->isEmpty()) {

            foreach ($students as $nilai) {
                $nilaiid = DB::table('nilais')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.id', $nilai->id)
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->value('nilais.id');

                DB::table('rincian_nilai_tugas')
                    ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->insert(['rincian_nilai_tugas.nilai_id' => $nilaiid, 'rincian_nilai_tugas.dosenpenguji' => $dosen]);
            }
        } else {
            $checkdosen = DB::table('rincian_nilai_tugas')
                ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                ->join('users', 'users.id', '=', 'nilais.user_id')
                ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                ->where('users.role', 'mahasiswa')
                ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                ->where('nilais.deleted_at', null)
                ->value('rincian_nilai_tugas.dosenpenguji');

            if ($checkdosen != $dosen) {
                $j = 0;
                foreach ($students as $nilai) {
                    $nilaiid = DB::table('nilais')
                        ->join('users', 'users.id', '=', 'nilais.user_id')
                        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                        ->where('nilais.deleted_at', null)
                        ->pluck('nilais.id');

                    DB::table('rincian_nilai_tugas')
                        ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                        ->join('users', 'users.id', '=', 'nilais.user_id')
                        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                        ->where('nilais.deleted_at', null)
                        ->insert(['rincian_nilai_tugas.nilai_id' => $nilaiid[$j], 'rincian_nilai_tugas.dosenpenguji' => $dosen]);

                    $j++;
                }
            }
        }

        $rinciantugas = DB::table('rincian_nilai_tugas')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', $dosen)
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->get();

        $checktugas = DB::table('nilai_tugas')
            ->join('rincian_nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.dosenpenguji', $dosen)
            ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
            ->where('nilais.deleted_at', null)
            ->select('nilai_tugas.rincian_nilai_tugas_id')->get();

        if ($checktugas->isEmpty()) {
            $j = 0;

            foreach ($rinciantugas as $rincian) {
                $rincianid = DB::table('rincian_nilai_tugas')
                    ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('rincian_nilai_tugas.dosenpenguji', $dosen)
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->pluck('rincian_nilai_tugas.id');

                DB::table('nilai_tugas')
                    ->join('rincian_nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                    ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                    ->join('users', 'users.id', '=', 'nilais.user_id')
                    ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
                    ->where('users.role', 'mahasiswa')
                    ->where('rincian_nilai_tugas.dosenpenguji', $dosen)
                    ->where('nilais.matkul_id', '=', $request->matkul_dipilih)
                    ->where('nilais.deleted_at', null)
                    ->insert(['nilai_tugas.rincian_nilai_tugas_id' => $rincianid[$j]]);
                $j++;
            }
        }

        $nilaitugas = RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.role', 'mahasiswa')
            ->where('nilais.deleted_at', null)
            ->get();

        return view('dashboard.nilai.dosen.export.tugas', [
            'nilaitugas' => $nilaitugas,
            'namamatkul' => Matkul::where('id', $request->matkul_dipilih)->pluck('namamatkul'),
            'dosen' => $dosen
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:P1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A2:P2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A3:P3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        ];
    }
}
