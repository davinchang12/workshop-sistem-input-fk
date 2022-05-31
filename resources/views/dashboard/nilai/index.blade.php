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
            @if (auth()->check())
                @if (auth()->user()->hasRole('mahasiswa'))
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama :</th>
                                        <th scope="col" style="text-align: left">{{ auth()->user()->name }}</th>
                                        <th scope="col">NIM :</th>
                                        <th scope="col" style="text-align: left">{{ auth()->user()->nim }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Topik Tugas</th>
                                        <th scope="col">Dosen Pengampu</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($nilaitugas->isEmpty()); --}}
                                    @if ($nilaitugas->isEmpty())
                                    @else
                                        @foreach ($nilaitugas as $tugas)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $tugas->keterangantugas }}</td>
                                            <td>{{ $tugas->dosenpenguji }}</td>
                                            <td>{{ $tugas->nilaitugas }}</td>
                                            </tr>
                                        @endforeach
                                        <td colspan="3">Rata-Rata</td>
                                        {{-- <td></td>
                                    <td></td> --}}
                                        <td>{{ $tugas->rataratatugas }}</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif (auth()->user()->hasRole('dosen'))
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIM</th>
                                        @php
                                            $keterangan = [];
                                            $count = 0;
                                        @endphp
                                        @foreach ($topik_tugas as $topik)
                                            <th scope="col">{{ $topik->keterangantugas }}</th>
                                            @php
                                                $count++;
                                                array_push($keterangan, $topik->keterangantugas);
                                            @endphp
                                        @endforeach
                                        {{-- <th scope="col"></th> --}}
                                        <th scope="col">Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                        $check = '';
                                        $z = 0;
                                    @endphp

                                    @foreach ($nilaitugas_dosen as $tugas)
                                        @if ($check != $tugas->name)
                                            @if ($check != '')
                                                {{-- <td>{{ $tugas->rataratatugas }}</td> --}}
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td>{{ $tugas->name }}</td>
                                                <td>{{ $tugas->nim }}</td>
                                                @php
                                                    $check = $tugas->name;
                                                    $x++;
                                                    $z = 1;
                                                @endphp
                                                <td>{{ $tugas->nilaitugas }}</td>
                                            @else
                                                <td>{{ $tugas->nilaitugas }}</td>
                                                @php $z++; @endphp
                                        @endif
                                        @if ($check == $tugas->name)
                                            @if ($z == $count)
                                                <td>{{ $tugas->rataratatugas }}</td>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="tab-pane fade" id="pbl">
            @if (auth()->check())
                @if (auth()->user()->hasRole('mahasiswa'))
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
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
                                        <th scope="col">Tanggal Pelaksanaan</th>
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
                                        <td>{{ $pbl->tanggal_pelaksanaan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif (auth()->user()->hasRole('dosen'))
                    @if ($check_pbl_dosen)
                        <div class="row">
                            <div class="col table-responsive">
                                <table class="table" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tanggal</th>
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
                                            <th scope="col">Total</th>
                                            <th scope="col">Rata Rata</th>
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
                                                <td>{{ $pbl_dosen->tanggal_pelaksanaan }}</td>
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
                                                <td>{{ $pbl_dosen->total }}</td>
                                                <td>{{ $pbl_dosen->rata_rata }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </div>
        <div class="tab-pane fade" id="praktikum">
            @if (auth()->check())
                @if (auth()->user()->hasRole('mahasiswa'))
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">Praktikum</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Rata-rata Quiz</th>
                                        <th scope="col">Rata-rata Nilai Laporan</th>
                                        <th scope="col">Nilai Responsi</th>
                                        <th scope="col">Nilai Akhir</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Keterangan Berdasarkan</th>
                                        <th scope="col">Remedi</th>
                                        <th scope="col">Remedi Konversi</th>
                                        <th scope="col">Nilai Setelah Remedi</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Keterangan Berdasarkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($praktikums as $praktikum)
                                        <tr>
                                            <td>{{ $praktikum->namapraktikum }}</td>
                                            <td>{{ $praktikum->name }}</td>
                                            <td>{{ $praktikum->nim }}</td>
                                            <td>{{ $praktikum->rata_rata_quiz }}</td>
                                            <td>{{ $praktikum->rata_rata_laporan }}</td>
                                            <td>{{ $praktikum->nilai_responsi }}</td>
                                            <td>{{ $praktikum->nilai_akhir }}</td>
                                            <td>{{ $praktikum->keterangan_nilai_akhir }}</td>
                                            <td>{{ $praktikum->keterangan_nilai_akhir_berdasarkan }}</td>
                                            <td>{{ $praktikum->remedi }}</td>
                                            <td>{{ $praktikum->remedi_konversi }}</td>
                                            <td>{{ $praktikum->nilai_setelah_remedi }}</td>
                                            <td>{{ $praktikum->keterangan_nilai_setelah_remedi }}</td>
                                            <td>{{ $praktikum->keterangan_nilai_setelah_remedi_berdasarkan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif (auth()->user()->hasRole('dosen'))
                    {{-- @if ($check_praktikum_dosen) --}}
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">Praktikum</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Rata-rata Quiz</th>
                                        <th scope="col">Rata-rata Nilai Laporan</th>
                                        <th scope="col">Nilai Responsi</th>
                                        <th scope="col">Nilai Akhir</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Keterangan Berdasarkan</th>
                                        <th scope="col">Remedi</th>
                                        <th scope="col">Remedi Konversi</th>
                                        <th scope="col">Nilai Setelah Remedi</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Keterangan Berdasarkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($praktikum_dosens as $praktikum_dosen)
                                        @if ($praktikum_dosen->keterangan_nilai_setelah_remedi == 'TIDAK LULUS')
                                            <tr class="table-danger">
                                                <td>{{ $praktikum_dosen->namapraktikum }}</td>
                                                <td>{{ $praktikum_dosen->name }}</td>
                                                <td>{{ $praktikum_dosen->nim }}</td>
                                                <td>{{ $praktikum_dosen->rata_rata_quiz }}</td>
                                                <td>{{ $praktikum_dosen->rata_rata_laporan }}</td>
                                                <td>{{ $praktikum_dosen->nilai_responsi }}</td>
                                                <td>{{ $praktikum_dosen->nilai_akhir }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_akhir }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_akhir_berdasarkan }}</td>
                                                <td>{{ $praktikum_dosen->remedi }}</td>
                                                <td>{{ $praktikum_dosen->remedi_konversi }}</td>
                                                <td>{{ $praktikum_dosen->nilai_setelah_remedi }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi_berdasarkan }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $praktikum_dosen->namapraktikum }}</td>
                                                <td>{{ $praktikum_dosen->name }}</td>
                                                <td>{{ $praktikum_dosen->nim }}</td>
                                                <td>{{ $praktikum_dosen->rata_rata_quiz }}</td>
                                                <td>{{ $praktikum_dosen->rata_rata_laporan }}</td>
                                                <td>{{ $praktikum_dosen->nilai_responsi }}</td>
                                                <td>{{ $praktikum_dosen->nilai_akhir }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_akhir }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_akhir_berdasarkan }}</td>
                                                <td>{{ $praktikum_dosen->remedi }}</td>
                                                <td>{{ $praktikum_dosen->remedi_konversi }}</td>
                                                <td>{{ $praktikum_dosen->nilai_setelah_remedi }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi }}</td>
                                                <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi_berdasarkan }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endif
            @endif
        </div>
        <div class="tab-pane fade" id="Ujian">
            @if (auth()->check())
                @if (auth()->user()->hasRole('mahasiswa'))
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama :</th>
                                        <th scope="col" style="text-align: left">{{ auth()->user()->name }}</th>
                                        <th scope="col">NIM :</th>
                                        <th scope="col" style="text-align: left">{{ auth()->user()->nim }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">UTB</th>
                                        <th scope="col">UAB</th>
                                        <th scope="col">Rata-Rata</th>
                                        <th scope="col">UAB Combined</th>
                                        <th scope="col">Sintak UTB</th>
                                        <th scope="col">Sintak UAB</th>
                                        <th scope="col">Remedi</th>
                                        <th scope="col">UAB Combined setelah Remedi</th>
                                        <th scope="col">Nilai Final CBT</th>
                                        <th scope="col">Nilai Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ujians as $ujian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ujian->name }}</td>
                                            <td>{{ $ujian->nim }}</td>
                                            <td>{{ $ujian->utb }}</td>
                                            <td>{{ $ujian->uab }}</td>
                                            <td>{{ $ujian->ratarataujian }}</td>
                                            <td>{{ $ujian->uabcombined }}</td>
                                            <td>{{ $ujian->sintakutb }}</td>
                                            <td>{{ $ujian->sintakuab }}</td>
                                            @if ($ujian->remediujian == 0 || $ujian->remediujian == null)
                                                <td>-</td>
                                            @else
                                                <td>{{ $ujian->remediujian }}</td>
                                            @endif
                                            <td>{{ $ujian->uabcombinedremedial }}</td>

                                            <td>{{ $ujian->finalcbt }}</td>
                                            @if ($ujian->finalcbt >= 80)
                                                <td>A</td>
                                            @endif
                                            @if ($ujian->finalcbt < 80 && $ujian->finalcbt >= 75)
                                                <td>AB</td>
                                            @endif
                                            @if ($ujian->finalcbt < 75 && $ujian->finalcbt >= 70)
                                                <td>B</td>
                                            @endif
                                            @if ($ujian->finalcbt < 70 && $ujian->finalcbt >= 65)
                                                <td>BC</td>
                                            @endif
                                            @if ($ujian->finalcbt < 65 && $ujian->finalcbt >= 55)
                                                <td>C</td>
                                            @endif
                                            @if ($ujian->finalcbt < 55 && $ujian->finalcbt >= 50)
                                                <td>CD</td>
                                            @endif
                                            @if ($ujian->finalcbt < 50 && $ujian->finalcbt >= 40)
                                                <td>D</td>
                                            @endif
                                            @if ($ujian->finalcbt < 40)
                                                <td>E</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif (auth()->user()->hasRole('dosen'))
                    {{-- @if ($check_praktikum_dosen) --}}
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">UTB</th>
                                        <th scope="col">UAB</th>
                                        <th scope="col">Rata-Rata</th>
                                        <th scope="col">UAB Combined</th>
                                        <th scope="col">Sintak UTB</th>
                                        <th scope="col">Sintak UAB</th>
                                        <th scope="col">Remedi</th>
                                        <th scope="col">UAB Combined setelah Remedi</th>
                                        <th scope="col">Nilai Final CBT</th>
                                        <th scope="col">Nilai Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ujian_dosens as $ujian)
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ujian->name }}</td>
                                        <td>{{ $ujian->nim }}</td>
                                        <td>{{ $ujian->utb }}</td>
                                        <td>{{ $ujian->uab }}</td>
                                        <td>{{ $ujian->ratarataujian }}</td>
                                        <td>{{ $ujian->uabcombined }}</td>
                                        <td>{{ $ujian->sintakutb }}</td>
                                        <td>{{ $ujian->sintakuab }}</td>
                                        @if ($ujian->remediujian == 0 || $ujian->remediujian == null)
                                            <td>-</td>
                                        @else
                                            <td>{{ $ujian->remediujian }}</td>
                                        @endif

                                        <td>{{ $ujian->uabcombinedremedial }}</td>
                                        <td>{{ $ujian->finalcbt }}</td>
                                        @if ($ujian->finalcbt >= 80)
                                            <td>A</td>
                                        @endif
                                        @if ($ujian->finalcbt < 80 && $ujian->finalcbt >= 75)
                                            <td>AB</td>
                                        @endif
                                        @if ($ujian->finalcbt < 75 && $ujian->finalcbt >= 70)
                                            <td>B</td>
                                        @endif
                                        @if ($ujian->finalcbt < 70 && $ujian->finalcbt >= 65)
                                            <td>BC</td>
                                        @endif
                                        @if ($ujian->finalcbt < 65 && $ujian->finalcbt >= 55)
                                            <td>C</td>
                                        @endif
                                        @if ($ujian->finalcbt < 55 && $ujian->finalcbt >= 50)
                                            <td>CD</td>
                                        @endif
                                        @if ($ujian->finalcbt < 50 && $ujian->finalcbt >= 40)
                                            <td>D</td>
                                        @endif
                                        @if ($ujian->finalcbt < 40)
                                            <td>E</td>
                                        @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endif
            @endif
        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
