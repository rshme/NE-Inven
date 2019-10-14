<?php

use Illuminate\Database\Seeder;
use App\Ruang;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['nama_ruang'=>'Ruang Elektronik', 'kode_ruang'=>'A34&D4D', 'keterangan'=>'Ruang Barang Elektronik'],
        	['nama_ruang'=>'Ruang Peralatan Kelas', 'kode_ruang'=>'A56RD5D', 'keterangan'=>'Ruang Barang Peralatan Kelas'],
        ];

        foreach($data as $jenis){
        	Ruang::create($jenis);
        }
    }
}
