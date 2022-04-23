<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisFeedbackUAB extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = [
        'feedbackuabs',
    ];

    public function feedbackuabs() {
        return $this->belongsTo(FeedbackUAB::class, 'feedback_uab_id');
    }
}
