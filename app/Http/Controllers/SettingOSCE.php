<?php

namespace App\Http\Controllers;

use App\Models\NilaiOSCE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingOSCE extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $osces = DB::table('nilai_o_s_c_e_s')
            ->select('nama_penguji')
            ->get()
            ->unique('nama_penguji');

        return view('dashboard.osce.admin.index', [
            'osces' => $osces
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
     * @param  \App\Models\NilaiOSCE  $nilaiOSCE
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiOSCE $nilaiOSCE)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiOSCE  $nilaiOSCE
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiOSCE $nilaiOSCE)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiOSCE  $nilaiOSCE
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiOSCE $nilaiOSCE)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiOSCE  $nilaiOSCE
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiOSCE $nilaiOSCE)
    {
        //
    }
}
