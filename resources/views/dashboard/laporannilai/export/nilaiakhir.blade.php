<div class="col table-responsive">
    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <td>Nama</td>
                <td>NIM</td>
                <td>Tugas</td>
                <td></td>
                <td>Sintak UTB</td>
                <td></td>
                <td>Sintak UAB</td>
                <td></td>
                <td>Validasi</td>
                <td>Keterangan</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilais as $nilai)
                <tr>
                    <td>{{ $nilai[0] }}</td>
                    <td>{{ $nilai[1] }}</td>
                    <td>{{ $nilai[2] }}</td>
                    <td>{{ $nilai[3] }}</td>
                    <td>{{ $nilai[4] }}</td>
                    <td>{{ $nilai[5] }}</td>
                    <td>{{ $nilai[6] }}</td>
                    <td>{{ $nilai[7] }}</td>
                    <td>{{ $nilai[8] }}</td>
                    <td>{{ $nilai[9] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>