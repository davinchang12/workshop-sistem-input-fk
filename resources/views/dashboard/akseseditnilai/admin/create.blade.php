@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Akses</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <a href="/dashboard/akseseditnilai" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/akseseditnilai" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Dosen</label>
                <select class="form-select" id="user_id" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jenisnilai" class="form-label @error('jenisnilai') is-invalid @enderror">Jenis Nilai</label>
                <select class="form-select" id="jenisnilai" name="jenisnilai">
                    <option value="tugas">Tugas</option>
                    <option value="praktikum">Praktikum</option>
                    <option value="pbl">PBL</option>
                    <option value="ujian">Ujian</option>
                    <option value="fieldlab">Field Lab</option>
                    <option value="osce">OSCE</option>
                    <option value="soca">SOCA</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="passwordakses" class="form-label @error('passwordakses') is-invalid @enderror">Password Akses</label>
                <input type="text" class="form-control" id="passwordakses" name="passwordakses" value="{{ old('passwordakses') }}">
                @error('passwordakses')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
