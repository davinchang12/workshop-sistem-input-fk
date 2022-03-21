<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kritik',
        'saran'
    ];

    protected $with = [
        'users', 
        'matkul'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function matkul() {
        return $this->belongsTo(Matakuliah::class);
    }
}
