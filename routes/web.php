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
use App\Models\Program;

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

// Permisos de crear programas, motivos y docentes
Route::get('user-settings', 'FunctionsController@settingUser')->name('settingUser')->middleware('permission:create user');
Route::get('/program-settings', 'FunctionsController@settingsProgram')->name('settingsProgram')->middleware('permission:create program');
Route::get('/motivos-setings', 'FunctionsController@settingsMotivo')->name('settingsMotivo')->middleware('permission:create motivo');
Route::get('/sedes-settings', 'FunctionsController@settingsSede')->name('settingsSede')->middleware('permission:create sede');
Route::get('/getPrograms', 'FunctionsController@getProgram')->name('getProgram')->middleware('permission:create sede');




// Route::get('/program', 'AdminController@program')->name('program');