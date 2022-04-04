<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'keterangan',
        'nilai_mhs'
    ];
    protected $with = [
        'users',
        'matkul'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
