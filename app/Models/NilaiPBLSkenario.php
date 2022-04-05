<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPBLSkenario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nilaipbl_id',
        'skenario'
    ];

    public function pbl() {
        return $this->belongsTo(NilaiPBL::class);
    }

    public function diskusi() {
        return $this->hasMany(NilaiPBLSkenarioDiskusi::class);
    }
}
