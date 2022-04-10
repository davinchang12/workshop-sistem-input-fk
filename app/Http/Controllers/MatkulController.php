<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use App\Models\NilaiPBLSkenarioDiskusi;
use App\Models\NilaiTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $nilaitugas=  DB::table('nilai_tugas')
        ->join('nilais', 'nilais.id', '=', 'nilai_tugas.nilai_id')
        ->join('users', 'users.id', '=', 'nilais.user_id')
        ->join('matkuls', 'matkuls.id', '=', 'nilais.matkul_id')
        ->where('matkul_id', '=', $matkul->id )
        ->get();

        $nilai = Nilai::where($checkUserAndMatkul)->first();
        $skenario = $nilai->pbl->pblskenario ?? null;

        return view('dashboard.nilai.dosen.index', [
            'kelompoks' => Kelompok::where($checkUserAndMatkul)->get(),
            'matkul' => $matkul,
            'nilaitugas' => $nilaitugas,
            'skenarios' => $skenario,
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
