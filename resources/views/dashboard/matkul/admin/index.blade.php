@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mata Kuliah</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/settingmatakuliah/create" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>
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
                            <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="/dashboard/posts/{{ $matkul->kodematkul }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf

                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
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
