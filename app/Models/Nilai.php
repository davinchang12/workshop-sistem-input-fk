<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matkul_id'
    ];
    protected $with = [
        'users',
        'matkul',
        'nilaitugas'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
    public function nilaitugas()
    {
        return $this->hasOne(NilaiTugas::class);
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

    public function osce() {
        return $this->hasOne(NilaiOSCE::class);
    }

    public function soca() {
        return $this->hasOne(NilaiSOCA::class);
    }

    public function fieldlab() {
        return $this->hasOne(NilaiFieldlab::class);
    }
}
