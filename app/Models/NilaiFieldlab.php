<?php

namespace App\Models;

use App\Models\Nilai;
use App\Models\JenisFieldlab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai',
        'jenisfieldlab'
    ];
    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
    public function jenisfieldlab()
    {
        return $this->hasMany(JenisFieldlab::class);
    }
}
