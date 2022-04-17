<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSemesterFieldLab extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'fieldlab'
    ];

    public function fieldlab() {
        return $this->belongsTo(NilaiFieldlab::class, 'nilai_field_lab_id');
    }
}
