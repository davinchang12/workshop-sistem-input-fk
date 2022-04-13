<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiJenisSOCA extends Model
{
    use HasFactory;

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
