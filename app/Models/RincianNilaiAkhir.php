<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RincianNilaiAkhir extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    protected $with = [
        'nilai',
    ];

    public function nilai() {
        return $this->belongsTo(Nilai::class, 'nilai_id');
    }
}
