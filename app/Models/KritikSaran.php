<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KritikSaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kritik',
        'saran'
    ];

    protected $with = [
        'users', 
        'jadwals'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
    public function jadwals() {
        return $this->belongsTo(Jadwal::class);
    }

}
