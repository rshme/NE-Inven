<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $guarded = [
        'id_pegawai'
    ];

    public function peminjaman()
    {
    	return $this->hasMany(Peminjaman::class, 'id_pegawai');
    }
}
