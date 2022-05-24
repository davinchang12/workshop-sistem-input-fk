@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Nilai Lain - OSCE</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/dashboard/laporanlain" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="table-responsive">
        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <th scope="col">Nama OSCE</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($osces as $mhs_osce)
                    <tr>
                        <td>{{ $mhs_osce->namaosce }}</td>
                        <td>
                            <form action="/dashboard/laporanlain/osce/get" method="post" class="d-inline">
                                @csrf

                                <input type="hidden" name="namaosce" id="namaosce" value="{{ $mhs_osce->namaosce }}">

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
