<table>
	<tr>
		<td style="border: 1px solid blank;" colspan=19 align="center" ><b>Daftar Nilai Tugas</b></td>
		</tr>
	<tr>
		<td style="border: 1px solid blank;" rowspan=3 bgcolor="lightgray" align="center" ><b>No</b></td>
		<td style="border: 1px solid blank;" rowspan=3 bgcolor="yellow" align="center" ><b>Nama</b></td>
		<td style="border: 1px solid blank;" rowspan=3 bgcolor="yellow" align="center" ><b>NIM</b></td>
		<td style="border: 1px solid blank;" bgcolor="yellow" colspan=16 align="center" ><b>Penilaian</b></td>
		</tr>
	<tr>
		<td style="border: 1px solid blank;" colspan=14 bgcolor="green" align="center" ><b>TUGAS</b></td>
		<td style="border: 1px solid blank;" rowspan=2 bgcolor="yellow" align="center" ><b>Total</b></td>
		<td style="border: 1px solid blank;" rowspan=2 bgcolor="yellow" align="center" ><b>Rata-Rata</b></td>
	</tr>
	<tr>
		<td style="border: 1px solid blank;" align="center"  ><b>1</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>2</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>3</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>4</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>5</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>6</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>7</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>8</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>9</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>10</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>11</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>12</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>13</b></td>
		<td style="border: 1px solid blank;" align="center"  ><b>14</b></td>
		</tr>
		@foreach ($nilaitugas as $tugas)
		@if ($tugas->role == 'mahasiswa')
			<tr>
				<td style="border: 1px solid blank;">{{ $loop->iteration }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->name }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->email }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_1 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_2 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_3 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_4 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_5 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_6 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_7 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_8 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_9 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_10 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_11 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_12 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_13 }}</td>
				<td style="border: 1px solid blank;">{{ $tugas->tugas_14 }}</td>
				<td style="border: 1px solid blank;"></td>
				<td style="border: 1px solid blank;"></td>
			</tr>
		@endif
		@endforeach
</table>

