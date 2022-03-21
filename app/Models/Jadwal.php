<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jammasuk',
        'jamselesai',
        'ruangan'
    ];

    protected $with = [
        'users',
        'matkul'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
    public function matkul() {
        return $this->belongsTo(Matakuliah::class);
    }
}
