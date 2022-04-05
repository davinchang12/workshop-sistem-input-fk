<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $fillable = ['kodekelompok'];

    protected $with = [
        'users', 
        'matkul',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function matkul() {
        return $this->belongsTo(Matkul::class);
    }
}
