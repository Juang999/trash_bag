<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama_lengkap' => 'ilahaka',
            'email' => 'ahmadarifilahaka77@gmail.com',
            'password' => Hash::make('password'),
            'no_telepon'=> '081234567890',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '5'
        ]);
    }
}
