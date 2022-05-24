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
                    <td>-</td>
                @else
                    <td>{{ $ujian->remediujian }}</td>
                    <td>{{ $ujian->uabcombinedremedial }}</td>
                @endif

                <td>{{ $ujian->finalcbt }}</td>
                @if ($ujian->finalcbt >= 90)
                    <td>A</td>
                @endif
                @if ($ujian->finalcbt < 90 && $ujian->finalcbt >= 85)
                    <td>AB</td>
                @endif
                @if ($ujian->finalcbt < 85 && $ujian->finalcbt >= 80)
                    <td>BC</td>
                @endif
                @if ($ujian->finalcbt < 80 && $ujian->finalcbt >= 75)
                    <td>C</td>
                @endif
                @if ($ujian->finalcbt < 75 && $ujian->finalcbt >= 70)
                    <td>CD</td>
                @endif
                @if ($ujian->finalcbt < 70 && $ujian->finalcbt >= 60)
                    <td>D</td>
                @endif
                @if ($ujian->finalcbt < 60)
                    <td>E</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
