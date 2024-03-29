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

// Auth::routes();

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
Route::get('historyBeratSampah', 'SetoranControllerAPI@totalBerat')->middleware('jwt.verify');

// Buku Tabungan Nasabah
Route::get('history', 'TabunganControllerAPI@index')->middleware('jwt.verify');
Route::get('saldo', 'TabunganControllerAPI@show')->middleware('jwt.verify');
Route::get('Total', 'SetoranControllerAPI@total')->middleware('jwt.verify');
Route::get('historySampah', 'JenisSampahControllerAPI@jenis')->middleware('jwt.verify');
Route::get('historySaldo', 'BukuTabunganController@saldo')->middleware('jwt.verify');

// Route Pengurus 2
Route::post('Jual', 'PenjualanControllerAPI@store')->middleware('jwt.verify');

// Get Jenis Sampah
Route::get('jenis', 'JenisSampahControllerAPI@index');

//message
Route::get('getMessangers', 'MessageController@index')->middleware('jwt.verify');
Route::get('getMessage/{id}', 'MessageController@getMessage')->middleware('jwt.verify');
Route::post('sendMessage/{id}', 'MessageController@sendMessage')->middleware('jwt.verify');

//reset password
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/email', 'UserControllerAPI@forgot');

//Resource
Route::resource('resource', 'UserController');