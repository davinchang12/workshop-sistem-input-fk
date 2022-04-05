<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSOCA extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function jenis() {
        return $this->hasMany(NilaiJenisSOCA::class);
    }
}
