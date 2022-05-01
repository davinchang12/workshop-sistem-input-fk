@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Field Lab</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/settingfieldlab/create" class="btn btn-primary mb-3">Tambah Kelompok</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fieldlabs as $fieldlab)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $fieldlab->semester }}</td>
                        <td>{{ $fieldlab->keterangan }}</td>
                        <td>
                            <a href="/dashboard/settingfieldlab" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <form action="/dashboard/settingfieldlab" method="post" class="d-inline">
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
