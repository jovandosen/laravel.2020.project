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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/foo', 'TestController@foo')->name('foo');

Route::get('/bar', 'TestController@bar')->name('bar');

Route::get('/baz', 'TestController@baz')->name('baz');

Route::get('/test', 'TestController@test')->name('test');