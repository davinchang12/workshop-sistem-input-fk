<?php

namespace App\Http\Controllers;

use App\Models\NilaiPraktikum;

use Illuminate\Http\Request;
use App\Exports\NilaiPraktikumTugasExport;
use App\Imports\NilaiPraktikumTugasImport;
use App\Exports\NilaiPraktikumResponsiRemedialExport;
use App\Imports\NilaiPraktikumResponsiRemedialImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Http\Requests\StoreNilaiPraktikumRequest;
use App\Http\Requests\UpdateNilaiPraktikumRequest;

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
    public function store(StoreNilaiPraktikumRequest $request)
    {
        //
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

    public function exportTugas() {
        return Excel::download(new NilaiPraktikumTugasExport, 'nilai-praktikum-tugas.xlsx');
    }

    public function importTugas(Request $request) {
        
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_praktikum_tugas',$nama_file);
 
		Excel::import(new NilaiPraktikumTugasImport, public_path('/nilai_praktikum_tugas/'.$nama_file));
 
		Session::flash('sukses','Nilai Praktikum Berhasil Diimport!');

        File::delete(public_path('/nilai_praktikum_tugas/'.$nama_file));
 
		return redirect('/dashboard/matkul/nilai/');
    }

    public function exportResponsiRemedial() {
        return Excel::download(new NilaiPraktikumResponsiRemedialExport, 'nilai-praktikum-responsi-remedial.xlsx');
    }

    public function importResponsiRemedial(Request $request) {
        
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_praktikum_responsi_remedial',$nama_file);
 
		Excel::import(new NilaiPraktikumResponsiRemedialImport, public_path('/nilai_praktikum_responsi_remedial/'.$nama_file));
 
		Session::flash('sukses','Nilai Praktikum Berhasil Diimport!');

        File::delete(public_path('/nilai_praktikum_responsi_remedial/'.$nama_file));
 
		return redirect('/dashboard/matkul/nilai/');
    }
}
