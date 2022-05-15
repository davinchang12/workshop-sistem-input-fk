<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiJenisOSCE extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'osce',
        'jenisosce'
    ];

    public function osce() {
        return $this->belongsTo(NilaiOSCE::class);
    }
    public function jenisosce() {
        return $this->hasOne(JenisOSCE::class);
    }
}
