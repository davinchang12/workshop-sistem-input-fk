<div class="col table-responsive">
    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <th scope="col">Praktikum</th>
                <th scope="col">Nama</th>
                <th scope="col">Nim</th>
                <th scope="col">Rata-rata Quiz</th>
                <th scope="col">Rata-rata Nilai Laporan</th>
                <th scope="col">Nilai Responsi</th>
                <th scope="col">Nilai Akhir</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Keterangan Berdasarkan</th>
                <th scope="col">Remedi</th>
                <th scope="col">Remedi Konversi</th>
                <th scope="col">Nilai Setelah Remedi</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Keterangan Berdasarkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($praktikum_dosens as $praktikum_dosen)
                @if ($praktikum_dosen->keterangan_nilai_setelah_remedi == 'TIDAK LULUS')
                    <tr class="table-danger">
                        <td>{{ $praktikum_dosen->namapraktikum }}</td>
                        <td>{{ $praktikum_dosen->name }}</td>
                        <td>{{ $praktikum_dosen->nim }}</td>
                        <td>{{ $praktikum_dosen->rata_rata_quiz }}</td>
                        <td>{{ $praktikum_dosen->rata_rata_laporan }}</td>
                        <td>{{ $praktikum_dosen->nilai_responsi }}</td>
                        <td>{{ $praktikum_dosen->nilai_akhir }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_akhir }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_akhir_berdasarkan }}</td>
                        <td>{{ $praktikum_dosen->remedi }}</td>
                        <td>{{ $praktikum_dosen->remedi_konversi }}</td>
                        <td>{{ $praktikum_dosen->nilai_setelah_remedi }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi_berdasarkan }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $praktikum_dosen->namapraktikum }}</td>
                        <td>{{ $praktikum_dosen->name }}</td>
                        <td>{{ $praktikum_dosen->nim }}</td>
                        <td>{{ $praktikum_dosen->rata_rata_quiz }}</td>
                        <td>{{ $praktikum_dosen->rata_rata_laporan }}</td>
                        <td>{{ $praktikum_dosen->nilai_responsi }}</td>
                        <td>{{ $praktikum_dosen->nilai_akhir }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_akhir }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_akhir_berdasarkan }}</td>
                        <td>{{ $praktikum_dosen->remedi }}</td>
                        <td>{{ $praktikum_dosen->remedi_konversi }}</td>
                        <td>{{ $praktikum_dosen->nilai_setelah_remedi }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi }}</td>
                        <td>{{ $praktikum_dosen->keterangan_nilai_setelah_remedi_berdasarkan }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
