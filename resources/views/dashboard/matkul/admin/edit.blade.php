@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Mata Kuliah</h1>
    </div>
    <a href="/dashboard/settingmatakuliah" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    
    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}" class="mb-5"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="kodematkul" class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control @error('kodematkul') is-invalid @enderror" id="kodematkul"
                    name="kodematkul" required autofocus value="{{ old('kodematkul', $matkul->kodematkul) }}">
                @error('kodematkul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="namamatkul" class="form-label @error('namamatkul') is-invalid @enderror">Nama Mata Kuliah</label>
                <input type="text" class="form-control" id="namamatkul" name="namamatkul" required
                    value="{{ old('namamatkul', $matkul->namamatkul) }}">
                @error('namamatkul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if ($matkul->blok != null)
                <div class="mb-3">
                    <label for="blok" class="form-label">Blok</label>
                    <input type="text" class="form-control" name="blok" id="blok" required
                        value="{{ old('blok', $matkul->blok) }}">
                    @error('blok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif
            <div class="mb-3">
                <label for="keterangan" class="form-label @error('keterangan') is-invalid @enderror">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required
                    value="{{ old('keterangan', $matkul->keterangan) }}">
                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tahun_ajaran" class="form-label @error('tahun_ajaran') is-invalid @enderror">Tahun Ajaran</label>
                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" required
                    value="{{ old('tahun_ajaran', $matkul->tahun_ajaran) }}">
                @error('tahun_ajaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bobot_sks" class="form-label @error('bobot_sks') is-invalid @enderror">Bobot SKS</label>
                <input type="text" class="form-control" id="bobot_sks" name="bobot_sks" required
                    value="{{ old('bobot_sks', $matkul->bobot_sks) }}">
                @error('bobot_sks')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kinerja" class="form-label @error('kinerja') is-invalid @enderror">Kinerja</label>
                <input type="text" class="form-control" id="kinerja" name="kinerja" required
                    value="{{ old('kinerja', $matkul->kinerja) }}">
                @error('bobot_sks')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
