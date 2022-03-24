@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Pilih Matkul</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a> --}}
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Matkul</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->matkul->namamatkul }}</td>
                        <td>{{ $jadwal->matkul->keterangan }}</td>
                        <td>{{ $jadwal->matkul->tahun_ajaran }}</td>
                        <td>
                            <a href="/dashboard/nilai/{{ $jadwal->matkul->namamatkul }}" class="badge bg-info">Pilih</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
