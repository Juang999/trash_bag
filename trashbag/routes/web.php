<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => ['auth', 'role:5']], function () {
    Route::get('user/profile', 'UserController@profile');
    Route::get('user/{id}', 'UserController@getUbah');
    Route::put('user/editFoto/{id}', 'UserController@editFoto');
    Route::put('user/resetPass/{id}', 'UserController@resetPassword');

    Route::get('pengurus/delete/{id}', 'PengurusController@destroy');
    Route::resource('pengurus', 'PengurusController');

    Route::get('nasabah/create', 'NasabahController@create')->name('nasabah.create');
    Route::get('nasabah/delete/{id}', 'NasabahController@destroy');
    Route::post('nasabah', 'NasabahController@store');
    Route::put('nasabah/{id}', 'NasabahController@update');
    Route::get('nasabah/{id}/edit', 'NasabahController@edit');

    Route::get('jenis/getEdit/{id}', 'JenisSampahController@getEdit');
    Route::get('jenis/delete/{id}','JenisSampahController@destroy');
    Route::resource('jenis', 'JenisSampahController');
});

Route::group(['middleware' => ['auth','role:5,4']], function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('nasabah', 'NasabahController@index');
    Route::get('nasabah/{id}', 'NasabahController@show');
    Route::get('nasabah/buku/{id}', 'NasabahController@bukuTabungan');
    Route::post('nasabah/penarikan/{id}', 'NasabahController@penarikan');
    
    Route::get('setoran', 'SetoranController@index');
    Route::get('penjualan', 'PenjualanController@index');
    Route::get('keuangan', 'KeuanganController@index');
});




