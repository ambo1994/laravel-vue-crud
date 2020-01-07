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


Route::get('blogDashboard','PostController@index')->name('blog-dashboard');
Route::get('add-post','PostController@addPost')->name('add-post');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

