@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Praktikum</h1>
    </div>
    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum/create"
            class="btn btn-success">Tambah Praktikum <span data-feather="arrow-right"></span></a>
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
                    <th scope="col">Jenis Praktikum</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($praktikums as $praktikum)
                        <td>{{ $praktikum->namapraktikum }}</td>
                        <td>
                        <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum/delete" method="post" class="d-inline">
                            @csrf

                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                        </form>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        feather.replace();
    </script>
@endsection
