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
        	['id_pegawai'=>1, 'tanggal_pinjam'=>Date::now()->format('Y-m-d'), 'status_peminjaman'=>'belum_kembali'],
        	['id_pegawai'=>2, 'tanggal_pinjam'=>Date::now()->format('Y-m-d'), 'tanggal_kembali'=>'2019-12-7', 'status_peminjaman'=>'sudah_kembali'],
        ];

        foreach($data as $peminjaman){
        	Peminjaman::create($peminjaman);
        }
    }
}
