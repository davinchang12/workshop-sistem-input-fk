@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
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
        <div class="container">
            <div class="row">
                @foreach ($jadwals as $jadwal)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->matkul->namamatkul }}</td>
                        <td>{{ $jadwal->matkul->keterangan }}</td>
                        <td>{{ $jadwal->matkul->tahun_ajaran }}</td>
                        <td>
                            {{-- <a href="/dashboard/nilai/input{{ $jadwal->matkul->namamatkul }}" class="badge bg-info">Input</a>
                            </form> --}}
                            <a href="/dashboard/nilai/lihat{{ $jadwal->matkul->namamatkul }}" class="badge bg-info"><span data-feather="eye"></span></a>
                            </form>
                            @can('dosen')
                                <a href="/dashboard/dosen/nilai" class="badge bg-info"><span data-feather="settings"></span></a>
                            </form>
                            @endcan
                            @can('admin')
                                <a href="/dashboard/admin/nilai/edit" class="badge bg-info"><span data-feather="key"></span></a>
                            </form>
                            @endcan

                                

                        </td>
                    </tr>
  
                {{-- <div class="col-md-4 mb-3">
                        <a href="/dashboard/nilai/{{ $jadwal->matkul->namamatkul }}" class="text-decoration-none text-dark">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal->matkul->namamatkul }}</h5>
                                <small>Tahun Ajaran : {{ $jadwal->matkul->tahun_ajaran }}</small>
                            </div>
                        </div>
                    </a>
                    </div> --}}

                @endforeach
            </div>
        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
