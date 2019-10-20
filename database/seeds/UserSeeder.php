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
            ['username'=>'admin', 'password'=>bcrypt('admin')],
            ['username'=>'petugas', 'password'=>bcrypt('petugas')],
        ];
        
        foreach($data as $petugas){
            User::create($petugas);
        }

    }
}
