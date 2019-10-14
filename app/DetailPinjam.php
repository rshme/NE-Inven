<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{
    protected $table = 'detail_pinjam';

    protected $primaryKey = 'id_detail_pinjam';

    protected $guarded = [
        'id_detail_pinjam'
    ]; 

    public function inventaris()
    {
    	return $this->belongsTo(Inventaris::class, 'id_inventaris');
    }

    public function peminjaman()
    {
    	return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}
