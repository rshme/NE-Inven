<?php

use Illuminate\Database\Seeder;
use App\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['nama_pegawai'=>'Beni Rahayu', 'nip'=>'1323357', 'alamat'=>'Jln.Ahmad Yani No.34 Subang'],
        	['nama_pegawai'=>'Fani Anggraeni', 'nip'=>'4334366', 'alamat'=>'Jln.Anggrek No.12 Subang'],
        ];

        foreach($data as $pegawai)
        {
        	Pegawai::create($pegawai);
        }
    }
}
