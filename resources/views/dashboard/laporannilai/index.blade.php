@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Nilai</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Matakuliah</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Bobot SKS</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkuls as $matkul)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $matkul->kodematkul }}</td>
                        <td>{{ $matkul->namamatkul }}</td>
                        <td>{{ $matkul->keterangan }}</td>
                        <td>{{ $matkul->tahun_ajaran }}</td>
                        <td>{{ $matkul->bobot_sks }}</td>
                        <td>
                            <form action="/dashboard/laporannilai/get" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul->id }}">
                                <input type="hidden" name="namamatkul" id="namamatkul" value="{{ $matkul->namamatkul }}">

                                <button class="badge bg-primary border-0"><span data-feather="arrow-right"></span></button>
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
