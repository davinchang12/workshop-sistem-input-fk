<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
	
</head>

<body>
<table cellspacing="0" border="0">
	<colgroup span="8" width="64"></colgroup>
	<tr>
		<td height="40" align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">No</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Kelompok</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Semester</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Nama</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Nim</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Total Nilai Dosbing</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Total Nilai Penguji</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Total Nilai Dosen Luar</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Nilai Akhir</font></td>
		<td align="center" valign=middle bgcolor="#FFE48F"><font color="#000000">Keterangan</font></td>
	</tr>
	<tr>
		<td height="19" align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Mohon tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Mohon tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Mohon tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Mohon tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Mohon tidak diubah</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Opsional</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Wajib</font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Opsional</font></td>
	</tr>
	<tr>
		<td height="19" align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000"><br></font></td>
		<td align="center" valign=middle bgcolor="#F2F2F2"><font color="#000000">Jika tidak diisi, akan ditentukan secara otomatis oleh sistem</font></td>
	</tr>
	@php
		$count = 1;
	@endphp
	@foreach ($fieldlabs as $fieldlab)
		<tr>
			<td height="19" align="center" valign=middle>{{ $count }}</td>
			<td align="center" valign=middle>{{ $fieldlab->kelompok }}</td>
			<td align="center" valign=middle>{{ $fieldlab->semester }}</td>
			<td align="center" valign=middle>{{ $fieldlab->name }}</td>
			<td align="center" valign=middle>{{ $fieldlab->nim }}</td>
		</tr>
		@php
			$count++;
		@endphp
	@endforeach
</table>
<!-- ************************************************************************** -->
</body>

</html>
