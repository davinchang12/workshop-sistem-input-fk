<?php

namespace App\Http\Controllers;

use App\Models\NilaiLain;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreNilaiLainRequest;
use App\Http\Requests\UpdateNilaiLainRequest;

class NilaiLainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs_socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('users.id', auth()->user()->id)
            ->select('nilai_s_o_c_a_s.namasoca', 'nilai_s_o_c_a_s.nama_penguji', 'nilai_s_o_c_a_s.id')
            ->get();

        // dd($mhs_socas);

        $socas = DB::table('nilai_jenis_s_o_c_a_s')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.role', 'mahasiswa')
            ->where('nilai_s_o_c_a_s.deleted_at', null)
            ->groupBy('users.name')
            ->select('name', 'nim')
            ->get();
      
        $osces = DB::table('nilai_jenis_o_s_c_e_s')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.role', 'mahasiswa')
            ->groupBy('users.name')
            ->select('name', 'nim')
            ->get();

        // $fieldlabs = DB::table('nilai_semester_field_labs')
        //     ->join('nilai_fieldlabs', 'nilai_semester_field_labs.nilai_field_lab_id', '=', 'nilai_fieldlabs.id')
        $fieldlabs = DB::table('nilai_fieldlabs')
        ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
        ->join('users', 'nilai_lains.user_id', '=', 'users.id')
        ->where('users.id', auth()->user()->id)
        ->get();
            
        return view('dashboard.nilailain.index', [
            'socas' => $socas,
            'osces' => $osces,
            'fieldlabs' => $fieldlabs,
            'mhs_socas' => $mhs_socas
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
     * @param  \App\Http\Requests\StoreNilaiLainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiLainRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiLain  $nilaiLain
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiLain $nilaiLain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiLain  $nilaiLain
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiLain $nilaiLain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiLainRequest  $request
     * @param  \App\Models\NilaiLain  $nilaiLain
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiLainRequest $request, NilaiLain $nilaiLain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiLain  $nilaiLain
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiLain $nilaiLain)
    {
        //
    }
}
