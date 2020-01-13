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
    if (Auth::check()) {
        return view('home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/example', 'HomeController@example')->name('example');

Route::group(['middleware' => 'permission:create program'], function () {
    Route::get('/program-setings', 'FunctionsController@createProgram')->name('createProgram');
});

Route::get('/program', 'AdminController@program')->name('program');