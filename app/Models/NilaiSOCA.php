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
        'nilailain'
    ];

    public function jenis() {
        return $this->hasMany(NilaiJenisSOCA::class);
    }

    public function nilailain() {
        return $this->belongsTo(NilaiLain::class, 'nilai_lain_id');
    }
}
