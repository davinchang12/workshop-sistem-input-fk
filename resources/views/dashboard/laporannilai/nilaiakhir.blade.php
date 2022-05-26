@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai Akhir {{ $namamatkul }}</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <form action="/dashboard/laporannilai/get" method="post" class="d-inline">
        @csrf
        <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul_dipilih }}">
        <button type="submit" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</button>
    </form>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Persentase Nilai Akhir</h3>
    </div>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/laporannilai/get/nilaiakhir/export" class="mb-5" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul_dipilih }}">

            <div class="mb-3">
                <label for="tugas" class="form-label @error('tugas') is-invalid @enderror">Tugas</label>
                <input type="text" class="form-control" id="tugas" name="tugas" aria-describedby="tugasHelp"
                    value="{{ old('tugas') }}" placeholder="Cth : 10">
                <div id="tugasHelp" class="form-text">Kosongkan jika nilai tugas <b>tidak masuk</b> dalam
                    perhitungan total komponen tugas.</div>
                @error('tugas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pbl" class="form-label @error('pbl') is-invalid @enderror">PBL</label>
                <input type="text" class="form-control" id="pbl" name="pbl" value="{{ old('pbl') }}" placeholder="Cth : 15" required>
                @error('pbl')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="utb" class="form-label @error('utb') is-invalid @enderror">UTB</label>
                <input type="text" class="form-control" id="utb" name="utb" value="{{ old('utb') }}" placeholder="Cth : 37.5 -> Dengan titik ' . '" required>
                @error('utb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="uab" class="form-label @error('uab') is-invalid @enderror">UAB</label>
                <input type="text" class="form-control" id="uab" name="uab" value="{{ old('uab') }}" placeholder="Cth : 50 -> Dengan titik ' . '" required>
                @error('uab')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Export Nilai Akhir</button>
        </form>
    </div>
@endsection
