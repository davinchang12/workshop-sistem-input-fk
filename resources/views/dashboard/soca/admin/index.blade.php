@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">SOCA</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/dashboard/settingsoca/create" class="btn btn-primary mb-3">Tambah Dosen Penguji</a>
        @if (count($socas) > 0)
            <a href="/dashboard/settingsoca/createsoal" class="btn btn-primary mb-3">Tambah Soal SOCA</a>
        @endif
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Nama SOCA</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socas as $soca)
                    <tr>
                        <td>{{ $soca->nama_penguji }}</td>
                        <td>{{ $soca->namasoca }}</td>
                        <td>{{ $soca->keterangan }}</td>
                        <td>
                            <form action="/dashboard/settingsoca/edit" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="nama_penguji" id="nama_penguji"
                                    value="{{ $soca->nama_penguji }}">
                                <input type="hidden" name="namasoca" id="namasoca" value="{{ $soca->namasoca }}">
                                <input type="hidden" name="keterangan" id="keterangan" value="{{ $soca->keterangan }}">
                                <button class="badge bg-warning border-0"><span data-feather="edit"></span></button>
                            </form>
                            <form action="/dashboard/settingsoca/delete" method="post" class="d-inline">
                                @csrf
                                
                                <input type="hidden" name="nama_penguji" id="nama_penguji"
                                    value="{{ $soca->nama_penguji }}">
                                <input type="hidden" name="namasoca" id="namasoca" value="{{ $soca->namasoca }}">
                                <input type="hidden" name="keterangan" id="keterangan" value="{{ $soca->keterangan }}">
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
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
