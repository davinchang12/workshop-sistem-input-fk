@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelompok Field Lab</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/dashboard/settingfieldlab" class="btn btn-success"><span
        data-feather="arrow-left"></span> Kembali</a>

    <div class="container mt-3">
        <div class="row">
            @if ($kelompoks != null)
                @foreach ($kelompoks as $kelompok)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">
                                            Kelompok {{ $kelompok->kelompok }}
                                        </h5>
                                        <small>Anggota :</small><br>
                                        @foreach ($fieldlabs as $fieldlab)
                                            @if ($fieldlab->kelompok == $kelompok->kelompok)
                                                <small><b>{{ $fieldlab->name }}</b></small><br>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-auto p-auto">
                                        <div class="col">
                                            <form action="/dashboard/settingfieldlab/deletekelompok"
                                                method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="kelompok" id="kelompok" value="{{ $kelompok->kelompok }}">
                                                <input type="hidden" name="semester" id="semester" value="{{ $kelompok->semester }}">
                                                <button class="btn btn-danger w-100 shadow-none"
                                                    onclick="return confirm('Are you sure?')"><span data-feather="x-circle"
                                                        style="height:24px;"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        feather.replace();
    </script>
@endsection
