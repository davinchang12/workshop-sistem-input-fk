<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>UTB</th>
            <th>UAB</th>
            <th>Rata-Rata</th>
            <th>UAB Combined</th>
            <th>Sintak UTB</th>
            <th>Sintak UAB</th>
            <th>Remedi</th>
            <th>UAB Combined setelah Remedi</th>
            <th>Nilai Final CBT</th>
            <th>Nilai Huruf</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ujian_dosens as $ujian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ujian->name }}</td>
                <td>{{ $ujian->nim }}</td>
                <td>{{ $ujian->utb }}</td>
                <td>{{ $ujian->uab }}</td>
                <td>{{ $ujian->ratarataujian }}</td>
                <td>{{ $ujian->uabcombined }}</td>
                <td>{{ $ujian->sintakutb }}</td>
                <td>{{ $ujian->sintakuab }}</td>
                @if ($ujian->remediujian == 0 || $ujian->remediujian == null)
                    <td>-</td>
                @else
                    <td>{{ $ujian->remediujian }}</td>
                @endif

                <td>{{ $ujian->uabcombinedremedial }}</td>
                <td>{{ $ujian->finalcbt }}</td>
                @if ($ujian->finalcbt >= 80)
                    <td>A</td>
                @endif
                @if ($ujian->finalcbt < 80 && $ujian->finalcbt >= 75)
                    <td>AB</td>
                @endif
                @if ($ujian->finalcbt < 75 && $ujian->finalcbt >= 70)
                    <td>B</td>
                @endif
                @if ($ujian->finalcbt < 70 && $ujian->finalcbt >= 65)
                    <td>BC</td>
                @endif
                @if ($ujian->finalcbt < 65 && $ujian->finalcbt >= 55)
                    <td>C</td>
                @endif
                @if ($ujian->finalcbt < 55 && $ujian->finalcbt >= 50)
                    <td>CD</td>
                @endif
                @if ($ujian->finalcbt < 50 && $ujian->finalcbt >= 40)
                    <td>D</td>
                @endif
                @if ($ujian->finalcbt < 40)
                    <td>E</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
