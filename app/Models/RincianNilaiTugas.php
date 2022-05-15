<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RincianNilaiTugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'nilais'
    ];

    public function nilaitugas() {
        return $this->hasMany(NilaiTugas::class);
    }
    public function nilais() {
        return $this->belongsTo(Nilai::class);
    }
    
}
