<table class="table" style="text-align: center">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            @php
                $keterangan = [];
                $count = 0;
            @endphp
            @foreach ($topik_tugas as $topik)
                <th scope="col">{{ $topik->keterangantugas }}</th>
                @php
                    $count++;
                    array_push($keterangan, $topik->keterangantugas);
                @endphp
            @endforeach
            {{-- <th scope="col"></th> --}}
            <th scope="col">Rata-Rata</th>
        </tr>
    </thead>
    <tbody>
        @php
            $x = 1;
            $check = '';
            $z = 0;
        @endphp

        @foreach ($nilaitugas_dosen as $tugas)
            @if ($check != $tugas->name)
                @if ($check != '')
                    {{-- <td>{{ $tugas->rataratatugas }}</td> --}}
                    </tr>
                @endif
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $tugas->name }}</td>
                    <td>{{ $tugas->nim }}</td>
                    @php
                        $check = $tugas->name;
                        $x++;
                        $z = 1;
                    @endphp
                    <td>{{ $tugas->nilaitugas }}</td>
                @else
                    <td>{{ $tugas->nilaitugas }}</td>
                    @php $z++; @endphp
            @endif
            @if ($check == $tugas->name)
                @if ($z == $count)
                    <td>{{ $tugas->rataratatugas }}</td>
                @endif
            @endif
        @endforeach
    </tbody>
</table>
