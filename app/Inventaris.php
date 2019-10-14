<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $primaryKey = 'id_inventaris';

    protected $guarded = [
        'id_inventaris'
    ];

    public function detail()
    {
    	return $this->hasMany(DetailPinjam::class, 'id_inventaris');
    }

    public function jenis()
    {
    	return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function ruang()
    {
    	return $this->belongsTo(Ruang::class, 'id_ruang');
    }

    public function petugas()
    {
    	return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}
