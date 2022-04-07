<?php

namespace App\Http\Controllers;

use App\Models\NilaiPBL;
use Illuminate\Http\Request;
use App\Exports\NilasPBLExport;
use App\Imports\NilaiPBLImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Http\Requests\StoreNilaiPBLRequest;
use App\Http\Requests\UpdateNilaiPBLRequest;

class NilaiPBLController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiPBLRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiPBLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiPBL $nilaiPBL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiPBL $nilaiPBL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiPBLRequest  $request
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiPBLRequest $request, NilaiPBL $nilaiPBL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiPBL $nilaiPBL)
    {
        //
    }

    public function export() {
        return Excel::download(new NilasPBLExport, 'nilai.xlsx');
    }

    public function import(Request $request) {
        
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_pbl',$nama_file);
 
		Excel::import(new NilaiPBLImport, public_path('/nilai_pbl/'.$nama_file));
 
		Session::flash('sukses','Nilai PBL Berhasil Diimport!');

        File::delete(public_path('/nilai_pbl/'.$nama_file));
 
		return redirect('/dashboard/matkul/nilai/');
    }
}
