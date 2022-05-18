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
            @if (count($osces) > 0)
                <div class="container mt-3 mb-3">
                    <form action="/dashboard/nilailain/input-osce" method="post">
                        @csrf
                        <p>Pilih Mahasiswa : </p>
                        <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                            <option selected>{{ $osces[0]->name }}</option>
                            @foreach ($osces->skip(1) as $osce)
                                <option>{{ $osce->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="soca">
            @if (count($socas) > 0)
                <div class="container mt-3 mb-3">
                    <form action="/dashboard/nilailain/input-soca" method="post">
                        @csrf
                        <p>Pilih Mahasiswa : </p>
                        <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                            <option selected>{{ $socas[0]->name }}</option>
                            @foreach ($socas->skip(1) as $soca)
                                <option>{{ $soca->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-3">Pilih</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="fieldlab">
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
                                            </div>
                                            <div class="">
                                                <div class="col pt-2">
                                                    @can('dosen')
                                                        <form action="/dashboard/nilailain/export/field-lab" method="get">
                                                            <input type="hidden" name="semester" id="semester" value="{{ $fieldlab->semester }}">
                                                            <input type="hidden" name="kelompok" id="kelompok" value="{{ $fieldlab->kelompok }}">
                                                            @csrf
                                                            <button class="btn btn-primary w-100 shadow-none"><span
                                                                    data-feather="download"></span> Download</button>
                                                        </form>
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
    </div>
    <script>
        feather.replace()
    </script>
@endsection