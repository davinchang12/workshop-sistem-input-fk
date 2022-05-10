<?php

namespace App\Http\Controllers;

use App\Models\NilaiSOCA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingSOCA extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socas = DB::table('nilai_s_o_c_a_s')
            ->select('nama_penguji', 'namasoca')
            ->get()
            ->unique('nama_penguji');

        return view('dashboard.soca.admin.index', [
            'socas' => $socas
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiSOCA $nilaiSOCA)
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
}
