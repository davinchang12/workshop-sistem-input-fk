<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSOCA extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function jenis() {
        return $this->belongsTo(NilaiJenisSOCA::class);
    }
}
