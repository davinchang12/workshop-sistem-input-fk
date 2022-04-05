<table cellspacing="0" border="0">
	<colgroup span="8" width="304"></colgroup>
	<colgroup width="193"></colgroup>
	<colgroup width="156"></colgroup>
	<colgroup width="215"></colgroup>
	<colgroup width="230"></colgroup>
	<colgroup width="156"></colgroup>
	<colgroup width="119"></colgroup>
	<colgroup width="363"></colgroup>
	<tr>
		<td height="107" align="center"  bgcolor="#FFFF00"><font color="#000000">No</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Nama Mahasiswa</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">NIM Mahasiswa</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Mata Kuliah</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Kelompok</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Skenario</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Diskusi</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Dosen Tutor</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Tanggal</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Kehadiran</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Aktivitas Diskusi</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Relevansi Pembicaraan</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Keterampilan Berkomunikasi</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Laporan Sementara</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Laporan Resmi</font></td>
		<td align="center"  bgcolor="#FFFF00"><font color="#000000">Catatan / Kesan Kegiatan Diskusi Tutorial</font></td>
	</tr>
	<tr>
		<td height="27" align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Wajib</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Opsional</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Opsional</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Opsional</font></td>
	</tr>
	<tr>
		<td height="107" align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Mohon untuk tidak diganti / diubah</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Nilai<br>4 : Tepat Waktu<br>3 : Terlambat 15 Menit<br>2 : Terlambat 10 Menit<br>0 : Tidak Hadir</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Nilai :<br>4 : Sangat Aktif<br>3 : Cukup Aktif<br>2 : Kurang Aktif<br>1 : Pasif</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Nilai :<br>4 : Selalu Relevan<br>3 : Cukup Relevan<br>2 : Kadang Tidak Relevan<br>1 : Sering Tidak Relevan</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000">Nilai :<br>4 : Sangat Baik<br>3 : Baik<br>2 : Cukup<br>1 : Kurang</font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000"><br></font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000"><br></font></td>
		<td align="center"  bgcolor="#CCCCCC"><font color="#000000"><br></font></td>
	</tr>
	@foreach ($kelompoks as $kelompok)
		@if ($kelompok->users->role == 'mahasiswa')
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $kelompok->users->name }}</td>
				<td>{{ $kelompok->users->email }}</td>
				<td>{{ $kelompok->matkul->namamatkul }}</td>
				<td>{{ $kelompok->kodekelompok }}</td>
				<td>1</td>
				<td>1</td>
				<td>{{ auth()->user()->name }}</td>
				<td>04/04/2022</td>
			</tr>
		@endif
	@endforeach
</table>