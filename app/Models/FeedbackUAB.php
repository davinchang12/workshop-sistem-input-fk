<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackUAB extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = [
        'hasilnilaiujians',
    ];

    public function hasilnilaiujians() {
        return $this->belongsTo(HasilNilaiUjian::class, 'hasil_ujians_id');
    }
    public function jenisfeedbackuabs() {
        return $this->hasMany(JenisFeedbackUAB::class);
    }
}
