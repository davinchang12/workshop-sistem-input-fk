<div class="col table-responsive">
    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Kelompok</th>
                <th scope="col">Skenario</th>
                <th scope="col">Diskusi</th>
                <th scope="col">Nama</th>
                <th scope="col">Nim</th>
                <th scope="col">Kehadiran</th>
                <th scope="col">Aktivitas Diskusi</th>
                <th scope="col">Relevansi Pembicaraan</th>
                <th scope="col">Keterampilan Berkomunikasi</th>
                <th scope="col">Laporan Sementara</th>
                <th scope="col">Laporan Resmi</th>
                <th scope="col">Catatan / Kesan Kegiatan Diskusi Tutorial</th>
                <th scope="col">Total</th>
                <th scope="col">Rata Rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pbl_dosens as $pbl_dosen)
                @if ($pbl_dosen->role == 'mahasiswa')
                    @if ($pbl_dosen->diskusi == 2)
                        <tr class="table-warning">
                        @else
                        <tr>
                    @endif
                    <td>{{ $pbl_dosen->tanggal_pelaksanaan }}</td>
                    <td>{{ $pbl_dosen->kelompok }}</td>
                    <td>{{ $pbl_dosen->skenario }}</td>
                    <td>{{ $pbl_dosen->diskusi }}</td>
                    <td>{{ $pbl_dosen->name }}</td>
                    <td>{{ $pbl_dosen->nim }}</td>
                    <td>{{ $pbl_dosen->kehadiran }}</td>
                    <td>{{ $pbl_dosen->aktivitas_diskusi }}</td>
                    <td>{{ $pbl_dosen->relevansi_pembicaraan }}</td>
                    <td>{{ $pbl_dosen->keterampilan_berkomunikasi }}</td>
                    <td>{{ $pbl_dosen->laporan_sementara }}</td>
                    <td>{{ $pbl_dosen->laporan_resmi }}</td>
                    <td>{{ $pbl_dosen->catatan_kesan_kegiatan_diskusi_tutorial }}</td>
                    <td>{{ $pbl_dosen->total }}</td>
                    <td>{{ $pbl_dosen->rata_rata }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>