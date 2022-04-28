<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = [
        'nilais',
    ];

    public function nilais() {
        return $this->belongsTo(Nilai::class);
    }
    public function hasilujians() {
        return $this->hasOne(HasilNilaiUjian::class);
    }

}
