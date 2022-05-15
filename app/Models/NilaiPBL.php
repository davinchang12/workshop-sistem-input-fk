<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPBL extends Model
{
    use HasFactory, SoftDeletes;

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
