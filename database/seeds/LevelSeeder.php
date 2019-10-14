<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['nama_level'=>'Administrator'],
        	['nama_level'=>'Operator'],
        ];

        foreach($data as $level){
        	Level::create($level);
        }
    }
}
