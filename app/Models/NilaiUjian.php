<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiUjian extends Model
{
    use HasFactory, SoftDeletes;

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
