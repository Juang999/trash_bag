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

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('user/profile', 'UserController@profile');
    Route::get('user/{id}', 'UserController@getUbah');
    Route::put('user/editFoto/{id}', 'UserController@editFoto');
    Route::put('user/resetPass/{id}', 'UserController@resetPassword');
    Route::resource('user', 'UserController');

    Route::get('pengurus/delete/{id}', 'PengurusController@destroy');
    Route::resource('pengurus', 'PengurusController');

    Route::get('nasabah/delete/{id}', 'NasabahController@destroy');
    Route::resource('nasabah', 'NasabahController');

    Route::get('jenis/getEdit/{id}', 'JenisSampahController@getEdit');
    Route::get('jenis/delete/{id}','JenisSampahController@destroy');
    Route::resource('jenis', 'JenisSampahController');

    Route::get('setoran', 'SetoranController@index');
    Route::get('penjualan', 'PenjualanController@index');
});


