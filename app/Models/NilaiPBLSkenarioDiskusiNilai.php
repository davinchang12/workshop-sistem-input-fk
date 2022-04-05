<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPBLSkenarioDiskusiNilai extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function diskusi() {
        return $this->belongsTo(NilaiPBLSkenarioDiskusi::class);
    }
}
