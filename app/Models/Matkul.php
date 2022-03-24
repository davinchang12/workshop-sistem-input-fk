<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'keterangan',
        'tahun_ajaran'
    ];

    public function nilaiMhs() {
        return $this->hasMany(Nilai::class);
    }

    public function kelompok() {
        return $this->hasMany(Kelompok::class);
    }

     public function jadwal() {
         return $this->hasMany(Jadwal::class);
     }
    
     public function kritikSaran() {
         return $this->hasMany(KritikSaran::class);
     }
}
