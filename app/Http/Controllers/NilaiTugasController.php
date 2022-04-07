<?php

namespace App\Http\Controllers;

use App\Models\NilaiTugas;
use Maatwebsite\Excel\Facades\Excel;
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
    public function import(Request $request){
        Excel::import(new NilaiTugasImport(), $request->file(key: 'file'));

        return 'Success';
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
}
