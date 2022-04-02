@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
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

    <div class="container">
        <div class="row">
            @foreach ($jadwals as $jadwal)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">{{ $jadwal->matkul->namamatkul }}</h5>
                                    <small>Tahun Ajaran : {{ $jadwal->matkul->tahun_ajaran }}</small>
                                </div>
                                <div class="col-md-auto">
                                    <div class="col pt-2">
                                        <a href="/dashboard/nilai/lihat{{ $jadwal->matkul->namamatkul }}"
                                            class="badge bg-info w-100"><span data-feather="eye"></span></a>
                                    </div>
                                    <div class="col pt-2">
                                        @can('dosen')
                                            <a href="/dashboard/dosen/nilai" class="badge bg-info w-100"><span
                                                    data-feather="settings"></span></a>
                                        @endcan
                                    </div>
                                    <div class="col pt-2">
                                        @can('admin')
                                            <a href="/dashboard/admin/nilai/edit" class="badge bg-info w-100"><span
                                                    data-feather="key"></span></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card border-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-dark">Header</div>
                            <div class="card-body text-dark">
                              <h5 class="card-title">dark card title</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer bg-transparent border-dark">Footer</div>
                          </div> --}}
                </div>
            @endforeach
        </div>
    </div>
    {{-- </div> --}}

    <script>
        feather.replace()
    </script>
@endsection
