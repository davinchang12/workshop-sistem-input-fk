@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai</h1>
    </div>
    <a href="/dashboard/matkul" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">{{ $matkul->namamatkul }} <br> Input / Edit </h3>
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
            <a href="#field-lab" class="nav-link" data-bs-toggle="tab">Field Lab</a>
        </li>
        <li class="nav-item">
            <a href="#ujian" class="nav-link" data-bs-toggle="tab">Ujian</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tugas">
            <form action="/dashboard/matkul/nilai/export/tugas" method="get">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
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
            <div class="container mt-3">
                <div class="row">
                    @if ($skenarios != null)
                        @foreach ($skenarios as $skenario)
                            @foreach ($skenario->skenariodiskusi as $diskusi)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title">
                                                        Kelompok {{ $skenario->kelompok }}
                                                    </h5>
                                                    <small><b>Skenario {{ $skenario->skenario }}</b></small><br>
                                                    <small><b>Diskusi {{ $diskusi->diskusi }}</b></small><br><br>
                                                    <small>{{ $skenario->pbl->nilai->matkul->keterangan }}</small><br>
                                                    <small>Tahun Ajaran
                                                        {{ $skenario->pbl->nilai->matkul->tahun_ajaran }}</small>
                                                </div>
                                                <div class="col-md-auto p-auto">
                                                    <div class="col pt-2">
                                                        @can('dosen')
                                                            <form action="/dashboard/matkul/nilai/input-pbl" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="matkul_dipilih" id=""
                                                                    value="{{ $matkul->id }}">
                                                                <input type="hidden" name="kodematkul" id=""
                                                                    value="{{ $matkul->kodematkul }}">
                                                                <input type="hidden" name="kelompok" id=""
                                                                    value="{{ $skenario->kelompok }}">
                                                                <input type="hidden" name="skenario" id=""
                                                                    value="{{ $skenario->skenario }}">
                                                                <input type="hidden" name="diskusi" id=""
                                                                    value="{{ $diskusi->diskusi }}">
                                                                <input type="hidden" name="diskusi_id" id=""
                                                                    value="{{ $diskusi->id }}">
                                                                <button class="btn btn-primary w-100 shadow-none"><span
                                                                        data-feather="settings"></span></button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="praktikum">
            <form action="/dashboard/matkul/nilai/export/praktikum" method="post">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                <button class="btn btn-primary w-100 shadow-none">Download Template</button>
            </form>
            <form method="post" action="/dashboard/matkul/nilai/import/praktikum" enctype="multipart/form-data">
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
                        <input type="hidden" name="kodematkul" id="" value="{{ $matkul->kodematkul }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            @if (count($praktikums) > 0)
                <div class="mt-3 mb-3">
                    <table cellspacing="0" border="0">
                        <colgroup width="200"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="87"></colgroup>
                        <colgroup width="200"></colgroup>
                        <tr>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign=bottom bgcolor="#92D050">
                                <font color="#000000"><br></font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign=bottom bgcolor="#92D050">
                                <font color="#000000"><br></font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                colspan=8 height="19" align="center" valign=bottom bgcolor="#92D050">
                                <font color="#000000">NILAI</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign=bottom bgcolor="#92D050">
                                <font color="#000000"><br></font>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 height="110" align="center" valign=middle bgcolor="#F4B183">
                                <font color="#000000">NAMA</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 height="110" align="center" valign=middle bgcolor="#F4B183">
                                <font color="#000000">NIM</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 height="110" align="center" valign=middle bgcolor="#F4B183">
                                <font color="#000000">RATA-RATA QUIZ (20%)</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#8FAADC">
                                <font color="#000000">RATA-RATA NILAI LAPORAN (10%)</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#FFD966">
                                <font color="#000000">NILAI RESPONSI (70%)</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#A9D18E">
                                <font color="#000000">NILAI AKHIR</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#96D0E2">
                                <font color="#000000">KETERANGAN</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#BF9000">
                                <font color="#000000">Remedi</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                                <font color="#000000">Remedi Konversi</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                                <font color="#000000">Nilai Setelah Remedi</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                                <font color="#000000">Keterangan</font>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        @foreach ($praktikums as $praktikum)
                            <tr>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->name }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->nim }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->rata_rata_quiz }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->rata_rata_laporan }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->nilai_responsi }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->nilai_akhir }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=bottom>
                                    <font color="#000000">{{ $praktikum->keterangan_nilai_akhir }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->remedi }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->remedi_konversi }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=middle>
                                    <font color="#000000">{{ $praktikum->nilai_setelah_remedi }}</font>
                                </td>
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                                    align="center" valign=bottom>
                                    <font color="#000000">{{ $praktikum->keterangan_nilai_setelah_remedi }}</font>
                                </td>
                            </tr>
                            <input type="hidden" name="loop" id="loop" value="{{ $loop->iteration }}">
                            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $praktikum->kodematkul }}">
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="SOCA">
            <div class="container mt-3 mb-3">
                <form action="/dashboard/matkul/nilai/input-soca" method="post">
                    @csrf
                    <p>Pilih Mahasiswa : </p>
                    <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                        <option selected>{{ $socas[0]->name }}</option>
                        @foreach ($socas->skip(1) as $soca)
                            <option>{{ $soca->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="kodematkul" id="" value="{{ $matkul->kodematkul }}">
                    <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul->id }}">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="field-lab">
            <form action="/dashboard/matkul/nilai/export/field-lab" method="get">
                @csrf
                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                <button class="btn btn-primary w-100 shadow-none">Download Template</button>
            </form>
            <form method="post" action="/dashboard/matkul/nilai/import/field-lab" enctype="multipart/form-data">
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
            @if (count($fieldlabs) > 0)
                <div class="mt-3 mb-3">
                    <table class="table-bordered">
                        <colgroup width="50"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="200"></colgroup>
                        <colgroup width="200"></colgroup>
                        <tr>
                            <td height="40" align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">No</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Nama</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Nim</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Total Nilai Dosbing</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Total Nilai Penguji</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Total Nilai Dosen Luar</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Nilai Akhir</font></td>
                            <td align="center" valign=middle bgcolor="#FFE48F" style="width: 20%"><font color="#000000">Keterangan</font></td>
                        </tr>
                        @foreach ($fieldlabs as $fieldlab)
                            <tr>
                                <td height="19" align="center" valign=middle>{{ $loop->iteration }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->name }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->nim }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->total_nilai_dosbing }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->total_nilai_penguji }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->total_nilai_penguji_2 }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->nilai_akhir }}</td>
                                <td align="center" valign=middle>{{ $fieldlab->keterangan }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="Ujian">
            <p>Ujian tab content ...</p>
        </div>
    </div>
    <script type="text/javascript">
        feather.replace();
    </script>
@endsection
