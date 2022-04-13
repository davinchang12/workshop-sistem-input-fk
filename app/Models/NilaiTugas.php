<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTugas extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'rinciannilaitugas'
    ];

    public function rinciannilaitugas() {
        return $this->belongsTo(RincianNilaiTugas::class);
    }
    
}
