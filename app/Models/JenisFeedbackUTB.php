<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisFeedbackUTB extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = [
        'feedbackutbs',
    ];

    public function feedbackutbs() {
        return $this->belongsTo(FeedbackUTB::class, 'feedback_utb_id');
    }
}
