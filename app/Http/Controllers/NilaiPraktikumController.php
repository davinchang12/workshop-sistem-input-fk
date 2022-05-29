<?php

namespace App\Http\Controllers;

use App\Models\Nilai;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\AksesEditNilai;
use App\Models\NilaiPraktikum;
use App\Models\NilaiJenisPraktikum;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiPraktikumExport;
use App\Imports\NilaiPraktikumImport;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

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

            $nilai = Nilai::select('users.name', 'users.nim', 'nilais.id', 'matkuls.kodematkul')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->where('matkuls.kodematkul', $request['kodematkul'])
                ->where('users.nim', $request['nim' . $i])
                ->where('users.role', 'mahasiswa')
                ->first();

            $praktikum = NilaiPraktikum::where('namapraktikum', $request['namapraktikum'])
                ->where('nilai_id', $nilai->id)
                ->first();

            NilaiJenisPraktikum::updateOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                [
                    'keterangan_nilai_akhir' => $request['keterangan_akhir' . $i],
                    'keterangan_nilai_akhir_berdasarkan' => $request['keterangan_akhir_berdasarkan' . $i],
                    'keterangan_nilai_setelah_remedi' => $request['keterangan-nilai-setelah-remedi' . $i],
                    'keterangan_nilai_setelah_remedi_berdasarkan' => $request['keterangan_nilai_setelah_remedi_berdasarkan' . $i],
                ]
            );
        }

        return redirect('/dashboard/matkul/' . $nilai->kodematkul);
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
    public function update(Request $request, NilaiPraktikum $nilaiPraktikum)
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

    public function export()
    {
        return Excel::download(new NilaiPraktikumExport, 'nilaipraktikum.xlsx');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('nilai_praktikum', $nama_file);

        Excel::import(new NilaiPraktikumImport, public_path('/nilai_praktikum/' . $nama_file));

        Session::flash('sukses', 'Nilai Praktikum Berhasil Diimport!');

        File::delete(public_path('/nilai_praktikum/' . $nama_file));

        return redirect()
            ->action([NilaiPraktikumController::class, 'importView'], ["kodematkul" => $request['kodematkul'], "namapraktikum" => $request['jenis_praktikum']]);
    }

    public function importView(Request $request)
    {
        $praktikums = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_jenis_praktikums.*', 'nilai_praktikums.namapraktikum')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilai_praktikums.namapraktikum', $request['namapraktikum'])
            ->where('matkuls.kodematkul', $request['kodematkul'])
            ->get();

        return view('dashboard.nilai.dosen.input.praktikum', [
            'praktikums' => $praktikums,

        ]);
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'PRAKTIKUM')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("praktikum", true);

                    $praktikums = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'nilai_jenis_praktikums.*')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('nilai_praktikums', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
                        ->join('nilai_jenis_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
                        ->where('users.role', 'mahasiswa')
                        ->where('matkuls.kodematkul', $request['kodematkul'])
                        ->where('nilai_praktikums.namapraktikum', $request['jenis_praktikum'])
                        ->get();

                    if (count($praktikums) > 0) {
                        return view('dashboard.nilai.dosen.edit.praktikum', [
                            'praktikums' => $praktikums,

                        ]);
                    } else {
                        return back()->with('fail', 'Nilai Praktikum belum diisi!');
                    }
                }
            }
        } else {
            return back()->with('fail', 'Password edit salah!');
        }
    }

    public function simpan(Request $request)
    {
        for ($i = 1; $i <= (int)$request['loop']; $i++) {


            $nilai = Nilai::select('users.name', 'users.nim', 'nilais.id', 'matkuls.kodematkul')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->where('matkuls.kodematkul', $request['kodematkul'])
                ->where('users.nim', $request['nim' . $i])
                ->where('users.role', 'mahasiswa')
                ->first();

            $praktikum = NilaiPraktikum::where('nilai_id', $nilai->id)
                ->where('namapraktikum', $request['namapraktikum'])
                ->first();

            NilaiJenisPraktikum::updateOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                [
                    'rata_rata_quiz' => $request['rata-rata-quiz' . $i],
                    'rata_rata_laporan' => $request['rata-rata-nilai-laporan' . $i],
                    'nilai_responsi' => $request['nilai-responsi' . $i],
                    'nilai_akhir' => $request['nilai-akhir' . $i],
                    'keterangan_nilai_akhir' => $request['keterangan_akhir' . $i],
                    'keterangan_nilai_akhir_berdasarkan' => $request['keterangan_akhir_berdasarkan' . $i],
                    'remedi' => $request['remedi' . $i],
                    'remedi_konversi' => $request['remedi-konversi' . $i],
                    'nilai_setelah_remedi' => $request['nilai-setelah-remedi' . $i],
                    'keterangan_nilai_setelah_remedi' => $request['keterangan-nilai-setelah-remedi' . $i],
                    'keterangan_nilai_setelah_remedi_berdasarkan' => $request['keterangan_nilai_setelah_remedi_berdasarkan' . $i],
                ]
            );
        }

        AksesEditNilai::where('jenisnilai', 'PRAKTIKUM')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/matkul/' . $request->input('kodematkul'))->with('success', 'Nilai praktikum berhasil diedit!');
    }
}
