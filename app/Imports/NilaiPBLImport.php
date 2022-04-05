<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use Maatwebsite\Excel\Concerns\ToModel;

class NilaiPBLImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $userID = User::where('name', $row[1])->first()->id;
        $matkulID = Matkul::where('name', $row[3])->first()->id;
        return new Nilai([
            'user_id' => $userID,
            'matkul_id' => $matkulID,
        ]);
    }
}
