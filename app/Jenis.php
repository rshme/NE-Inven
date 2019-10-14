<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';

    protected $primaryKey = 'id_jenis';

    protected $guarded = [
        'id_jenis'
    ];

    public function inventaris()
    {
    	return $this->hasMany(Inventaris::class, 'id_jenis');
    }
}
