<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\Jadwal;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.matkul.index', [
            'jadwals' => Jadwal::where('user_id', auth()->user()->id)->get(),
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
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function show(Matkul $matkul)
    {
        $checkUserAndMatkul = [
            'user_id' => auth()->user()->id,
            'matkul_id' => $matkul->id 
        ];

        return view('dashboard.nilai.dosen.index', [
            'kelompoks' => Kelompok::where($checkUserAndMatkul)->get(),
            'matkul_id' => $matkul->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function edit(Matkul $matkul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matkul $matkul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matkul $matkul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matkul $matkul)
    {
        //
    }
}
