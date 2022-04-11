<?php

namespace App\Http\Controllers;

use App\Models\Nilai;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\NilaiPraktikum;
use App\Models\NilaiJenisPraktikum;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

use App\Exports\NilaiPraktikumTugasExport;
use App\Imports\NilaiPraktikumTugasImport;
use App\Http\Requests\UpdateNilaiPraktikumRequest;
use App\Exports\NilaiPraktikumResponsiRemedialExport;
use App\Imports\NilaiPraktikumResponsiRemedialImport;

class NilaiPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNilaiPraktikumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for ($i = 1; $i <= (int)$request['loop']; $i++) {

            $nilai = Jadwal::select('users.name', 'users.nim', 'nilais.id')
                ->join('users', 'jadwals.user_id', '=', 'users.id')
                ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
                ->join('nilais', 'nilais.user_id', '=', 'users.id')
                ->where('matkuls.kodematkul', $request['kodematkul'])
                ->where('users.nim', $request['nim' . $i])
                ->where('users.role', 'mahasiswa')
                ->first();

            $praktikum = NilaiPraktikum::firstOrCreate(
                ['nilai_id' => $nilai->id],
                ['namapraktikum' => $request['namapraktikum']]
            );

            $nilaijenispraktikum = NilaiJenisPraktikum::firstOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                [
                    'rata_rata_quiz' => $request['rata-rata-quiz' . $i],
                    'rata_rata_laporan' => $request['rata-rata-nilai-laporan' . $i],
                    'nilai_responsi' => $request['nilai-responsi' . $i],
                    'nilai_akhir' => $request['nilai-akhir' . $i],
                    'keterangan_nilai_akhir' => $request['keterangan-nilai-akhir' . $i],
                    'remedi' => $request['remedi' . $i],
                    'remedi_konversi' => $request['remedi-konversi' . $i],
                    'nilai_setelah_remedi' => $request['nilai-setelah-remedi' . $i],
                    'keterangan_nilai_setelah_remedi' => $request['keterangan-nilai-setelah-remedi' . $i]
                ]
            );

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('rata_rata_quiz', null)
                ->update(['rata_rata_quiz' => $request['rata-rata-quiz' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('rata_rata_laporan', null)
                ->update(['rata_rata_laporan' => $request['rata-rata-nilai-laporan' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('nilai_responsi', null)
                ->update(['nilai_responsi' => $request['nilai-responsi' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('nilai_akhir', null)
                ->update(['nilai_akhir' => $request['nilai-akhir' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('keterangan_nilai_akhir', null)
                ->update(['keterangan_nilai_akhir' => $request['keterangan-nilai-akhir' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('remedi', null)
                ->update(['remedi' => $request['remedi' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('remedi_konversi', null)
                ->update(['remedi_konversi' => $request['remedi-konversi' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('nilai_setelah_remedi', null)
                ->update(['nilai_setelah_remedi' => $request['nilai-setelah-remedi' . $i]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('keterangan_nilai_setelah_remedi', null)
                ->update(['keterangan_nilai_setelah_remedi' => $request['keterangan-nilai-setelah-remedi' . $i]]);
        }

        return redirect('/dashboard/matkul/nilai/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPraktikum  $nilaiPraktikum
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiPraktikum $nilaiPraktikum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiPraktikum  $nilaiPraktikum
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiPraktikum $nilaiPraktikum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiPraktikumRequest  $request
     * @param  \App\Models\NilaiPraktikum  $nilaiPraktikum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiPraktikumRequest $request, NilaiPraktikum $nilaiPraktikum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPraktikum  $nilaiPraktikum
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiPraktikum $nilaiPraktikum)
    {
        //
    }
}
