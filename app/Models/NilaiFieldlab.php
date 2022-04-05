<?php

namespace App\Models;

use App\Models\Nilai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with =[
        'nilai'
    ];
    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
}
