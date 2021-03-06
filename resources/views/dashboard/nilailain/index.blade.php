@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai Lain</h1>
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
            <a href="#osce" class="nav-link active" data-bs-toggle="tab">OSCE</a>
        </li>
        <li class="nav-item">
            <a href="#soca" class="nav-link" data-bs-toggle="tab">SOCA</a>
        </li>
        <li class="nav-item">
            <a href="#fieldlab" class="nav-link" data-bs-toggle="tab">Field Lab</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="osce">
            @can('mahasiswa')
                @if (count($mhs_osces) > 0)
                    <table class="table" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">Nama OSCE</th>
                                <th scope="col">Nama Penguji</th>
                                <th scope="col">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($mhs_osces as $mhs_osce)
                                <tr>
                                    <td>{{ $mhs_osce->namaosce }}</td>
                                    <td>{{ $mhs_osce->nama_penguji }}</td>
                                    <td>{{ $mhs_osce->nilaiosce == null ? 'BELUM DINILAI' : $mhs_osce->nilaiosce }}</td>
                                    {{-- <td>
                                        <form action="/dashboard/nilailain/show/osce" method="post">
                                            @csrf
                                            <input type="hidden" name="osce_id" id="osce_id" value="{{ $mhs_osce->id }}">
                                            <input type="hidden" name="nama_penguji" id="nama_penguji"
                                                value="{{ $mhs_osce->nama_penguji }}">

                                            <button class="badge bg-info border-0"><span data-feather="eye"></span></button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endcan
            @can('dosen')
                @if (count($osces) > 0)
                    @foreach ($namaosces as $namaosce)
                        <div class="container mt-3 mb-3 border p-3">
                            <form action="/dashboard/nilailain/input-osce" method="post">
                                @csrf
                                <p>OSCE : {{ $namaosce->namaosce }}</p>
                                <p>Pilih Mahasiswa : </p>
                                <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                                    @foreach ($osces as $osce)
                                        @if ($osce->namaosce == $namaosce->namaosce)
                                            <option>{{ $osce->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-3">Pilih</button>
                            </form>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-bs-expanded="false" aria-bs-controls="collapseExample">
                                    Edit Nilai
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <form class="form-inline" action="/dashboard/nilailain/edit/osce" method="post">
                                    @csrf
                                    <label for="password" class="form-label">Password : </label>
                                    <input type="password" name="password" id="password">
                                    <button class="btn btn-primary shadow-none">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
        </div>
        <div class="tab-pane fade" id="soca">
            @can('mahasiswa')
                @if (count($mhs_socas) > 0)
                    <table class="table" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">Nama SOCA</th>
                                <th scope="col">Nama Penguji</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($mhs_socas as $mhs_soca)
                                <tr>
                                    <td>{{ $mhs_soca->namasoca }}</td>
                                    <td>{{ $mhs_soca->nama_penguji }}</td>
                                    <td>{{ $mhs_soca->keterangan }}</td>
                                    <td>{{ $mhs_soca->nilaisocas == null ? 'BELUM DINILAI' : $mhs_soca->nilaisocas }}</td>
                                    {{-- <td>
                                        <form action="/dashboard/nilailain/show/soca" method="post">
                                            @csrf
                                            <input type="hidden" name="soca_id" id="soca_id" value="{{ $mhs_soca->id }}">
                                            <input type="hidden" name="nama_penguji" id="nama_penguji"
                                                value="{{ $mhs_soca->nama_penguji }}">

                                            <button class="badge bg-info border-0"><span data-feather="eye"></span></button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endcan
            @can('dosen')
                @if (count($socas) > 0)
                    @foreach ($namasocas as $namasoca)
                        <div class="container mt-3 mb-3 border p-3">
                            <form action="/dashboard/nilailain/input-soca" method="post">
                                @csrf
                                <p>SOCA : {{ $namasoca->namasoca }} - {{ $namasoca->keterangan }}</p>
                                <p>Pilih Mahasiswa : </p>
                                <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                                    @foreach ($socas as $soca)
                                        @if ($soca->namasoca == $namasoca->namasoca && $soca->keterangan == $namasoca->keterangan)
                                            <option>{{ $soca->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-3">Pilih</button>
                            </form>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-bs-expanded="false" aria-bs-controls="collapseExample">
                                    Edit Nilai
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <form class="form-inline" action="/dashboard/nilailain/edit/soca" method="post">
                                    @csrf
                                    <label for="password" class="form-label">Password : </label>
                                    <input type="password" name="password" id="password">
                                    <button class="btn btn-primary shadow-none">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
        </div>
        <div class="tab-pane fade" id="fieldlab">
            @can('mahasiswa')
                <div class="container mt-3">
                    <div class="row">
                        @if ($fieldlabs != null)
                            @foreach ($fieldlabs as $fieldlab)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5 class="card-title mb-0">
                                                        {{ $fieldlab->semester }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <form action="/dashboard/nilailain/show/fieldlab" method="post"
                                                        class="mb-0">
                                                        @csrf
                                                        <input type="hidden" name="semester" id="semester"
                                                            value="{{ $fieldlab->semester }}">

                                                        <input type="hidden" name="kelompok" id="kelompok"
                                                            value="{{ $fieldlab->kelompok }}">

                                                        <button class="badge bg-info border-0"><span
                                                                data-feather="eye"></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endcan
            @can('dosen')
                <div class="container mt-3">
                    <div class="row">
                        @if ($fieldlabs != null)
                            @foreach ($fieldlabs as $fieldlab)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title">
                                                        {{ $fieldlab->semester }}
                                                    </h5>
                                                    <small>Kelompok {{ $fieldlab->kelompok }}</small>
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
                                                                            action="/dashboard/nilailain/edit/fieldlab"
                                                                            method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="semester" id="semester"
                                                                                value="{{ $fieldlab->semester }}">
                                                                            <input type="hidden" name="kelompok" id="kelompok"
                                                                                value="{{ $fieldlab->kelompok }}">
                                                                            <label for="password" class="form-label">Password :
                                                                            </label>
                                                                            <input type="password" name="password" id="password">
                                                                            <button
                                                                                class="btn btn-primary shadow-none">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <form action="/dashboard/nilailain/export/field-lab" method="get">
                                                                    <input type="hidden" name="semester" id="semester"
                                                                        value="{{ $fieldlab->semester }}">
                                                                    <input type="hidden" name="kelompok" id="kelompok"
                                                                        value="{{ $fieldlab->kelompok }}">
                                                                    @csrf
                                                                    <button
                                                                        class="btn btn-primary w-100 shadow-none">Download</button>
                                                                </form>
                                                            </div>
                                                            <form method="post" action="/dashboard/nilailain/import/field-lab"
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
                                                                        <button type="submit"
                                                                            class="btn btn-primary w-100">Import</button>
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
            @endcan
        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
