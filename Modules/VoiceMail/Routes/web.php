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

Route::prefix('voicemail')->group(function() {
    Route::get('/', 'VoiceMailController@index');
});
/**
 * Rutas para CRUD de Grabaciones buzon voz
 */
Route::group(['namespace' => '\Modules\VoiceMail\Http\Controllers', 'prefix' => 'voicemail', 'middleware' => 'auth'], function() {
    Route::get('grabaciones_voicemial/descargar/{fecha_inicio}/{fecha_fin}', 'GrabacionesBuzonVozController@update');
    Route::post('grabaciones_voicemial/escuchar', 'GrabacionesBuzonVozController@listen');
    Route::post('grabaciones_voicemial/descargar', 'GrabacionesBuzonVozController@dowloadZip');
    Route::resource('grabaciones_voicemial','GrabacionesBuzonVozController');
});
