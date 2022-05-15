<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPBLSkenarioDiskusiNilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'diskusi'
    ];

    public function diskusi() {
        return $this->belongsTo(NilaiPBLSkenarioDiskusi::class, 'nilaipblskenariodiskusi_id');
    }
}
