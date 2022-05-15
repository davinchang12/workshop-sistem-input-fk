@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trashbin Jadwal</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/settingjadwal" class="btn btn-primary mb-3">Kembali</a>
        <form action="/dashboard/settingjadwal/trashbin/empty-trash" method="post" class="d-inline">
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
                    <th scope="col">Dosen</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Selesai</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->kodematkul }}</td>
                        <td>{{ $jadwal->namamatkul }}</td>
                        <td>{{ $jadwal->name }}</td>
                        <td>{{ $jadwal->tanggal }}</td>
                        <td>{{ $jadwal->jammasuk }}</td>
                        <td>{{ $jadwal->jamselesai }}</td>
                        <td>{{ $jadwal->ruangan }}</td>
                        <td>
                            {{-- <a href="/dashboard/settingjadwal/{{ $jadwal->id }}/restore" class="badge bg-warning"><span data-feather="refresh-ccw"></span></a> --}}
                            <form action="/dashboard/settingjadwal/{{ $jadwal->id }}/restore" method="post" class="d-inline">
                                @method('post')
                                @csrf
                                <input type="hidden" id="kodejadwal" name="kodejadwal" value={{  $jadwal->id }}>
                                <button class="badge bg-warning border-0" onclick="return confirm('Restore Data?')"><span data-feather="refresh-ccw"></span></button>
                            </form>
                            <form action="/dashboard/settingjadwal/{{ $jadwal->id }}/force-delete" method="post" class="d-inline">
                                @method('post')
                                @csrf
                                <input type="hidden" id="kodejadwal" name="kodejadwal" value={{  $jadwal->id }}>
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure? It will not be able restored')"><span data-feather="x-circle"></span></button>
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
