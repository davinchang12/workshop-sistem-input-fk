<?php

namespace App\Imports;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\NilaiPraktikum;
use Illuminate\Support\Collection;
use App\Models\NilaiJenisPraktikum;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiPraktikumImport implements ToCollection, WithStartRow
{
    private $nilai;
    public function __construct()
    {
        $this->nilai = Jadwal::select('nilais.id', 'users.name', 'users.role', 'matkuls.namamatkul', 'users.nim')
            ->join('users', 'jadwals.user_id', '=', 'users.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('nilais', 'nilais.user_id', '=', 'users.id')
            ->where('users.role', 'mahasiswa')
            ->get();
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $nilai = $this->nilai->where('namamatkul', $row[0])->where('nim', $row[3])->first();
            
            $praktikum = NilaiPraktikum::firstOrCreate(
                ['nilai_id' => $nilai->id],
                ['namapraktikum' => $row[1]]
            );

            $calculateNilaiAkhir = ($row[4]*0.2)+($row[5]*0.1)+($row[6]*0.7);
            $keteranganNilaiAkhir = $calculateNilaiAkhir >= 70 ? "LULUS" : "TIDAK LULUS";

            $calculateNilaiSetelahRemedi = ($row[4]*0.2)+($row[5]*0.1)+($row[10]*0.7);
            $keteranganNilaiSetelahRemedi = $calculateNilaiSetelahRemedi >= 70 ? "LULUS" : "TIDAK LULUS";

            $nilaijenispraktikum = NilaiJenisPraktikum::firstOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                [
                    'rata_rata_quiz' => $row[4],
                    'rata_rata_laporan' => $row[5],
                    'nilai_responsi' => $row[6],
                    'nilai_akhir' => $row[7] ?? $calculateNilaiAkhir,
                    'keterangan_nilai_akhir' => $row[8] ?? $keteranganNilaiAkhir,
                    'remedi' => $row[9],
                    'remedi_konversi' => $row[10],
                    'nilai_setelah_remedi' => $row[11] ?? $calculateNilaiSetelahRemedi,
                    'keterangan_nilai_setelah_remedi' => $row[12] ?? $keteranganNilaiSetelahRemedi
                ]
            );

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('remedi', null)
                ->update(['remedi' => $row[9]]);

            $nilaijenispraktikum
                ->where('nilai_praktikum_id', $praktikum->id)
                ->where('remedi_konversi', null)
                ->update(['remedi_konversi' => $row[10]]);
        }
    }
}
