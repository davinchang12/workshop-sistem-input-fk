@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Kelompok</h1>
    </div>
    <form method="post" action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl"
        class="mb-5" enctype="multipart/form-data">
        <div class="d-flex justify-content-between">
            <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl"
                class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

            <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
            <input type="hidden" name="matkul_kodematkul" id="matkuk_kodematkul" value="{{ $matkul->kodematkul }}">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
        <div class="col-lg-8 mt-3">

            @csrf
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
            <div class="mb-3">
                <label for="skenario" class="form-label @error('skenario') is-invalid @enderror">Skenario</label>
                <input type="text" class="form-control" id="skenario" name="skenario" required
                    value="{{ old('skenario') }}">
                @error('skenario')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <ul class="nav nav-tabs">
                @foreach ($angkatans as $angkatan)
                    <li class="nav-item">
                        <a href="#a{{ $angkatan->angkatan }}"
                            class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}"
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
                                                            {{ in_array($user->id, $skenarios->pluck('id')->toArray()) ? 'checked disabled' : '' }}>
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
    </div>
    <script>
        const kodematkul = document.querySelector('#kodematkul');
        const blok = document.querySelector('#blok');

        kodematkul.addEventListener('change', function() {
            fetch('/dashboard/settingmatakuliah/checkBlok?kodematkul=' + kodematkul.value)
                .then(response => response.json())
                .then(data => blok.value = data.blok)
        });
    </script>
@endsection
