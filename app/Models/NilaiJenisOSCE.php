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

    public function osce() {
        return $this->belongsTo(NilaiOSCE::class);
    }
}
