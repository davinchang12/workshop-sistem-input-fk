@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trashbin Mata Kuliah</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/settingmatakuliah" class="btn btn-primary mb-3">Kembali</a>
        <form action="/dashboard/settingmatakuliah/trashbin/empty-trash" method="post" class="d-inline">
            @method('post')
            @csrf
            <button class="btn btn-primary bg-danger mb-3" onclick="return confirm('Are you sure? All of the data will not be able restored')">Hapus Semua Data di Trashbin</button>
        </form>
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
                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/restore" method="post" class="d-inline">
                                @method('post')
                                @csrf
                                <input type="hidden" id="kodematkul" name="kodematkul" value={{ $matkul->kodematkul }}>
                                <button class="badge bg-warning border-0" onclick="return confirm('Restore data?')"><span data-feather="refresh-ccw"></span></button>
                            </form>
                            <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/force-delete" method="post" class="d-inline">
                                @method('post')
                                @csrf
                                <input type="hidden" id="kodematkul" name="kodematkul" value={{ $matkul->kodematkul }}>
                                <button class="badge bg-danger border-0" onclick="return confirm('Delete Data?It will not be able restored')"><span data-feather="x-circle"></span></button>
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
