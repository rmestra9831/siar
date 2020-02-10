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
use App\Models\Radicado;
use App\User;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\RedirectionRespon;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/example', 'HomeController@example')->name('example');




// Permisos de crear programas, motivos y docentes
Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('getUsers', 'FunctionsController@getUser')->name('getUser')->middleware('permission:settings user');
    Route::get('user-settings', 'FunctionsController@settingUser')->name('settingUser')->middleware('permission:create user');
    Route::put('/user-settings/user/{id}/edit', 'FunctionsController@editUser')->name('editUser')->middleware('permission:edit user');
    Route::delete('/user-settings/{id}/delete', 'FunctionsController@deleteUser')->name('deleteUser')->middleware('permission:delete user');


    Route::get('getPrograms', 'FunctionsController@getProgram')->name('getProgram')->middleware('permission:create sede');
    Route::get('program-settings', 'FunctionsController@settingsProgram')->name('settingsProgram')->middleware('permission:create program');
    Route::put('program-settings/program/{id}/edit', 'FunctionsController@editProgram')->name('editProgram')->middleware('permission:edit program');
    Route::delete('program-settings/{id}/delete', 'FunctionsController@deleteProgram')->name('deleteProgram')->middleware('permission:delete program');

    Route::get('sedes-settings', 'FunctionsController@settingsSede')->name('settingsSede')->middleware('permission:settings sede');
    Route::get('getSedes', 'FunctionsController@getSede')->name('getSede')->middleware('permission:create motivo');
    Route::put('sede-settings/sede{id}/edit', 'FunctionsController@editSede')->name('editSede')->middleware('permission:create motivo');
    Route::delete('/sede-settings/{id}/delete', 'FunctionsController@deleteSede')->name('deleteSede')->middleware('permission:create motivo');

    Route::get('motivos-setings', 'FunctionsController@settingsMotivo')->name('settingsMotivo')->middleware('permission:settings motivo');
});

//RUTA DE CREACIOn DE RADICADO
    Route::resource('radicado', 'RadicadoController', ['only' => ['index', 'store']])->middleware('permission:create radicado');
    Route::get('getDataSelects', 'RadicadoController@getDataSelects')->middleware('permission:create radicado');
    Route::get('getReasons/{id}', 'RadicadoController@getReasons')->middleware('permission:create radicado');
    Route::get('getRadicados', 'RadicadoController@getRadicados')->middleware('auth');
    Route::get('/getonlyUsers', 'FunctionsController@onlyUsers')->name('onlyUsers');

//vista previa de emails
Route::get('mail', function () {
    $radicado = App\Models\Radicado::find(1);
    return (new MailMessage)->markdown('mail/notify/sentDir', compact('radicado'));
});
Route::get('mailSent/{slug}', function ($slug) {
    $radicado = Radicado::where('slug',$slug)->firstOrFail();
    $user = User::find(2);
    $url = $_SERVER['HTTP_HOST'];
    // $user->notify(new DelegateUser($radicado, $url));
    // return response()->json($radicado);
    return (new MailMessage)->markdown('mail/notify/RedirectionRespon', compact('radicado','url'));
});
