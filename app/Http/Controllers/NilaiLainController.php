<?php

namespace App\Http\Controllers;

use App\Models\NilaiLain;
use Illuminate\Http\Request;
use App\Exports\LaporanOSCEExport;
use App\Exports\LaporanSOCAExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanFieldLabExport;
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

        $mhs_osces = DB::table('nilai_o_s_c_e_s')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('users.id', auth()->user()->id)
            ->where('nilai_o_s_c_e_s.deleted_at', null)
            ->select('nilai_o_s_c_e_s.namaosce', 'nilai_o_s_c_e_s.nama_penguji', 'nilai_o_s_c_e_s.id', 'nilai_o_s_c_e_s.nilaiosce')
            ->get();

        $mhs_socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('users.id', auth()->user()->id)
            ->where('nilai_s_o_c_a_s.deleted_at', null)
            ->select('nilai_s_o_c_a_s.namasoca', 'nilai_s_o_c_a_s.nama_penguji', 'nilai_s_o_c_a_s.id', 'nilai_s_o_c_a_s.keterangan', 'nilai_s_o_c_a_s.nilaisocas')
            ->get();

        $namasocas = DB::table('nilai_jenis_s_o_c_a_s')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.role', 'mahasiswa')
            ->where('nilai_s_o_c_a_s.deleted_at', null)
            ->groupBy('users.name', 'nilai_s_o_c_a_s.namasoca')
            ->select('nilai_s_o_c_a_s.namasoca')
            ->get();

        $socas = DB::table('nilai_jenis_s_o_c_a_s')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.role', 'mahasiswa')
            ->where('nilai_s_o_c_a_s.deleted_at', null)
            ->groupBy('users.name')
            ->select('name', 'nim', 'nilai_s_o_c_a_s.namasoca')
            ->get();

        $namaosces = DB::table('nilai_jenis_o_s_c_e_s')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.role', 'mahasiswa')
            ->where('nilai_o_s_c_e_s.deleted_at', null)
            ->groupBy('users.name', 'nilai_o_s_c_e_s.namaosce')
            ->select('nilai_o_s_c_e_s.namaosce')
            ->get();

        $osces = DB::table('nilai_jenis_o_s_c_e_s')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.role', 'mahasiswa')
            ->where('nilai_o_s_c_e_s.deleted_at', null)
            ->groupBy('users.name')
            ->select('name', 'nim', 'nilai_o_s_c_e_s.namaosce')
            ->get();

        $fieldlabs = DB::table('nilai_fieldlabs')
            ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->where('nilai_fieldlabs.deleted_at', null)
            ->get();

        return view('dashboard.nilailain.index', [
            'socas' => $socas,
            'osces' => $osces,
            'namaosces' => $namaosces,
            'namasocas' => $namasocas,
            'fieldlabs' => $fieldlabs,
            'mhs_socas' => $mhs_socas,
            'mhs_osces' => $mhs_osces
        ]);
    }

    public function laporan_index()
    {
        return view('dashboard.laporannilailain.index');
    }

    public function laporan_osce()
    {
        $osces = DB::table('nilai_o_s_c_e_s')
            ->select('nama_penguji', 'namaosce')
            ->where('nilai_o_s_c_e_s.deleted_at', null)
            ->get()
            ->unique('nama_penguji');

        return view('dashboard.laporannilailain.osce', [
            'osces' => $osces
        ]);
    }

    public function laporan_soca()
    {
        $socas = DB::table('nilai_s_o_c_a_s')
            ->select('nama_penguji', 'namasoca', 'keterangan')
            ->groupBy('namasoca')
            ->where('deleted_at', '=', null)
            ->get();

        return view('dashboard.laporannilailain.soca', [
            'socas' => $socas
        ]);
    }

    public function laporan_fieldlab()
    {
        $fieldlabs = DB::table('nilai_fieldlabs')
            ->orderBy('keterangan', 'ASC')
            ->groupBy('semester')
            ->where('deleted_at', '=', null)
            ->get();

        return view('dashboard.laporannilailain.fieldlab', [
            'fieldlabs' => $fieldlabs
        ]);
    }

    public function laporan_osce_get(Request $request)
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanOSCEExport, 'laporanosce_' . $request->namaosce . '.xlsx');
    }

    public function laporan_soca_get(Request $request)
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanSOCAExport, 'laporansoca_' . $request->namasoca . '.xlsx');
    }

    public function laporan_fieldlab_get(Request $request)
    {
        $this->authorize('dosen');
        return Excel::download(new LaporanFieldLabExport, 'laporanfieldlab_' . $request->semester . '.xlsx');
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
