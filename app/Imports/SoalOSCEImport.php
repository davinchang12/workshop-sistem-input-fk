<?php

namespace App\Imports;

use App\Models\NilaiOSCE;
use Maatwebsite\Excel\Concerns\ToModel;

class SoalOSCEImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NilaiOSCE([
            //
        ]);
    }
}
