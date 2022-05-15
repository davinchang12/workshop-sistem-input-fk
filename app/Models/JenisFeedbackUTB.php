<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisFeedbackUTB extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = [
        'feedbackutbs',
    ];

    public function feedbackutbs() {
        return $this->belongsTo(FeedbackUTB::class, 'feedback_utb_id');
    }
}
