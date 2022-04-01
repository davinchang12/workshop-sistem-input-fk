<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('mahasiswa');
        return view('dashboard.nilai.kritiksaran.index');
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
     * @param  \App\Models\KritikSaran $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function show(KritikSaran $kritiksaran)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\KritikSaran $kritiksaran
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(KritikSaran $kritiksaran)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\KritikSaran $kritiksaran
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, KritikSaran $kritiksaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KritikSaran $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(KritikSaran $kritiksaran)
    {
        //
    }
}
