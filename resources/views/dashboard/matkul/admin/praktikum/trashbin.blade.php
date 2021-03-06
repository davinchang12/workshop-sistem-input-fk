@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Praktikum</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum" class="btn btn-primary mb-3">Kembali</a>
        <form action="/dashboard/settingmatakuliah/trashbin/empty-trash-praktikum"
            method="post" class="d-inline">
            @csrf
            
            <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
            <button class="btn btn-primary mb-3 bg-danger" onclick="return confirm('Are you sure? All the data will not be able restored!')">Hapus semua praktikum di trashbin</button>
        </form>
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
                @foreach ($praktikums as $praktikum)
                    <tr>
                        <td>{{ $praktikum->namapraktikum }}</td>
                        <td>
                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum/restore"
                                method="post" class="d-inline">
                                @csrf
                                
                                <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                                <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
                                <input type="hidden" name="namapraktikum" id="namapraktikum" value="{{ $praktikum->namapraktikum }}">
                                <button class="badge bg-warning border-0" onclick="return confirm('Restore Data?')"><span
                                        data-feather="refresh-ccw"></span></button>
                            </form>
                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum/force-delete"
                                method="post" class="d-inline">
                                @csrf
                                
                                <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                                <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
                                <input type="hidden" name="namapraktikum" id="namapraktikum" value="{{ $praktikum->namapraktikum }}">
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure? It will not be able restored!')"><span
                                        data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        feather.replace();
    </script>
@endsection
