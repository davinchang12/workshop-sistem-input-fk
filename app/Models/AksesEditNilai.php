<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AksesEditNilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    
    protected $with = [
        'users',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
