@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Soal OSCE</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingosce" class="btn btn-success">
            <span data-feather="arrow-left"></span> Kembali
        </a>

        <form action="/dashboard/settingosce/createsoal/export-template" method="get">
            @csrf
            <button class="btn btn-primary w-100 shadow-none"><span data-feather="download"></span> Download Template</button>
        </form>
    </div>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingosce/createsoal/tambah" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_osce" class="form-label">Nama OSCE</label>
                <select class="form-select" id="nama_osce" name="nama_osce">
                    @foreach ($namaosces as $namaosce)
                        <option value="{{ $namaosce->namaosce }}">{{ $namaosce->namaosce }}</option>
                    @endforeach
                </select>
            </div>

            <div class="modal-content mb-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import
                        Template</h5>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
