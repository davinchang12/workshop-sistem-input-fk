@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai Lain</h1>
    </div>

    <a href="/dashboard/nilailain" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Edit Nilai SOCA</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('fail'))
        <div class="alert alert-danger" role="alert">
            {{ session('fail') }}
        </div>
    @endif

    @if (count($socas) > 0)
        @foreach ($namasocas as $namasoca)
            <div class="container mt-3 mb-3">
                <form action="/dashboard/nilailain/edit/soca/input" method="post">
                    @csrf
                    <p>SOCA : {{ $namasoca->namasoca }}</p>
                    <p>Pilih Mahasiswa : </p>
                    <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                        @foreach ($socas as $soca)
                            @if ($soca->namasoca == $namasoca->namasoca)
                                <option>{{ $soca->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Pilih</button>
                </form>
            </div>
        @endforeach
    @endif

    <script>
        feather.replace()
    </script>
@endsection
