<?php

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
Route::resource('/post', 'PostsController');

Route::resource('/categories', 'CategoriesController');
//----Add to whishlist
Route::post('/post/{post}/favourites', 'FavouriteController@store')->name('post.fav.store');
Route::delete('/post/{post}/favourites', 'FavouriteController@destroy')->name('post.fav.destroy');
Route::get('/whishlist', 'FavouriteController@index');
//----

//---Like or Unlike
Route::post('/post/{post}/liked', 'LikesController@store')->name('post.like.store');
Route::delete('/post/{post}/liked', 'LikesController@destroy')->name('post.like.destroy');
