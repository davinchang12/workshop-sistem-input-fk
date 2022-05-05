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
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($osces as $osce)
                    <tr>
                        <td>{{ $osce->nama_penguji }}</td>
                        <td>
                            <a href="/dashboard/settingosce/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="/dashboard/settingosce/delete" method="post" class="d-inline">
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
