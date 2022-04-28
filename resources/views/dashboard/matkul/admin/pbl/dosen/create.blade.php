@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Dosen Tutor PBL</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <a href="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/editdosen" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingmatakuliah/{{ $matkul->kodematkul }}/settingkelompokpbl/editdosen" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="kelompok" class="form-label @error('kelompok') is-invalid @enderror">Kelompok</label>
                <select class="form-select" id="kelompok" name="kelompok">
                    @foreach ($kelompoks as $kelompok)
                        <option value="{{ $kelompok }}">{{ $kelompok }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Dosen</label>
                <select class="form-select" id="user_id" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
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
            <div class="mb-3">
                <label for="tanggal1" class="form-label @error('tanggal1') is-invalid @enderror">Tanggal Pelaksanaan Diskusi 1</label>
                <input type="date" class="form-control" id="tanggal1" name="tanggal1" required
                    value="{{ old('tanggal1') }}">
                @error('tanggal1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal2" class="form-label @error('tanggal2') is-invalid @enderror">Tanggal Pelaksanaan Diskusi 2</label>
                <input type="date" class="form-control" id="tanggal2" name="tanggal2" required
                    value="{{ old('tanggal2') }}">
                @error('tanggal2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $matkul->kodematkul }}">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
