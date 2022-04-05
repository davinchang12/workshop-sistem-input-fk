<?php

namespace App\Models;

use App\Models\NilaiJenisPraktikum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiLaporanPraktikum extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai_jenis_praktikum'
    ];
    public function nilai_jenis_praktikum()
    {
        return $this->belongsTo(NilaiJenisPraktikum::class);
    }
}