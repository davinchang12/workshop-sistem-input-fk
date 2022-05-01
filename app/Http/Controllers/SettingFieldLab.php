<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NilaiLain;
use Illuminate\Http\Request;
use App\Models\NilaiFieldlab;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class SettingFieldLab extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fieldlabs = DB::table('nilai_fieldlabs')
            ->orderBy('keterangan', 'ASC')
            ->groupBy('semester')
            ->get();

        return view('dashboard.fieldlab.admin.index', [
            'fieldlabs' => $fieldlabs
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

        $fieldlabs = DB::table('nilai_fieldlabs')
            ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->select('users.id as user_id')
            ->get();
            
        return view('dashboard.fieldlab.admin.create', [
            'dosens' => $dosens,
            'users' => $users,
            'angkatans' => $angkatans,
            'fieldlabs' => $fieldlabs
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

        $user_ids = $request->input('user_id');
        $semester = $request->input('semester');
        $keterangan = $request->input('keterangan');

        $kelompoks = DB::table('nilai_fieldlabs')
            ->groupBy('kelompok')
            ->select('kelompok')
            ->get();

        // dd($kelompoks->pluck('kelompok')->toArray());

        $kelompok = 1;

        for ($i = 1; $i <= 10; $i++) {
            if(!in_array($i, $kelompoks->pluck('kelompok')->toArray())) {
                $kelompok = $i;
                break;
            }
        }

        foreach ($user_ids as $user_id) {
            $nilailain = NilaiLain::create([
                'user_id' => $user_id,
            ]);

            NilaiFieldlab::create([
                'nilai_lain_id' => $nilailain->id,
                'semester' => 'Semester '.$semester,
                'kelompok' => $kelompok,
                'keterangan' => $keterangan
            ]);
        }
        return redirect('/dashboard/settingfieldlab/')->with('success', 'Kelompok Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiFieldlab $nilaiFieldlab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiFieldlab $nilaiFieldlab)
    {
        //
    }
}
