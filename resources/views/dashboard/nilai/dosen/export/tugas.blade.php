<table>
	<tr>
		<td style="border: 1px solid blank;" colspan=7 align="center" ><b>Daftar Nilai Tugas</b></td>
		
	</tr>
	<tr>
		<td style="border: 1px solid blank;" colspan=3 align="center" ><b>Dosen Penguji:</b></td>  
		<td style="border: 1px solid blank;" colspan=4 align="center" ><b>{{ $dosen }}</b></td>  
		
	</tr>
	
	<tr>
		<td style="border: 1px solid blank;" rowspan=3 bgcolor="lightgray" align="center" ><b>No</b></td>
		<td style="border: 1px solid blank;" rowspan=3 bgcolor="yellow" align="center" ><b>Nama</b></td>
		<td style="border: 1px solid blank;" rowspan=3 bgcolor="yellow" align="center" ><b>NIM</b></td>
		<td style="border: 1px solid blank;" bgcolor="yellow" colspan=4 align="center" ><b>Penilaian</b></td>
		</tr>
	<tr>
		<td style="border: 1px solid blank;" colspan=2 bgcolor="green" align="center" ><b>Nilai</b></td>
		<td style="border: 1px solid blank;" rowspan=2 bgcolor="yellow" align="center" ><b>Matkul<br>(Mohon untuk tidak diganti)</b></td>
		<td style="border: 1px solid blank;" rowspan=2 bgcolor="yellow" align="center" ><b>Topik Tugas<br>(Mohon diisi sama semua)</b></td>
	</tr>
	<tr>
		<td style="border: 1px solid blank;" align="center" bgcolor="lightgray" colspan=2  ><b>Tugas</b></td>
		</tr>
		@foreach ($nilaitugas as $tugas)
			<tr>
				<td style="border: 1px solid blank;">{{ $loop->iteration }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->name }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->nim }}</td>
				<td style="border: 1px solid blank;" colspan=2>{{ $tugas->nilaitugas }}</td>
				<td style="border: 1px solid blank;" bgcolor="lightgray">{{ $tugas->namamatkul }}</td>
				<td style="border: 1px solid blank;" bgcolor="lightgray">{{ $tugas->keterangantugas }}</td>
			</tr>
		@endforeach
</table>

