<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SettingJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = DB::table('jadwals')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->orderBy('tanggal', 'ASC')
            ->get();
            
        return view('dashboard.jadwal.admin.index', [
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
        $matkuls = Matkul::get();
        $users = User::where('role', 'dosen')->get();
        return view('dashboard.jadwal.admin.create', [
            'users' => $users,
            'matkuls' => $matkuls
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
        $rules = [
            'matkul_id' => 'required',
            'user_id' => 'required',
            'tanggal' => 'required',
            'jammasuk' => 'required',
            'jamselesai' => 'required|after:jammasuk',
            'ruangan' => 'nullable'
        ];

        $validatedData = $request->validate($rules);        
        $validatedData['jammasuk'] = $validatedData['jammasuk'].":00";
        $validatedData['jamselesai'] = $validatedData['jamselesai'].":00";
        
        $jadwals = DB::table('jadwals')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->where('users.id', $validatedData['user_id'])
            ->where('jadwals.tanggal', $validatedData['tanggal'])
            ->get();

        if (count($jadwals)>0) {
            foreach($jadwals as $jadwal) {
                $ruleJam1 = $jadwal->jammasuk <= $validatedData['jammasuk'] && $validatedData['jammasuk'] <= $jadwal->jamselesai;
                $ruleJam2 = strtotime($jadwal->jammasuk) <= strtotime($validatedData['jamselesai']) && strtotime($validatedData['jamselesai']) <= strtotime($jadwal->jamselesai);

                if ($ruleJam1){
                    throw ValidationException::withMessages(['errorJam' => 'Dosen sudah memiliki jam masuk pada tanggal yang sama di jadwal lain!']);
                } else if ($ruleJam2) {
                    throw ValidationException::withMessages(['errorJam' => 'Dosen sudah memiliki jam selesai pada tanggal yang sama di jadwal lain!']);
                }
            }
        }

        Jadwal::create($validatedData);

        return redirect('/dashboard/settingjadwal')->with('success', 'Mata kuliah berhasil ditambahkan!');
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
