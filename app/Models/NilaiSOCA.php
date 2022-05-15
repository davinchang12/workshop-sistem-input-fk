<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiSOCA extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->belongsTo(Nilai::class, 'nilai_id');
    }
}
