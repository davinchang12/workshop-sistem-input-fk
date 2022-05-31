<?php

namespace App\Http\Controllers;

use App\Models\NilaiPBL;

use Illuminate\Http\Request;
use App\Models\AksesEditNilai;
use App\Models\NilaiPBLSkenario;
use Illuminate\Support\Facades\Hash;
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
                ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
                ->where('nilai_p_b_l_skenario_diskusis.diskusi', $request['diskusi'])
                ->where('nilai_p_b_l_skenarios.skenario', $request['skenario'])
                ->where('nilai_p_b_l_s.deleted_at', null)
                ->where('nilais.deleted_at', null)
                ->where('users.name', $request['nama' . $i])
                ->where('matkuls.kodematkul', $request['kodematkul'])
                ->first();

            $total = ((((int)$request['kehadiran' . $i] + (int)$request['aktivitas_saat_diskusi' . $i]) + (int)$request['relevansi_pembicaraan' . $i] + (int)$request['keterampilan_berkomunikasi' . $i]) / 16) * 100;

            if ($request['laporan_resmi' . $i] == 'diskusi_1') {
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
        $blok = $request->blok;
        $skenario = $request->skenario;
        $diskusi = $request->diskusi;
        $diskusi_id = $request->diskusi_id;
        $kelompok = $request->kelompok;
        $dosen_tutor = auth()->user()->name;
        $tanggal_pelaksanaan = $request->tanggal_pelaksanaan;

        $kelompoks = NilaiPBLSkenarioDiskusi::select('nilai_p_b_l_skenario_diskusis.id as diskusi_id', 'nilai_p_b_l_skenario_diskusis.diskusi as diskusi', 'users.role as role', 'users.name as name', 'users.nim as nim')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
            ->where('nilai_p_b_l_skenarios.kelompok', $kelompok)
            ->where('nilai_p_b_l_skenarios.skenario', $skenario)
            ->where('nilai_p_b_l_skenario_diskusis.diskusi', $diskusi)
            ->where('matkuls.kodematkul', $kodematkul)
            ->where('nilais.deleted_at', null)
            ->where('nilai_p_b_l_s.deleted_at', null)
            ->get();

        return view('dashboard.nilai.dosen.input.pbl', [
            'kelompoks' => $kelompoks,
            'skenarios' => NilaiPBLSkenario::where('kelompok', $kelompok)->get(),
            'tutor' => $dosen_tutor,
            'kodematkul' => $kodematkul,
            'blok' => $blok,
            'kelompok_id' => $kelompok,
            'skenario' => $skenario,
            'diskusi' => $diskusi,
            'diskusi_id' => $diskusi_id,
            'tanggal_pelaksanaan' => $tanggal_pelaksanaan
        ]);
    }

    public function check(Request $request)
    {
        $aksesnilai = AksesEditNilai::where('user_id', auth()->user()->id)
            ->where('jenisnilai', 'PBL')
            ->get();

        if (count($aksesnilai) > 0) {
            foreach ($aksesnilai as $akses) {
                if (Hash::check($request->password, $akses->passwordakses)) {
                    session("pbl", true);

                    $kodematkul = $request->kodematkul;
                    $blok = $request->blok;
                    $skenario = $request->skenario;
                    $diskusi = $request->diskusi;
                    $diskusi_id = $request->diskusi_id;
                    $kelompok = $request->kelompok;
                    $dosen_tutor = auth()->user()->name;
                    $tanggal_pelaksanaan = $request->tanggal_pelaksanaan;

                    $kelompoks = NilaiPBLSkenarioDiskusiNilai::select(
                        'nilai_p_b_l_skenario_diskusis.id as diskusi_id',
                        'nilai_p_b_l_skenario_diskusis.diskusi as diskusi',
                        'users.role as role',
                        'users.name as name',
                        'users.nim as nim',
                        'nilai_p_b_l_skenario_diskusi_nilais.kehadiran',
                        'nilai_p_b_l_skenario_diskusi_nilais.relevansi_pembicaraan',
                        'nilai_p_b_l_skenario_diskusi_nilais.keterampilan_berkomunikasi',
                        'nilai_p_b_l_skenario_diskusi_nilais.laporan_sementara',
                        'nilai_p_b_l_skenario_diskusi_nilais.laporan_resmi',
                        'nilai_p_b_l_skenario_diskusi_nilais.total',
                        'nilai_p_b_l_skenario_diskusi_nilais.rata_rata',
                        'nilai_p_b_l_skenario_diskusi_nilais.catatan_kesan_kegiatan_diskusi_tutorial'
                    )
                        ->join('nilai_p_b_l_skenario_diskusis', 'nilai_p_b_l_skenario_diskusi_nilais.nilaipblskenariodiskusi_id', '=', 'nilai_p_b_l_skenario_diskusis.id')
                        ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
                        ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
                        ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
                        ->join('users', 'nilais.user_id', '=', 'users.id')
                        ->where('nilai_p_b_l_skenarios.kelompok', $kelompok)
                        ->where('nilai_p_b_l_skenarios.skenario', $skenario)
                        ->where('nilai_p_b_l_skenario_diskusis.diskusi', $diskusi)
                        ->where('nilais.deleted_at', null)
                        ->where('nilai_p_b_l_s.deleted_at', null)
                        ->get();

                    if (count($kelompoks) > 0) {
                        return view('dashboard.nilai.dosen.edit.pbl', [
                            'kelompoks' => $kelompoks,
                            'skenarios' => NilaiPBLSkenario::where('kelompok', $kelompok)->get(),
                            'tutor' => $dosen_tutor,
                            'kodematkul' => $kodematkul,
                            'blok' => $blok,
                            'kelompok_id' => $kelompok,
                            'skenario' => $skenario,
                            'diskusi' => $diskusi,
                            'diskusi_id' => $diskusi_id,
                            'tanggal_pelaksanaan' => $tanggal_pelaksanaan
                        ]);
                    } else {
                        return back()->with('fail', 'Nilai PBL belum diisi!');
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
        for ($i = 1; $i <= (int)$request['loop']; $i++) {
            $getNilaiPBLSkenarioID = NilaiPBLSkenarioDiskusi::select('nilai_p_b_l_skenario_diskusis.id as id', 'nilai_p_b_l_skenario_diskusis.tanggal_pelaksanaan', 'users.id as user_id')
                ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
                ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
                ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
                ->join('users', 'nilais.user_id', '=', 'users.id')
                ->where('users.name', $request['nama' . $i])
                ->where('nilai_p_b_l_skenario_diskusis.diskusi', $request['diskusi'])
                ->where('nilais.deleted_at', null)
                ->where('nilai_p_b_l_s.deleted_at', null)
                ->first();

            $total = ((((int)$request['kehadiran' . $i] + (int)$request['aktivitas_saat_diskusi' . $i]) + (int)$request['relevansi_pembicaraan' . $i] + (int)$request['keterampilan_berkomunikasi' . $i]) / 16) * 100;

            if ($request['laporan_resmi' . $i] == 'diskusi_1') {
                $mean = ((int)$request['laporan_sementara' . $i] + $total) / 2;
            } else {
                $mean = ((int)$request['laporan_sementara' . $i] + $total + (int)$request['laporan_resmi' . $i]) / 3;
            }

            NilaiPBLSkenarioDiskusi::where('id', $getNilaiPBLSkenarioID->id)
                ->update(['tanggal_pelaksanaan' => $request['tanggal_pelaksanaan']]);

            NilaiPBLSkenarioDiskusiNilai::where('nilaipblskenariodiskusi_id', $getNilaiPBLSkenarioID->id)
                ->update(
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

        AksesEditNilai::where('jenisnilai', 'PBL')
            ->where('user_id', auth()->user()->id)
            ->forcedelete();

        return redirect('/dashboard/matkul/' . $request->input('kodematkul'))->with('success', 'Nilai PBL berhasil diedit!');
    }
}
