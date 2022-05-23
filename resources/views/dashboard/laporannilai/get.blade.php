@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Nilai {{ $matkul->namamatkul }}</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/dashboard/laporannilai" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

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

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Jenis Nilai</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($tugas != null)
                    <tr>
                        <td>Tugas</td>
                        <td>
                            <form action="/dashboard/laporannilai/get/tugas" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul->id }}">

                                <button class="badge bg-info border-0"><span data-feather="download"></span></button>
                            </form>
                        </td>
                    </tr>
                @endif
                @if (count($praktikums) > 0)
                    @foreach ($praktikums as $praktikum)
                        <tr>
                            <td>Praktikum - {{ $praktikum->namapraktikum }}</td>
                            <td>
                                <form action="/dashboard/laporannilai/get/praktikum" method="post" class="d-inline">
                                    @csrf

                                    <input type="hidden" name="namapraktikum" id="namapraktikum"
                                        value="{{ $praktikum->namapraktikum }}">
                                    <input type="hidden" name="matkul_dipilih" id="matkul_dipilih"
                                        value="{{ $matkul->id }}">

                                    <button class="badge bg-info border-0"><span data-feather="download"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (count($pbls) > 0)
                    @foreach ($pbls as $pbl)
                        <tr>
                            <td>PBL - Skenario {{ $pbl->skenario }}</td>
                            <td>
                                <form action="/dashboard/laporannilai/get/pbl" method="post" class="d-inline">
                                    @csrf

                                    <input type="hidden" name="skenario" id="skenario" value="{{ $pbl->skenario }}">
                                    <input type="hidden" name="matkul_dipilih" id="matkul_dipilih"
                                        value="{{ $matkul->id }}">

                                    <button class="badge bg-info border-0"><span data-feather="download"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if ($ujians != null)
                    <tr>
                        <td>Ujian</td>
                        <td>
                            <form action="/dashboard/laporannilai/get/ujian" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul->id }}">

                                <button class="badge bg-info border-0"><span data-feather="download"></span></button>
                            </form>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <script>
        feather.replace();
    </script>
@endsection
