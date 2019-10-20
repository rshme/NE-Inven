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
        	['id_peminjaman'=>1, 'id_inventaris'=>1, 'jumlah'=>10],
        	['id_peminjaman'=>2, 'id_inventaris'=>2, 'jumlah'=>0],
            ['id_peminjaman'=>3, 'id_inventaris'=>3, 'jumlah'=>20],
        ];

        foreach($data as $detail){
        	DetailPinjam::create($detail);
        }
    }
}
