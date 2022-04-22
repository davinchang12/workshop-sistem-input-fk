
<table cellspacing="0" border="0">
	<tr>
		<td style="border:1px solid black" colspan=6  align="center" valign=middle>Feedback UTB</td>
		</tr>
	<tr>
		<td style="border:1px solid black"  align="left" valign=bottom>No.</td>
		<td style="border:1px solid black" align="center" valign=middle>Nama</td>
		<td style="border:1px solid black" align="center" valign=middle>NIM</td>
		<td style="border:1px solid black" align="center" valign=middle>SKOR</td>
		<td style="border:1px solid black" align="center" valign=middle>Nama Matkul<br> (Harap Jangan Diganti)</td>
		<td style="border:1px solid black" align="center" valign=middle>Nama Topik</td>
	</tr>
    @foreach ($utbs as $utb)
        <tr>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $loop->iteration }}</td>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $utb->name }}</td>
            <td style="border: 1px solid blank;" align="center" valign=bottom>{{ $utb->nim }}</td>
            <td style="border : 1px solid black" align="center" valign=bottom >{{ $utb->skor }}</td>
			<td style="border : 1px solid black" align="center" valign=bottom >{{ $utb->namamatkul }}</td>
			<td style="border : 1px solid black" align="center" valign=bottom >{{ $utb->topik }}</td>
        </tr>
    @endforeach
	
</table>
