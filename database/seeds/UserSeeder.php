<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['username'=>'petugas', 'password'=>bcrypt('petugas')],
        	['username'=>'pegawai', 'password'=>bcrypt('pegawai')],
        ];

        foreach($data as $user){
        	User::create($user);
        }
    }
}
