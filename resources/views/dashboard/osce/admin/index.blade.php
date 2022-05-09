@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">OSCE</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/dashboard/settingosce/create" class="btn btn-primary mb-3">Tambah Dosen Penguji</a>
        @if (count($osces) > 0)
            <a href="/dashboard/settingosce/createsoal" class="btn btn-primary mb-3">Tambah Soal OSCE</a>
        @endif
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Nama OSCE</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($osces as $osce)
                    <tr>
                        <td>{{ $osce->nama_penguji }}</td>
                        <td>{{ $osce->namaosce }}</td>
                        <td>
                            <form action="/dashboard/settingosce/edit" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="nama_penguji" id="nama_penguji"
                                    value="{{ $osce->nama_penguji }}">
                                <input type="hidden" name="namaosce" id="namaosce" value="{{ $osce->namaosce }}">
                                <button class="badge bg-warning border-0"><span data-feather="edit"></span></button>
                            </form>
                            <form action="/dashboard/settingosce/delete" method="post" class="d-inline">
                                @csrf

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
