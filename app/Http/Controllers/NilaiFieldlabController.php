<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiFieldlab;
use App\Models\AksesEditNilai;
use Illuminate\Support\Facades\DB;

use App\Exports\NilaiFieldLabExport;
use App\Imports\NilaiFieldLabImport;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NilaiSemesterFieldLab;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreNilaiFieldlabRequest;
use App\Http\Requests\UpdateNilaiFieldlabRequest;

class NilaiFieldlabController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiFieldlabRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiFieldlabRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $fieldlabs = DB::table('nilai_semester_field_labs')
            ->join('nilai_fieldlabs', 'nilai_semester_field_labs.nilai_field_lab_id', '=', 'nilai_fieldlabs.id')
            ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
            ->join('users', 'nilai_lains.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->where('nilai_fieldlabs.semester', $request['semester'])
            ->where('nilai_fieldlabs.kelompok', $request['kelompok'])
            ->where('users.id', auth()->user()->id)
            ->get();

        if (count($fieldlabs) > 0) {
            return view('dashboard.nilailain.fieldlab', [
                'fieldlabs' => $fieldlabs
            ]);
        } else {
            return back()->with('fail', 'Nilai Fieldlab belum diisi!');
        }
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
     * @param  \App\Http\Requests\UpdateNilaiFieldlabRequest  $request
     * @param  \App\Models\NilaiFieldlab  $nilaiFieldlab
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiFieldlabRequest $request, NilaiFieldlab $nilaiFieldlab)
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

    public function export()
    {
        return Excel::download(new NilaiFieldLabExport, 'nilaifieldlab.xlsx');
    }

    public function import(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('nilai_field_lab', $nama_file);

        Excel::import(new NilaiFieldLabImport, public_path('/nilai_field_lab/' . $nama_file));

        Session::flash('sukses', 'Nilai Tugas Berhasil Diimport!');

        File::delete(public_path('/nilai_field_lab/' . $nama_file));

        return redirect('/dashboard/nilailain');
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'FIELDLAB')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("fieldlab", true);

                    $fieldlabs = DB::table('nilai_semester_field_labs')
                        ->join('nilai_fieldlabs', 'nilai_semester_field_labs.nilai_field_lab_id', '=', 'nilai_fieldlabs.id')
                        ->join('nilai_lains', 'nilai_fieldlabs.nilai_lain_id', '=', 'nilai_lains.id')
                        ->join('users', 'nilai_lains.user_id', '=', 'users.id')
                        ->where('users.role', 'mahasiswa')
                        ->where('nilai_fieldlabs.semester', $request['semester'])
                        ->where('nilai_fieldlabs.kelompok', $request['kelompok'])
                        ->get();

                    if (count($fieldlabs) > 0) {
                        return view('dashboard.nilai.dosen.edit.fieldlab', [
                            'fieldlabs' => $fieldlabs
                        ]);
                    } else {
                        return back()->with('fail', 'Nilai Fieldlab belum diisi!');
                    }
                } else {
                    return back()->with('fail', 'Password edit salah!');
                }
            }
        } else {
            return back()->with('fail', 'Password edit salah!');
        }
    }

    public function simpan(Request $request)
    {
        for ($i = 0; $i < ((int)$request->count - 1); $i++) {
            NilaiSemesterFieldLab::where('nilai_field_lab_id', $request->fieldlab_id[$i])
                ->update([
                    'total_nilai_dosbing' => $request->total_nilai_dosbing[$i],
                    'total_nilai_penguji' => $request->total_nilai_penguji[$i],
                    'total_nilai_penguji_2' => $request->total_nilai_penguji_2[$i],
                    'nilai_akhir' => $request->nilai_akhir[$i],
                    'keterangan_akhir' => $request->keterangan_akhir[$i]
                ]);
        }

        AksesEditNilai::where('jenisnilai', 'FIELDLAB')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/nilailain')->with('success', 'Nilai fieldlab berhasil diedit!');
    }
}
