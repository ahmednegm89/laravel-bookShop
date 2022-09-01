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


// book api
Route::get('/books', 'ApiBookController@index');
Route::get('/books/show/{id}', 'ApiBookController@show');


Route::middleware('isApiUser')->group(function () {
    Route::post('/books/store', 'ApiBookController@store');
    Route::post('/books/update/{id}', 'ApiBookController@update');
    Route::get('/books/delete/{id}', 'ApiBookController@delete');
});


// login/register
Route::post('/hlogin', 'ApiAuthController@hLogin');
Route::post('/hregister', 'ApiAuthController@hRegister');
Route::post('/logout', 'ApiAuthController@hLogout');
