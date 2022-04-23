<?php

namespace App\Http\Controllers;

use App\Models\NilaiTugas;
use Illuminate\Http\Request;
use App\Exports\NilaiTugasExport;
use App\Imports\NilaiTugasImport;
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\File;
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
    public function store(StoreNilaiTugasRequest $request)
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
        $this->authorize('dosen');
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_tugas',$nama_file);
 
		Excel::import(new NilaiTugasImport, public_path('/nilai_tugas/'.$nama_file));
 
		Session::flash('sukses','Nilai Tugas Berhasil Diimport!');

        File::delete(public_path('/nilai_tugas/'.$nama_file));
 
		return redirect('/dashboard/matkul');
    }
    public function export() {
        $this->authorize('dosen');
        return Excel::download(new NilaiTugasExport, 'nilaitugas.xlsx');
    }

}
