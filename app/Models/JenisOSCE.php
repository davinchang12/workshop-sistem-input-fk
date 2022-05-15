<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisOSCE extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'jenisosce'
    ];

    public function jenisosce() {
        return $this->belongsTo(NilaiJenisOSCE::class, 'nilaijenisosce_id');
    }
}
