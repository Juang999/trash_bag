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
        $this->call(UserSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(SetoranSeeder::class);
        $this->call(TabunganSeeder::class);
        $this->call(KeuanganSeeder::class);
    }
}
