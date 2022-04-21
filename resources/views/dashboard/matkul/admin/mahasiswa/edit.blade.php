@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Mahasiswa</h1>
    </div>
    <form action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingmahasiswamatakuliah" method="post">
        @csrf
        <div class="d-flex justify-content-between">
            <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}" class="btn btn-success"><span
                    data-feather="arrow-left"></span> Kembali</a>

            <input type="hidden" name="matkul_id" id="matkuk_id" value="{{ $matkul->id }}">
            <input type="hidden" name="matkul_kodematkul" id="matkuk_kodematkul" value="{{ $matkul->kodematkul }}">
            <button type="submit" class="btn btn-primary">Simpan</button>

        </div>

        <div class="row d-flex justify-content-between mt-3">
            <div class="col">
                <p>Kode Mata Kuliah : <b>{{ $matkul->kodematkul }}</b></p>
                <p>Nama Mata Kuliah : <b>{{ $matkul->namamatkul }}</b></p>
                @if ($matkul->blok != null)
                    <p>Blok : <b>{{ $matkul->blok }}</b></p>
                @endif
            </div>
            <div class="col">
                <p><b>{{ $matkul->keterangan }}</b></p>
                <p>Tahun Ajaran : <b>{{ $matkul->tahun_ajaran }}</b></p>
                <p>Bobot SKS : <b>{{ $matkul->bobot_sks }}</b></p>
            </div>
        </div>
        {{-- <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">NIM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkul->nilais as $nilai)
                    @if ($nilai->users->hasRole('mahasiswa'))
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $nilai->users->name }}</td>
                            <td>{{ $nilai->users->nim }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div> --}}
        <ul class="nav nav-tabs">
            @foreach ($angkatans as $angkatan)
                <li class="nav-item">
                    <a href="#a{{ $angkatan->angkatan }}" class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ $angkatan->angkatan }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach ($angkatans as $angkatan)
                <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }}"
                    id="a{{ $angkatan->angkatan }}">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->angkatan == $angkatan->angkatan)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->nim }}</td>
                                            <td>{{ $user->angkatan }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $user->id }}" name="user_id[]"
                                                        {{ in_array($user->id, $matkul->nilais->pluck('user_id')->toArray()) ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
    <script>
        feather.replace();
    </script>
@endsection
