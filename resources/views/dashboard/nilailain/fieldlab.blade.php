@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai Fieldlab</h1>
    </div>
    <form action="/dashboard/nilailain/edit/fieldlab/simpan" method="post">
        @csrf
        <div class="d-flex justify-content-between">
            <a href="/dashboard/nilailain" class="btn btn-success"><span data-feather="arrow-left"></span>
                Kembali</a>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h5">Lihat Nilai</h3>
        </div>

        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <td>Kelompok</td>
                    <td>Semester</td>
                    <td>Nama</td>
                    <td>Nim</td>
                    <td>Total Nilai Dosbing</td>
                    <td>Total Nilai Penguji</td>
                    <td>Total Nilai Dosen Luar</td>
                    <td>Nilai Akhir</td>
                    <td>Keterangan</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($fieldlabs as $fieldlab)
                    <tr>
                        <td>{{ $fieldlab->kelompok }}</td>
                        <td>{{ $fieldlab->semester }}</td>
                        <td>{{ $fieldlab->name }}</td>
                        <td>{{ $fieldlab->nim }}</td>
                        <td>
                            {{ $fieldlab->total_nilai_dosbing }}
                        </td>
                        <td>
                            {{ $fieldlab->total_nilai_penguji }}
                        </td>
                        <td>
                            {{ $fieldlab->total_nilai_penguji_2 }}
                        </td>
                        <td>
                            {{ $fieldlab->nilai_akhir }}
                        </td>
                        <td>
                            {{ $fieldlab->keterangan_akhir }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
@endsection
