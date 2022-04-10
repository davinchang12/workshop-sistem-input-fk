<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPBLSkenarioDiskusi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'skenario'
    ];

    public function skenario() {
        return $this->belongsTo(NilaiPBLSkenario::class, 'nilaipblskenario_id');
    }

    public function nilai() {
        return $this->hasMany(NilaiPBLSkenarioDiskusiNilai::class);
    }

    public function nilai_user() {
        return NilaiPBLSkenarioDiskusi::select('nilai_p_b_l_skenario_diskusis.*')
            ->join('nilai_p_b_l_skenarios', 'nilai_p_b_l_skenario_diskusis.nilaipblskenario_id', '=', 'nilai_p_b_l_skenarios.id')
            ->join('nilai_p_b_l_s', 'nilai_p_b_l_skenarios.nilaipbl_id', '=', 'nilai_p_b_l_s.id')
            ->join('nilais', 'nilai_p_b_l_s.nilai_id', '=', 'nilais.id')
            ->join('users', 'nilais.user_id', '=', 'users.id')
            ->get();
    }
}
