<?php

namespace App\Imports;

use App\Models\Nilai;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\NilaiPraktikum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\NilaiJenisPraktikum;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NilaiPraktikumImport implements ToCollection, WithStartRow
{
    private $nilai, $dosen_id;
    public function __construct()
    {
        $request = request();

        $this->dosen_id = DB::table('nilais')
            ->join('users', 'nilais.user_id', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', 'matkuls.id')
            ->where('user_id', $request->dosen_id)
            ->where('matkuls.id', $request->matkul_dipilih)
            ->select('nilais.id')
            ->first();

        $this->nilai = Nilai::select('nilais.id', 'users.name', 'users.role', 'matkuls.namamatkul', 'users.nim')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->join('matkuls', 'nilais.matkul_id', '=', 'matkuls.id')
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
        NilaiPraktikum::firstOrCreate(
            [
                'nilai_id' => $this->dosen_id->id,
                'deleted_at' => null,
                'namapraktikum' => $rows[0][1],
            ],
            []
        );

        foreach ($rows as $row) {
            $nilai = $this->nilai->where('namamatkul', $row[0])->where('nim', $row[3])->first();
            
            $praktikum = NilaiPraktikum::firstOrCreate(
                [
                    'nilai_id' => $nilai->id,
                    'deleted_at' => null,
                    'namapraktikum' => $row[1]
                ],
                []
            );
            $calculateNilaiAkhir = ($row[4]*0.2)+($row[5]*0.1)+($row[6]*0.7);
            $keteranganNilaiAkhir = $calculateNilaiAkhir >= 70 ? "LULUS" : "TIDAK LULUS";

            if ($row[10] != null) {
                $calculateNilaiSetelahRemedi = ($row[4]*0.2)+($row[5]*0.1)+($row[10]*0.7);
                $keteranganNilaiSetelahRemedi = $calculateNilaiSetelahRemedi >= 70 ? "LULUS" : "TIDAK LULUS";
                $keterangan_nilai_setelah_remedi_berdasarkan = "NILAI SETELAH REMEDI";
            } else {
                $calculateNilaiSetelahRemedi = $calculateNilaiAkhir;
                $keteranganNilaiSetelahRemedi = $keteranganNilaiAkhir;
                $keterangan_nilai_setelah_remedi_berdasarkan = "NILAI AKHIR";
            }

            $nilaijenispraktikum = NilaiJenisPraktikum::firstOrCreate(
                ['nilai_praktikum_id' => $praktikum->id],
                [
                    'rata_rata_quiz' => $row[4],
                    'rata_rata_laporan' => $row[5],
                    'nilai_responsi' => $row[6],
                    'nilai_akhir' => $row[7] ?? $calculateNilaiAkhir,
                    'keterangan_nilai_akhir' => $row[8] != null ? strtoupper($row[8]) : $keteranganNilaiAkhir,
                    'keterangan_nilai_akhir_berdasarkan' => 'NILAI AKHIR',
                    'remedi' => $row[9],
                    'remedi_konversi' => $row[10],
                    'nilai_setelah_remedi' => $row[11] ?? $calculateNilaiSetelahRemedi,
                    'keterangan_nilai_setelah_remedi' => $row[12] != null ? strtoupper($row[12]) : $keteranganNilaiSetelahRemedi,
                    'keterangan_nilai_setelah_remedi_berdasarkan' => $keterangan_nilai_setelah_remedi_berdasarkan
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
