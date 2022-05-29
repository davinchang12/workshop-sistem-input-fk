<div class="mt-3">
    <form action="/dashboard/matkul/nilai/import/praktikum-submit" method="post" enctype="multipart/form-data">
        @csrf
        <table cellspacing="0" border="0">
            <colgroup width="200"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="200"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="87"></colgroup>
            <colgroup width="200"></colgroup>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center" valign=bottom bgcolor="#92D050">
                    <font color="#000000"><br></font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center" valign=bottom bgcolor="#92D050">
                    <font color="#000000"><br></font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    colspan=9 height="19" align="center" valign=bottom bgcolor="#92D050">
                    <font color="#000000">NILAI</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="2"
                    align="center" valign=bottom bgcolor="#92D050">
                    <font color="#000000"><br></font>
                </td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 height="110" align="center" valign=middle bgcolor="#F4B183">
                    <font color="#000000">NAMA</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 height="110" align="center" valign=middle bgcolor="#F4B183">
                    <font color="#000000">NIM</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 height="110" align="center" valign=middle bgcolor="#F4B183">
                    <font color="#000000">RATA-RATA QUIZ</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#8FAADC">
                    <font color="#000000">RATA-RATA NILAI LAPORAN</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#FFD966">
                    <font color="#000000">NILAI RESPONSI</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#A9D18E">
                    <font color="#000000">NILAI AKHIR</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#96D0E2">
                    <font color="#000000">KETERANGAN</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#96D0E2">
                    <font color="#000000">KETERANGAN BERDASARKAN</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#BF9000">
                    <font color="#000000">Remedi</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                    <font color="#000000">Remedi Konversi</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                    <font color="#000000">Nilai Setelah Remedi</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                    <font color="#000000">Keterangan</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center" valign=middle bgcolor="#ADB9CA">
                    <font color="#000000">Keterangan Berdasarkan</font>
                </td>
            </tr>
            <tr>
            </tr>
            @foreach ($praktikums as $praktikum) 
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <font color="#000000">{{ $praktikum->name }}</font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <font color="#000000">{{ $praktikum->nim }}</font>
                        <input type="hidden" name="nim{{ $loop->iteration }}" id="nim{{ $loop->iteration }}" value="{{ $praktikum->nim }}">
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="rata-rata-quiz{{ $loop->iteration }}"
                            id="rata-rata-quiz{{ $loop->iteration }}" max="100" min="0"
                            style="border: none; font-size:18px; width:100%; text-align: center;" value="{{ $praktikum->rata_rata_quiz }}"
                            onchange="calculateNilaiAkhir({{ $loop->iteration }})" disabled>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="rata-rata-nilai-laporan{{ $loop->iteration }}"
                            id="rata-rata-nilai-laporan{{ $loop->iteration }}" max="100" min="0"
                            style="border: none; font-size:18px; width:100%; text-align: center;" value="{{ $praktikum->rata_rata_laporan }}"
                            onchange="calculateNilaiAkhir({{ $loop->iteration }})" disabled>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="nilai-responsi{{ $loop->iteration }}"
                            id="nilai-responsi{{ $loop->iteration }}" max="100" min="0"
                            style="border: none; font-size:18px; width:100%; text-align: center;" value="{{ $praktikum->nilai_responsi }}"
                            onchange="calculateNilaiAkhir({{ $loop->iteration }})" disabled>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="nilai-akhir{{ $loop->iteration }}"
                            id="nilai-akhir{{ $loop->iteration }}" max="100" min="0" value="{{ $praktikum->nilai_akhir }}"
                            style="border: none; font-size:18px; width:100%; text-align: center;" disabled>
                        
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=bottom>
                        <input list="keterangan_akhirs{{ $loop->iteration }}" name="keterangan_akhir{{ $loop->iteration }}" id="keterangan_akhir{{ $loop->iteration }}" value="{{ $praktikum->keterangan_nilai_akhir }}" style="border: none; font-size:18px; width:100%; text-align: center;">
                        <datalist id="keterangan_akhirs{{ $loop->iteration }}">
                            <option value="LULUS">
                            <option value="LULUS BILA DENGAN TUGAS">
                            <option value="TIDAK LULUS">
                        </datalist>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=bottom>
                        <input list="keterangan_akhir_berdasarkans{{ $loop->iteration }}" name="keterangan_akhir_berdasarkan{{ $loop->iteration }}" id="keterangan_akhir_berdasarkan{{ $loop->iteration }}" value="{{ $praktikum->keterangan_nilai_akhir_berdasarkan }}" style="border: none; font-size:18px; width:100%; text-align: center;">
                        <datalist id="keterangan_akhir_berdasarkans{{ $loop->iteration }}">
                            <option value="QUIZ">
                            <option value="LAPORAN">
                            <option value="RESPONSI">
                            <option value="NILAI AKHIR">
                        </datalist>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="remedi{{ $loop->iteration }}"
                            id="remedi{{ $loop->iteration }}" max="100" min="0"
                            style="border: none; font-size:18px; width:100%; text-align: center;" value="{{ $praktikum->remedi }}"
                            onchange="calculateNilaiAkhirSetelahRemedi({{ $loop->iteration }})" disabled>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="remedi-konversi{{ $loop->iteration }}"
                            id="remedi-konversi{{ $loop->iteration }}" max="100" min="0"
                            style="border: none; font-size:18px; width:100%; text-align: center;" value="{{ $praktikum->remedi_konversi }}"
                            onchange="calculateNilaiAkhirSetelahRemedi({{ $loop->iteration }})" disabled>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=middle>
                        <input type="number" name="nilai-setelah-remedi{{ $loop->iteration }}"
                            id="nilai-setelah-remedi{{ $loop->iteration }}" max="100" min="0" value="{{ $praktikum->nilai_setelah_remedi }}"
                            style="border: none; font-size:18px; width:100%; text-align: center;" disabled>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=bottom>
                        <input type="text" name="keterangan-nilai-setelah-remedi{{ $loop->iteration }}"
                            id="keterangan-nilai-setelah-remedi{{ $loop->iteration }}" value="{{ $praktikum->keterangan_nilai_setelah_remedi }}"
                            style="border: none; font-size:18px; width:100%; text-align: center;">
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center;"
                        align="center" valign=bottom>
                        <input list="keterangan_nilai_setelah_remedi_berdasarkans{{ $loop->iteration }}" name="keterangan_nilai_setelah_remedi_berdasarkan{{ $loop->iteration }}" id="keterangan_nilai_setelah_remedi_berdasarkan{{ $loop->iteration }}" value="{{ $praktikum->keterangan_nilai_setelah_remedi_berdasarkan }}" style="border: none; font-size:18px; width:100%; text-align: center;">
                        <datalist id="keterangan_nilai_setelah_remedi_berdasarkans{{ $loop->iteration }}">
                            <option value="QUIZ">
                            <option value="LAPORAN">
                            <option value="RESPONSI">
                            <option value="NILAI AKHIR">
                            <option value="NILAI SETELAH REMEDI">
                        </datalist>
                    </td>
                </tr>
                <input type="hidden" name="loop" id="loop" value="{{ $loop->iteration }}">
                <input type="hidden" name="kodematkul" id="kodematkul" value="{{ $praktikum->kodematkul }}">
            @endforeach
        </table>
        <input type="hidden" name="namapraktikum" id="namapraktikum" value={{ $praktikums[0]->namapraktikum }}>
        <button type="submit" class="btn btn-primary mt-3">Submit Nilai</button>
    </form>
</div>

<script type="text/javascript">
    function calculateNilaiAkhir(id) {
        var rata_rata_quiz = document.getElementById('rata-rata-quiz' + id).value;
        var rata_rata_laporan = document.getElementById('rata-rata-nilai-laporan' + id).value;
        var nilai_responsi = document.getElementById('nilai-responsi' + id).value;
        var nilaiAkhirResult = document.querySelector('#nilai-akhir' + id);

        var total = ((Number(rata_rata_quiz)*0.2) + (Number(rata_rata_laporan)*0.1) + (Number(nilai_responsi)*0.7));

        nilaiAkhirResult.value = total;

        getNilaiAkhirKeterangan(total, id);
    }

    function getNilaiAkhirKeterangan(num, id) {
        var keterangan = document.querySelector('#keterangan-nilai-akhir' + id);
        if (Number(num) >= 70) {
            keterangan.value = 'LULUS';
        } else {
            keterangan.value = 'TIDAK LULUS';
        }
    }

    function calculateNilaiAkhirSetelahRemedi(id) {
        var rata_rata_quiz = document.getElementById('rata-rata-quiz' + id).value;
        var rata_rata_laporan = document.getElementById('rata-rata-nilai-laporan' + id).value;
        var remedi_konversi = document.getElementById('remedi-konversi' + id).value;
        var nilaiAkhirSetelahRemeditotal = document.querySelector('#nilai-setelah-remedi' + id);

        var total = ((Number(rata_rata_quiz)*0.2) + (Number(rata_rata_laporan)*0.1) + (Number(remedi_konversi)*0.7)).toFixed(3);

        nilaiAkhirSetelahRemeditotal.value = total;

        getNilaiAkhirSetelahRemediKeterangan(total, id);
    }

    function getNilaiAkhirSetelahRemediKeterangan(num, id) {
        var keterangan = document.querySelector('#keterangan-nilai-setelah-remedi' + id);
        if (Number(num) >= 70) {
            keterangan.value = 'LULUS';
        } else {
            keterangan.value = 'TIDAK LULUS';
        }
    }
</script>