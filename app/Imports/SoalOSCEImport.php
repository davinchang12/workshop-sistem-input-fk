<?php

namespace App\Imports;

use App\Models\NilaiJenisOSCE;
use App\Models\NilaiOSCE;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalOSCEImport implements ToCollection, WithStartRow
{
    public function __construct()
    {
        $request = request();

        $this->nama_osce = $request['nama_osce'];
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)
    {
        $nilaiosces = NilaiOSCE::where('namaosce', $this->nama_osce)
            ->select('id')
            ->get();

        foreach ($nilaiosces as $nilaiosce) {
            foreach ($rows as $row) {
                NilaiJenisOSCE::firstOrCreate([
                    'nilaiosce_id' => $nilaiosce->id,
                    'bobot' => $row['1'],
                    'aspekdinilaiosce' => $row['0']
                ]);
            }
        }
    }
}
