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
    <div class="container mt-3 mb-3 w-75">
        <div class="d-flex justify-content-between">
            <a href="/dashboard/nilailain" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
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
                    @endphp
                    @foreach ($osces as $osce)
                        @php
                            $totalbobot += (int) $osce->bobot;
                            $totalskor += (int) $osce->bobot * (int) $osce->skor_osce;
                        @endphp
                <tr>
                    <td style="border : 1px solid black" align="middle" valign=middle>{{ $loop->iteration }}.<br>
                    </td>
                    <td style="border : 1px solid black" align="justify" colspan=2 valign=middle>
                        {{ $osce->aspekdinilaiosce }}<br></td>
                    <td style="border : 1px solid black" align="middle" valign=middle>

                        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>{{ $osce->bobot }}</span></p>
                    </td>
                    <td colspan=3 style="border : 1px solid black" align="middle" valign=middle>
                        <p align=center style='margin-bottom:0in;text-align:center;
                        line-height:normal'>{{ $osce->skor_osce }}</p>
                    </td>
                    <td style="border : 1px solid black" align="middle" valign=middle>
                        <p align=center style='margin-bottom:0in;text-align:center;
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
</body>

</html>
