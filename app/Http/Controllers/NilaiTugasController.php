<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\NilaiTugas;
use Illuminate\Http\Request;
use App\Models\AksesEditNilai;
use App\Exports\NilaiTugasExport;
use App\Imports\NilaiTugasImport;
use App\Models\RincianNilaiTugas;
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Http\Requests\StoreNilaiTugasRequest;
use App\Http\Requests\UpdateNilaiTugasRequest;

class NilaiTugasController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiTugasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiTugas  $nilaiTugas
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiTugas $nilaiTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiTugas  $nilaiTugas
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiTugas $nilaiTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiTugasRequest  $request
     * @param  \App\Models\NilaiTugas  $nilaiTugas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiTugasRequest $request, NilaiTugas $nilaiTugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiTugas  $nilaiTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiTugas $nilaiTugas)
    {
        //
    }
    // public function export() {
    //     return Excel::download(new NilaiTugasExport, 'nilaitugas.xlsx');
    // }
    public function import(Request $request) {
        // dd($request);
        $this->authorize('dosen');
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
        // dd($request);
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_tugas',$nama_file);
 
		Excel::import(new NilaiTugasImport, public_path('/nilai_tugas/'.$nama_file));
 
		Session::flash('sukses','Nilai Tugas Berhasil Diimport!');

        File::delete(public_path('/nilai_tugas/'.$nama_file));

            $jadwalid = Jadwal::join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->orderBy('nilais.id')
            // ->where('users.role', 'mahasiswa')
            ->where('jadwals.deleted_at', null)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->value('jadwals.id');
            // dd($jadwalid);
            $students = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
            ->join('jadwals', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->orderBy('nilais.id')
            ->where('users.role', 'mahasiswa')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('jadwals.id', $jadwalid)
            ->get();
            // dd($students);
            $listtugas = RincianNilaiTugas::select('nilais.id', 'users.name', 'users.nim', 'matkuls.*', 'rincian_nilai_tugas.*')
            // ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id','=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id','=', 'matkuls.id')
            ->join('jadwals', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->where('jadwals.id', $jadwalid)
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.role', 'mahasiswa')
            ->get();
        // dd($listtugas);
        foreach($listtugas as $tugas){
            // dd($tugas->id);
            $avgtugas = RincianNilaiTugas::select('nilai_tugas.nilaitugas')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id','=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id','=', 'matkuls.id')
            ->join('jadwals', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.id', $tugas->id)
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->avg('nilai_tugas.nilaitugas');
            
            $avgtugas2 = RincianNilaiTugas::select('nilai_tugas.nilaitugas')
            ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
            ->join('nilais', 'rincian_nilai_tugas.nilai_id','=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id','=', 'matkuls.id')
            ->join('jadwals', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('users', 'users.id', '=', 'nilais.user_id')
            ->where('users.role', 'mahasiswa')
            ->where('rincian_nilai_tugas.nilai_id', $tugas->nilai_id)
            ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->update(['rincian_nilai_tugas.rataratatugas' => $avgtugas]);
           
        }
        // dd($avgtugas2);
 
		return redirect('/dashboard/matkul');
    }
    public function export()
    {
        $this->authorize('dosen');
        return Excel::download(new NilaiTugasExport, 'nilaitugas.xlsx');
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'TUGAS')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("tugas", true);

                    $nilaitugas_dosen = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                        ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                        ->orderBy('nilais.id')
                        ->orderBy('nilai_tugas.keterangantugas')
                        ->where('users.role', 'mahasiswa')
                        ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->get();

                    $topik_tugas = Nilai::select('nilai_tugas.keterangantugas', 'nilai_tugas.nilaitugas')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                        ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                        ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                        // ->groupBy('users.id')
                        ->groupBy('nilai_tugas.keterangantugas')
                        ->where('users.role', 'mahasiswa')
                        ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                        ->where('matkuls.id', $request->matkul_dipilih)
                        ->get();

                    return view('dashboard.nilai.dosen.edit.tugas', [
                        'nilaitugas_dosen' => $nilaitugas_dosen,
                        'topik_tugas' => $topik_tugas,
                        'kodematkul' => $request->kodematkul,
                        'namamatkul' => $request->namamatkul,
                        'matkul_dipilih' => $request->matkul_dipilih
                    ]);
                } else {
                    return back()->with('fail', 'Password edit salah!');
                }
            }
        } else {
            return back()->with('fail', 'Password edit salah!');
        }
    }

    public function simpan(Request $request)
    {

        $user_nims = $request->input('user_nim');
        $keterangan = $request->input('keterangan');
        $ratarata = $request->input('ratarata');

        foreach ($user_nims as $key => $user_nim) {
            for ($i = 0; $i < (int)$request->totaltugas; $i++) {
                $get_key = collect($request->all())->keys()[5 + $i];

                Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                    ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                    ->orderBy('nilais.id')
                    ->orderBy('nilai_tugas.keterangantugas')
                    ->where('users.role', 'mahasiswa')
                    ->where('users.nim', $user_nim)
                    ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->where('keterangantugas', $keterangan[$i])
                    ->update([
                        'nilaitugas' => $request->$get_key[$key]
                    ]);
            }

            $listtugas = Nilai::select('nilais.id', 'users.name', 'users.nim', 'matkuls.kodematkul', 'rincian_nilai_tugas.*', 'nilai_tugas.*')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                ->groupBy('nilais.id')
                ->orderBy('nilais.id')
                ->orderBy('nilai_tugas.keterangantugas')
                ->where('users.role', 'mahasiswa')
                ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                ->where('matkuls.id', $request->matkul_dipilih)
                ->get();

            foreach ($listtugas as $key => $tugas) {
                Nilai::select('nilai_tugas.nilaitugas')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('rincian_nilai_tugas', 'rincian_nilai_tugas.nilai_id', '=', 'nilais.id')
                    ->join('nilai_tugas', 'nilai_tugas.rincian_nilai_tugas_id', '=', 'rincian_nilai_tugas.id')
                    ->where('users.role', 'mahasiswa')
                    ->where('rincian_nilai_tugas.nilai_id', $tugas->nilai_id)
                    ->where('rincian_nilai_tugas.dosenpenguji', auth()->user()->name)
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->update(['rincian_nilai_tugas.rataratatugas' => $ratarata[$key]]);
            }
        }

        AksesEditNilai::where('jenisnilai', 'TUGAS')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/matkul/' . $request->input('kodematkul'))->with('success', 'Nilai tugas berhasil diedit!');
    }
}
