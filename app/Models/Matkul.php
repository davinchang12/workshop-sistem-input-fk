<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodematkul',
        'name',
        'keterangan',
        'tahun_ajaran',
        'bobot_sks'
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
