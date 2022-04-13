<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\NilaiSOCA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreNilaiSOCARequest;
use App\Http\Requests\UpdateNilaiSOCARequest;

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

        $socas = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $request->matkul_id)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Kemampuan mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan terjadinya penyakit  sesuai dengan skenario)')
            ->get();
        
            dd($socas);

        return view('dashboard.nilai.dosen.input.soca', [
            'socas' => $socas
        ]);
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
