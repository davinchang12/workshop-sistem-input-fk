<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiLain extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'users'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nilaifieldlab() {
        return $this->hasMany(NilaiFieldlab::class);
    }

    public function nilaiosce() {
        return $this->hasMany(NilaiOSCE::class);
    }
}
