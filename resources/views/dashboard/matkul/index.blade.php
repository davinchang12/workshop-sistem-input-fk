@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai</h1>
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
            @foreach ($jadwals as $jadwal)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">{{ $jadwal->matkul->namamatkul }}</h5>
                                    <small>{{ $jadwal->matkul->kodematkul }}</small><br>
                                    <small>{{ $jadwal->matkul->keterangan }}</small><br>
                                    <small>Tahun Ajaran {{ $jadwal->matkul->tahun_ajaran }}</small>
                                </div>
                                <div class="col-md-auto p-auto">
                                    <div class="col pt-2">
                                        {{-- <a href="/dashboard/matkul/nilai" class="badge bg-info w-100"><span
                                                data-feather="eye"></span></a> --}}
                                        <form action="/dashboard/matkul/nilai" method="get">
                                            @csrf
                                            <input type="hidden" name="matkul_dipilih" id=""
                                                value="{{ $jadwal->matkul->id }}">
                                            <button class="btn btn-primary w-100 shadow-none"><span
                                                    data-feather="eye"></span></button>
                                        </form>
                                    </div>
                                    @can('dosen')
                                        <div class="col pt-2">
                                            <a href="/dashboard/matkul/{{ $jadwal->matkul->kodematkul }}"
                                                class="btn btn-primary w-100"><span data-feather="settings"></span></a>
                                        </div>
                                    @endcan
                                    @can('admin')
                                        <div class="col pt-2">
                                            <a href="/dashboard/admin/nilai/edit" class="badge bg-info w-100"><span
                                                    data-feather="key"></span></a>
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
