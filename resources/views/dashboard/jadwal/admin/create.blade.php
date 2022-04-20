@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Jadwal</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <a href="/dashboard/settingjadwal" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingjadwal" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="matkul_id" class="form-label @error('matkul_id') is-invalid @enderror">Nama Mata
                    Kuliah</label>
                <select class="form-select" id="matkul_id" name="matkul_id">
                    @foreach ($matkuls as $matkul)
                        <option value="{{ $matkul->id }}">{{ $matkul->namamatkul }}</option>
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
                <label for="tanggal" class="form-label @error('tanggal') is-invalid @enderror">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required
                    value="{{ old('tanggal') }}">
                @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jammasuk" class="form-label @error('jammasuk') is-invalid @enderror">Jam Masuk</label>
                <input type="time" class="form-control" id="jammasuk" name="jammasuk" required
                    value="{{ old('jammasuk') }}">
                @error('jammasuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jamselesai" class="form-label @error('jamselesai') is-invalid @enderror">Jam Selesai</label>
                <input type="time" class="form-control" id="jamselesai" name="jamselesai" required
                    value="{{ old('jamselesai') }}">
                @error('jamselesai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ruangan" class="form-label @error('ruangan') is-invalid @enderror">Ruangan</label>
                <input type="text" class="form-control" id="ruangan" name="ruangan" value="{{ old('ruangan') }}">
                @error('ruangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
