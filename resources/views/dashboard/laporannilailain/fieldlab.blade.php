@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Nilai Lain - Field Lab</h1>
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
                    <th scope="col">Semester</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fieldlabs as $fieldlab)
                    <tr>
                        <td>{{ $fieldlab->semester }}</td>
                        <td>
                            <form action="/dashboard/laporanlain/fieldlab/get" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="semester" id="semester" value="{{ $fieldlab->semester }}">

                                <button class="badge bg-info border-0"><span data-feather="download"></span></button>
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
