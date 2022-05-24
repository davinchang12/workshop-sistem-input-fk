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
        {{-- <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenis Nilai Lain</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>OSCE</td>
                    <td>
                        <form action="/dashboard/laporannilailain/osce" method="post" class="d-inline">
                            @csrf

                            <button class="badge bg-primary border-0"><span data-feather="arrow-right"></span></button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SOCA</td>
                    <td>
                        <form action="/dashboard/laporannilailain/soca" method="post" class="d-inline">
                            @csrf

                            <button class="badge bg-primary border-0"><span data-feather="arrow-right"></span></button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Field Lab</td>
                    <td>
                        <form action="/dashboard/laporannilailain/fiedlab" method="post" class="d-inline">
                            @csrf

                            <button class="badge bg-primary border-0"><span data-feather="arrow-right"></span></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table> --}}
    </div>

    <script>
        feather.replace();
    </script>
@endsection
