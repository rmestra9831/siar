<?php
//RUTA DE CREACIOM DE RADICADO
Route::get('/{slug}/show', 'RadicadoController@viewRadic')->name('viewRadic')->middleware('auth','CanViewRadic');
Route::put('/{slug}/uploadFile', 'RadicadoController@uploadFile')->name('uploadFile')->middleware('auth');
Route::put('/{slug}/sentDir', 'RadicadoController@sentDir')->name('sentDir')->middleware('auth');
Route::put('/{slug}/getDir', 'RadicadoController@getDir')->name('getDir')->middleware('auth');
Route::get('/{slug}/download', 'RadicadoController@downloadRadic')->name('downloadRadic');
Route::get('/{slug}/downloadAnswer', 'RadicadoController@downloadAnswer')->name('downloadAnswer');
Route::get('/{slug}/downloadTemplateWord', 'RadicadoController@downloadTemplateWord')->name('downloadTemplateWord');
Route::put('/{slug}/sentAdmissions','RadicadoController@sentAdmissions')->name('sentAdmissions')->middleware('auth');
// Route::get('/{slug}/previewRadic','RadicadoController@previewRadic')->name('previewRadic')->middleware('auth');
//RESPUESTAS DEL RADICADO
Route::put('/{slug}/Answertext', 'AnswerController@Answertext')->name('Answertext')->middleware('auth');
Route::put('/{slug}/fileAnswer', 'AnswerController@fileAnswer')->name('fileAnswer')->middleware('auth');
Route::put('/{slug}/delegateAnswer', 'AnswerController@delegateAnswer')->name('delegateAnswer')->middleware('auth');
Route::put('/{slug}/redirectionAnswerPetition', 'AnswerController@redirectionAnswerPetition')->name('redirectionAnswerPetition')->middleware('auth');
//ACEPTAR O DENEGAR REDIRECCIONAMIENTO
Route::put('/{slug}/refuseRedirection','AnswerController@refuseRedirection')->name('refuseRedirection')->middleware('auth');
Route::put('/{slug}/acceptRedirection','AnswerController@acceptRedirection')->name('acceptRedirection')->middleware('auth');
//EDITAR RESPUESTA DEL RADICADO
Route::put('/{slug}/EditAnswer','AnswerController@EditAnswer')->name('EditAnswer')->middleware('auth');
Route::put('/{slug}/aproveAnswer','AnswerController@aproveAnswer')->name('aproveAnswer')->middleware('auth');
//NOTIFICACIONES
Route::put('/{user}/readNotify','RadicadoController@readNotify')->name('readNotify')->middleware('auth');
Route::put('/{user}/readAllNotify','RadicadoController@readAllNotify')->name('readAllNotify')->middleware('auth');