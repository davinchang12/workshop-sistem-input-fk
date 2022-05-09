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
        'nilailain'
    ];

    public function jenis() {
        return $this->hasMany(NilaiJenisSOCA::class);
    }

    public function nilailain() {
        return $this->belongsTo(NilaiLain::class, 'nilai_lain_id');
    }
}
