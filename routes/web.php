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

Route::get('/index', 'HomeController@index')->name('index');

Route::get('/users', 'UserController@show')->name('users.show');

Route::get('/profile/{user}','ProfileController@show')->name('profile.show');
Route::get('/profile/{user}/edit','ProfileController@edit')->name('profile.edit');
Route::post('/profile/{user}/update','ProfileController@update');
