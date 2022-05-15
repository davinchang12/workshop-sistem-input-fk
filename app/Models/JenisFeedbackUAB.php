<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisFeedbackUAB extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = [
        'feedbackuabs',
    ];

    public function feedbackuabs() {
        return $this->belongsTo(FeedbackUAB::class, 'feedback_uab_id');
    }
}
