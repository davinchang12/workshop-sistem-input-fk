<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanPBLExports implements FromArray, WithMultipleSheets
{
    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new LaporanPBLExportDiskusi1,
            new LaporanPBLExportDiskusi2,
        ];

        return $sheets;
    }
}
