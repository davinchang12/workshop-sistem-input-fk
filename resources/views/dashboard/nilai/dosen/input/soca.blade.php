<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unika | SOCA Input</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <form action="/dashboard/matkul/nilai/input-soca-submit" method="post">
        @csrf
        <div class="container mt-3 mb-3 w-75">
            <input type="hidden" name="namasoca" id="namasoca" value="{{ $socas[0]->namasoca }}">
            <input type="hidden" name="nama" id="nama" value="{{ $socas[0]->name }}">
            <input type="hidden" name="nim" id="nim" value="{{ $socas[0]->nim }}">
            <input type="hidden" name="jumlah_ke_2" id="jumlah_ke_2" value="{{ count($socas_2) }}">
            <div class="d-flex justify-content-between">
                <a href="/dashboard/nilailain" class="btn btn-success mt-3">Kembali</a>
                <button type="submit" class="btn btn-primary mt-3 ml-2">Submit Nilai</button>
            </div>
            <div class=WordSection1>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><span lang=IN style='font-size:14.0pt'>Checklist SOCA
                            {{ $socas[0]->keterangan }}</span></b></p>

                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><u><span
                                style='font-size:14.0pt'>{{ $socas[0]->namasoca }}</span></u></b></p>

                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><u><span style='font-size:14.0pt'><span
                                    style='text-decoration:none'><br></span></u></b></p>

                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                line-height:normal'><b><u><span style='font-size:14.0pt'><span
                                    style='text-decoration:none'><br></span></u></b></p>

                <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=100%
                    style='margin-left:.1pt;border-collapse:collapse'>
                    <tr style='height:22.5pt'>
                        <td width=422 colspan=2 style='width:316.75pt;border:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:22.5pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nama
                                    Mahasiswa: {{ $socas[0]->name }}</b></p>
                        </td>
                        <td width=274 colspan=3 style='width:205.75pt;border:solid black 1.0pt;
                                  border-left:none;padding:.75pt 4.9pt 0in 4.9pt;height:22.5pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>NIM :
                                    {{ $socas[0]->nim }}</b></p>
                        </td>
                    </tr>
                    <tr style='height:22.8pt'>
                        <td width=697 colspan=5 style='width:522.5pt;border:solid black 1.0pt;
                                  border-top:none;padding:.75pt 4.9pt 0in 4.9pt;height:22.8pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nama
                                    Penguji: {{ $penguji }}</b></p>
                        </td>
                    </tr>
                    <tr style='height:14.55pt'>
                        <td width=48 style='width:.5in;border:solid black 1.0pt;border-top:none;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>No</span></b></p>
                        </td>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Analisa Kasus</span></b></p>
                        </td>
                        <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Skor (0-</span></b><b>10<span
                                        lang=IN>)</span></b>
                            </p>
                        </td>
                        <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Bobot</span></b></p>
                        </td>
                        <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b><span lang=IN>Total </span></b></p>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><b>(Skor x bobot)</b></p>
                        </td>
                    </tr>
                    <tr style='height:14.55pt'>
                        <td width=48 rowspan=3 style='width:.5in;border:solid black 1.0pt;border-top:
                                  none;padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                            <p class=MsoNormal align=center style='text-align:center'><span lang=IN>I</span></p>
                        </td>
                        <td width=374 valign=bottom style='width:280.75pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>Kemampuan
                                    analisa
                                    masalah</span></p>
                        </td>
                        <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt; text-align:center;'>
                        </td>
                        <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;background:gray;padding:
                                  .75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                        </td>
                        <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  background:gray;padding:.75pt 4.9pt 0in 4.9pt;height:14.55pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                        </td>
                    </tr>
                    <tr style='height:20.85pt'>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:20.85pt'>
                            <p class=MsoListParagraph style='margin-top:0in;margin-right:0in;margin-bottom:
                                  0in;margin-left:.2in;text-indent:-.2in;line-height:normal'><span lang=IN>1.<span
                                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
                                    lang=IN>Overview
                                    masalah </span></p>
                        </td>
                        <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:20.85pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><input type="number" name="overview_masalah"
                                    id="overview_masalah" max="10" min="0"
                                    style="border: none; font-size:18px; width:100%; text-align: center;"
                                    onchange="calculateOverviewMasalah()"></p>
                        </td>
                        <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:20.85pt'>
                            <p class="MsoNormal" id="overview_masalah_bobot" align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'>
                                {{ $socas->where('keterangan_soca', 'Overview Masalah')->first()->bobot }}</p>
                        </td>
                        <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:20.85pt'>
                            <p class="MsoNormal" id="overview_masalah_total" align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'></p>
                        </td>
                    </tr>
                    <tr style='height:15.75pt'>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:15.75pt'>
                            <p class=MsoListParagraph style='margin-top:0in;margin-right:0in;margin-bottom:
                                  0in;margin-left:.2in;text-indent:-.2in;line-height:normal'><span lang=IN>2.<span
                                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
                                    lang=IN>Analisis masalah </span></p>
                        </td>
                        <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:15.75pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><input type="number" name="analisis_masalah"
                                    id="analisis_masalah" max="10" min="0"
                                    style="border: none; font-size:18px; width:100%; text-align: center;"
                                    onchange="calculateAnalisisMasalah()"></p>
                        </td>
                        <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:15.75pt'>
                            <p class="MsoNormal" id="analisis_masalah_bobot" align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span
                                    lang=IN>{{ $socas->where('keterangan_soca', 'Analisis Masalah')->first()->bobot }}</span>
                            </p>
                        </td>
                        <td width=126 valign=bottom style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:15.75pt'>
                            <p class=MsoNormal id="analisis_masalah_total" align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'></p>
                        </td>
                    </tr>
                    <tr style='height:.6in'>
                        <td width=48 rowspan={{ count($socas_2) + 1 }} style='width:.5in;border:solid black 1.0pt;border-top:
                                  none;padding:.75pt 4.9pt 0in 4.9pt;height:.6in'>
                            <p class=MsoNormal align=center style='text-align:center'><span lang=IN>II</span></p>
                        </td>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:.6in'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>Kemampuan
                                    mengaplikasikan pengetahuan ilmu dasar untuk menjelaskan
                                    terjadinya penyakit sesuai dengan skenario)</span></p>
                        </td>
                        <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:.6in'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN style='color:#595959'>&nbsp;</span></p>
                        </td>
                        <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;background:gray;padding:
                                  .75pt 4.9pt 0in 4.9pt;height:.6in'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                        </td>
                        <td width=126 valign=top style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  background:gray;padding:.75pt 4.9pt 0in 4.9pt;height:.6in'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>&nbsp;</span></p>
                        </td>
                    </tr>

                    @foreach ($socas_2 as $soca)
                        <tr style='height:13.7pt'>
                            <td width=374 v align=bottom style='width:280.75pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:13.7pt'>
                                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
                                        lang=IN>{{ $loop->iteration }}. </span>{{ $soca->keterangan_soca }}
                                </p>
                            </td>
                            <td width=82 style='width:61.55pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:13.7pt'>
                                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'>
                                    <input type="number"
                                        name="{{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) }}"
                                        id="{{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) }}" max="10"
                                        min="0" style="border: none; font-size:18px; width:100%; text-align: center;"
                                        onchange="calculateKemampuanPengaplikasian({{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) }})">
                                </p>
                            </td>
                            <td width=66 style='width:49.5pt;border-top:none;border-left:none;border-bottom:
                                  solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:13.7pt'>
                                <p class=MsoNormal
                                    id="{{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) . '_bobot' }}"
                                    align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>{{ $soca->bobot }}</span></p>
                            </td>
                            <td width=126 style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:13.7pt'>
                                <p class=MsoNormal
                                    id="{{ str_replace(' ', '_', strtolower($soca->keterangan_soca)) . '_total' }}"
                                    align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'></p>
                            </td>
                        </tr>
                    @endforeach
                    <tr style='height:37.5pt'>
                        <td width=570 colspan=4 style='width:427.8pt;border:solid black 1.0pt;
                                  border-top:none;padding:.75pt 4.9pt 0in 4.9pt;height:37.5pt'>
                            <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right'><b>Total
                                    Jumlah</b><span lang=IN> = </span></p>
                            <p class=MsoNormal style='margin-bottom:0in'>&nbsp;</p>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nilai
                                    akhir (Jumlah Total : 2) = ………………</b></p>
                        </td>
                        <td width=126 valign=top style='width:94.7pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:37.5pt'>
                            <p class=MsoNormal id="total_jumlah" align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'></p>
                        </td>
                    </tr>
                    <tr style='height:35.75pt'>
                        <td width=48 rowspan=4 style='width:.5in;border:solid black 1.0pt;border-top:
                                  none;padding:.75pt 4.9pt 0in 4.9pt;height:35.75pt'>
                            <p class=MsoNormal align=center style='text-align:center'><span lang=IN>III</span></p>
                        </td>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:35.75pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Keterampilan saat presentasi</span></p>
                        </td>
                        <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  padding:.75pt 4.9pt 0in 4.9pt;height:35.75pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Memuaskan/</span></p>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Tidak memuaskan</span></p>
                        </td>
                        <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:35.75pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
                                  line-height:normal'><span lang=IN>Komentar</span></p>
                        </td>
                    </tr>
                    <tr style='height:14.55pt'>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>1.
                                    Sikap</span></p>
                        </td>
                        <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;height:14.55pt'>
                            <select name="sikap_keterangan" id="sikap_keterangan"
                                style="border:none; width:100%; font-size:18px; text-align:center;" required>
                                <option disabled selected value></option>
                                <option value="memuaskan" title="Memuaskan">Memuaskan</option>
                                <option value="tidak_memuaskan" title="Tidak Memuaskan">Tidak Memuaskan</option>
                            </select>
                        </td>
                        <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:14.55pt'>
                            <input type="text" name="sikap_komentar" id="sikap_komentar" max="10" min="0"
                                style="border: none; font-size:18px; width:100%;">
                        </td>
                    </tr>
                    <tr style='height:14.55pt'>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>2. Kemampuan
                                    berkomunikasi</span></p>
                        </td>
                        <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;height:14.55pt'>
                            <select name="kemampuan_berkomunikasi_keterangan" id="kemampuan_berkomunikasi_keterangan"
                                style="border:none; width:100%; font-size:18px; text-align:center;" required>
                                <option disabled selected value></option>
                                <option value="memuaskan" title="Memuaskan">Memuaskan</option>
                                <option value="tidak_memuaskan" title="Tidak Memuaskan">Tidak Memuaskan</option>
                            </select>
                        </td>
                        <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:14.55pt'>
                            <input type="text" name="kemampuan_berkomunikasi_komentar"
                                id="kemampuan_berkomunikasi_komentar" max="10" min="0"
                                style="border: none; font-size:18px; width:100%;">
                        </td>
                    </tr>
                    <tr style='height:14.55pt'>
                        <td width=374 style='width:280.75pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:.75pt 4.9pt 0in 4.9pt;
                                  height:14.55pt'>
                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span lang=IN>3. Sistematika
                                    penyajian</span></p>
                        </td>
                        <td width=148 colspan=2 style='width:111.05pt;border-top:none;border-left:
                                  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;height:14.55pt'>
                            <select name="sistematika_penyajian_keterangan" id="sistematika_penyajian_keterangan"
                                style="border:none; width:100%; font-size:18px; text-align:center;" required>
                                <option disabled selected value></option>
                                <option value="memuaskan" title="Memuaskan">Memuaskan</option>
                                <option value="tidak_memuaskan" title="Tidak Memuaskan">Tidak Memuaskan</option>
                            </select>
                        </td>
                        <td width=126 style='width:94.7pt;border-top:none;border-left:none;
                                  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
                                  height:14.55pt'>
                            <input type="text" name="sistematika_penyajian_komentar" id="sistematika_penyajian_komentar"
                                max="10" min="0" style="border: none; font-size:18px; width:100%;">
                        </td>
                    </tr>
                    <tr style='height:71.45pt'>
                        <td width=697 colspan=5 valign=top style='width:522.5pt;border:solid black 1.0pt;
                                  border-top:none;padding:.75pt 4.9pt 0in 4.9pt;height:71.45pt'>
                            <p class=MsoNormal><span lang=ES>Hasil Penilaian Keterampilan presentasi &amp;
                                    sikap</span></p>
                            <textarea name="hasil_penilaian_keterampilan_presentasi_dan_sikap" id="hasil_penilaian_keterampilan_presentasi_dan_sikap" style="width: 100%"></textarea>
                        </td>
                    </tr>
                </table>

                <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
                                line-height:normal'><span lang=IN>&nbsp;</span></p>

                <p class=MsoNormal style='margin-bottom:0in;line-height:normal; text-align:right;'><span lang=IN>
                    </span>
                    <span lang=IN>Tanda Tangan Penguji,</span>
                </p>

                <p class=MsoNormal align=right style='text-align:right'>&nbsp;</p>

                <p class=MsoNormal align=right style='text-align:right'>&nbsp;</p>

                <p class=MsoNormal align=right style='text-align:right'>&nbsp;</p>

                <p class=MsoNormal style="text-align:right;"><span lang=IN>
                    </span>
                    <span lang=IN>(.....................................)</span>
                </p>

            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        var jumlahTotal = 0;
        var jenis_2 = ['overview_masalah', 'analisis_masalah'];

        function calculateOverviewMasalah() {
            var skor = document.getElementById('overview_masalah').value;
            var bobot = document.getElementById('overview_masalah_bobot').textContent;
            var totalResult = document.querySelector('#overview_masalah_total');

            var total = Number(skor) * Number(bobot);

            totalResult.innerHTML = total;

            calculateTotalJumlah();
        }

        function calculateAnalisisMasalah() {
            var skor = document.getElementById('analisis_masalah').value;
            var bobot = document.getElementById('analisis_masalah_bobot').textContent;
            var totalResult = document.querySelector('#analisis_masalah_total');

            var total = Number(skor) * Number(bobot);

            totalResult.innerHTML = total;

            calculateTotalJumlah();
        }

        function calculateKemampuanPengaplikasian(jenis) {
            var skor = document.getElementById(jenis.id).value;
            var bobot = document.getElementById(jenis.id + "_bobot").textContent;
            var totalResult = document.querySelector("#" + jenis.id + "_total");

            var total = Number(skor) * Number(bobot);

            totalResult.innerHTML = total;

            if(!jenis_2.includes(jenis.id)) {
                jenis_2.push(jenis.id)
            }

            calculateTotalJumlah();
        }

        function calculateTotalJumlah() {
            var tempTotal = 0;
            jenis_2.forEach(element => {
                tempTotal += Number(document.querySelector('#' + element + '_total').innerHTML);
            });
            var totalResult = document.querySelector("#total_jumlah");
            totalResult.innerHTML = tempTotal;
        }
    </script>
</body>

</html>
