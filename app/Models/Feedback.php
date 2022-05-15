<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

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
