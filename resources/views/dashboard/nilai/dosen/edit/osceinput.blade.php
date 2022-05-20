<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unika | OSCE Input</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <form action="/dashboard/nilailain/edit/osce/simpan" method="post">
        @csrf
        <div class="container mt-3 mb-3 w-75">
            <input type="hidden" name="namaosce" id="namaosce" value="{{ $osces[0]->namaosce }}">
            <input type="hidden" name="nama" id="nama" value="{{ $osces[0]->name }}">
            <input type="hidden" name="nim" id="nim" value="{{ $osces[0]->nim }}">
            <input type="hidden" name="jumlahaspek" id="jumlahaspek" value="{{ count($osces) }}">
            <div class="d-flex justify-content-between">
                <a href="/dashboard/nilailain/edit/osce" class="btn btn-success mt-3">Kembali</a>
                <button type="submit" class="btn btn-primary mt-3 ml-2">Submit Nilai</button>
            </div>

            <div class="container mt-3 mb-3 w-75">
                <table cellspacing="0" border="0">
                    <tr>
                        <td colspan=9 align="center" valign=middle>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                    line-height:normal'><b><span style='font-size:14.0pt'>Lembar Penilaian OSCE</span></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=9 align="center" valign=middle>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                    line-height:normal'><b><span style='font-size:14.0pt'>{{ $osces[0]->namaosce }}</span></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=1 align="left" valign=middle>Penguji :</td>
                        <td colspan=1 align="left" valign=middle>{{ $penguji }}<br></td>
                    </tr>
                    <tr>
                        <td colspan=1 align="left" valign=middle>Nama Mahasiswa :</td>
                        <td colspan=1 align="left" valign=middle>{{ $osces[0]->name }}<br></td>
                    </tr>
                    <tr>
                        <td colspan=1 align="left" valign=middle>NIM :</td>
                        <td colspan=1 align="left" valign=middle>{{ $osces[0]->nim }}<br></td>
                    </tr>

                    <tr>
                        <td style="border : 1px solid black" rowspan=2 align="center" valign=middle><b>No.</b></td>
                        <td style="border : 1px solid black" colspan=2 rowspan=2 align="center" valign=middle><b>Aspek
                                yang Dinilai</b></td>
                        <td style="border : 1px solid black" rowspan=2 align="center" valign=middle><b>Bobot</b></td>
                        <td style="border : 1px solid black" colspan=3 rowspawn=2 align="center" valign=middle>
                            <b>Nilai<br>0-2</b>
                        </td>
                        <td style="border : 1px solid black" rowspan=2 align="center" valign=middle><b>TOTAL<br> BOBOT X
                                SKOR</b></td>
                    </tr>
                    <tr>
                        @php
                            $totalbobot = 0;
                            $totalskor = 0;
                            $jenis_aspek = array();
                        @endphp
                        @foreach ($osces as $osce)
                        @php
                            $totalbobot += (int) $osce->bobot;
                            $totalskor += (int) $osce->bobot * (int) $osce->skor_osce;
                            array_push($jenis_aspek, str_replace(',', '_', str_replace(')', '_', str_replace('(', '_', str_replace(' ', '_', strtolower($osce->aspekdinilaiosce))))))
                        @endphp
                    <tr>
                        <td style="border : 1px solid black" align="middle" valign=middle>{{ $loop->iteration }}.<br>
                        </td>
                        <td style="border : 1px solid black" align="justify" colspan=2 valign=middle>
                            {{ $osce->aspekdinilaiosce }}<br></td>
                        <td style="border : 1px solid black" align="middle" valign=middle>

                            <p class=MsoNormal
                                id="{{ str_replace(',', '_', str_replace(')', '_', str_replace('(', '_', str_replace(' ', '_', strtolower($osce->aspekdinilaiosce))))) . '_bobot' }}"
                                align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>{{ $osce->bobot }}</span></p>
                        </td>
                        <td colspan=3 style="border : 1px solid black" align="middle" valign=middle>

                            <input type="number"
                                name="{{ str_replace(',', '_', str_replace(')', '_', str_replace('(', '_', str_replace(' ', '_', strtolower($osce->aspekdinilaiosce))))) }}"
                                id="{{ str_replace(',', '_', str_replace(')', '_', str_replace('(', '_', str_replace(' ', '_', strtolower($osce->aspekdinilaiosce))))) }}"
                                max="2" min="0" style="border: none; font-size:18px; width:100%; text-align: center;"
                                onchange="calculateBobot({{ str_replace(',', '_', str_replace(')', '_', str_replace('(', '_', str_replace(' ', '_', strtolower($osce->aspekdinilaiosce))))) }}), calculateNilaiOSCE()"
                                value="{{ $osce->skor_osce }}">

                        </td>
                        <td style="border : 1px solid black" align="middle" valign=middle>
                            <p id="{{ str_replace(',', '_', str_replace(')', '_', str_replace('(', '_', str_replace(' ', '_', strtolower($osce->aspekdinilaiosce))))) . '_total' }}"
                                align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'>{{ (int) $osce->bobot * (int) $osce->skor_osce }}</p>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan=3 rowspan=3 style="border :1px solid black" align="center" valign=middle><b><span
                                    style='font-size:14.0pt'>Nilai : Total Skor : (Total Bobot x 2) x 100% = </span></b>
                        </td>
                        <td colspan=1 rowspan=3 style="border :1px solid black" align="center" valign=middle><b><span
                                    style='font-size:14.0pt'>
                                    {{-- <input type="radio"
                                            name="hitungnilai"
                                            id="hitungnilai" 
                                            max="2"
                                            min="0" 
                                            style="border: none; font-size:18px; width:100%; text-align: center;"
                                            onchange="calculateNilaiOSCE()"> --}}
                                </span></b>
                        </td>

                        <td colspan=5 rowspan=3 style="border :1px solid black" align="center" valign=middle><b>
                                <span name="_nilaiosce" id='_nilaiosce'
                                    style="border: none; font-size:18px; width:100%; text-align: center;">{{ $osces[0]->nilaiosce }}</span>

                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                    </tr>
                    <tr>
                    <tr>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                        <td align="left" valign=bottom></td>
                    </tr>
                    <tr>
                        <td colspan=3 align="left" valign=bottom>Keterangan Prosedur</td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                    </tr>
                    <tr>
                        <td align="left" valign=bottom>Skor 0</td>
                        <td colspan=2 align="left" valign=bottom>: Tidak dilakukan</td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                    </tr>
                    <tr>
                        <td align="left" valign=bottom>Skor 1</td>
                        <td colspan=2 align="left" valign=bottom>: Dilakukan tidak sempurna</td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                    </tr>
                    <tr>
                        <td align="left" valign=bottom>Skor 2</td>
                        <td colspan=2 align="left" valign=bottom>: Dilakukan dengan sempurna</td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                    </tr>
                    <tr>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                        <td align="left" valign=bottom><br></td>
                    </tr>
                </table>
            </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        var totalskor = Number('<?php echo json_encode($totalbobot); ?>');
        var totalbobot = Number('<?php echo json_encode($totalskor); ?>');
        var nilai = 0;
        var jenis_2 = <?php echo json_encode($jenis_aspek); ?>;

        function calculateBobot(jenis) {

            console.log(jenis.id);
            var skor = document.getElementById(jenis.id).value;
            var bobot = document.getElementById(jenis.id + "_bobot").textContent;
            var totalResult = document.querySelector("#" + jenis.id + "_total");

            var total = Number(skor) * Number(bobot);
            totalbobot += Number(bobot);
            totalskor += total;
            totalResult.innerHTML = total;

            if (!jenis_2.includes(jenis.id)) {
                jenis_2.push(jenis.id)
            }

            calculateNilaiOSCE();

        }

        function calculateNilaiOSCE() {
            // var totalResult = document.querySelector('#_nilaiosce');
            // var nilai = (totalskor / (2*totalbobot))*100;
            // totalResult.innerHTML = nilai;
            // var nilai = Math.round(nilai * 100)/100;

            var tempTotalSkor = 0;
            var tempTotalBobot = 0;
            jenis_2.forEach(element => {
                // console.log(element);
                tempTotalBobot += Number(document.getElementById(element + '_bobot').textContent);
                tempTotalSkor += Number(document.querySelector('#' + element + '_total').innerHTML);
            });

            var tempTotal = (tempTotalSkor / (2 * tempTotalBobot)) * 100;

            var totalResult = document.querySelector("#_nilaiosce");
            totalResult.innerHTML = tempTotal;
        }
    </script>
</body>

</html>
