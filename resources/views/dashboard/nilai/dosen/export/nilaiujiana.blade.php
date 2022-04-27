
<table cellspacing="0" border="0">
	<tr>
		<td style="border : 1px solid black" colspan=12 rowspan=2  align="center" valign=bottom><b>Daftar Nilai Ujian Tertulis {{ $namamatkul }}</b></td>
		</tr>
	<tr>
		</tr>
	<tr>
		<td style="border : 1px solid black" rowspan=4 align="center" valign=bottom><b>No</b></td>
		<td style="border : 1px solid black" rowspan=4 align="center" valign=bottom><b>Nama</b></td>
		<td style="border : 1px solid black" rowspan=4 align="center" valign=bottom><b>Nim</b></td>
		<td style="border : 1px solid black" colspan=9 align="center" valign=bottom><b>Penilaian</b></td>
		</tr>
	<tr>
		<td style="border : 1px solid black" colspan=2 align="center" valign=bottom><b>Ujian Blok</b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>Rata-rata</b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom bgcolor="gray"><b></b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>UAB Combined</b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>sintak utb</b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>sintak uab</b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>NILAI FINAL CBT </b></td>
		<td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>REMEDI </b></td>
		{{-- <td style="border : 1px solid black" rowspan=3 align="center" valign=bottom><b>Nama Matkul<br>(Jangan diganti)</b></td> --}}
	</tr>
	<tr>
		<td style="border : 1px solid black" rowspan=2 align="center" valign=bottom><b><i>UTB</i></b></td>
		<td style="border : 1px solid black" rowspan=2 align="center" valign=bottom><b><i>UAB</i></b></td>
		</tr>
	<tr>
		</tr>
        @foreach ($ujians as $ujian)
        <tr>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $loop->iteration }}</td>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $ujian->name }}</td>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $ujian->nim }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom>{{ $ujian->utb }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom >{{ $ujian->uab }}</td>
			<td style="border : 1px solid black" align="center" valign=bottom >{{ $ujian->ratarataujian }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom bgcolor="gray"></td>
            <td style="border : 1px solid black" align="center" valign=bottom >{{ $ujian->uabcombined }}</td>
            <td style="border : 1px solid black" align="left" valign=bottom >{{ $ujian->sintakutb }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom >{{ $ujian->sintakuab }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom>{{ $ujian->finalcbt }}</td>
			@if($ujian->ratarataujian <= $ujian->ratamin){
				<td style="border : 1px solid black" align="center" bgcolor="red" valign=bottom></td>
			}
			@else
            <td style="border : 1px solid black" align="center" bgcolor="green" valign=bottom>-</td>
			@endif
        </tr>
    	@endforeach
</table>
