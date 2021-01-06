<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Login & Register
Route::post('register', 'UserControllerAPI@register');
Route::post('login', 'UserControllerAPI@login');
Route::get('book', 'BookControllerAPI@book');
Route::get('bookall', 'BookControllerAPI@bookAuth')->middleware('jwt.verify');
Route::get('user', 'UserControllerAPI@getAuthenticatedUser')->middleware('jwt.verify');
Route::patch('user/{id}', 'UserControllerAPI@update')->middleware('jwt.verify');

// Antar & Jemput Sampah
Route::post('store', 'SetoranControllerAPI@store')->middleware('jwt.verify');
Route::post('Jemput', 'SetoranControllerAPI@jemput')->middleware('jwt.verify');
Route::get('index', 'SetoranControllerAPI@index')->middleware('jwt.verify');
Route::patch('updateJemput/{id}', 'SetoranControllerAPI@jemputUpdate')->middleware('jwt.verify');
Route::patch('jumlahJemput/{id}', 'SetoranControllerAPI@jemputHarga')->middleware('jwt.verify');

// Buku Tabungan Nasabah
Route::get('history', 'TabunganControllerAPI@index')->middleware('jwt.verify');
Route::get('saldo', 'TabunganControllerAPI@show')->middleware('jwt.verify');

// Penjualan Sampah
Route::post('Jual', 'PenjualanControllerAPI@store')->middleware('jwt.verify');

// Get Jenis Sampah
Route::get('jenis', 'JenisSampahControllerAPI@index')->middleware('jwt.verify');

//Resource
Route::resource('resource', 'UserController');