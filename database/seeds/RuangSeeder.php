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
        	['nama_ruang'=>'Ruang Elektronik', 'kode_ruang'=>'B11', 'keterangan'=>'Ruang Barang Elektronik'],
        	['nama_ruang'=>'Ruang Peralatan Kelas', 'kode_ruang'=>'B12', 'keterangan'=>'Ruang Barang Peralatan Kelas'],
            ['nama_ruang'=>'Ruang Barang Sekali Pakai', 'kode_ruang'=>'A11', 'keterangan'=>'Ruang Barang Sekali Pakai'],
            ['nama_ruang'=>'Ruang Peraga', 'kode_ruang'=>'A12', 'keterangan'=>'Ruang Barang Peraga'],
        ];

        foreach($data as $jenis){
        	Ruang::create($jenis);
        }
    }
}
