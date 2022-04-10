<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPBLSkenario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nilaipbl_id',
        'skenario',
        'kelompok'
    ];

    protected $with = [
        'pbl'
    ];

    public function pbl() {
        return $this->belongsTo(NilaiPBL::class, 'nilaipbl_id');
    }

    public function skenariodiskusi() {
        return $this->hasMany(NilaiPBLSkenarioDiskusi::class, 'nilaipblskenario_id');
    }
}
