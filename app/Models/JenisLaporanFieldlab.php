<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaporanFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with =[
        'jenis_fieldlab'
    ];
    public function jenis_fieldlab()
    {
        return $this->belongsTo(JenisFieldlab::class);
    }
}
