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
        	['nama_pegawai'=>'Beni Rahayu', 'nip'=>'11700787', 'alamat'=>'Jln.Ahmad Yani No.34 Subang'],
        	['nama_pegawai'=>'Fani Anggraeni', 'nip'=>'11700999', 'alamat'=>'Jln.Anggrek No.12 Subang'],
            ['nama_pegawai'=>'Anggi Nur', 'nip'=>'11700889', 'alamat'=>'Jln.Anggrek No.15 Subang'],
        ];

        foreach($data as $pegawai)
        {
        	Pegawai::create($pegawai);
        }
    }
}
