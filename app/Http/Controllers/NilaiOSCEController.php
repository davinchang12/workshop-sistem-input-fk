<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JenisOSCE;
use App\Models\NilaiOSCE;
use Illuminate\Http\Request;
use App\Models\AksesEditNilai;
use App\Models\NilaiJenisOSCE;
use App\Imports\SoalOSCEImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
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
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
            ->limit(1)
            ->value('skor_osce');
        for ($i = 0; $i < ((int)$request->jumlahaspek); $i++) {
            $get_key = collect($request->all())->keys()[5 + $i];
            if ($checkskor == null) {
                DB::table('jenis_o_s_c_e_s')
                    ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                    ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                    ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                    ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                    ->where('users.name', $request->nama)
                    ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                    ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                    ->limit(1)
                    ->update(['skor_osce' => (int)$request->$get_key]);
            }
            $skor = DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->value('skor_osce');
            $bobot = DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->value('bobot');
            $total = $skor * $bobot;
            $value += $bobot;
            $totalskor += $total;
        }
        $checknilai = DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
            ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
            ->value('nilai_o_s_c_e_s.nilaiosce');
        // dd($checknilai);
        if ($checknilai == null) {
            $value = $value * 2;
            $nilai = round((($totalskor / $value) * 100), 2);
            DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                ->update(['nilai_o_s_c_e_s.nilaiosce' => $nilai]);
        }

        return redirect('/dashboard/nilailain')->with('success', 'Nilai OSCE berhasil diinput!');
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

    public function input(Request $request)
    {
        $this->authorize('dosen');
        $osces = DB::table('nilai_jenis_o_s_c_e_s')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->get();

        $checkExist = DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->get('nilaijenisosce_id');
        // dd($checkExist->isEmpty());
        if ($checkExist->isEmpty()) {
            $i = 0;
            foreach ($osces as $osces2) {
                $aspekid = DB::table('nilai_jenis_o_s_c_e_s')
                    ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                    ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                    ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                    ->where('nama_penguji', auth()->user()->name)
                    ->where('users.name', $request->mahasiswa_dipilih)
                    ->pluck("nilai_jenis_o_s_c_e_s.id");
                // dd($aspekid);
                DB::table('jenis_o_s_c_e_s')
                    ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                    ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                    ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                    ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                    ->where('nama_penguji', auth()->user()->name)
                    ->where('users.name', $request->mahasiswa_dipilih)
                    ->insert(['nilaijenisosce_id' => $aspekid[$i]]);
                $i++;
            }
        }

        return view('dashboard.nilai.dosen.input.osce', [
            'osces' => $osces,
            'penguji' => auth()->user()->name,
        ]);
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'OSCE')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("osce", true);

                    $osces = DB::table('nilai_jenis_o_s_c_e_s')
                        ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                        ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                        ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                        ->where('nama_penguji', auth()->user()->name)
                        ->where('users.role', 'mahasiswa')
                        ->groupBy('users.name')
                        ->select('name', 'nim')
                        ->get();

                    if (count($osces) > 0) {
                        return view('dashboard.nilai.dosen.edit.osceedit', [
                            'osces' => $osces,
                            'penguji' => auth()->user()->name,
                        ]);
                    } else {
                        return back()->with('fail', 'Nilai OSCE belum diisi!');
                    }
                }
            }
        } else {
            return back()->with('fail', 'Password edit salah!');
        }
    }

    public function input_edit(Request $request)
    {
        $osces = DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('nama_penguji', auth()->user()->name)
            ->where('users.name', $request->mahasiswa_dipilih)
            ->get();

        return view('dashboard.nilai.dosen.edit.osceinput', [
            'osces' => $osces,
            'penguji' => auth()->user()->name,
        ]);
    }

    public function simpan(Request $request)
    {
        // dd($request);
        $totalskor = 0;
        $value = 0;
        for ($i = 0; $i < ((int)$request->jumlahaspek); $i++) {
            $get_key = collect($request->all())->keys()[5 + $i];

            DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->update(['skor_osce' => (int)$request->$get_key]);

            $skor = DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->value('skor_osce');
            $bobot = DB::table('jenis_o_s_c_e_s')
                ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
                ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
                ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
                ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                ->where('users.name', $request->nama)
                ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
                ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
                ->limit(1)
                ->value('bobot');
            $total = $skor * $bobot;
            $value += $bobot;
            $totalskor += $total;
        }

        $value = $value * 2;
        $nilai = round((($totalskor / $value) * 100), 2);
        DB::table('jenis_o_s_c_e_s')
            ->join('nilai_jenis_o_s_c_e_s', 'jenis_o_s_c_e_s.nilaijenisosce_id', '=', 'nilai_jenis_o_s_c_e_s.id')
            ->join('nilai_o_s_c_e_s', 'nilai_jenis_o_s_c_e_s.nilaiosce_id', '=', 'nilai_o_s_c_e_s.id')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.name', $request->nama)
            ->where('nilai_o_s_c_e_s.namaosce', $request->namaosce)
            ->where('nilai_jenis_o_s_c_e_s.aspekdinilaiosce', 'like', '%' . $get_key . '%')
            ->update(['nilai_o_s_c_e_s.nilaiosce' => $nilai]);

        AksesEditNilai::where('jenisnilai', 'OSCE')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/nilailain/')->with('success', 'Nilai OSCE berhasil diedit!');
    }
}
