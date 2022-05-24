<table class="table" style="text-align: center">
    <thead>
        <tr>
            <th scope="col">Nama SOCA</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama Penguji</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($socas as $mhs_soca)
            <tr>
                <td>{{ $mhs_soca->namasoca }}</td>
                <td>{{ $mhs_soca->name }}</td>
                <td>{{ $mhs_soca->nim }}</td>
                <td>{{ $mhs_soca->nama_penguji }}</td>
                <td>{{ $mhs_soca->keterangan }}</td>
                <td>{{ $mhs_soca->nilaisocas == null ? "BELUM DINILAI" : $mhs_soca->nilaisocas}}</td>
            </tr>
        @endforeach
    </tbody>
</table>