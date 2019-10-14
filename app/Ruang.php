<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
	protected $table = 'ruang';

    protected $primaryKey = 'id_ruang';

    protected $guarded = [
        'id_ruang'
    ];

    public function inventaris()
    {
    	return $this->hasMany(Inventaris::class, 'id_ruang');
    }
}
