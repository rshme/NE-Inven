<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    protected $guarded = [
        'id_peminjaman'
    ];

    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function detail()
    {
    	return $this->hasOne(DetailPinjam::class, 'id_peminjaman');
    }
}
