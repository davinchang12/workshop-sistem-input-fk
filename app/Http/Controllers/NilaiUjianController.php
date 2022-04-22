<?php

namespace App\Http\Controllers;

use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use App\Models\FeedbackUjian;
use App\Models\HasilNilaiUjian;
use App\Exports\NilaiUjianExport;
use App\Imports\NilaiUjianImport;
use App\Exports\FeedbackUABExport;
use App\Exports\FeedbackUTBExport;
use App\Imports\FeedbackUABImport;
use App\Imports\FeedbackUTBImport;
use App\Models\JenisFeedbackUjian;
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Http\Requests\StoreNilaiUjianRequest;
use App\Http\Requests\UpdateNilaiUjianRequest;

class NilaiUjianController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiUjianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiUjianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiUjian $nilaiUjian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiUjian $nilaiUjian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiUjianRequest  $request
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiUjianRequest $request, NilaiUjian $nilaiUjian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiUjian  $nilaiUjian
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiUjian $nilaiUjian)
    {
        //
    }
    public function import_ujian(Request $request) {
        $this->authorize('dosen');
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('nilai_ujian',$nama_file);
 
		Excel::import(new NilaiUjianImport, public_path('/nilai_ujian/'.$nama_file));
 
		Session::flash('sukses','Nilai Ujian Berhasil Diimport!');

        File::delete(public_path('/nilai_ujian/'.$nama_file));
 
		return redirect('/dashboard/matkul');
    }
    public function export_ujian() {
        $this->authorize('dosen');
        return Excel::download(new NilaiUjianExport, 'nilaiujian.xlsx');
    }

    public function import_utb(Request $request) {
        $this->authorize('dosen');
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('feedback_utb',$nama_file);
 
		Excel::import(new FeedbackUTBImport, public_path('/feedback_utb/'.$nama_file));
 
		Session::flash('sukses','Nilai Feedback UTB Berhasil Diimport!');

        File::delete(public_path('/feedback_utb/'.$nama_file));
 
		return redirect('/dashboard/matkul');
    }
    public function export_utb() {
        $this->authorize('dosen');
        return Excel::download(new FeedbackUTBExport, 'feedbackutb.xlsx');
    }

    public function import_uab(Request $request) {
        $this->authorize('dosen');
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('feedback_uab',$nama_file);
 
		Excel::import(new FeedbackUABImport, public_path('/feedback_uab/'.$nama_file));
 
		Session::flash('sukses','Feedback UAB Berhasil Diimport!');

        File::delete(public_path('/feedback_uab/'.$nama_file));
 
		return redirect('/dashboard/matkul');
    }
    public function export_uab() {
        $this->authorize('dosen');
        return Excel::download(new FeedbackUABExport, 'feedbackuab.xlsx');
    }
}
