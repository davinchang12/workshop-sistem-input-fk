<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiOSCE extends Model
{
    use HasFactory;

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
