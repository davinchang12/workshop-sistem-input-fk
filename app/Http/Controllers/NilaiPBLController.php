<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NilaiPBL;
use App\Models\NilaiPBLSkenario;
use App\Models\NilaiPBLSkenarioDiskusi;
use App\Models\NilaiPBLSkenarioDiskusiNilai;

class NilaiPBLController extends Controller
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
     * @param  \App\Http\Requests\StoreNilaiPBLRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        for ($i = 1; $i <= (int)$request['loop']; $i++) {
            $getNilaiPBLSkenarioID = NilaiPBLSkenarioDiskusi::select('nilai_p_b_l_skenario_diskusis.id as id', 'nilai_p_b_l_skenario_diskusis.tanggal_pelaksanaan', 'users.id as user_id')
                ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
                ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
                ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('users.name', $request['nama' . $i])
                ->where('nilai_p_b_l_skenario_diskusis.diskusi', $request['diskusi'])
                ->first();
            
            $total = ((((int)$request['kehadiran' . $i] + (int)$request['aktivitas_saat_diskusi' . $i]) + (int)$request['relevansi_pembicaraan' . $i] + (int)$request['keterampilan_berkomunikasi' . $i]) / 16) * 100;
            
            if($request['laporan_resmi' . $i] == 'diskusi_1') {
                $mean = ((int)$request['laporan_sementara' . $i] + $total) / 2;
            } else {
                $mean = ((int)$request['laporan_sementara' . $i] + $total + (int)$request['laporan_resmi' . $i]) / 3;
            }

            NilaiPBLSkenarioDiskusi::where('id', $getNilaiPBLSkenarioID->id)
                ->update(['tanggal_pelaksanaan' => $request['tanggal_pelaksanaan']]);

            NilaiPBLSkenarioDiskusiNilai::firstOrCreate(
                ['nilaipblskenariodiskusi_id' => $getNilaiPBLSkenarioID->id],
                [
                    'kehadiran' => $request['kehadiran' . $i],
                    'aktivitas_diskusi' => $request['aktivitas_saat_diskusi' . $i],
                    'relevansi_pembicaraan' => $request['relevansi_pembicaraan' . $i],
                    'keterampilan_berkomunikasi' => $request['keterampilan_berkomunikasi' . $i],
                    'laporan_sementara' => $request['laporan_sementara' . $i] ?? 0,
                    'laporan_resmi' => $request['laporan_resmi' . $i] == 'diskusi_1' ? null : $request['laporan_resmi' . $i],
                    'total' => $total,
                    'rata_rata' => $mean,
                    'catatan_kesan_kegiatan_diskusi_tutorial' => $request->catatan
                ],
            );
        }

        return redirect('/dashboard/matkul/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiPBL $nilaiPBL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiPBL $nilaiPBL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiPBLRequest  $request
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiPBL $nilaiPBL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPBL  $nilaiPBL
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiPBL $nilaiPBL)
    {
        //
    }

    public function input(Request $request)
    {
        $kodematkul = $request->kodematkul;
        $skenario = $request->skenario;
        $diskusi = $request->diskusi;
        $diskusi_id = $request->diskusi_id;
        $kelompok = $request->kelompok;
        $dosen_tutor = auth()->user()->name;

        $kelompoks = NilaiPBLSkenarioDiskusi::select('nilai_p_b_l_skenario_diskusis.id as diskusi_id', 'nilai_p_b_l_skenario_diskusis.diskusi as diskusi', 'users.role as role', 'users.name as name', 'users.nim as nim')
                ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
                ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
                ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('nilai_p_b_l_skenarios.kelompok', $kelompok)
                ->where('nilai_p_b_l_skenarios.skenario', $skenario)
                ->where('nilai_p_b_l_skenario_diskusis.diskusi', $diskusi)
                ->get();

        return view('dashboard.nilai.dosen.input.pbl', [
            'kelompoks' => $kelompoks,
            'skenarios' => NilaiPBLSkenario::where('kelompok', $kelompok)->get(),
            'tutor' => $dosen_tutor,
            'kodematkul' => $kodematkul,
            'kelompok_id' => $kelompok,
            'skenario' => $skenario,
            'diskusi' => $diskusi,
            'diskusi_id' => $diskusi_id
        ]);
    }
}
