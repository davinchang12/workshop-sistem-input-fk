<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackUTB extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = [
        'hasilnilaiujians',
    ];

    public function hasilnilaiujians() {
        return $this->belongsTo(HasilNilaiUjian::class, 'hasil_ujians_id');
    }
    public function jenisfeedbackutbs() {
        return $this->hasMany(JenisFeedbackUTB::class);
    }
    
}
