<?php

use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenissampah')->insert([
            [
                'jenis_sampah' => 'besi',
                'harga' => 15000,
            ],[
                'jenis_sampah' => 'botol',
                'harga' => 5000,
            ],[
                'jenis_sampah' => 'kaca',
                'harga' => 10000,
            ]
        ]);
    }
}
