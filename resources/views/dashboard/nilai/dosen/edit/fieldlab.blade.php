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

            <button class="btn btn-primary shadow-none">Simpan</button>

        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h5">Edit Nilai</h3>
        </div>

        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <td>No</td>
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
                @php
                    $count = 1;
                @endphp
                @foreach ($fieldlabs as $fieldlab)
                    <tr>
                        <input type="hidden" name="fieldlab_id[]" id="fieldlab_id[]" value="{{ $fieldlab->nilai_field_lab_id }}">
                        <td>{{ $count }}</td>
                        <td>{{ $fieldlab->kelompok }}</td>
                        <td>{{ $fieldlab->semester }}</td>
                        <td>{{ $fieldlab->name }}</td>
                        <td>{{ $fieldlab->nim }}</td>
                        <td>
                            <input type="number" max="100" min="0" step="0.01"
                                style="border: none; font-size:18px; width:100%; text-align: center;"
                                name="total_nilai_dosbing[]" id="total_nilai_dosbing[]"
                                value="{{ $fieldlab->total_nilai_dosbing }}" onchange="calculateNilaiAkhir()">
                        </td>
                        <td>
                            <input type="number" max="100" min="0" step="0.01"
                                style="border: none; font-size:18px; width:100%; text-align: center;"
                                name="total_nilai_penguji[]" id="total_nilai_penguji[]"
                                value="{{ $fieldlab->total_nilai_penguji }}" onchange="calculateNilaiAkhir()">
                        </td>
                        <td>
                            <input type="number" max="100" min="0" step="0.01"
                                style="border: none; font-size:18px; width:100%; text-align: center;"
                                name="total_nilai_penguji_2[]" id="total_nilai_penguji_2[]"
                                value="{{ $fieldlab->total_nilai_penguji_2 }}" onchange="calculateNilaiAkhir()">
                        </td>
                        <td>
                            <input type="number" max="100" min="0" step="0.01"
                                style="border: none; font-size:18px; width:100%; text-align: center;" name="nilai_akhir[]"
                                id="nilai_akhir[]" value="{{ $fieldlab->nilai_akhir }}">
                        </td>
                        <td>
                            <input type="text" style="border: none; font-size:18px; width:100%; text-align: center;"
                                name="keterangan_akhir[]" id="keterangan_akhir[]"
                                value="{{ $fieldlab->keterangan_akhir }}">
                        </td>
                    </tr>
                    @php
                        $count++;
                    @endphp
                    <input type="hidden" name="count" id="count" value="{{ $count }}">
                @endforeach
            </tbody>
        </table>
    </form>

    <script type="text/javascript">
        function calculateNilaiAkhir() {
            var total_nilai_dosbing = document.getElementsByName('total_nilai_dosbing[]');
            var total_nilai_penguji = document.getElementsByName('total_nilai_penguji[]');
            var total_nilai_penguji_2 = document.getElementsByName('total_nilai_penguji_2[]');
            var nilai_akhir = document.getElementsByName('nilai_akhir[]');
            var keterangan_akhir = document.getElementsByName('keterangan_akhir[]');

            console.log(total_nilai_penguji_2[0].value);

            var nilaiakhir = [];
            for (var k = 0; k < total_nilai_dosbing.length; k++) {
                var a = Number(total_nilai_dosbing[k].value);
                var b = Number(total_nilai_penguji[k].value);
                var c = Number(total_nilai_penguji_2[k].value);

                if (c == 0) {
                    var tempNilaiAkhir = (a * 0.5) + (b * 0.5);

                    nilaiakhir.push(tempNilaiAkhir);
                } else {
                    var tempNilaiAkhir = (a * 0.5) + (b * 0.25) + (c * 0.25);

                    nilaiakhir.push(tempNilaiAkhir);
                }
            }

            for (var i = 0; i < nilaiakhir.length; i++) {
                nilai_akhir[i].value = nilaiakhir[i];
                if(nilaiakhir[i] >= 80) {
                    keterangan_akhir[i].value = "LULUS";
                } else {
                    keterangan_akhir[i].value = "TIDAK LULUS";
                }
            }
        }
    </script>
@endsection
