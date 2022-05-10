<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NilaiLain;
use App\Models\NilaiSOCA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingSOCA extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socas = DB::table('nilai_s_o_c_a_s')
            ->select('nama_penguji', 'namasoca')
            ->groupBy('nama_penguji', 'namasoca')
            ->get();

        return view('dashboard.soca.admin.index', [
            'socas' => $socas
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

        $socas = DB::table('nilai_s_o_c_a_s')
            ->join('nilai_lains', 'nilai_s_o_c_a_s.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->select('users.id as user_id')
            ->get();

        return view('dashboard.soca.admin.create', [
            'dosens' => $dosens,
            'users' => $users,
            'angkatans' => $angkatans,
            'socas' => $socas
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
            'nama_soca' => 'required',
            'user_id' => 'required'
        ]);

        $validatedData['nama_soca'] = strtoupper($validatedData['nama_soca']);

        foreach($validatedData['user_id'] as $user) {
            $nilai_lain = NilaiLain::where('user_id', $user)->first()->id ??
                NilaiLain::create(['user_id' => $user])->id;

            NilaiSOCA::create([
                'nilai_lain_id' => $nilai_lain,
                'namasoca' => $validatedData['nama_soca'],
                'nama_penguji' => $validatedData['nama_dosen']
            ]);    
        }

        return redirect('/dashboard/settingsoca')->with('success', 'Dosen dan mahasiswa berhasil ditambahkan!');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiSOCA  $nilaiSOCA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiSOCA $nilaiSOCA)
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
}
