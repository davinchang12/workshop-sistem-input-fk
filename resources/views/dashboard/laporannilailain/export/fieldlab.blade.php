<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">Semester</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Nilai Dosbing</th>
            <th scope="col">Nilai Penguji</th>
            <th scope="col">Nilai Penguji 2</th>
            <th scope="col">Nilai Akhir</th>
            <th scope="col">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < $len; $i++)
            <tr>
                <td>{{ $semester }}</td>
                <td>{{ $name[$i] }}</td>
                <td>{{ $nim[$i] }}</td>
                <td>{{ $nilai_dosbing[$i] }}</td>
                <td>{{ $nilai_penguji[$i] }}</td>
                <td>{{ $nilai_penguji_2[$i] }}</td>
                <td>{{ $nilai_akhir[$i] }}</td>
                <td>{{ $keterangan_akhir[$i] }}</td>
            </tr>
        @endfor
    </tbody>
</table>
