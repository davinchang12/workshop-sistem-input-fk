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

    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}" class="btn btn-success"><span
                data-feather="arrow-left"></span> Kembali</a>
        
        <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/trashbinpraktikum"
                                method="post" class="d-inline">
                                @csrf
                                {{-- <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}"> --}}
                                <button class="btn btn-success">Trashbin</button>
                            </form>

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
                @if($praktikums == null){

                }
                @else
                    @foreach ($praktikums as $praktikum)
                        <tr>
                            <td>{{ $praktikum->namapraktikum }}</td>
                            <td>
                                <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum/delete"
                                    method="post" class="d-inline">
                                    @csrf
                                    
                                    <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                                    <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
                                    <input type="hidden" name="namapraktikum" id="namapraktikum" value="{{ $praktikum->namapraktikum }}">
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                            data-feather="x-circle"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        feather.replace();
    </script>
@endsection
