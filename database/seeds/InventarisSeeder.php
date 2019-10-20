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
            ['id_jenis'=>2, 'id_ruang'=>2, 'id_petugas'=>1, 'nama'=>'Meja Guru', 'kondisi'=>'Baik', 'keterangan'=>'Membeli di Toko Surya Citra', 'jumlah'=>20, 'kode_inventaris'=>'11-2-2-1-2', 'tanggal_register'=>'2019-10-01'],
            ['id_jenis'=>2, 'id_ruang'=>2, 'id_petugas'=>1, 'nama'=>'Kursi Siswa', 'kondisi'=>'Baik', 'keterangan'=>'Membeli di Toko Surya Citra', 'jumlah'=>20, 'kode_inventaris'=>'11-2-2-1-2', 'tanggal_register'=>'2019-10-05'],
            ['id_jenis'=>1, 'id_ruang'=>1, 'id_petugas'=>1, 'nama'=>'Laptop', 'kondisi'=>'Baik', 'keterangan'=>'Membeli di BEC', 'jumlah'=>50, 'kode_inventaris'=>'11-1-1-1-3', 'tanggal_register'=>'2019-10-10'],
            ['id_jenis'=>1, 'id_ruang'=>1, 'id_petugas'=>2, 'nama'=>'PC', 'kondisi'=>'Baik', 'keterangan'=>'Membeli di BEC', 'jumlah'=>100, 'kode_inventaris'=>'11-1-1-1-3', 'tanggal_register'=>'2019-10-12'],
            ['id_jenis'=>2, 'id_ruang'=>2, 'id_petugas'=>2, 'nama'=>'Papan Tulis', 'kondisi'=>'Baik', 'keterangan'=>'Membeli di Toko Surya Citra', 'jumlah'=>20, 'kode_inventaris'=>'11-2-2-1-4', 'tanggal_register'=>'2019-10-12'],
        ];

        foreach ($data as $inven) {
            Inventaris::create($inven);
        }
    }
}
