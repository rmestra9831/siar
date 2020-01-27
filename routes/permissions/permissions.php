<?php

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
    Route::get('DirectPermissionsOnUser/{id}','FunctionsController@DirectPermissionsOnUser')->name('DirectPermissionsOnUser')->middleware('auth');
    Route::get('deleteViewDirectPermissionsOnUser/{id}','FunctionsController@deleteViewDirectPermissionsOnUser')->name('deleteViewDirectPermissionsOnUser')->middleware('auth');

    //POST
    Route::post('/assingPermissionsOnRole','FunctionsController@assingPermissionsOnRole')->name('assingPermissionsOnRole')->middleware('auth');
    Route::post('/assignDirectPermissionsOnUser','FunctionsController@assignDirectPermissionsOnUser')->name('assignDirectPermissionsOnUser')->middleware('auth');

    //DELETE
    Route::delete('deleteDirectPermissionsOnUser/{id}/delete','FunctionsController@deleteDirectPermissionsOnUser')->name('deleteDirectPermissionsOnUser');
});