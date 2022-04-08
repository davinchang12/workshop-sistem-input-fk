<table cellspacing="0" border="0">
	<colgroup width="51"></colgroup>
	<colgroup width="171"></colgroup>
	<colgroup width="251"></colgroup>
	<colgroup width="314"></colgroup>
	<colgroup width="314"></colgroup>
	<colgroup width="81"></colgroup>
	<colgroup width="128"></colgroup>
	<tr>
		<td height="107" align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">No</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">NIM</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">Nama</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">Mata Kuliah</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">Praktikum</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">Jenis Praktikum</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">Nilai Quiz</font></td>
		<td align="center" valign=middle bgcolor="#FFFF00"><font color="#000000">Laporan Praktikum</font></td>
	</tr>
	<tr>
		<td height="107" align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Opsional</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Opsional</font></td>
	</tr>
	<tr>
		<td height="107" align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Mohon untuk tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Mohon untuk tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Mohon untuk tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Mohon untuk tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Mohon untuk tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000">Mohon untuk tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#EEECE1"><font color="#000000"><br></font></td>
	</tr>
    @foreach ($jadwals as $jadwal)
        @if ($jadwal->users->role == 'mahasiswa')
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $jadwal->users->email }}</td>
                <td>{{ $jadwal->users->name }}</td>
                <td>{{ $jadwal->matkul->namamatkul }}</td>
                <td>Histiologi</td>
                <td>Epitel</td>
            </tr>
        @endif
    @endforeach
</table>