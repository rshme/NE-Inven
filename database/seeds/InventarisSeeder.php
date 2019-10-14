<?php

use Illuminate\Database\Seeder;
use App\Inventaris;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['id_jenis'=>1, 'id_ruang'=>1, 'id_petugas'=>1, 'nama'=>'Laptop ACER', 'kondisi'=>'baik', 'keterangan'=>'Membeli di BEC', 'jumlah'=>50, 'kode_inventaris'=>'11-1-1-1-1', 'tanggal_register'=>'2019-10-11'],
            ['id_jenis'=>2, 'id_ruang'=>2, 'id_petugas'=>1, 'nama'=>'Meja Guru', 'kondisi'=>'baik', 'keterangan'=>'Barang Bagus', 'jumlah'=>50, 'kode_inventaris'=>'11-2-2-1-2', 'tanggal_register'=>'2019-10-11'],
            ['id_jenis'=>1, 'id_ruang'=>1, 'id_petugas'=>1, 'nama'=>'Laptop Lenovo', 'kondisi'=>'baik', 'keterangan'=>'Membeli di BEC', 'jumlah'=>50, 'kode_inventaris'=>'11-1-1-1-3', 'tanggal_register'=>'2019-10-11'],
            ['id_jenis'=>2, 'id_ruang'=>2, 'id_petugas'=>1, 'nama'=>'Papan Tulis', 'kondisi'=>'baik', 'keterangan'=>'Barang Bagus', 'jumlah'=>50, 'kode_inventaris'=>'11-2-2-1-4', 'tanggal_register'=>'2019-10-11'],
        ];

        foreach ($data as $inven) {
            Inventaris::create($inven);
        }
    }
}
