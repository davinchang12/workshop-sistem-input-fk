@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai {{ $namamatkul }}</h1>
    </div>
    <form action="/dashboard/matkul/nilai/edit/ujian/simpan" method="post">
        @csrf
        <div class="d-flex justify-content-between">
            <a href="/dashboard/matkul/{{ $kodematkul }}" class="btn btn-success"><span data-feather="arrow-left"></span>
                Kembali</a>

            <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul_dipilih }}">
            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $kodematkul }}">
            <button class="btn btn-primary shadow-none">Simpan</button>

        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h5">Edit Nilai</h3>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (auth()->check())
            @if (auth()->user()->hasRole('mahasiswa'))
                <table class="table" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">Nama :</th>
                            <th scope="col" style="text-align: left">{{ auth()->user()->name }}</th>
                            <th scope="col">NIM :</th>
                            <th scope="col" style="text-align: left">{{ auth()->user()->nim }}</th>
                        </tr>
                        <tr>
                            <<th scope="col">No</th>
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
                                <td>-</td>
                            @else
                                <td>{{ $ujian->remediujian }}</td>
                                <td>{{ $ujian->uabcombinedremedial }}</td>
                            @endif

                            <td>{{ $ujian->finalcbt }}</td>
                            @if ($ujian->finalcbt >= 90)
                                <td>A</td>
                            @endif
                            @if ($ujian->finalcbt < 90 && $ujian->finalcbt >= 85)
                                <td>AB</td>
                            @endif
                            @if ($ujian->finalcbt < 85 && $ujian->finalcbt >= 80)
                                <td>BC</td>
                            @endif
                            @if ($ujian->finalcbt < 80 && $ujian->finalcbt >= 75)
                                <td>C</td>
                            @endif
                            @if ($ujian->finalcbt < 75 && $ujian->finalcbt >= 70)
                                <td>CD</td>
                            @endif
                            @if ($ujian->finalcbt < 70 && $ujian->finalcbt >= 60)
                                <td>D</td>
                            @endif
                            @if ($ujian->finalcbt < 60)
                                <td>E</td>
                            @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif (auth()->user()->hasRole('dosen'))
                @if ($check_praktikum_dosen)
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
                                    <td>-</td>
                                @else
                                    <td>{{ $ujian->remediujian }}</td>
                                    <td>{{ $ujian->uabcombinedremedial }}</td>
                                @endif

                                <td>{{ $ujian->finalcbt }}</td>
                                @if ($ujian->finalcbt >= 90)
                                    <td>A</td>
                                @endif
                                @if ($ujian->finalcbt < 90 && $ujian->finalcbt >= 85)
                                    <td>AB</td>
                                @endif
                                @if ($ujian->finalcbt < 85 && $ujian->finalcbt >= 80)
                                    <td>BC</td>
                                @endif
                                @if ($ujian->finalcbt < 80 && $ujian->finalcbt >= 75)
                                    <td>C</td>
                                @endif
                                @if ($ujian->finalcbt < 75 && $ujian->finalcbt >= 70)
                                    <td>CD</td>
                                @endif
                                @if ($ujian->finalcbt < 70 && $ujian->finalcbt >= 60)
                                    <td>D</td>
                                @endif
                                @if ($ujian->finalcbt < 60)
                                    <td>E</td>
                                @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        @endif
        </div>
    </form>
    <script>
        feather.replace()
    </script>
@endsection
