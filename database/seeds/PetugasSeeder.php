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
        $data = [
            ['user_id'=>1, 'nama_petugas'=>'Panji Saputra', 'id_level'=>1],
            ['user_id'=>2, 'nama_petugas'=>'John Doe', 'id_level'=>2],
        ];

        foreach ($data as $petugas) {
            Petugas::create($petugas);
        }
    }
}
