<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPBL extends Model
{
    use HasFactory;

    protected $fillable = [
        'nilai_id'
    ];

    public function nilai() {
        return $this->belongsTo(Nilai::class);
    }

    public function pblskenario() {
        return $this->hasMany(NilaiPBLSkenario::class, 'nilaipbl_id');
    }
}
