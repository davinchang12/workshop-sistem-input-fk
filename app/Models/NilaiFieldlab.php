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
        'nilailain',
    ];
    public function nilailain()
    {
        return $this->belongsTo(NilaiLain::class, 'nilai_lain_id');
    }
    public function nilaisemester()
    {
        return $this->hasMany(NilaiSemesterFieldLab::class);
    }
}
