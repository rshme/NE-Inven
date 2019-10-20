<?php

use Illuminate\Database\Seeder;
use App\Peminjaman;
use Jenssegers\Date\Date as Date;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['id_pegawai'=>1, 'tanggal_pinjam'=>'2019-10-05', 'status_peminjaman'=>'Belum Kembali'],
        	['id_pegawai'=>2, 'tanggal_pinjam'=>'2019-10-07', 'tanggal_kembali'=>'2019-12-07', 'status_peminjaman'=>'Sudah Kembali'],
            ['id_pegawai'=>3, 'tanggal_pinjam'=>'2019-10-10', 'status_peminjaman'=>'Belum Kembali'],
        ];

        foreach($data as $peminjaman){
        	Peminjaman::create($peminjaman);
        }
    }
}
