<?php

namespace App\Http\Controllers;

use App\Models\NilaiOSCE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateNilaiOSCERequest;

class NilaiOSCEController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiOSCERequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('dosen');
        
        
        
        for($i = 0; $i < ((int)$request->jumlahaspek+6); $i++) {
            $get_key = collect($request->all())->keys()[$i];
            
            DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%'.$get_key.'%')
                ->limit(1)
                ->update(['skor_osce' => (int)$request->$get_key, 'total_osce' => (int)$request->$get_key]);
                // dd((int)$request->jumlahaspek+2);
        }
        
        return redirect('/dashboard/matkul/' . $request->kodematkul);
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
     * @param  \App\Http\Requests\UpdateNilaiOSCERequest  $request
     * @param  \App\Models\NilaiOSCE  $nilaiOSCE
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiOSCERequest $request, NilaiOSCE $nilaiOSCE)
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

    public function input(Request $request) {

        $osces = DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->get();

        return view('dashboard.nilai.dosen.input.osce', [
            'osces' => $osces,
            'penguji' => auth()->user()->name,
            'kodematkul' => $request->kodematkul
        ]);
    }
}
