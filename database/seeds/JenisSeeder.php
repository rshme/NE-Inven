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
        	['nama_jenis'=>'Elektronik', 'kode_jenis'=>'A34ED4D', 'keterangan'=>'Jenis Barang Elektronik'],
        	['nama_jenis'=>'Peralatan Kelas', 'kode_jenis'=>'A56ED5D', 'keterangan'=>'Jenis Barang Peralatan Kelas'],
        ];

        foreach($data as $jenis){
        	Jenis::create($jenis);
        }
    }
}
