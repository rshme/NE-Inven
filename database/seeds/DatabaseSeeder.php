<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PetugasSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(RuangSeeder::class);
        $this->call(InventarisSeeder::class);
        $this->call(PeminjamanSeeder::class);
        $this->call(DetailPeminjamanSeeder::class);
    }
}
