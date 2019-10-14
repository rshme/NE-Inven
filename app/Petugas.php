<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $primaryKey = 'id_petugas';

    protected $guarded = [
        'id_petugas'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function inventaris()
    {
    	return $this->hasMany(Inventaris::class, 'id_petugas');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
}
