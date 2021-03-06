@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mata Kuliah</h1>
    </div>
    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingmatakuliah" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
        @if ($matkul->blok != null)
            <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum" class="btn btn-success">Edit Praktikum</a>
            <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl"
                class="btn btn-success">Edit Kelompok PBL</a>
        @endif
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingmahasiswamatakuliah"
            class="btn btn-success">Edit Mahasiswa <span data-feather="arrow-right"></span></a>

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
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">NIM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkul->nilais as $nilai)
                    @if ($nilai->users->hasRole('mahasiswa'))
                        <tr>
                            <td>{{ $nilai->users->name }}</td>
                            <td>{{ $nilai->users->nim }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        feather.replace();
    </script>
@endsection
