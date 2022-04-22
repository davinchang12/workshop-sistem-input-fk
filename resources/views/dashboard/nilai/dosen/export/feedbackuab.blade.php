
<table cellspacing="0" border="0">
	<tr>
		<td style="border:1px solid black" colspan=6  align="center" valign=middle>Feedback UAB</td>
		</tr>
	<tr>
		<td style="border:1px solid black"  align="left" valign=bottom>No.</td>
		<td style="border:1px solid black" align="center" valign=middle>Nama</td>
		<td style="border:1px solid black" align="center" valign=middle>NIM</td>
		<td style="border:1px solid black" align="center" valign=middle>SKOR</td>
		<td style="border:1px solid black" align="center" valign=middle>Nama Matkul<br> (Harap Jangan Diganti)</td>
		<td style="border:1px solid black" align="center" valign=middle>Nama Topik</td>
	</tr>
    @foreach ($uabs as $uab)
        <tr>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $loop->iteration }}</td>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $uab->name }}</td>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $uab->nim }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom >{{ $uab->skor }}</td>
			<td style="border : 1px solid black" align="center" valign=bottom >{{ $uab->namamatkul }}</td>
			<td style="border : 1px solid black" align="center" valign=bottom >{{ $uab->topik }}</td>
        </tr>
    @endforeach
	
</table>
