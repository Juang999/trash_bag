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
                'jenis_sampah' => 'Plastik',
                'harga' => 2000
            ],[
                'jenis_sampah' => 'Besi',
                'harga' => 15000
            ],[
                'jenis_sampah' => 'Koran',
                'harga' => 3500
            ],[
                'jenis_sampah' => 'Botol',
                'harga' => 5000
            ],[
                'jenis_sampah' => 'Kardus',
                'harga' => 3000
            ],[
                'jenis_sampah' => 'Triplek',
                'harga' => 2000
            ]
        ]);
    }
}
