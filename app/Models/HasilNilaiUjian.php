<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilNilaiUjian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = [
        'nilaiujians',
    ];

    public function nilaiujians() {
        return $this->belongsTo(NilaiUjian::class, "nilai_ujian_id");
    }
    public function feedbackutbs() {
        return $this->hasMany(FeedbackUTB::class);
    }
    public function feedbackuabs() {
        return $this->hasMany(FeedbackUAB::class);
    }
}
