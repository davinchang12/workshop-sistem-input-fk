@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Beri Kritik/Saran</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    {{-- <a href="/dashboard/kritikdansaran" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a> --}}

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/kritikdansaran" class="mb-5" enctype="multipart/form-data">
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
                <label for="kritik">Kritik</label>
                <textarea type="text" class="form-control @error('kritik') is-invalid @enderror" name="kritik" rows="3"></textarea>
                @error('kritik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="saran">Saran</label>
                <textarea type="text" class="form-control @error('saran') is-invalid @enderror" name="saran" rows="3"></textarea>
                @error('saran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul }}">
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
@endsection
