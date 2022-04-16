<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisOSCE extends Model
{
    use HasFactory;
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
