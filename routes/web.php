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
Route::get('getUsers', 'FunctionsController@getUser')->name('getUser')->middleware('permission:settings user');
Route::get('user-settings', 'FunctionsController@settingUser')->name('settingUser')->middleware('permission:create user');
Route::put('/user-settings/user/{id}/edit', 'FunctionsController@editUser')->name('editUser')->middleware('permission:edit user');
Route::delete('/user-settings/{id}/delete', 'FunctionsController@deleteUser')->name('deleteUser')->middleware('permission:delete user');


Route::get('getPrograms', 'FunctionsController@getProgram')->name('getProgram')->middleware('permission:create sede');
Route::get('/program-settings', 'FunctionsController@settingsProgram')->name('settingsProgram')->middleware('permission:create program');
Route::put('/program-settings/program/{id}/edit', 'FunctionsController@editProgram')->name('editProgram')->middleware('permission:edit program');
Route::delete('/program-settings/{id}/delete', 'FunctionsController@deleteProgram')->name('deleteProgram')->middleware('permission:delete program');

Route::get('/sedes-settings', 'FunctionsController@settingsSede')->name('settingsSede')->middleware('permission:settings sede');
Route::get('getSedes', 'FunctionsController@getSede')->name('getSede')->middleware('permission:create motivo');
Route::put('/sede-settings/sede{id}/edit', 'FunctionsController@editSede')->name('editSede')->middleware('permission:create motivo');
Route::delete('/sede-settings/{id}/delete', 'FunctionsController@deleteSede')->name('deleteSede')->middleware('permission:create motivo');

Route::get('/motivos-setings', 'FunctionsController@settingsMotivo')->name('settingsMotivo')->middleware('permission:settings motivo');

//trayendo permisos segun usuario
Route::group(['middleware' => ['role:Super Admin']], function () {
    Route::get('/Permissions', 'FunctionsController@Permissions')->name('Permissions')->middleware('auth');
    Route::get('getUserPermissions', 'FunctionsController@getUserPermissions')->name('getUserPermissions')->middleware('auth');
    Route::get('getPermissions/{id}', 'FunctionsController@getPermissions')->name('getPermissions')->middleware('auth');
    Route::get('getPermissionsOnRole/{id}', 'FunctionsController@getPermissionsOnRole')->name('getPermissionsOnRole')->middleware('auth');
    Route::get('getRole', 'FunctionsController@getRole')->name('getRole')->middleware('auth');
    Route::get('getAllPermissions', 'FunctionsController@getAllPermissions')->name('getAllPermissions')->middleware('auth');
    Route::get('getAddPermissions/{id}', 'FunctionsController@getAddPermissions')->name('getAddPermissions')->middleware('auth');
    Route::get('permission/{id}/delete', 'FunctionsController@deletePermission')->name('deletePermission')->middleware('auth');
});


// Route::get('/program', 'AdminController@program')->name('program');