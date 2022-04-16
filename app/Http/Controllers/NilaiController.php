<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        
        $pbl_dosens = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
            ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        
        $pbls = DB::table('nilai_p_b_l_skenario_diskusi_nilais')
            ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $praktikum_dosens = DB::table('nilai_jenis_praktikums')
            ->join('nilai_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();

        $praktikums = DB::table('nilai_jenis_praktikums')
            ->join('nilai_praktikums', 'nilai_jenis_praktikums.nilai_praktikum_id', '=', 'nilai_praktikums.id')
            ->join('nilais', 'nilai_praktikums.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('users.id', auth()->user()->id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->get();
        
        return view('dashboard.nilai.index', [
            'pbl_dosens' => $pbl_dosens,
            'pbls' => $pbls,
            'praktikum_dosens' => $praktikum_dosens,
            'praktikums' => $praktikums
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
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }    
}
