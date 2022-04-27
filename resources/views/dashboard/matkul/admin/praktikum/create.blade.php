@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Praktikum</h1>
    </div>
    <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingpraktikum" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="jenispraktikum" class="form-label @error('jenispraktikum') is-invalid @enderror">Jenis Praktikum</label>
                <input type="text" class="form-control" id="jenispraktikum" name="jenispraktikum" required
                    value="{{ old('jenispraktikum') }}">
                @error('jenispraktikum')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
