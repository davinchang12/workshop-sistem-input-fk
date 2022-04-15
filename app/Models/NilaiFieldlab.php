<?php

namespace App\Models;

use App\Models\Nilai;
use App\Models\NilaiSemesterFieldLab;
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
    ];
    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
    public function nilaisemester()
    {
        return $this->hasMany(NilaiSemesterFieldLab::class);
    }
}
