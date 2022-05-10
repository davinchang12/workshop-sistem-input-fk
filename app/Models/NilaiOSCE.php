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
        'nilailain',
        'jenis'
    ];
    
    public function nilailain() {
        return $this->belongTo(NilaiLain::class, 'nilai_lain_id');
    }
    public function jenis() {
        return $this->hasMany(NilaiJenisOSCE::class);
    }
}
