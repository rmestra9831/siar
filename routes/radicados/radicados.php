<?php

//RUTA DE CREACIOM DE RADICADO
Route::get('/{slug}/show', 'RadicadoController@viewRadic')->name('viewRadic')->middleware('auth');
Route::put('/{slug}/uploadFile', 'RadicadoController@uploadFile')->name('uploadFile')->middleware('auth');
Route::put('/{slug}/sentDir', 'RadicadoController@sentDir')->name('sentDir')->middleware('auth');
Route::put('/{slug}/getDir', 'RadicadoController@getDir')->name('getDir')->middleware('auth');
Route::get('/{slug}/download', 'RadicadoController@downloadRadic')->name('downloadRadic');

//RESPUESTAS DEL RADICADO
Route::put('/{slug}/Answertext', 'AnswerController@Answertext')->name('Answertext')->middleware('auth');
Route::put('/{slug}/fileAnswer', 'AnswerController@fileAnswer')->name('fileAnswer')->middleware('auth');
Route::put('/{slug}/delegateAnswer', 'AnswerController@delegateAnswer')->name('delegateAnswer')->middleware('auth');
Route::put('/{slug}/redirectionAnswerPetition', 'AnswerController@redirectionAnswerPetition')->name('redirectionAnswerPetition')->middleware('auth');
//ACEPTAR O DENEGAR REDIRECCIONAMIENTO
Route::put('/{slug}/refuseRedirection','AnswerController@refuseRedirection')->name('refuseRedirection')->middleware('auth');
Route::put('/{slug}/acceptRedirection','AnswerController@acceptRedirection')->name('acceptRedirection')->middleware('auth');