@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai</h1>
    </div>
    <a href="/dashboard/matkul" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Lihat</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#tugas" class="nav-link active" data-bs-toggle="tab">Tugas</a>
        </li>
        <li class="nav-item">
            <a href="#pbl" class="nav-link" data-bs-toggle="tab">PBL</a>
        </li>
        <li class="nav-item">
            <a href="#praktikum" class="nav-link" data-bs-toggle="tab">Praktikum</a>
        </li>
        <li class="nav-item">
            <a href="#ujian" class="nav-link" data-bs-toggle="tab">Ujian</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tugas">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Matkul</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilais as $nilai)
                        @if (strpos($nilai->keterangan, 'tugas') !== false)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $nilai->matkul->namamatkul }}</td>
                                <td>{{ $nilai->keterangan }}</td>
                                <td>{{ $nilai->nilai_mhs }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pbl">
            <div class="container">
                <div class="row">
                    @foreach ($kelompoks as $kelompok)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">{{ $kelompok->kodekelompok }}</h5>
                                            <small>{{ $kelompok->matkul->keterangan }}</small><br>
                                            <small>Tahun Ajaran {{ $kelompok->matkul->tahun_ajaran }}</small>
                                        </div>
                                        <div class="col-md-auto p-auto">
                                            <div class="col pt-2">
                                                <a href="/dashboard/nilai/lihat{{ $kelompok->matkul->namamatkul }}"
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
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="praktikum">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Matkul</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilais as $nilai)
                        @if (strpos($nilai->keterangan, 'praktikum') !== false)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $nilai->matkul->namamatkul }}</td>
                                <td>{{ $nilai->keterangan }}</td>
                                <td>{{ $nilai->nilai_mhs }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="Ujian">
            <p>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Matkul</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilais as $nilai)
                        @if (strpos($nilai->keterangan, 'ujian') !== false)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $nilai->matkul->namamatkul }}</td>
                                <td>{{ $nilai->keterangan }}</td>
                                <td>{{ $nilai->nilai_mhs }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            </p>
        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
