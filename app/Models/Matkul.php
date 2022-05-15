<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matkul extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kodematkul',
        'namamatkul',
        'keterangan',
        'tahun_ajaran',
        'bobot_sks',
        'kinerja',
        'blok'
    ];

    public function nilais() {
        return $this->hasMany(Nilai::class);
    }
    /**
     * Get all of the comments for the Matkul
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    
    public function kelompok() {
        return $this->hasMany(Kelompok::class);
    }

     public function jadwal() {
         return $this->hasMany(Jadwal::class);
     }
    
     public function kritikSaran() {
         return $this->hasMany(KritikSaran::class);
     }

     public function getRouteKeyName()
     {
         return 'kodematkul';
     }
}
