@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nilai {{ $namamatkul }}</h1>
    </div>
    <form action="/dashboard/matkul/nilai/edit/tugas/simpan" method="post">
        @csrf
        <div class="d-flex justify-content-between">
            <a href="/dashboard/matkul/{{ $kodematkul }}" class="btn btn-success"><span data-feather="arrow-left"></span>
                Kembali</a>
            

            <input type="hidden" name="matkul_dipilih" id="matkul_dipilih" value="{{ $matkul_dipilih }}">
            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $kodematkul }}">
            <button class="btn btn-primary shadow-none">Simpan</button>

        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h5">Edit Nilai</h3>
        </div>
        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    @php
                        $keterangan = [];
                        $count = 0;
                    @endphp
                    @foreach ($topik_tugas as $topik)
                        <th scope="col">{{ $topik->keterangantugas }}</th>
                        @php
                            $count++;
                            array_push($keterangan, $topik->keterangantugas);
                        @endphp
                        <input type="hidden" name="keterangan[]" id="keterangan[]" value="{{ $topik->keterangantugas }}">
                    @endforeach
                    {{-- <th scope="col"></th> --}}
                    <th scope="col">Rata-Rata</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                    $y = 2;
                    $check = '';
                    $z = 0;
                    $len = 1;
                @endphp

                @foreach ($nilaitugas_dosen as $tugas)
                    @if ($check != $tugas->name)
                        @if ($check != '')
                            {{-- <td>{{ $tugas->rataratatugas }}</td> --}}
                            </tr>
                        @endif
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $tugas->name }}</td>
                            <td>
                                {{ $tugas->nim }}
                                <input type="hidden" name="user_nim[]" value="{{ $tugas->nim }}">
                            </td>
                            @php
                                $check = $tugas->name;
                                $x++;
                                $z = 1;
                            @endphp
                            <td>
                                <input type="number" max="100" min="0"
                                    style="border: none; font-size:18px; width:100%; text-align: center;" name="tugas1[]"
                                    id="tugas1[]"
                                    value="{{ $tugas->nilaitugas }}" onchange="calculateAVG()">
                            </td>
                        @else
                            <td>
                                <input type="number" max="100" min="0"
                                    style="border: none; font-size:18px; width:100%; text-align: center;"
                                    name="tugas{{ $y }}[]" id="tugas{{ $y }}[]" value="{{ $tugas->nilaitugas }}" onchange="calculateAVG()">
                                    <input type="hidden" name="totaltugas" id="totaltugas" value="{{ $y }}">
                            </td>
                            @php
                                $z++;
                                $y++;
                            @endphp
                    @endif
                    @if ($check == $tugas->name)
                        @if ($z == $count)
                            <td>
                                <input type="float" max="100" min="0"
                                style="border: none; font-size:18px; width:100%; text-align: center;"
                                name="ratarata[]" id="ratarata[]" value="{{ $tugas->rataratatugas }}" readonly="readonly">
                            </td>
                        @endif
                        @php
                            $y = 2;
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </form>

    <script type="text/javascript">
        function calculateAVG() {
            var total = "<?php echo $y; ?>";
            var tugas1 = document.getElementsByName('tugas1[]');
            var ratarata = document.getElementsByName('ratarata[]');

            var avg = [];
            var idx = 0;
            if (total > 1) {
                for(var i = 2; i <= total; i++) {
                    var tempAvg = 0;
                    var tugas = document.getElementsByName('tugas' + i + '[]');

                    for (var k = 0; k < tugas.length; k++) {
                        if(i == 2) {
                            var a = Number(tugas1[k].value);
                            var b = Number(tugas[k].value);
                            var tempAvg = a + b;

                            avg.push(tempAvg);
                        } else {
                            var c = Number(tugas[k].value);
                            avg[k] = avg[k] + c;
                        }
                    }
                }
            }

            for (var i = 0; i < avg.length; i++) {
                ratarata[i].value = avg[i] / total;
            }
        }
    </script>
@endsection
