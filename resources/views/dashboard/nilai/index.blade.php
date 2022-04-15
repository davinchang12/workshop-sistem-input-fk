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
            {{-- TUGAS --}}
        </div>
        <div class="tab-pane fade" id="pbl">
            @if (auth()->check())
                @if (auth()->user()->hasRole('mahasiswa'))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kelompok</th>
                                <th scope="col">Skenario</th>
                                <th scope="col">Diskusi</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Kehadiran</th>
                                <th scope="col">Aktivitas Diskusi</th>
                                <th scope="col">Relevansi Pembicaraan</th>
                                <th scope="col">Keterampilan Berkomunikasi</th>
                                <th scope="col">Laporan Sementara</th>
                                <th scope="col">Laporan Resmi</th>
                                <th scope="col">Catatan / Kesan Kegiatan Diskusi Tutorial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pbls as $pbl)
                                @if ($pbl->diskusi == 2)
                                    <tr class="table-warning">
                                    @else
                                    <tr>
                                @endif
                                <td>{{ $pbl->kelompok }}</td>
                                <td>{{ $pbl->skenario }}</td>
                                <td>{{ $pbl->diskusi }}</td>
                                <td>{{ $pbl->name }}</td>
                                <td>{{ $pbl->nim }}</td>
                                <td>{{ $pbl->kehadiran }}</td>
                                <td>{{ $pbl->aktivitas_diskusi }}</td>
                                <td>{{ $pbl->relevansi_pembicaraan }}</td>
                                <td>{{ $pbl->keterampilan_berkomunikasi }}</td>
                                <td>{{ $pbl->laporan_sementara }}</td>
                                <td>{{ $pbl->laporan_resmi }}</td>
                                <td>{{ $pbl->catatan_kesan_kegiatan_diskusi_tutorial }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif (auth()->user()->hasRole('dosen'))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kelompok</th>
                                <th scope="col">Skenario</th>
                                <th scope="col">Diskusi</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Kehadiran</th>
                                <th scope="col">Aktivitas Diskusi</th>
                                <th scope="col">Relevansi Pembicaraan</th>
                                <th scope="col">Keterampilan Berkomunikasi</th>
                                <th scope="col">Laporan Sementara</th>
                                <th scope="col">Laporan Resmi</th>
                                <th scope="col">Catatan / Kesan Kegiatan Diskusi Tutorial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pbl_dosens as $pbl_dosen)
                                @if ($pbl_dosen->role == 'mahasiswa')
                                    @if ($pbl_dosen->diskusi == 2)
                                        <tr class="table-warning">
                                        @else
                                        <tr>
                                    @endif
                                    <td>{{ $pbl_dosen->kelompok }}</td>
                                    <td>{{ $pbl_dosen->skenario }}</td>
                                    <td>{{ $pbl_dosen->diskusi }}</td>
                                    <td>{{ $pbl_dosen->name }}</td>
                                    <td>{{ $pbl_dosen->nim }}</td>
                                    <td>{{ $pbl_dosen->kehadiran }}</td>
                                    <td>{{ $pbl_dosen->aktivitas_diskusi }}</td>
                                    <td>{{ $pbl_dosen->relevansi_pembicaraan }}</td>
                                    <td>{{ $pbl_dosen->keterampilan_berkomunikasi }}</td>
                                    <td>{{ $pbl_dosen->laporan_sementara }}</td>
                                    <td>{{ $pbl_dosen->laporan_resmi }}</td>
                                    <td>{{ $pbl_dosen->catatan_kesan_kegiatan_diskusi_tutorial }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
        <div class="tab-pane fade" id="praktikum">

        </div>
        <div class="tab-pane fade" id="Ujian">

        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
