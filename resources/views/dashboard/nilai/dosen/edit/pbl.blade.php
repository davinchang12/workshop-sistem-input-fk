<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        body,
        div,
        table,
        thead,
        tbody,
        tfoot,
        tr,
        th,
        td,
        p {
            font-family: "Arial";
            font-size: x-small
        }

        a.comment-indicator:hover+comment {
            background: #ffd;
            position: absolute;
            display: block;
            border: 1px solid black;
            padding: 0.5em;
        }

        a.comment-indicator {
            background: red;
            display: inline-block;
            border: 1px solid black;
            width: 0.5em;
            height: 0.5em;
        }

        comment {
            display: none;
        }

    </style>

</head>

<body>
    <div class="container-fluid mt-3">
        <form action="/dashboard/matkul/nilai/edit/pbl/simpan" method="post" enctype="multipart/form-data">
            @csrf
            <table cellspacing="0" border="0">
                <colgroup width="99"></colgroup>
                <colgroup width="36"></colgroup>
                <colgroup width="326"></colgroup>
                <colgroup width="95"></colgroup>
                <colgroup width="99"></colgroup>
                <colgroup width="94"></colgroup>
                <colgroup width="102"></colgroup>
                <colgroup width="142"></colgroup>
                <colgroup width="110"></colgroup>
                <colgroup width="95"></colgroup>
                <colgroup width="63"></colgroup>
                <colgroup width="152"></colgroup>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 height="38" align="center" valign=bottom>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=11 rowspan=2 align="center" valign=middle><b>
                            <font size=6 color="#000000">NILAI DISKUSI BLOK {{ $blok }}</font>
                        </b></td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; writing-mode: vertical-rl; text-orientation: upright;"
                        rowspan=16 align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;"><b>
                            <font face="Calibri" size=7 color="#000000">{{ $skenarios[0]->kelompok }}</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b>
                            <font color="#000000"></font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">KELOMPOK </font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;"><b>
                            <font color="#000000">{{ $skenarios[0]->kelompok }}</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">SKENARIO:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;"><b>
                            <font color="#000000">{{ $skenario }}</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">DISKUSI: </font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle bgcolor="#FFFF00" sdval="1" sdnum="1033;"><b>
                            <font color="#000000">{{ $diskusi }}</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=4 align="center" valign=middle bgcolor="#000000"><b>
                            <font color="#000000"><br></font>
                        </b></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">DOSEN TUTOR </font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=5 align="left" valign=middle><b>
                            <font color="#000000">{{ $tutor }}</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">TANGGAL:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=3 align="center" valign=middle><b>
                            <font color="#000000">{{ date('d-m-Y', strtotime($tanggal_pelaksanaan)) }}
                            </font>
                            <input type="hidden" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" value="{{ $tanggal_pelaksanaan }}">
                        </b></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=4 align="center" valign=middle><b>
                            <font color="#000000">No</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=4 align="center" valign=middle><b>
                            <font color="#000000">Nama</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=4 align="center" valign=middle><b>
                            <font color="#000000">Nim</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=6 align="center" valign=middle><b>
                            <font color="#000000">Pekelompokan</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=4 align="center" valign=middle><b>
                            <font face="Calibri" color="#000000">Total</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=4 align="center" valign=middle><b>
                            <font face="Calibri" color="#000000">Rata-rata</font>
                        </b></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b>
                            <font color="#000000">KEHADIRAN</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b><i>
                                <font color="#000000">AKTIVITAS DISKUSI</font>
                            </i></b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b><i>
                                <font color="#000000">RELEVANSI PEMBICARAAN</font>
                            </i></b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b><i>
                                <font color="#000000">KETERAMPILAN BERKOMUNIKASI</font>
                            </i></b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b><i>
                                <font color="#000000">LAPORAN SEMENTARA</font>
                            </i></b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 align="center" valign=middle><b><i>
                                <font color="#000000">LAPORAN RESMI</font>
                            </i></b></td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">I</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">II</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">III</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">IV</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">V</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle><b>
                            <font color="#000000">VI</font>
                        </b></td>
                </tr>
                @php
                    $count = 1;
                @endphp
                @foreach ($kelompoks as $kelompok)
                    @if ($kelompok->role == 'mahasiswa')
                        <tr>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle" sdval="1" sdnum="1033;">
                                <font color="#000000">{{ $count }}</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <font face="Calibri" color="#000000">{{ $kelompok->name }}</font>
                                <input type="hidden" name="nama{{ $count }}"
                                    id="nama{{ $count }}" value="{{ $kelompok->name }}">
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <font face="Calibri" color="#000000">{{ $kelompok->nim }}</font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <select name="kehadiran{{ $count }}"
                                    id="kehadiran{{ $count }}"
                                    style="border:none; width:100%; font-size:18px; text-align:center;"
                                    onchange="calculateTotal({{ $count }})" required>
                                    <option value="4" title="Tepat Waktu" {{ $kelompok->kehadiran == 4 ? "selected" : "" }}>4</option>
                                    <option value="3" title="Terlambat 10 Menit" {{ $kelompok->kehadiran == 3 ? "selected" : "" }}>3</option>
                                    <option value="2" title="Terlambat 15 Menit" {{ $kelompok->kehadiran == 2 ? "selected" : "" }}>2</option>
                                    <option value="0" title="Tidak Hadir" {{ $kelompok->kehadiran == 0 ? "selected" : "" }}>0</option>
                                </select>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <select name="aktivitas_saat_diskusi{{ $count }}"
                                    id="aktivitas_saat_diskusi{{ $count }}"
                                    style="border:none; width:100%; font-size:18px; text-align:center;"
                                    onchange="calculateTotal({{ $count }})" required>
                                    <option value="4" title="Sangat Aktif" {{ $kelompok->aktivitas_saat_diskusi == 4 ? "selected" : "" }}>4</option>
                                    <option value="3" title="Cukup Aktif" {{ $kelompok->aktivitas_saat_diskusi == 3 ? "selected" : "" }}>3</option>
                                    <option value="2" title="Kurang AKtif" {{ $kelompok->aktivitas_saat_diskusi == 2 ? "selected" : "" }}>2</option>
                                    <option value="1" title="Pasif" {{ $kelompok->aktivitas_saat_diskusi == 1 ? "selected" : "" }}>1</option>
                                </select>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <select name="relevansi_pembicaraan{{ $count }}"
                                    id="relevansi_pembicaraan{{ $count }}"
                                    style="border:none; width:100%; font-size:18px; text-align:center;"
                                    onchange="calculateTotal({{ $count }})" required>
                                    <option value="4" title="Selalu Relevan" {{ $kelompok->relevansi_pembicaraan == 4 ? "selected" : "" }}>4</option>
                                    <option value="3" title="Cukup Relevan" {{ $kelompok->relevansi_pembicaraan == 3 ? "selected" : "" }}>3</option>
                                    <option value="2" title="Kadang Tidak Relevan" {{ $kelompok->relevansi_pembicaraan == 2 ? "selected" : "" }}>2</option>
                                    <option value="1" title="Sering Tidak Relevan" {{ $kelompok->relevansi_pembicaraan == 1 ? "selected" : "" }}>1</option>
                                </select>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <select name="keterampilan_berkomunikasi{{ $count }}"
                                    id="keterampilan_berkomunikasi{{ $count }}"
                                    style="border:none; width:100%; font-size:18px; text-align:center;"
                                    onchange="calculateTotal({{ $count }})" required>
                                    <option value="4" title="Sangat Baik" {{ $kelompok->keterampilan_berkomunikasi == 4 ? "selected" : "" }}>4</option>
                                    <option value="3" title="Baik" {{ $kelompok->keterampilan_berkomunikasi == 3 ? "selected" : "" }}>3</option>
                                    <option value="2" title="Cukup" {{ $kelompok->keterampilan_berkomunikasi == 2 ? "selected" : "" }}>2</option>
                                    <option value="1" title="Kurang" {{ $kelompok->keterampilan_berkomunikasi == 1 ? "selected" : "" }}>1</option>
                                </select>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle">
                                <input type="number" name="laporan_sementara{{ $count }}"
                                    id="laporan_sementara{{ $count }}" max="100" min="0"
                                    style="border: none; font-size:18px; width:100%; text-align: center;"
                                    onchange="calculateMean({{ $count }})" value="{{ $kelompok->laporan_sementara }}">
                            </td>

                            @if ($kelompok->diskusi == 1)
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    align="left" valign=bottom bgcolor="#000000">
                                    <input type="hidden" name="laporan_resmi{{ $count }}" id="laporan_resmi{{ $count }}" value="diskusi_1">
                                </td>
                            @else
                                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                    align="center" valign="middle" sdval="0" sdnum="1033;">
                                    <input type="number" name="laporan_resmi{{ $count }}"
                                    id="laporan_resmi{{ $count }}" max="100" min="0"
                                    style="border: none; font-size:18px; width:100%; text-align: center;"
                                    onchange="calculateMean({{ $count }})" value="{{ $kelompok->laporan_resmi }}">
                                </td>
                            @endif

                            
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle" sdval="0" sdnum="1033;">
                                <font face="Calibri" color="#000000">
                                    <span id="total{{ $count }}">{{ $kelompok->total }}</span>
                                </font>
                            </td>
                            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                                align="center" valign="middle" sdval="0" sdnum="1033;">
                                <font face="Calibri" color="#000000">
                                    <span id="mean{{ $count }}">{{ $kelompok->rata_rata }}</span>
                                </font>
                            </td>
                        </tr>
                        <input type="hidden" name="loop" id="loop" value="{{ $count }}">
                        @php
                            $count++;
                        @endphp
                        @endif
                @endforeach
            </table>

            <div class="d-flex justify-content-between">
                <table class="table table-bordered border-primary m-3 w-50">
                    <thead>
                        <tr>
                            <th colspan="8" style="text-align: center">Dasar Penilaian</th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="2" style="text-align: center">Kehadiran</th>
                            <th scope="col" colspan="2" style="text-align: center">Aktivitas Saat Diskusi</th>
                            <th scope="col" colspan="2" style="text-align: center">Relevansi Pembicaraan</th>
                            <th scope="col" colspan="2" style="text-align: center">Keterampilan Komunikasi</th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="2" style="text-align: center">Nilai</th>
                            <th scope="col" colspan="2" style="text-align: center">Nilai</th>
                            <th scope="col" colspan="2" style="text-align: center">Nilai</th>
                            <th scope="col" colspan="2" style="text-align: center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center">
                            <td>4</td>
                            <td>Tepat Waktu</td>
                            <td>4</td>
                            <td>Sangat Aktif</td>
                            <td>4</td>
                            <td>Selalu Relevan</td>
                            <td>4</td>
                            <td>Sangat Baik</td>
                        </tr>
                        <tr style="text-align: center">
                            <td>3</td>
                            <td>Terlambat 10 Menit</td>
                            <td>3</td>
                            <td>Cukup Aktif</td>
                            <td>3</td>
                            <td>Cukup Relevan</td>
                            <td>3</td>
                            <td>Baik</td>
                        </tr>
                        <tr style="text-align: center">
                            <td>2</td>
                            <td>Terlambat 15 Menit</td>
                            <td>2</td>
                            <td>Kurang Aktif</td>
                            <td>2</td>
                            <td>Kadang Tidak Relevan</td>
                            <td>2</td>
                            <td>Cukup</td>
                        </tr>
                        <tr style="text-align: center">
                            <td>0</td>
                            <td>Tidak Hadir</td>
                            <td>1</td>
                            <td>Pasif</td>
                            <td>1</td>
                            <td>Sering Tidak Relevan</td>
                            <td>1</td>
                            <td>Kurang</td>
                        </tr>
                    </tbody>
                </table>
                <div class=" mt-3 w-50">
                    <p><b>Catatan / Kesan Kegiatan Diskusi Tutorial</b></p>
                    <textarea class="w-100 h-75" name="catatan" id="catatan">{{ $kelompoks[0]->catatan_kesan_kegiatan_diskusi_tutorial }}</textarea>
                </div>
            </div>
            <input type="hidden" name="diskusi" id="diskusi" value="{{ $diskusi }}">
            <input type="hidden" name="skenario" id="skenario" value="{{ $skenario }}">
            <input type="hidden" name="kelompok_id" id="kelompok_id" value="{{ $kelompok_id }}">
            <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $kodematkul }}">
            <a href="/dashboard/matkul/{{ $kodematkul }}" class="btn btn-success mt-3">Kembali</a>
            <button type="submit" class="btn btn-primary mt-3 ml-2">Submit Nilai</button>
        </form>
    </div>
    <!-- ************************************************************************** -->
    <script type="text/javascript">
        function calculateTotal(id) {
            var kehadiran = document.getElementById('kehadiran' + id).value;
            var aktivitas_saat_diskusi = document.getElementById('aktivitas_saat_diskusi' + id).value;
            var relevansi_pembicaraan = document.getElementById('relevansi_pembicaraan' + id).value;
            var keterampilan_berkomunikasi = document.getElementById('keterampilan_berkomunikasi' + id).value;
            var totalResult = document.querySelector('#total' + id);

            var total = ((Number(kehadiran) + Number(aktivitas_saat_diskusi) + Number(relevansi_pembicaraan) + Number(
                keterampilan_berkomunikasi)) / 16) * 100;

            totalResult.innerHTML = total;
            return calculateMean(id);
        }

        function calculateMean(id) {
            var laporan_sementara = document.getElementById('laporan_sementara' + id).value;
            var laporan_resmi = document.getElementById('laporan_resmi' + id).value;
            var total = document.getElementById('total' + id).innerHTML;

            var meanResult = document.querySelector('#mean' + id);

            if(laporan_resmi == 'diskusi_1') {
                var mean = (Number(laporan_sementara) + Number(total)) / 2;
            } else {
                var mean = (Number(laporan_sementara) + Number(total) + Number(laporan_resmi)) / 3;
            }

            return meanResult.innerHTML = mean;
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
