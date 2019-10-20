<?php

use Illuminate\Database\Seeder;
use App\Jenis;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['nama_jenis'=>'Alat Elektronik', 'kode_jenis'=>'ELE', 'keterangan'=>'Jenis Barang Elektronik'],
        	['nama_jenis'=>'Alat Belajar', 'kode_jenis'=>'ABE', 'keterangan'=>'Jenis Barang Untuk Belajar'],
            ['nama_jenis'=>'Alat Peraga', 'kode_jenis'=>'APE', 'keterangan'=>'Jenis Barang Untuk Olahraga'],
            ['nama_jenis'=>'Habis Dipakai', 'kode_jenis'=>'SPA', 'keterangan'=>'Jenis Barang Sekali Pakai'],
            ['nama_jenis'=>'Tidak Habis Dipakai', 'kode_jenis'=>'TSPA', 'keterangan'=>'Jenis Barang Tidak Sekali Pakai'],
        ];

        foreach($data as $jenis){
        	Jenis::create($jenis);
        }
    }
}
