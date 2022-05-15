<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiOSCE extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai',
        'jenis'
    ];
    
    public function nilai() {
        return $this->belongTo(Nilai::class);
    }
    public function jenis() {
        return $this->hasMany(NilaiJenisOSCE::class);
    }
}
