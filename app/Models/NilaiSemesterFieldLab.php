<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiSemesterFieldLab extends Model
{
    use HasFactory, SoftDeletes;

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
