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

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/foo', 'TestController@foo')->name('foo');

Route::get('/bar', 'TestController@bar')->name('bar');

Route::get('/baz', 'TestController@baz')->name('baz');

Route::get('/test', 'TestController@test')->name('test');

Route::get('/profile', 'ShowProfile')->name('profile')->middleware('auth');

Route::resource('photos', 'PhotoController');

// Post routes

Route::get('/posts/create', 'PostController@create')->name('post.show');

Route::post('/posts', 'PostController@store')->name('post.store');

Route::get('/posts/list', 'PostController@index')->name('post.list');

Route::delete('/posts/delete/{id}', 'PostController@destroy')->name('post.delete');

Route::get('/posts/edit/{id}', 'PostController@edit')->name('post.edit');

Route::patch('/posts/update/{id}', 'PostController@update')->name('post.update');

// Movie routes

Route::get('/movie/create', 'MovieController@create')->name('movie.show');

Route::post('/movie', 'MovieController@store')->name('movie.store');

Route::get('/movie/list', 'MovieController@index')->name('movie.list');

Route::delete('/movie/delete/{id}', 'MovieController@destroy')->name('movie.delete');

Route::get('/movie/edit/{id}', 'MovieController@edit')->name('movie.edit');

Route::patch('/movie/update/{id}', 'MovieController@update')->name('movie.update');

// Verify email routes

Auth::routes(['verify' => true]);