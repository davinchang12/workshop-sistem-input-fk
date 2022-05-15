@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trashbin Dosen PBL</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/editdosen" class="btn btn-success"><span
                data-feather="arrow-left"></span> Kembali</a>
        {{-- <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/editdosen/create"
            class="btn btn-success">Tambah Dosen <span data-feather="arrow-right"></span></a> --}}
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

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Kelompok</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Skenario</th>
                <th scope="col">Tanggal Pelaksanaan Diskusi 1</th>
                <th scope="col">Tanggal Pelaksanaan Diskusi 2</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skenarios as $skenario)
                @php
                    $temp = array();
                @endphp
                <tr>
                    <td>{{ $skenario->kelompok }}</td>
                    <td>{{ $skenario->name }}</td>
                    <td>{{ $skenario->skenario }}</td>
                    @foreach ($diskusis->where('nilaipblskenario_id', $skenario->id) as $diskusi)
                        @php
                            array_push($temp, $diskusi->id);
                        @endphp
                        <td>{{ $diskusi->tanggal_pelaksanaan }}</td>
                    @endforeach
                    <td>
                        <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/editdosen/restore" method="post" class="d-inline">
                            @csrf
                            @foreach ($temp as $t)
                                <input type="hidden" name="diskusi[]" value="{{ $t }}">
                            @endforeach
                            <input type="hidden" name="skenario" value="{{ $skenario->id }}">
                            <input type="hidden" name="kodematkul" value="{{ $matkul->kodematkul }}">
                            <button class="badge bg-warning border-0" onclick="return confirm('Restore data?')"><span data-feather="refresh-ccw"></span></button>
                        </form>
                        <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/editdosen/force-delete" method="post" class="d-inline">
                            @csrf
                            @foreach ($temp as $t)
                                <input type="hidden" name="diskusi[]" value="{{ $t }}">
                            @endforeach
                            <input type="hidden" name="skenario" value="{{ $skenario->id }}">
                            <input type="hidden" name="kodematkul" value="{{ $matkul->kodematkul }}">
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?It will not be able restored?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        feather.replace();
    </script>
@endsection
