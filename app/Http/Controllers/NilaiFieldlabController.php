<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiFieldlab;
use App\Exports\NilaiFieldLabExport;
use App\Imports\NilaiFieldLabImport;

use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\StoreNilaiFieldlabRequest;
use App\Http\Requests\UpdateNilaiFieldlabRequest;

class NilaiFieldlabController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiFieldlabRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiFieldlabRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiFieldlabRequest  $request
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiFieldlabRequest $request, NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    public function export() {
        return Excel::download(new NilaiFieldLabExport, 'nilaifieldlab.xlsx');
    }

    public function import(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('nilai_field_lab', $nama_file);

        Excel::import(new NilaiFieldLabImport, public_path('/nilai_field_lab/' . $nama_file));

        Session::flash('sukses', 'Nilai Tugas Berhasil Diimport!');

        File::delete(public_path('/nilai_field_lab/' . $nama_file));

        return redirect('/dashboard/nilailain');
    }
}
