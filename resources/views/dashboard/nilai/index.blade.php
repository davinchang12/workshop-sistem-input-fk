@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Pilih Matkul</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        <div class="container">
            <div class="row">
                @foreach ($jadwals as $jadwal)
                <div class="col-md-4 mb-3">
                        <a href="/dashboard/nilai/{{ $jadwal->matkul->namamatkul }}" class="text-decoration-none text-dark">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal->matkul->namamatkul }}</h5>
                                <small>Tahun Ajaran : {{ $jadwal->matkul->tahun_ajaran }}</small>
                            </div>
                        </div>
                    </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
