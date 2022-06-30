<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\KritikSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KritikSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilais = DB::table('nilais')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('user_id', auth()->user()->id)
            ->where('matkuls.deleted_at', null)
            ->groupBy('matkul_id')
            ->select('matkuls.namamatkul', 'matkuls.kodematkul', 'matkuls.id', 'matkuls.keterangan', 'matkuls.tahun_ajaran', 'matkuls.keterangan')
            ->get();
        return view('dashboard.kritiksaran.index', [
            'nilais' => $nilais
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('mahasiswa');
        $matkul = $request->matkul_dipilih;
        $dosens = DB::table('jadwals')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'mahasiswa')
            ->where('jadwals.matkul_id', $matkul)
            ->where('jadwals.deleted_at', '=', null)
            ->select('users.name', 'users.id', 'matkuls.kodematkul')
            ->get();
        $users = User::where('role', 'dosen')->get();
        return view('dashboard.kritiksaran.create', [
            'users' => $dosens,
            'matkul' => $matkul
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
        // dd($request);
        $matkul = $request->matkul_dipilih;
        $namasiswa = auth()->user()->name;
        $nimsiswa = auth()->user()->nim;
        $rules = [
            'user_id' => 'required',
            'kritik' => 'required',
            'saran' => 'required'
        ];

        // dd($namasiswa);
        $validatedData = $request->validate($rules);
        $jadwals = DB::table('jadwals')->select('jadwals.id')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->where('users.id', $validatedData['user_id'])
            ->where('jadwals.matkul_id', $matkul)
            ->whereNull('jadwals.deleted_at')
            ->get();
        $count = 0;

        foreach($jadwals as $jadwal){
            $jadwalid = $jadwal->id;
            $ceksiswa = DB::table('kritik_sarans')
            ->join('users', 'kritik_sarans.user_id', '=', 'users.id')
            ->join('jadwals', 'jadwals.id', '=', 'kritik_sarans.jadwal_id')
            ->where('jadwals.id', $jadwalid)
            ->whereNull('jadwals.deleted_at')
            ->value('kritik_sarans.nimmahasiswa');
            $cekdosen = DB::table('kritik_sarans')
            ->join('users', 'kritik_sarans.user_id', '=', 'users.id')
            ->join('jadwals', 'jadwals.id', '=', 'kritik_sarans.jadwal_id')
            ->where('jadwals.id', $jadwalid)
            ->whereNull('jadwals.deleted_at')
            ->value('kritik_sarans.user_id');

            if($ceksiswa == $nimsiswa){
                if($cekdosen == $validatedData['user_id']){
                    $count++;
                }
                else{
                    $count=0;
                }
            }
            else{
                $count=0;
            }
        }
        if($count==0){
            DB::table('kritik_sarans')
                    ->join('jadwals', 'jadwals.id','=', 'kritik_sarans.jadwal_id')
                    ->join('users', 'kritik_sarans.user_id', '=', 'users.id')
                    ->where('jadwals.id', $jadwalid)
                    ->whereNull('jadwals.deleted_at')
                    ->insert([
                        'user_id' => $validatedData['user_id'],
                        'namamahasiswa' => $namasiswa,
                        'nimmahasiswa' => $nimsiswa,
                        'jadwal_id' => $jadwalid,
                        'kritik' => $validatedData['kritik'],
                        'saran' => $validatedData['saran']
                    ]);

        }
        return redirect('/dashboard/kritikdansaran')->with('success', 'Kritik dan saran berhasil diberikan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KritikSaran $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function show(KritikSaran $kritiksaran, Request $request)
    {
        $this->authorize('dosen');
        $dosen = auth()->user()->id;
        $matkul = $request->matkul_dipilih;
        $namamatkul = Matkul::where('id', $matkul)->value('namamatkul');

        $jadwals = DB::table('jadwals')->select('jadwals.*', 'matkuls.*', 'kritik_sarans.*', 'users.*')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('kritik_sarans', 'jadwals.id','=', 'kritik_sarans.jadwal_id')
            ->where('users.id', $dosen)
            ->where('users.role', 'dosen')
            ->where('jadwals.matkul_id', $matkul)
            ->whereNull('jadwals.deleted_at')
            ->get();
        return view('dashboard.kritiksaran.dosen', [
            'dosen' => auth()->user()->name,
            'jadwals' => $jadwals,
            'namamatkul' => $namamatkul
        ]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\KritikSaran $kritiksaran
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(KritikSaran $kritiksaran)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\KritikSaran $kritiksaran
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, KritikSaran $kritiksaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KritikSaran $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(KritikSaran $kritiksaran)
    {
        //
    }
}
