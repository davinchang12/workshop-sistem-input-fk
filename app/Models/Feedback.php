<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback'
    ];

    protected $with = [
        'nilaiMhs'
    ];

    public function nilaiMhs() {
        return $this->belongsTo(Nilai::class);
    }
}
