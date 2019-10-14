<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level';

    protected $primaryKey = 'id_level';

    protected $guarded = [
        'id_level'
    ];

    public function petugas()
    {
    	return $this->hasMany(Petugas::class, 'id_level');
    }
}
