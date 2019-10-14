<?php

use Illuminate\Database\Seeder;
use App\Petugas;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['user_id'=>1, 'nama_petugas'=>'Panji Saputra', 'id_level'=>1];

        Petugas::create($data);
    }
}
