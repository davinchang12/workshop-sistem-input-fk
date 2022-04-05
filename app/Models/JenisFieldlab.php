<?php

namespace App\Models;

use App\Models\NilaiFieldlab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with =[
        'nilai_fieldlab'
    ];
    public function nilai_fieldlab()
    {
        return $this->belongsTo(NilaiFieldlab::class);
    }
}
