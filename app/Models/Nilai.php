<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    protected $with = [
        'users',
        'matkul',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function nilaijenis()
    {
        return $this->hasMany(NilaiJenis::class);
    }

    public function rinciannilaitugas()
    {
        return $this->hasOne(RincianNilaiTugas::class);
    }

    public function nilaiujian()
    {
        return $this->hasOne(NilaiUjian::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function pbl() {
        return $this->hasOne(NilaiPBL::class);
    }

    public function praktikum() {
        return $this->hasOne(NilaiPraktikum::class);
    }
}
