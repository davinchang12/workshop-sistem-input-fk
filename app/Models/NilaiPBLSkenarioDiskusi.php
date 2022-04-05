<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPBLSkenarioDiskusi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function skenario() {
        return $this->belongsTo(NilaiPBLSkenario::class);
    }

    public function nilai() {
        return $this->hasMany(NilaiPBLSkenarioDiskusiNilai::class);
    }
}
