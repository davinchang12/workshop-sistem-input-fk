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

    protected $with = [
        'nilai'
    ];

    public function jenis() {
        return $this->hasMany(NilaiJenisSOCA::class);
    }

    public function nilai() {
        return $this->belongsTo(Nilai::class);
    }
}
