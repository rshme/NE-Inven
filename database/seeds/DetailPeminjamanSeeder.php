<?php

use Illuminate\Database\Seeder;
use App\DetailPinjam;

class DetailPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['id_peminjaman'=>1, 'id_inventaris'=>1, 'jumlah'=>5],
        	['id_peminjaman'=>2, 'id_inventaris'=>1, 'jumlah'=>5],
        ];

        foreach($data as $detail){
        	DetailPinjam::create($detail);
        }
    }
}
