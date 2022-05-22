@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai {{ $matkul->namamatkul }}</h1>
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
                            <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
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
                    {{-- <table class="talbe table-bordered">
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
                    </table> --}}
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
                                                    <small><b>Tanggal {{ $diskusi->tanggal_pelaksanaan }}</b></small><br>
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
                                                                <input type="hidden" name="tanggal_pelaksanaan"
                                                                    value="{{ $diskusi->tanggal_pelaksanaan }}">
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
            <div class="container mt-3">
                <div class="row">
                    @if ($praktikums != null)
                        @foreach ($praktikums as $praktikum)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title">
                                                    Praktikum {{ $praktikum->namapraktikum }}
                                                </h5>
                                            </div>
                                            <div class="">
                                                <div class="col pt-2">
                                                    @can('dosen')
                                                        <form action="/dashboard/matkul/nilai/export/praktikum" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="kodematkul" id=""
                                                                value="{{ $matkul->kodematkul }}">
                                                            <input type="hidden" name="jenis_praktikum" id=""
                                                                value="{{ $praktikum->namapraktikum }}">
                                                            <button class="btn btn-primary w-100 shadow-none"><span
                                                                    data-feather="download"></span> Download</button>
                                                        </form>
                                                        <form method="post" action="/dashboard/matkul/nilai/import/praktikum"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Import
                                                                        Template</h5>
                                                                </div>
                                                                <div class="modal-body">

                                                                    {{ csrf_field() }}

                                                                    <label>Pilih file excel</label>
                                                                    <div class="form-group">
                                                                        <input type="file" name="file" required="required">
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="kodematkul" id=""
                                                                        value="{{ $matkul->kodematkul }}">
                                                                    <button type="submit" class="btn btn-primary w-100"><span
                                                                            data-feather="upload"></span> Import</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Ujian">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#feedbackutb" class="nav-link active" data-bs-toggle="tab">Feedback UTB</a>
                </li>
                <li class="nav-item">
                    <a href="#feedbackuab" class="nav-link" data-bs-toggle="tab">Feedback UAB</a>
                </li>
                <li class="nav-item">
                    <a href="#nilaiujian" class="nav-link" data-bs-toggle="tab">Daftar Nilai Ujian</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="feedbackutb">
                    <form action="/dashboard/matkul/nilai/export/feedbackutb" method="get">
                        @csrf
                        <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                        <button class="btn btn-primary w-100 shadow-none">Download Template</button>
                    </form>
                    <form method="post" action="/dashboard/matkul/nilai/import/feedbackutb" enctype="multipart/form-data">
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

                </div>
                <div class="tab-pane fade" id="feedbackuab">
                    <form action="/dashboard/matkul/nilai/export/feedbackuab" method="get">
                        @csrf
                        <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                        <button class="btn btn-primary w-100 shadow-none">Download Template</button>
                    </form>
                    <form method="post" action="/dashboard/matkul/nilai/import/feedbackuab" enctype="multipart/form-data">
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
                </div>

                <div class="tab-pane fade" id="nilaiujian">


                    <form method="post" action="/dashboard/matkul/nilai/import/nilaiujian-persen"
                        enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Persentase Nilai
                                    {{ $matkul->namamatkul }}</h5>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                                    <label for="utb">UTB</label>
                                    <input type="float" class="form-control" id="persenutb" name="persenutb"
                                        placeholder="Cukup isi angkanya saja (tanpa %)" max="100" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="uab">UAB</label>
                                    <input type="float" class="form-control" id="persenuab" name="persenuab"
                                        placeholder="Cukup isi angkanya saja (tanpa %)" max="100" min="0">
                                </div>
                                @if ($checkpraktikumujians->isnotEmpty())
                                    <div class="form-group">
                                        <label for="praktikum">Nilai Praktikum</label>
                                        <input type="float" class="form-control" id="persenpraktikum"
                                            name="persenpraktikum" placeholder="Cukup isi angkanya saja (tanpa %)" max="100"
                                            min="0">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="praktikum">Nilai Final CBT</label>
                                    <input type="float" class="form-control" id="persenfinalcbt" name="persenfinalcbt"
                                        placeholder="Cukup isi angkanya saja (tanpa %)" max="100" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="praktikum">Rata-Rata Minimal</label>
                                    <input type="float" class="form-control" id="ratamin" name="ratamin"
                                        placeholder="Contoh : 75" max="100" min="0">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">submit</button>
                            </div>
                        </div>
                    </form>
                    <form action="/dashboard/matkul/nilai/export/nilaiujian" method="get">
                        @csrf
                        <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                        <button class="btn btn-primary w-100 shadow-none">Download Template Remidi</button>
                    </form>
                    <form method="post" action="/dashboard/matkul/nilai/import/nilaiujian" enctype="multipart/form-data">
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
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        feather.replace();
    </script>
@endsection
