<?php

namespace App\Http\Controllers;

use App\Models\NilaiSOCA;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNilaiSOCARequest;
use App\Http\Requests\UpdateNilaiSOCARequest;
use App\Models\Jadwal;

class NilaiSOCAController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiSOCARequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiSOCARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiSOCA $nilaiSOCA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiSOCA $nilaiSOCA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiSOCARequest  $request
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiSOCARequest $request, NilaiSOCA $nilaiSOCA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSOCA $nilaiSOCA)
    {
        //
    }

    public function input(Request $request) {
        return view('dashboard.nilai.dosen.input.soca');
    }

    public function export() {
        $request = request();
        
        $checkUser = [
            'matkul_id' => $request->matkul_dipilih,
        ];

        return view('dashboard.nilai.dosen.export.soca', [
            'jadwals' => Jadwal::where($checkUser)->get(),
        ]);
    }
}
