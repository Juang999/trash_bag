<?php

use Illuminate\Database\Seeder;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keuangans')->insert([
            'saldo' => 0,
        ]);
    }
}
