<?php

namespace App\Models;

use App\Models\NilaiFieldlab;
use App\Models\JenisLaporanFieldlab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai_fieldlab',
        'jenislaporanfieldlab'
    ];
    public function nilai_fieldlab()
    {
        return $this->belongsTo(NilaiFieldlab::class);
    }
    public function jenislaporanfieldlab()
    {
        return $this->hasMany(JenisLaporanFieldlab::class);
    }

}
