<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('setlang')->group(function () {
    Route::middleware('isLogin')->group(function () {
        //logout
        Route::get('/logout', 'AuthController@logout')->name('auth.logout');

        // books:create
        Route::get('/books/create', 'BookController@create')->name('books.create');
        Route::post('/books/store', 'BookController@store')->name('books.store');

        // create notes
        Route::get('/notes/create', 'NoteController@create')->name('notes.create');
        Route::post('/notes/store', 'NoteController@store')->name('notes.store');

        // delete notes
        Route::get('/notes/delete/{id}', 'NoteController@delete')->name('notes.delete');
    });


    Route::middleware('isAdmin')->group(function () {
        // books:update
        Route::get('/books/edit/{id}', 'BookController@edit')->name('books.edit');
        Route::post('/books/update/{id}', 'BookController@update')->name('books.update');

        // books:delete
        Route::get('/books/delete/{id}', 'BookController@delete')->name('books.delete');

        // category:create
        Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
        Route::post('/categories/store', 'CategoryController@store')->name('categories.store');

        // category:update
        Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
        Route::post('/categories/update/{id}', 'CategoryController@update')->name('categories.update');

        // category:delete
        Route::get('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');
    });

    Route::middleware('isGuest')->group(function () {
        // register
        Route::get('/register', 'AuthController@register')->name('auth.register');
        Route::post('/hregister', 'AuthController@hRegister')->name('auth.hregister');

        //login
        Route::get('/login', 'AuthController@login')->name('auth.login');
        Route::post('/hlogin', 'AuthController@hLogin')->name('auth.hlogin');

        Route::get('login/github', 'AuthController@redirectToProvider')->name('auth.github.redirect');
        Route::get('login/github/callback', 'AuthController@handleProviderCallback')->name('auth.github.callback');
    });

    // books:read
    Route::get('/books', 'BookController@index')->name('books.index');
    Route::get('/books/show/{id}', 'BookController@show')->name('books.show');
    Route::get('/books/search', 'BookController@search')->name('books.search');


    // category:read
    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::get('/categories/show/{id}', 'CategoryController@show')->name('categories.show');

    Route::get('/lang/en', 'LangController@en')->name('lang.en');
    Route::get('/lang/ar', 'LangController@ar')->name('lang.ar');
});
