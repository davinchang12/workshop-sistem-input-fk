@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Dosen Penguji</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <a href="/dashboard/settingsoca" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingsoca/updatedosen" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_soca" class="form-label">Nama SOCA</label>
                <input type="text" class="form-control" id="nama_soca" name="nama_soca" value="{{ old('nama_soca', $socas[0]->namasoca) }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="nama_dosen" class="form-label">Nama Dosen</label>
                <select class="form-select" id="nama_dosen" name="nama_dosen" disabled>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->name }}" {{ $dosen->name == $socas[0]->nama_penguji ? "selected" : "" }}>{{ $dosen->name }}</option>
                    @endforeach

                    <input type="hidden" name="nama_dosen" id="nama_dosen" value="{{ $socas[0]->nama_penguji }}">
                </select>
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
                                                            {{ in_array($user->id, $socas->pluck('user_id')->toArray()) ? 'checked' : '' }}>
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

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
