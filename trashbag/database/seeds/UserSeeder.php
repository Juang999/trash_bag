<?php

use Illuminate\Database\Seeder;
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
            [
            'nama_lengkap' => 'Juang666',
            'email' => 'Juang666@gmail.com',
            'password' => Hash::make('Juang666'),
            'no_telepon'=> '087871504747',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '1'
            ],[
            'nama_lengkap' => 'Hariri Pratama',
            'email' => 'Hariri123@gmail.com',
            'password' => Hash::make('Hariri1123'),
            'no_telepon'=> '087871504747',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '1'
            ],[
            'nama_lengkap' => 'Ahmad Dani',
            'email' => 'zen1@gmail.com',
            'password' => Hash::make('Ahmad123'),
            'no_telepon'=> '087871504747',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '2'
            ],[
            'nama_lengkap' => 'Mahmudah Anggraeni',
            'email' => 'Mahmudah123@gmail.com',
            'password' => Hash::make('Mahmudah123'),
            'no_telepon'=> '0874788587667',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '3'
            ],[
            'nama_lengkap' => 'Super Admin',
            'email' => 'superadmin@email.com',
            'password' => Hash::make('password'),
            'no_telepon'=> '0874788587667',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '5'
            ],[
            'nama_lengkap' => 'Bangkit Juang Raharjo',
            'email' => 'Juang123@gmail.com',
            'password' => Hash::make('Juang123'),
            'no_telepon'=> '0874788587667',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '3'
            ],[
            'nama_lengkap' => 'zen',
            'email' => 'zen@yahoo.com',
            'password' => Hash::make('1234567890'),
            'no_telepon'=> '0874788587667',
            'alamat'=>'pondok programmer', 
            'foto_profil' => 'https://via.placeholder.com/150',
            'role'=> '1'
            ]
        ]);
    }
}
