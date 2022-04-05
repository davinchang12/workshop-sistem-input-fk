<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaporanFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'jenis_fieldlab',
        'laporanfieldlab'
    ];
    public function jenis_fieldlab()
    {
        return $this->belongsTo(JenisFieldlab::class);
    }
    public function laporanfieldlab()
    {
        return $this->hasMany(LaporanFieldlab::class);
    }
}
