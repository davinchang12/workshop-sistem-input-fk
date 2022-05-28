@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kritik dan Saran</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Pilih Mata Kuliah</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($nilais as $nilai)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">{{ $nilai->matkul->namamatkul }}</h5>
                                    <small>{{ $nilai->matkul->kodematkul }}</small><br>
                                    <small>{{ $nilai->matkul->keterangan }}</small><br>
                                    <small>Tahun Ajaran {{ $nilai->matkul->tahun_ajaran }}</small>
                                </div>
                                <div class="col-md-auto p-auto">
                                    @can('dosen')
                                    <div class="col pt-2">
                                       
                                        <form action="/dashboard/kritikdansaran/show" method="get">
                                            @csrf
                                            <input type="hidden" name="matkul_dipilih" id=""
                                                value="{{ $nilai->matkul->id }}">
                                            <button class="btn btn-primary w-100 shadow-none"><span
                                                    data-feather="eye"></span></button>
                                        </form>
                                    </div>
                                    @endcan
                                    @can('mahasiswa')
                                        <div class="col pt-2">
                                            <form action="/dashboard/kritikdansaran/create" method="get">
                                                @csrf
                                                <input type="hidden" name="matkul_dipilih" id=""
                                                    value="{{ $nilai->matkul->id }}">
                                                <button class="btn btn-primary w-100 shadow-none"><span
                                                        data-feather="edit"></span></button>
                                            </form>
                                        </div>
                                    @endcan
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
