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

// Route::get('/profile', 'ShowProfile')->name('profile')->middleware('auth');

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

// Profile routes

Route::get('/profile', 'ProfileController@profile')->name('profile');

Route::patch('/profile/update/{id}', 'ProfileController@update')->name('profile.update');

// Movie Genre routes

Route::get('/genre/create', 'GenreController@create')->name('genre.show');

Route::post('/genre', 'GenreController@store')->name('genre.store');

Route::get('/genre/list', 'GenreController@index')->name('genre.list');

Route::delete('/genre/delete/{id}', 'GenreController@destroy')->name('genre.delete');

Route::get('/genre/edit/{id}', 'GenreController@edit')->name('genre.edit');

Route::patch('/genre/update/{id}', 'GenreController@update')->name('genre.update');

// Artisan command routes

Route::get('/foo/example', function(){
	$command = Artisan::call('foo:example', ['name' => 'Foo']);
});

// Cache routes

Route::get('/cache/users', function(){

	$value = Cache::rememberForever('users', function () {
    	return DB::table('users')->get();
	});

});

Route::get('/get/users', function(){
	$users = Cache::get('users');
	var_dump($users);
});

Route::get('/cache/movies', function(){

	$value = Cache::rememberForever('movies', function () {
    	return DB::table('movies')->get();
	});

});

Route::get('/get/movies', function(){
	$movies = Cache::get('movies');
	var_dump($movies);
});

// Category routes

Route::get('/category/create', 'CategoryController@create')->name('category.show');

Route::post('/category', 'CategoryController@store')->name('category.store');

Route::get('/category/list', 'CategoryController@index')->name('category.list');

Route::delete('/category/delete/{id}', 'CategoryController@destroy')->name('category.delete');

Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');

Route::patch('/category/update/{id}', 'CategoryController@update')->name('category.update');

// Product routes

Route::get('/product/create', 'ProductController@create')->name('product.show');

Route::post('/product', 'ProductController@store')->name('product.store');

Route::get('/product/list', 'ProductController@index')->name('product.list');

Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete');