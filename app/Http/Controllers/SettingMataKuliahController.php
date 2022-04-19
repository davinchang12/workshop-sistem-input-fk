<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingMataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkuls = DB::table('matkuls')
            ->orderBy('keterangan', 'ASC')
            ->get();

        return view('dashboard.matkul.admin.index', [
            'matkuls' => $matkuls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.matkul.admin.create');
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
            'kodematkul' => 'required|unique:matkuls',
            'namamatkul' => 'required|max:255',
            'keterangan' => 'required',
            'tahun_ajaran' => 'required',
            'bobot_sks' => 'required',
            'blok' => 'nullable',
            'kinerja' => 'nullable'
        ]);
        Matkul::create($validatedData);

        return redirect('/dashboard/settingmatakuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function show(Matkul $settingmatakuliah)
    {
        return view('dashboard.matkul.admin.show', [
            'matkul' => $settingmatakuliah
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function edit(Matkul $settingmatakuliah)
    {
        return view('dashboard.matkul.admin.edit', [
            'matkul' => $settingmatakuliah
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matkul $settingmatakuliah)
    {

        $rules = [
            'namamatkul' => 'required|max:255',
            'keterangan' => 'required',
            'tahun_ajaran' => 'required',
            'bobot_sks' => 'required',
            'blok' => 'nullable',
            'kinerja' => 'nullable'
        ];

        if ($request->kodematkul != $settingmatakuliah->kodematkul) {
            $rules['kodematkul'] = 'required|unique:matkuls';
        }

        $validatedData = $request->validate($rules);

        Matkul::where('id', $settingmatakuliah->id)
            ->update($validatedData);

        return redirect('/dashboard/settingmatakuliah')->with('success', 'Mata kuliah berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matkul $settingmatakuliah)
    {
        Matkul::destroy($settingmatakuliah->id);

        return redirect('/dashboard/settingmatakuliah')->with('success', 'Mata kuliah berhasil dihapus!');
    }

    public function checkBlok(Request $request)
    {
        $blok = substr ($request->kodematkul, -2);
        $blok = $blok[0].".".$blok[1];
        return response()->json(['blok' => $blok]);
    }
}
