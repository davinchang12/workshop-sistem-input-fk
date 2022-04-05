<?php

namespace App\Models;

use App\Models\JenisLaporanFieldlab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanFieldlab extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with =[
        'jenis_laporan_fieldlab'
    ];
    public function jenis_laporan_fieldlab()
    {
        return $this->belongsTo(JenisLaporanFieldlab::class);
    }
}
