<?php

namespace App\Models;

use App\Models\NilaiPraktikum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResponsiPraktikum extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai_praktikum'
    ];
    public function nilai_praktikum()
    {
        return $this->belongsTo(NilaiPraktikum::class);
    }
}
