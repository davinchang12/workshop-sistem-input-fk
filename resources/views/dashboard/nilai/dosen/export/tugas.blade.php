<table>
	<tr>
		<td style="border: 1px solid blank;" colspan=19 align="center" ><b>Daftar Nilai Tugas</b></td>
		</tr>
	<tr>
		<td style="border: 1px solid blank;" rowspan=3 align="center" ><b>No</b></td>
		<td style="border: 1px solid blank;" rowspan=3 align="center" ><b>Nama</b></td>
		<td style="border: 1px solid blank;" rowspan=3 align="center" ><b>NIM</b></td>
		<td style="border: 1px solid blank;"colspan=16 align="center" ><b>Penilaian</b></td>
		</tr>
	<tr>
		<td style="border: 1px solid blank;" colspan=14 align="center" ><b>TUGAS</b></td>
		<td style="border: 1px solid blank;" rowspan=2 align="center" ><b>Total</b></td>
		<td style="border: 1px solid blank;" rowspan=2 align="center" ><b>Rata-Rata</b></td>
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
    <tr style="border: 1px solid blank;">
        @foreach ($list_tugas as $tugas)
			<td>{{ $loop->iteration }}</td>
			<td>{{ $tugas->users->name }}</td>
			<td>{{ $tugas->users->email }}</td>
			@foreach ($tugas as $nilai_tugas)
				<td>{{ $tugas->nilai_mhs }}</td>			
			@endforeach
		@endforeach
    </tr>
</table>

