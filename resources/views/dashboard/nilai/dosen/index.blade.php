@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai</h1>
    </div>
    <a href="/dashboard/matkul" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Input / Edit </h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#tugas" class="nav-link active" data-bs-toggle="tab">Tugas</a>
        </li>
        <li class="nav-item">
            <a href="#pbl" class="nav-link" data-bs-toggle="tab">PBL</a>
        </li>
        <li class="nav-item">
            <a href="#praktikum" class="nav-link" data-bs-toggle="tab">Praktikum</a>
        </li>
        <li class="nav-item">
            <a href="#soca" class="nav-link" data-bs-toggle="tab">SOCA</a>
        </li>
        <li class="nav-item">
            <a href="#ujian" class="nav-link" data-bs-toggle="tab">Ujian</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tugas">
            <form action="/dashboard/matkul/nilai/export/tugas" method="get">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul_id }}">
                <button class="btn btn-primary w-100 shadow-none">Download Template</button>
            </form>
            <form method="post" action="/dashboard/matkul/nilai/import/tugas" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Template</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            <div class="container">
                <div class="row">
                    <table class="talbe table-bordered">
                        <tr>
                            <td colspan=19 align="center"><b>Daftar Nilai Tugas </b></td>
                        </tr>
                        <tr>
                            <td rowspan=3 align="center" bgcolor="lightgray"><b>No</b></td>
                            <td rowspan=3 align="center" bgcolor="yellow"><b>Nama</b></td>
                            <td rowspan=3 align="center" bgcolor="yellow"><b>NIM</b></td>
                            <td colspan=16 align="center" bgcolor="yellow"><b>Penilaian</b></td>
                        </tr>
                        <tr>
                            <td colspan=14 align="center" bgcolor="lightblue"><b>TUGAS</b></td>
                            <td rowspan=2 align="center" bgcolor="lightblue"><b>Total</b></td>
                            <td rowspan=2 align="center" bgcolor="lightblue"><b>Rata-Rata</b></td>
                        </tr>
                        <tr>
                            <td align="center"><b>1</b></td>
                            <td align="center"><b>2</b></td>
                            <td align="center"><b>3</b></td>
                            <td align="center"><b>4</b></td>
                            <td align="center"><b>5</b></td>
                            <td align="center"><b>6</b></td>
                            <td align="center"><b>7</b></td>
                            <td align="center"><b>8</b></td>
                            <td align="center"><b>9</b></td>
                            <td align="center"><b>10</b></td>
                            <td align="center"><b>11</b></td>
                            <td align="center"><b>12</b></td>
                            <td align="center"><b>13</b></td>
                            <td align="center"><b>14</b></td>
                        </tr>
                        @foreach ($nilaitugas as $tugas)
                            @if ($tugas->role == 'mahasiswa')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tugas->name }}</td>
                                    <td>{{ $tugas->email }}</td>
                                    <td>{{ $tugas->tugas_1 }}</td>
                                    <td>{{ $tugas->tugas_2 }}</td>
                                    <td>{{ $tugas->tugas_3 }}</td>
                                    <td>{{ $tugas->tugas_4 }}</td>
                                    <td>{{ $tugas->tugas_5 }}</td>
                                    <td>{{ $tugas->tugas_6 }}</td>
                                    <td>{{ $tugas->tugas_7 }}</td>
                                    <td>{{ $tugas->tugas_8 }}</td>
                                    <td>{{ $tugas->tugas_9 }}</td>
                                    <td>{{ $tugas->tugas_10 }}</td>
                                    <td>{{ $tugas->tugas_11 }}</td>
                                    <td>{{ $tugas->tugas_12 }}</td>
                                    <td>{{ $tugas->tugas_13 }}</td>
                                    <td>{{ $tugas->tugas_14 }}</td>
                                    <td>Total</td>
                                    <td>Rata-rata</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pbl">
            <form action="/dashboard/matkul/nilai/export-pbl" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul_id }}">
                <button class="btn btn-primary w-100 shadow-none">Download Template</button>
            </form>
            <form method="post" action="/dashboard/matkul/nilai/import-pbl" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Template</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            <div class="container">
                <div class="row">
                    @foreach ($kelompoks as $kelompok)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">{{ $kelompok->kodekelompok }}</h5>
                                            <small>{{ $kelompok->matkul->keterangan }}</small><br>
                                            <small>Tahun Ajaran {{ $kelompok->matkul->tahun_ajaran }}</small>
                                        </div>
                                        <div class="col-md-auto p-auto">
                                            <div class="col pt-2">
                                                <a href="/dashboard/nilai/lihat{{ $kelompok->matkul->namamatkul }}"
                                                    class="badge bg-info w-100"><span data-feather="eye"></span></a>
                                            </div>
                                            <div class="col pt-2">
                                                @can('dosen')
                                                    <a href="/dashboard/dosen/nilai" class="badge bg-info w-100"><span
                                                            data-feather="settings"></span></a>
                                                @endcan
                                            </div>
                                            <div class="col pt-2">
                                                @can('admin')
                                                    <a href="/dashboard/admin/nilai/edit" class="badge bg-info w-100"><span
                                                            data-feather="key"></span></a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="praktikum">
            <form action="/dashboard/matkul/nilai/export-praktikum-tugas" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul_id }}">
                <button class="btn btn-primary w-100 shadow-none">Download Template</button>
            </form>
            <form method="post" action="/dashboard/matkul/nilai/import-praktikum-tugas" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Template Tugas</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>

            <form action="/dashboard/matkul/nilai/export-praktikum-responsi-remedial" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul_id }}">
                <button class="btn btn-primary w-100 shadow-none">Download Template Responsi dan Remedial</button>
            </form>
            <form method="post" action="/dashboard/matkul/nilai/import-praktikum-responsi-remedial"
                enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Template Responsi dan Remedial</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="SOCA">
            <div class="container mt-3 mb-3">
                <div class=WordSection1>
                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><span lang=IN style='font-size:14.0pt'>Checklist SOCA
                                {{ $socas[0]->keterangan }}</span></b></p>

                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><u><span
                                    style='font-size:14.0pt'>{{ $socas[0]->namasoca }}</span></u></b></p>

                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><u><span style='font-size:14.0pt'><span
                                        style='text-decoration:none'><br></span></u></b></p>

                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><u><span style='font-size:14.0pt'><span
                                        style='text-decoration:none'><br></span></u></b></p>

                    <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=100%
                        style='margin-left:.1pt;border-collapse:collapse'>
                        <tr style='height:22.5pt'>
                            <td width=422 colspan=2 style='width:316.75pt;border:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:22.5pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nama
                                        mahasiswa:</b></p>
                            </td>
                            <td width=274 colspan=3 style='width:205.75pt;border:solid black 1.0pt;
                                  border-left:none;padding:.75pt 4.9pt 0in 4.9pt;height:22.5pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>NIM :</b></p>
                            </td>
                        </tr>
                        <tr style='height:22.8pt'>
                            <td width=697 colspan=5 style='width:522.5pt;border:solid black 1.0pt;
                                  border-top:none;padding:.75pt 4.9pt 0in 4.9pt;height:22.8pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nama
                                        Penguji: </b></p>
                            </td>
                        </tr>
                        <tr style='height:14.55pt'>
                            <td width=48 style='width:.5in;border:solid black 1.0pt;border-top:none;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>No</span></b></p>
                            </td>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Analisa Kasus</span></b></p>
                            </td>
                            <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Skor (0-</span></b><b>10<span lang=IN>)</span></b>
                                </p>
                            </td>
                            <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Bobot</span></b></p>
                            </td>
                            <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Total </span></b></p>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b>(Skor x bobot)</b></p>
                            </td>
                        </tr>
                        <tr style='height:14.55pt'>
                            <td width=48 rowspan=3 style='width:.5in;border:solid black 1.0pt;border-top:
                                  none;padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                                <p class=MsoNormal align=center style='text-align:center'><span lang=IN>I</span></p>
                            </td>
                            <td width=374 valign=bottom style='width:280.75pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>Kemampuan
                                        analisa
                                        masalah</span></p>
                            </td>
                            <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt; text-align:center;'>
                            </td>
                            <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;background:gray;padding:
                                  .75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                            <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  background:gray;padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                        </tr>
                        <tr style='height:20.85pt'>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:20.85pt'>
                                <p class=MsoListParagraph style='margin-top:0in;margin-right:0in;margin-bottom:
                                  0in;margin-left:.2in;text-indent:-.2in;line-height:normal'><span lang=IN>1.<span
                                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
                                        lang=IN>Overview
                                        masalah </span></p>
                            </td>
                            <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:20.85pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><input type="number" name="overview_masalah" id="overview_masalah"
                                        max="10" min="0"
                                        style="border: none; font-size:18px; width:100%; text-align: center;"></p>
                            </td>
                            <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:20.85pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'>2</p>
                            </td>
                            <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:20.85pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                        </tr>
                        <tr style='height:15.75pt'>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:15.75pt'>
                                <p class=MsoListParagraph style='margin-top:0in;margin-right:0in;margin-bottom:
                                  0in;margin-left:.2in;text-indent:-.2in;line-height:normal'><span lang=IN>2.<span
                                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
                                        lang=IN>Analisis masalah </span></p>
                            </td>
                            <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:15.75pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><input type="number" name="analisis_masalah" id="analisis_masalah"
                                        max="10" min="0"
                                        style="border: none; font-size:18px; width:100%; text-align: center;"></p>
                            </td>
                            <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:15.75pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>4</span></p>
                            </td>
                            <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:15.75pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                        </tr>
                        <tr style='height:.6in'>
                            <td width=48 rowspan={{ count($socas) + 1 }} style='width:.5in;border:solid black 1.0pt;border-top:
                                  none;padding:.75pt 4.9pt 0in 4.9pt;height:.6in'>
                                <p class=MsoNormal align=center style='text-align:center'><span lang=IN>II</span></p>
                            </td>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:.6in'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>Kemampuan
                                        mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan
                                        terjadinya penyakit sesuai dengan skenario)</span></p>
                            </td>
                            <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:.6in'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN style='color:#595959'>&nbsp;</span></p>
                            </td>
                            <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;background:gray;padding:
                                  .75pt 4.9pt 0in 4.9pt;height:.6in'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                            <td width=126 valign=top style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  background:gray;padding:.75pt 4.9pt 0in 4.9pt;height:.6in'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                        </tr>

                        @foreach ($socas as $soca)
                            <tr style='height:13.7pt'>
                                <td width=374 v align=bottom style='width:280.75pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:13.7pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
                                            lang=IN>{{ $loop->iteration }}. </span>{{ $soca->keterangan_soca }}
                                    </p>
                                </td>
                                <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:13.7pt'>
                                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><input type="number" name="{{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) }}" id="{{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) }}"
                                        max="10" min="0"
                                        style="border: none; font-size:18px; width:100%; text-align: center;"></p>
                                </td>
                                <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:13.7pt'>
                                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>2</span></p>
                                </td>
                                <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:13.7pt'>
                                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                                </td>
                            </tr>
                        @endforeach
                        <tr style='height:37.5pt'>
                            <td width=570 colspan=4 style='width:427.8pt;border:solid black 1.0pt;
                                  border-top:none;padding:.75pt 4.9pt 0in 4.9pt;height:37.5pt'>
                                <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right'><b>Total
                                        Jumlah</b><span lang=IN> = </span></p>
                                <p class=MsoNormal style='margin-bottom:0in'>&nbsp;</p>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nilai
                                        akhir (Jumlah Total : 2) = ………………</b></p>
                            </td>
                            <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:37.5pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                            </td>
                        </tr>
                        <tr style='height:35.75pt'>
                            <td width=48 rowspan=4 style='width:.5in;border:solid black 1.0pt;border-top:
                                  none;padding:.75pt 4.9pt 0in 4.9pt;height:35.75pt'>
                                <p class=MsoNormal align=center style='text-align:center'><span lang=IN>III</span></p>
                            </td>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:35.75pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Keterampilan saat presentasi</span></p>
                            </td>
                            <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:35.75pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Memuaskan/</span></p>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Tidak memuaskan</span></p>
                            </td>
                            <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:35.75pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Komentar</span></p>
                            </td>
                        </tr>
                        <tr style='height:14.55pt'>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>1.
                                        Sikap</span></p>
                            </td>
                            <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;height:14.55pt'>
                                <input type="number" name="sikap_keterangan" id="sikap_keterangan"
                                max="10" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;">
                            </td>
                            <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:14.55pt'>
                                <input type="number" name="sikap_komentar" id="sikap_komentar"
                                max="10" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;">
                            </td>
                        </tr>
                        <tr style='height:14.55pt'>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>2. Kemampuan
                                        berkomunikasi</span></p>
                            </td>
                            <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;height:14.55pt'>
                                <input type="number" name="kemampuan_berkomunikasi_keterangan" id="kemampuan_berkomunikasi_keterangan"
                                max="10" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;">
                            </td>
                            <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:14.55pt'>
                                <input type="number" name="kemampuan_berkomunikasi_komentar" id="kemampuan_berkomunikasi_komentar"
                                max="10" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;">
                            </td>
                        </tr>
                        <tr style='height:14.55pt'>
                            <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>3. Sistematika
                                        penyajian</span></p>
                            </td>
                            <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;height:14.55pt'>
                                <input type="number" name="sistematika_penyajian_keterangan" id="sistematika_penyajian_keterangan"
                                max="10" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;">
                            </td>
                            <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:14.55pt'>
                                <input type="number" name="sistematika_penyajian_komentar" id="sistematika_penyajian_komentar"
                                max="10" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;">
                            </td>
                        </tr>
                        <tr style='height:71.45pt'>
                            <td width=697 colspan=5 valign=top style='width:522.5pt;border:solid black 1.0pt;
                                  border-top:none;padding:.75pt 4.9pt 0in 4.9pt;height:71.45pt'>
                                <p class=MsoNormal><span lang=ES>Hasil Penilaian Keterampilan presentasi &amp;
                                        sikap</span></p>
                            </td>
                        </tr>
                    </table>

                    <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                    <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                    <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                    <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                    <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal; text-align:right;'><span lang=IN>
                        </span>
                        <span lang=IN>Tanda Tangan Penguji,</span>
                    </p>

                    <p class=MsoNormal align=right style='text-align:right'>&nbsp;</p>

                    <p class=MsoNormal align=right style='text-align:right'>&nbsp;</p>

                    <p class=MsoNormal align=right style='text-align:right'>&nbsp;</p>

                    <p class=MsoNormal style="text-align:right;"><span lang=IN>
                        </span>
                        <span lang=IN>(.....................................)</span>
                    </p>

                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="Ujian">
            <p>Ujian tab content ...</p>
        </div>
    </div>

    {{-- <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nilai</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->matkul->namamatkul }}</td>
                        <td>{{ $jadwal->matkul->keterangan }}</td>
                        <td>{{ $jadwal->matkul->tahun_ajaran }}</td>
                        <td>
                            <a href="/dashboard/nilai/input" class="badge bg-info"><span
                                    data-feather="pen-tool"></span></a>
                            </form>
                            <a href="/dashboard/nilai/edit" class="badge bg-info"><span
                                    data-feather="edit"></span></a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    <script>
        feather.replace()
    </script>
@endsection
