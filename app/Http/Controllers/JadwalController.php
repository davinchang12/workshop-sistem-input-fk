<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('dosen');
        $user = auth()->user()->id;
        $jadwals = DB::table('jadwals')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('users.id', $user)
            ->where('jadwals.deleted_at', '=', null)
            ->orderBy('tanggal', 'ASC')
            ->select('jadwals.id', 'matkuls.kodematkul', 'matkuls.namamatkul', 'users.name', 'jadwals.tanggal', 'jadwals.jammasuk', 'jadwals.jamselesai', 'jadwals.ruangan', 'jadwals.materi')
            ->get();
        foreach ($jadwals as $jadwal){

            $day = date('l', strtotime($jadwal->tanggal));
        }   
        // dd($day);

        
        return view('dashboard.jadwal.index', [
            'jadwals' => $jadwals,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
