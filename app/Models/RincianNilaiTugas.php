<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianNilaiTugas extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'nilaitugas',
        'nilais'
    ];

    public function nilaitugas() {
        return $this->hasMany(NilaiTugas::class);
    }
    public function nilais() {
        return $this->belongsTo(Nilai::class);
    }
    
}
