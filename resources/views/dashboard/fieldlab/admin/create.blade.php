@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Kelompok</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <a href="/dashboard/settingfieldlab" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingfieldlab" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Dosen</label>
                <select class="form-select" id="user_id" name="user_id">
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="semester" class="form-label @error('semester') is-invalid @enderror">Semester</label>
                <input type="text" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" required>
                @error('semester')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label @error('keterangan') is-invalid @enderror">Tahun Ajaran</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

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
                                                            {{ in_array($user->id, $fieldlabs->pluck('user_id')->toArray()) ? 'checked disabled' : '' }}>
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

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
