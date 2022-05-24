<table class="table" style="text-align: center">
    <thead>
        <tr>
            <th scope="col">Nama OSCE</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Nilai</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($mhs_osces as $mhs_osce)
            <tr>
                <td>{{ $mhs_osce->namaosce }}</td>
                <td>{{ $mhs_osce->name }}</td>
                <td>{{ $mhs_osce->nim }}</td>
                <td>{{ $mhs_osce->nilaiosce == null ? 'BELUM DINILAI' : $mhs_osce->nilaiosce }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
