@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai Lain</h1>
    </div>

    <a href="/dashboard/nilailain" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h5">Edit Nilai OSCE</h3>
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

    @if (count($osces) > 0)
        <div class="container mt-3 mb-3">
            <form action="/dashboard/nilailain/edit/osce/input" method="post">
                @csrf
                <p>Pilih Mahasiswa : </p>
                <select class="form-select" id="mahasiswa_dipilih" name="mahasiswa_dipilih">
                    <option selected>{{ $osces[0]->name }}</option>
                    @foreach ($osces->skip(1) as $osce)
                        <option>{{ $osce->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    @endif

    <script>
        feather.replace()
    </script>
@endsection
