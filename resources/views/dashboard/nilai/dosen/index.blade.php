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

    @if (session()->has('fail'))
        <div class="alert alert-danger" role="alert">
            {{ session('fail') }}
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
            <div class="container mt-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                aria-bs-expanded="false" aria-bs-controls="collapseExample">
                                Edit Nilai
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <form class="form-inline" action="/dashboard/matkul/nilai/edit/tugas" method="post">
                                @csrf
                                <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                                <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
                                <input type="hidden" name="namamatkul" id="namamatkul" value="{{ $matkul->namamatkul }}">
                                <label for="password" class="form-label">Password : </label>
                                <input type="password" name="password" id="password">
                                <button class="btn btn-primary shadow-none">Submit</button>
                            </form>
                        </div>
                    </div>
                    <form action="/dashboard/matkul/nilai/export/tugas" method="get">
                        @csrf
                        <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                        <button class="btn btn-primary w-100 shadow-none" onClick="refreshPage()">Download Template</button>
                    </form>
                </div>

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
                            <div class="modal-footer">
                                @if ($nilaitugas->isnotEmpty())
                                    <button type="submit" class="btn btn-primary">Import</button>
                                @else
                                    <h5 class="modal-title" id="exampleModalLabel">Download Template dahulu kemudian
                                        refresh atau tekan tombol F5.</h5>
                                @endif
                            </div>
                        </div>
                </form>

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pbl">
        <div class="container mt-3">
            <div class="row">
                @if ($skenarios != null)
                    @foreach ($skenarios as $skenario)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">
                                                Kelompok {{ $skenario->kelompok }}
                                            </h5>
                                            <small><b>Skenario {{ $skenario->skenario }}</b></small><br>
                                            <small><b>Diskusi {{ $skenario->diskusi }}</b></small><br><br>
                                            <small><b>Tanggal {{ $skenario->tanggal_pelaksanaan }}</b></small><br>
                                            <small>{{ $skenario->keterangan }}</small><br>
                                            <small>Tahun Ajaran
                                                {{ $skenario->tahun_ajaran }}</small>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <div>
                                                <p>
                                                    <a class="btn btn-primary" data-bs-toggle="collapse"
                                                        href="#collapseExample{{ $loop->iteration }}" role="button"
                                                        aria-bs-expanded="false"
                                                        aria-bs-controls="collapseExample{{ $loop->iteration }}">
                                                        Edit Nilai
                                                    </a>
                                                </p>
                                                <div class="collapse" id="collapseExample{{ $loop->iteration }}">
                                                    <form class="form-inline" action="/dashboard/matkul/nilai/edit/pbl"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="matkul_dipilih" id=""
                                                            value="{{ $matkul->id }}">
                                                        <input type="hidden" name="kodematkul" id=""
                                                            value="{{ $matkul->kodematkul }}">
                                                        <input type="hidden" name="blok" id="blok"
                                                            value="{{ $matkul->blok }}">
                                                        <input type="hidden" name="kelompok" id=""
                                                            value="{{ $skenario->kelompok }}">
                                                        <input type="hidden" name="skenario" id=""
                                                            value="{{ $skenario->skenario }}">
                                                        <input type="hidden" name="diskusi" id=""
                                                            value="{{ $skenario->diskusi }}">
                                                        <input type="hidden" name="diskusi_id" id=""
                                                            value="{{ $skenario->diskusi_id }}">
                                                        <input type="hidden" name="tanggal_pelaksanaan"
                                                            value="{{ $skenario->tanggal_pelaksanaan }}">
                                                        <label for="password" class="form-label">Password :
                                                        </label>
                                                        <input type="password" name="password" id="password">
                                                        <button class="btn btn-primary shadow-none">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @can('dosen')
                                                <form action="/dashboard/matkul/nilai/input-pbl" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="matkul_dipilih" id=""
                                                        value="{{ $matkul->id }}">
                                                    <input type="hidden" name="kodematkul" id=""
                                                        value="{{ $matkul->kodematkul }}">
                                                    <input type="hidden" name="blok" id="blok"
                                                        value="{{ $matkul->blok }}">
                                                    <input type="hidden" name="kelompok" id=""
                                                        value="{{ $skenario->kelompok }}">
                                                    <input type="hidden" name="skenario" id=""
                                                        value="{{ $skenario->skenario }}">
                                                    <input type="hidden" name="diskusi" id=""
                                                        value="{{ $skenario->diskusi }}">
                                                    <input type="hidden" name="diskusi_id" id=""
                                                        value="{{ $skenario->diskusi_id }}">
                                                    <input type="hidden" name="tanggal_pelaksanaan"
                                                        value="{{ $skenario->tanggal_pelaksanaan }}">
                                                    <button class="btn btn-primary w-100 shadow-none"><span
                                                            data-feather="settings"></span></button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- @foreach ($skenarios as $skenario)
                        @foreach ($skenario->skenariodiskusi as $diskusi)
                            <div class="col-md-6 mb-3">
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
                                            <div class="d-flex justify-content-between mt-3">
                                                <div>
                                                    <p>
                                                        <a class="btn btn-primary" data-bs-toggle="collapse"
                                                            href="#collapseExample{{ $loop->iteration }}" role="button"
                                                            aria-bs-expanded="false"
                                                            aria-bs-controls="collapseExample{{ $loop->iteration }}">
                                                            Edit Nilai
                                                        </a>
                                                    </p>
                                                    <div class="collapse"
                                                        id="collapseExample{{ $loop->iteration }}">
                                                        <form class="form-inline"
                                                            action="/dashboard/matkul/nilai/edit/pbl" method="post">
                                                            @csrf
                                                            <input type="hidden" name="matkul_dipilih" id=""
                                                                value="{{ $matkul->id }}">
                                                            <input type="hidden" name="kodematkul" id=""
                                                                value="{{ $matkul->kodematkul }}">
                                                            <input type="hidden" name="blok" id="blok"
                                                                value="{{ $matkul->blok }}">
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
                                                            <label for="password" class="form-label">Password :
                                                            </label>
                                                            <input type="password" name="password" id="password">
                                                            <button class="btn btn-primary shadow-none">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @can('dosen')
                                                    <form action="/dashboard/matkul/nilai/input-pbl" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="matkul_dipilih" id=""
                                                            value="{{ $matkul->id }}">
                                                        <input type="hidden" name="kodematkul" id=""
                                                            value="{{ $matkul->kodematkul }}">
                                                        <input type="hidden" name="blok" id="blok"
                                                            value="{{ $matkul->blok }}">
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
                        @endforeach
                    @endforeach --}}
                @endif
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="praktikum">
        <div class="container mt-3">
            <div class="row">
                @if ($praktikums != null)
                    @foreach ($praktikums as $praktikum)
                        <div class="col-md-6 mb-3">
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
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p>
                                                                <a class="btn btn-primary" data-bs-toggle="collapse"
                                                                    href="#collapseExample{{ $loop->iteration }}"
                                                                    role="button" aria-bs-expanded="false"
                                                                    aria-bs-controls="collapseExample{{ $loop->iteration }}">
                                                                    Edit Nilai
                                                                </a>
                                                            </p>
                                                            <div class="collapse"
                                                                id="collapseExample{{ $loop->iteration }}">
                                                                <form class="form-inline"
                                                                    action="/dashboard/matkul/nilai/edit/praktikum"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="matkul_dipilih"
                                                                        id="" value="{{ $matkul->id }}">
                                                                    <input type="hidden" name="kodematkul" id=""
                                                                        value="{{ $matkul->kodematkul }}">
                                                                    <input type="hidden" name="jenis_praktikum"
                                                                        id=""
                                                                        value="{{ $praktikum->namapraktikum }}">
                                                                    <label for="password" class="form-label">Password :
                                                                    </label>
                                                                    <input type="password" name="password" id="password">
                                                                    <button class="btn btn-primary shadow-none">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <form action="/dashboard/matkul/nilai/export/praktikum" method="post"
                                                            id="praktikumForm{{ $loop->iteration }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="kodematkul" id=""
                                                                value="{{ $matkul->kodematkul }}">
                                                            <input type="hidden" name="jenis_praktikum" id=""
                                                                value="{{ $praktikum->namapraktikum }}">

                                                            <button class="btn btn-primary w-100 shadow-none">Download</button>
                                                        </form>
                                                    </div>

                                                    <div class="row g-3 align-items-center mb-3">
                                                        <div class="col-auto">
                                                            <label for="inputKeteranganSebelum" class="col-form-label">Ket.
                                                                Sebelum Remedi</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <select name="inputKeteranganSebelum" id="inputKeteranganSebelum"
                                                                class="form-control" form="praktikumForm{{ $loop->iteration }}" required>
                                                                <option disabled selected value></option>
                                                                <option value="quiz">Quiz</option>
                                                                <option value="laporan">Laporan</option>
                                                                <option value="responsi">Responsi</option>
                                                                <option value="nilaiakhir">Nilai Akhir</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label for="inputKeteranganSesudah" class="col-form-label">Ket.
                                                                Sesudah Remedi</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <select name="inputKeteranganSesudah" id="inputKeteranganSesudah"
                                                                class="form-control" form="praktikumForm{{ $loop->iteration }}" required>
                                                                <option disabled selected value></option>
                                                                <option value="quiz">Quiz</option>
                                                                <option value="laporan">Laporan</option>
                                                                <option value="responsi">Responsi</option>
                                                                <option value="nilaiakhir">Nilai AKhir</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <form method="post" action="/dashboard/matkul/nilai/import/praktikum"
                                                        enctype="multipart/form-data">

                                                        <input type="hidden" name="dosen_id" id="dosen_id"
                                                            value="{{ auth()->user()->id }}">
                                                        <input type="hidden" name="matkul_dipilih" id=""
                                                            value="{{ $matkul->id }}">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Import
                                                                    Template</h5>
                                                            </div>
                                                            <div class="modal-body">

                                                                {{ csrf_field() }}

                                                                <div class="form-text">Persentase Nilai Akhir</div>
                                                                <div class="form-group">
                                                                    <label for="quiz"
                                                                        class="form-label @error('quiz') is-invalid @enderror">Quiz</label>
                                                                    <input type="text" class="form-control" id="quiz"
                                                                        name="quiz" placeholder="Cth : 10">
                                                                    @error('quiz')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="laporan"
                                                                        class="form-label @error('laporan') is-invalid @enderror">Laporan</label>
                                                                    <input type="text" class="form-control" id="laporan"
                                                                        name="laporan" placeholder="Cth : 20">
                                                                    @error('laporan')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="responsi" class="form-label @error('responsi') is-invalid @enderror">Responsi</label>
                                                                    <input type="text" class="form-control" id="responsi"
                                                                        name="responsi" placeholder="Cth : 70">
																		@error('laporan')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <br>

                                                                <label>Pilih file excel</label>
                                                                <div class="form-group">
                                                                    <input type="file" name="file" required="required">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="kodematkul" id=""
                                                                    value="{{ $matkul->kodematkul }}">
                                                                <input type="hidden" name="jenis_praktikum" id=""
                                                                    value="{{ $praktikum->namapraktikum }}">
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
        <div class="container mt-3">
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
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-bs-expanded="false" aria-bs-controls="collapseExample">
                                    Edit Nilai
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <form class="form-inline" action="/dashboard/matkul/nilai/edit/feedbackutb"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="matkul_dipilih" id=""
                                        value="{{ $matkul->id }}">
                                    <input type="hidden" name="kodematkul" id=""
                                        value="{{ $matkul->kodematkul }}">
                                    <label for="password" class="form-label">Password :
                                    </label>
                                    <input type="password" name="password" id="password">
                                    <button class="btn btn-primary shadow-none">Submit</button>
                                </form>
                            </div>
                        </div>
                        <form action="/dashboard/matkul/nilai/export/feedbackutb" method="get">
                            @csrf
                            <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                            <button class="btn btn-primary w-100 shadow-none">Download Template</button>
                        </form>
                    </div>
                    <form method="post" action="/dashboard/matkul/nilai/import/feedbackutb"
                        enctype="multipart/form-data">
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
                                @if ($feedbackutbs->isnotEmpty())
                                    <button type="submit" class="btn btn-primary">Import</button>
                                @else
                                    <h5 class="modal-title" id="exampleModalLabel">Download Template dahulu kemudian
                                        refresh atau tekan tombol F5.</h5>
                                @endif
                            </div>
                        </div>
                    </form>

                </div>
                <div class="tab-pane fade" id="feedbackuab">
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-bs-expanded="false" aria-bs-controls="collapseExample">
                                    Edit Nilai
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <form class="form-inline" action="/dashboard/matkul/nilai/edit/feedbackuab"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="matkul_dipilih" id=""
                                        value="{{ $matkul->id }}">
                                    <input type="hidden" name="kodematkul" id=""
                                        value="{{ $matkul->kodematkul }}">
                                    <label for="password" class="form-label">Password :
                                    </label>
                                    <input type="password" name="password" id="password">
                                    <button class="btn btn-primary shadow-none">Submit</button>
                                </form>
                            </div>
                        </div>
                        <form action="/dashboard/matkul/nilai/export/feedbackuab" method="get">
                            @csrf
                            <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                            <button class="btn btn-primary w-100 shadow-none">Download Template</button>
                        </form>
                    </div>
                    <form method="post" action="/dashboard/matkul/nilai/import/feedbackuab"
                        enctype="multipart/form-data">
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
                                @if ($feedbackuabs->isnotEmpty())
                                    <button type="submit" class="btn btn-primary">Import</button>
                                @else
                                    <h5 class="modal-title" id="exampleModalLabel">Download Template dahulu kemudian
                                        refresh atau tekan tombol F5.</h5>
                                @endif
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
                                    <input type="hidden" name="matkul_dipilih" id=""
                                        value="{{ $matkul->id }}">
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
                                        <label for="praktikum">Praktikum</label>
                                        <input type="float" class="form-control" id="persenpraktikum"
                                            name="persenpraktikum" placeholder="Cukup isi angkanya saja (tanpa %)"
                                            max="100" min="0">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="praktikum">Nilai Final CBT untuk Sintak UAB</label>
                                    <input type="float" class="form-control" id="persenfinalcbt" name="persenfinalcbt"
                                        placeholder="Cukup isi angkanya saja (tanpa %)" max="100" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="praktikum">Nilai Final CBT untuk UAB Combined setelah Remedi</label>
                                    <input type="float" class="form-control" id="persenfinalcbtremidi"
                                        name="persenfinalcbtremidi" placeholder="Cukup isi angkanya saja (tanpa %)"
                                        max="100" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="praktikum">Rata-Rata Minimal</label>
                                    <input type="float" class="form-control" id="ratamin" name="ratamin"
                                        placeholder="Contoh : 75" max="100" min="0">
                                </div>

                            </div>
                            <div class="modal-footer">
                                @if ($ujians->isnotEmpty())
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                @else
                                    <h5 class="modal-title" id="exampleModalLabel">Feedback UTB dan UAB masih kosong,
                                        silahkan diisi terlebih dahulu.</h5>
                                @endif
                            </div>
                        </div>
                    </form>
                    <form action="/dashboard/matkul/nilai/export/nilaiujian" method="get">
                        @csrf
                        <input type="hidden" name="matkul_dipilih" id="" value="{{ $matkul->id }}">
                        <button class="btn btn-primary w-100 shadow-none">Download Template Remidi</button>
                    </form>
                    <form method="post" action="/dashboard/matkul/nilai/import/nilaiujian"
                        enctype="multipart/form-data">
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
                                @if ($ujians->isnotEmpty())
                                    <button type="submit" class="btn btn-primary">Import</button>
                                @else
                                    <h5 class="modal-title" id="exampleModalLabel">Download Template dahulu kemudian
                                        refresh atau tekan tombol F5.</h5>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        feather.replace();
    </script>
    <script>
        function refreshPage() {
            window.parent.location = window.parent.location.href;
        }
    </script>
@endsection
