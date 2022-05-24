@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Nilai Lain - SOCA</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/dashboard/laporanlain" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nama SOCA</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socas as $soca)
                    <tr>
                        <td>{{ $soca->namasoca }}</td>
                        <td>{{ $soca->keterangan }}</td>
                        <td>
                            <form action="/dashboard/laporanlain/soca/get" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="namasoca" id="namasoca" value="{{ $soca->namasoca }}">
                                <input type="hidden" name="keterangan" id="keterangan" value="{{ $soca->keterangan }}">

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
