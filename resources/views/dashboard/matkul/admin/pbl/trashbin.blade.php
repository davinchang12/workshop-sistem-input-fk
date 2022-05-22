@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trashbin Kelompok PBL</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl" class="btn btn-primary mb-3"><span
                data-feather="arrow-left"></span> Kembali</a>
        <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/emptytrash"
                    method="post" class="d-inline">
                    @csrf
                    <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                    <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">

                    <button class="btn btn-primary bg-danger mb-3"
                        onclick="return confirm('Are you sure? All data will not be able restored!')">Hapus semua kelompok di trashbin</span></button>
        </form>
        {{-- <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/empty-trash"
            class="btn btn-primary bg-danger mb-3"onclick="return confirm('Are you sure? All data will not be able restored!')">Hapus semua kelompok di trashbin</a> --}}
    </div>

    <div class="row d-flex justify-content-between mt-3">
        <div class="col">
            <p>Kode Mata Kuliah : <b>{{ $matkul->kodematkul }}</b></p>
            <p>Nama Mata Kuliah : <b>{{ $matkul->namamatkul }}</b></p>
            @if ($matkul->blok != null)
                <p>Blok : <b>{{ $matkul->blok }}</b></p>
            @endif
        </div>
        <div class="col">
            <p><b>{{ $matkul->keterangan }}</b></p>
            <p>Tahun Ajaran : <b>{{ $matkul->tahun_ajaran }}</b></p>
            <p>Bobot SKS : <b>{{ $matkul->bobot_sks }}</b></p>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            @if ($kelompoks != null)
                @foreach ($kelompoks as $kelompok)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">
                                            Kelompok {{ $kelompok }}
                                        </h5>
                                        <small>Anggota :</small><br>
                                        @foreach ($skenarios as $skenario)
                                            @if ($skenario->kelompok == $kelompok)
                                                <small><b>{{ $skenario->name }}</b></small><br>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-auto p-auto">
                                        <div class="col">
                                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/restore"
                                                method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                                                <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
                                                <input type="hidden" name="kelompok" id="kelompok" value="{{ $kelompok }}">
                                                <button class="btn btn-warning w-100 shadow-none"
                                                    onclick="return confirm('Restore Data?')"><span data-feather="refresh-ccw"
                                                        style="height:24px;"></span></button>
                                            </form>
                                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/force-delete"
                                                method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                                                <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
                                                <input type="hidden" name="kelompok" id="kelompok" value="{{ $kelompok }}">
                                                <button class="btn btn-danger w-100 shadow-none"
                                                    onclick="return confirm('Are you sure? The data will not be able restored!')"><span data-feather="x-circle"
                                                        style="height:24px;"></span></button>
                                            </form>
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

    <script>
        feather.replace();
    </script>
@endsection
