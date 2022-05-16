@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Akses Edit Nilai</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <a href="/dashboard/akseseditnilai/create" class="btn btn-primary mb-3">Tambah Akses</a>
        <a href="/dashboard/akseseditnilai/trashbin" class="btn btn-primary mb-3">Trashbin</a>
    
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dosen</th>
                    <th scope="col">Jenis Nilai</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akseseditnilais as $akseseditnilai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $akseseditnilai->users->name }}</td>
                        <td>{{ $akseseditnilai->jenisnilai }}</td>
                        <td>
                            <form action="/dashboard/akseseditnilai/{{ $akseseditnilai->id }}" method="post" class="d-inline">
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
