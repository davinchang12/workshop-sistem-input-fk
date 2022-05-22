@extends('dashboard.layouts.main')
<script src="https://unpkg.com/feather-icons"></script>
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai {{ $namamatkul[0] }}</h1>
    </div>
    <form action="/dashboard/matkul/nilai/edit/feedbackutb/simpan" method="post">
        @csrf
        <div class="d-flex justify-content-between">
            <a href="/dashboard/matkul/{{ $kodematkul }}" class="btn btn-success"><span data-feather="arrow-left"></span>
                Kembali</a>

            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $kodematkul }}">
            <button class="btn btn-primary shadow-none">Simpan</button>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h5">Edit Nilai Feeback UTB</h3>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <td>No.</td>
                    <td>Nama</td>
                    <td>NIM</td>
                    <td>SKOR</td>
                    <td>Nama Topik</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($utbs as $utb)
                    <tr>
                        <input type="hidden" name="jenisfeedback[]" id="jenisfeedback[]" value="{{ $utb->jenisfeedback_id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $utb->name }}</td>
                        <td>
                            {{ $utb->nim }}
                            <input type="hidden" name="nim[]" id="nim[]" value="{{ $utb->nim }}">
                        </td>
                        <td>
                            <input type="number" max="100" min="0" step="0.01"
                                style="border: none; font-size:18px; width:100%; text-align: center;" name="skor[]"
                                id="skor[]" value="{{ $utb->skor }}">
                        </td>
                        <td>
                            {{ $utb->topik }}
                            <input type="hidden" name="topik[]" id="topik[]" value="{{ $utb->topik }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
    </form>
    <script>
        feather.replace()
    </script>
@endsection
