<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiJenisOSCE extends Model
{
    use HasFactory;

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
