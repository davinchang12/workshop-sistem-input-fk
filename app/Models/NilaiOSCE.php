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
