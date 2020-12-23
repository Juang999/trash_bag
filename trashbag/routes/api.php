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

Route::post('register', 'UserControllerAPI@register');
Route::post('login', 'UserControllerAPI@login');
Route::get('book', 'BookControllerAPI@book');

Route::get('bookall', 'BookControllerAPI@bookAuth')->middleware('jwt.verify');
Route::get('user', 'UserControllerAPI@getAuthenticatedUser')->middleware('jwt.verify');
Route::patch('user/{id}', 'UserControllerAPI@update');

Route::resource('resource', 'UserController');