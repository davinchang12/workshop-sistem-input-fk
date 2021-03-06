<?php

namespace App\Models;

use App\Models\Nilai;
use App\Models\NilaiJenisPraktikum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPraktikum extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [
        'id'
    ];
    protected $with =[
        'nilai'
    ];

    public function hasDosen($id) {
        return $this->nilai_id == $id;
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
    public function nilai_jenis_praktikum() {
        return $this->hasMany(NilaiJenisPraktikum::class);
    }

}
