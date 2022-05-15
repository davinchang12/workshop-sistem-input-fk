<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiJenisSOCA extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    
    protected $with = [
        'soca'
    ];

    public function nilaisoca() {
        return $this->hasMany(JenisSOCA::class);
    }

    public function soca() {
        return $this->belongsTo(NilaiSOCA::class, 'nilaisoca_id');
    }
}
