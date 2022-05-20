<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\NilaiSOCA;
use Illuminate\Http\Request;
use App\Models\AksesEditNilai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->limit(1)
            ->update(['nilaisocas' => (int)$request->totalsoca]);
        
        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Overview Masalah')
            ->limit(1)
            ->update(['skor_soca' => (int)$request->overview_masalah]);

        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Analisis Masalah')
            ->limit(1)
            ->update(['skor_soca' => (int)$request->analisis_masalah]);

        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
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
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
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
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
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
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Hasil Penilaian Keterampilan presentasi & sikap')
            ->limit(1)
            ->update([
                'komentar' => $request->hasil_penilaian_keterampilan_presentasi_dan_sikap
            ]);

        for ($i = 0; $i < (int)$request->jumlah_ke_2; $i++) {
            $get_key = collect($request->all())->keys()[7 + $i];

            DB::table('jenis_s_o_c_a_s')
                ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
                ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
                ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
                ->where('jenis_s_o_c_a_s.keterangan_soca', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->update(['skor_soca' => (int)$request->$get_key]);
        }

        return redirect('/dashboard/nilailain');
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

    public function input(Request $request)
    {

        $socas = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Kemampuan analisa masalah')
            ->get();

        $socas_2 = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
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

    public function export()
    {
        $request = request();

        $checkUser = [
            'matkul_id' => $request->matkul_dipilih,
        ];

        return view('dashboard.nilai.dosen.export.soca', [
            'jadwals' => Jadwal::where($checkUser)->get(),
        ]);
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'SOCA')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("soca", true);

                    $socas = DB::table('nilai_jenis_s_o_c_a_s')
                        ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
                        ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
                        ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                        ->where('nama_penguji', auth()->user()->name)
                        ->where('users.role', 'mahasiswa')
                        ->groupBy('users.name')
                        ->select('name', 'nim')
                        ->get();

                    return view('dashboard.nilai.dosen.edit.socaedit', [
                        'socas' => $socas,
                    ]);
                }
            }
        } else {
            return back()->with('fail', 'Password edit salah!');
        }
    }

    public function input_edit(Request $request)
    {
        $socas = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Kemampuan analisa masalah')
            ->get();

        $socas_2 = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Kemampuan mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan terjadinya penyakit  sesuai dengan skenario)')
            ->get();

        $socas_3 = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Keterampilan saat presentasi')
            ->get();

        $socas_4 = DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->where('nilai_jenis_s_o_c_a_s.namaanalisis', 'Hasil Penilaian Keterampilan presentasi & sikap')
            ->get();

        // dd($socas_4);

        if ($socas_3[0]->kepuasan_presentasi != "") {
            return view('dashboard.nilai.dosen.edit.socainput', [
                'socas' => $socas,
                'socas_2' => $socas_2,
                'socas_3' => $socas_3,
                'socas_4' => $socas_4,
                'penguji' => auth()->user()->name,
            ]);
        } else {
            return redirect('/dashboard/nilailain')->with('fail', 'Nilai SOCA belum diisi!');
        }
    }

    public function simpan(Request $request)
    {
        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Overview Masalah')
            ->limit(1)
            ->update(['skor_soca' => (int)$request->overview_masalah]);

        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Analisis Masalah')
            ->limit(1)
            ->update(['skor_soca' => (int)$request->analisis_masalah]);

        DB::table('jenis_s_o_c_a_s')
            ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
            ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
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
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
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
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
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
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
            ->where('jenis_s_o_c_a_s.keterangan_soca', 'Hasil Penilaian Keterampilan presentasi & sikap')
            ->limit(1)
            ->update([
                'komentar' => $request->hasil_penilaian_keterampilan_presentasi_dan_sikap
            ]);

        for ($i = 0; $i < (int)$request->jumlah_ke_2; $i++) {
            $get_key = collect($request->all())->keys()[7 + $i];

            DB::table('jenis_s_o_c_a_s')
                ->join('nilai_jenis_s_o_c_a_s', 'jenis_s_o_c_a_s.nilaijenissoca_id', '=', 'nilai_jenis_s_o_c_a_s.id')
                ->join('nilai_s_o_c_a_s', 'nilai_jenis_s_o_c_a_s.nilaisoca_id', '=', 'nilai_s_o_c_a_s.id')
                ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_s_o_c_a_s.namasoca', $request->namasoca)
                ->where('jenis_s_o_c_a_s.keterangan_soca', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->update(['skor_soca' => (int)$request->$get_key]);
        }

        AksesEditNilai::where('jenisnilai', 'SOCA')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/nilailain/')->with('success', 'Nilai SOCA berhasil diedit!');
    }
}
