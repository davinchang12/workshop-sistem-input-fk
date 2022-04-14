<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\NilaiSOCA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function store(Request $request)
    {
        $socas = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Overview Masalah')
            ->limit(1)
            ->update(['skor_soca' => (int)$request->overview_masalah]);
        
        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Analisis Masalah')
            ->limit(1)
            ->update(['skor_soca' => (int)$request->analisis_masalah]);

        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Sikap')
            ->limit(1)
            ->update([
                'kepuasan_presentasi' => $request->sikap_keterangan, 
                'komentar' => $request->sikap_komentar
            ]);
        
        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Kemampuan berkomunikasi')
            ->limit(1)
            ->update([
                'kepuasan_presentasi' => $request->kemampuan_berkomunikasi_keterangan, 
                'komentar' => $request->kemampuan_berkomunikasi_komentar
            ]);

        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Sistematika penyajian')
            ->limit(1)
            ->update([
                'kepuasan_presentasi' => $request->sistematika_penyajian_keterangan, 
                'komentar' => $request->sistematika_penyajian_komentar
            ]);
        
        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Hasil Penilaian Keterampilan presentasi & sikap')
            ->limit(1)
            ->update([
                'komentar' => $request->hasil_penilaian_keterampilan_presentasi_dan_sikap
            ]);
        
        for($i = 0; $i < (int)$request->jumlah_ke_2; $i++) {
            $get_key = collect($request->all())->keys()[8+$i];

            DB::table('jenis_s_o_c_a_s')
                ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
                ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
                ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
                ->where('jenis_s_o_c_a_s.keterangan_soca', 'like', '%'.$get_key.'%')
                ->limit(1)
                ->update(['skor_soca' => (int)$request->$get_key]);
        }
        
        return redirect('/dashboard/matkul/' . $request->kodematkul);
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
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Kemampuan analisa masalah')
            ->get();

        $socas_2 = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilais', 'nilai_s_o_c_a_s.nilai_id', '=', 'nilais.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->where('matkuls.id', $request->matkul_dipilih)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Kemampuan mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan terjadinya penyakit  sesuai dengan skenario)')
            ->get();

        return view('dashboard.nilai.dosen.input.soca', [
            'socas' => $socas,
            'socas_2' => $socas_2,
            'penguji' => auth()->user()->name,
            'kodematkul' => $request->kodematkul
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
