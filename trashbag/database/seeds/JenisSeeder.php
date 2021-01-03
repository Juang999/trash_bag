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
                'harga' => 300
            ],
            [
                'jenis_sampah' => 'Besi',
                'harga' => 3000
            ]
        ]);
    }
}
