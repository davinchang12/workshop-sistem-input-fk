<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JenisOSCE;
use App\Models\NilaiOSCE;
use Illuminate\Http\Request;
use App\Models\NilaiJenisOSCE;
use App\Imports\SoalOSCEImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
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
        
        $totalskor = 0;
        $value = 0;
        // dd($request);
        $checkskor =  DB::table('jenis_o_s_c_e_s')
                            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
                            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                            ->join('users', 'nilais.user_id', '=', 'users.id')
                            ->where('users.name', $request->nama)
                            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                            ->limit(1)
                            ->value('skor_osce'); 
        for($i = 0; $i < ((int)$request->jumlahaspek); $i++) {
            $get_key = collect($request->all())->keys()[6+$i];
            
            if($checkskor == null){
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
                ->update(['skor_osce' => (int)$request->$get_key]);
            }
            $skor = DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
            ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%'.$get_key.'%')
            ->limit(1)
            ->value('skor_osce'); 
            $bobot = DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
            ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%'.$get_key.'%')
            ->limit(1)
            ->value('bobot');
            $total = $skor * $bobot;
            $value += $bobot;
            $totalskor += $total; 
        }
        $checknilai = DB::table('jenis_o_s_c_e_s')
        ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
        ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
        ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
        ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
        ->join('users', 'nilais.user_id', '=', 'users.id')
        ->where('users.name', $request->nama)
        ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
        ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%'.$get_key.'%')
        ->value('nilai_o_s_c_e_s.nilaiosce');
        // dd($checknilai);
        if($checknilai == null){
            $value = $value * 2;
            $nilai = round((($totalskor / $value) * 100), 2);
            DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
            ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%'.$get_key.'%')
            ->update(['nilai_o_s_c_e_s.nilaiosce' => $nilai]);
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
        $this->authorize('dosen');
        $osces = DB::table('nilai_jenis_o_s_c_e_s')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('matkuls.id', $request->matkul_dipilih)
                ->where('users.name', $request->mahasiswa_dipilih)
                ->get();
                        

        $checkExist = DB::table('jenis_o_s_c_e_s')
                    ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                    ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                    ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
                    ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                    ->join('users', 'nilais.user_id', '=', 'users.id')
                    ->where('matkuls.id', $request->matkul_dipilih)
                    ->where('users.name', $request->mahasiswa_dipilih)
                    ->get('nilaijenisosce_id');
            // dd($checkExist->isEmpty());
            if($checkExist->isEmpty()){
                        $i = 0;
                        foreach( $osces as $osces2 ){
                            $aspekid = DB::table('nilai_jenis_o_s_c_e_s')
                            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
                            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                            ->join('users', 'nilais.user_id', '=', 'users.id')
                            ->where('matkuls.id', $request->matkul_dipilih)
                            ->where('users.name', $request->mahasiswa_dipilih)
                            ->pluck("nilai_jenis_o_s_c_e_s.id");
                            // dd($aspekid);
                            DB::table('jenis_o_s_c_e_s')
                            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                            ->join('nilais', 'nilai_o_s_c_e_s.nilai_id', '=', 'nilais.id')
                            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                            ->join('users', 'nilais.user_id', '=', 'users.id')
                            ->where('matkuls.id', $request->matkul_dipilih)
                            ->where('users.name', $request->mahasiswa_dipilih)
                            ->insert(['nilaijenisosce_id'=> $aspekid[$i]]);
                           $i++;
                        }
                    }

        return view('dashboard.nilai.dosen.input.osce', [
            'osces' => $osces,
            'penguji' => auth()->user()->name,
            'kodematkul' => $request->kodematkul
        ]);
    }
    public function import(Request $request) {
        
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_tugas',$nama_file);
 
		Excel::import(new SoalOSCEImport, public_path('/soal_osce/'.$nama_file));
 
		Session::flash('sukses','Soal OSCE Berhasil Diimport!');

        File::delete(public_path('/soal_osce/'.$nama_file));
 
		return redirect('/dashboard/matkul');
    }

    public function export() {
        return Excel::download(new SoalOSCEExport, 'soalosce.xlsx');
    }
}
