@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelompok PBL</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}" class="btn btn-success"><span
                data-feather="arrow-left"></span> Kembali</a>
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl" class="btn btn-success">Edit
            Dosen</a>
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/create"
            class="btn btn-success">Tambah Kelompok <span data-feather="arrow-right"></span></a>
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
                                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl"
                                                method="post" class="d-inline">
                                                @method('delete')
                                                @csrf

                                                <button class="btn btn-danger w-100 shadow-none"
                                                    onclick="return confirm('Are you sure?')"><span data-feather="x-circle"
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
