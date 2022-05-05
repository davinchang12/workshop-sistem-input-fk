<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NilaiLain;
use App\Models\NilaiOSCE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingOSCE extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $osces = DB::table('nilai_o_s_c_e_s')
            ->select('nama_penguji')
            ->get()
            ->unique('nama_penguji');

        return view('dashboard.osce.admin.index', [
            'osces' => $osces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosens = User::where('role', 'dosen')->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.nim', 'users.angkatan')
            ->where('users.role', 'mahasiswa')
            ->get();

        $angkatans = DB::table('users')
            ->select('angkatan')
            ->where('angkatan', '!=', null)
            ->groupBy('angkatan')
            ->get();

        $osces = DB::table('nilai_o_s_c_e_s')
            ->join('nilai_lains', 'nilai_o_s_c_e_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->select('users.id as user_id')
            ->get();

        return view('dashboard.osce.admin.create', [
            'dosens' => $dosens,
            'users' => $users,
            'angkatans' => $angkatans,
            'osces' => $osces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dosen' => 'required',
            'nama_osce' => 'required',
            'user_id' => 'required'
        ]);

        $validatedData['nama_osce'] = strtoupper($validatedData['nama_osce']);

        foreach($validatedData['user_id'] as $user) {
            $nilai_lain = NilaiLain::where('user_id', $user)->first()->id ??
                NilaiLain::create(['user_id' => $user])->id;

            NilaiOSCE::create([
                'nilai_lain_id' => $nilai_lain,
                'namaosce' => $validatedData['nama_osce'],
                'nama_penguji' => $validatedData['nama_dosen']
            ]);    
        }

        return redirect('/dashboard/settingosce')->with('success', 'Dosen dan mahasiswa berhasil ditambahkan!');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiOSCE  $nilaiOSCE
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiOSCE $nilaiOSCE)
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
}
