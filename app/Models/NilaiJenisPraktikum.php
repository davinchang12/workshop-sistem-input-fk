<?php

namespace App\Models;

use App\Models\NilaiPraktikum;
use App\Models\NilaiQuizPraktikum;
use App\Models\NilaiLaporanPraktikum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiJenisPraktikum extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai_praktikum',
    ];
    public function nilai_praktikum()
    {
        return $this->belongsTo(NilaiPraktikum::class);
    }
    public function laporan() {
        return $this->hasMany(NilaiLaporanPraktikum::class);
    }
    public function quiz() {
        return $this->hasMany(NilaiQuizPraktikum::class);
    }
}
