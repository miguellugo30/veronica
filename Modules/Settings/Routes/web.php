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

Route::prefix('settings')->group(function() {
    Route::get('/', 'SettingsController@index');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL MODULO DE Tipificaciones
|--------------------------------------------------------------------------
*/
/**
 * Rutas para CRUD de Formularios
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::get('/formularios/duplicar/{id}', 'FormulariosController@duplicate');
    Route::resource('formularios','FormulariosController');
});
/**
 * Rutas para CRUD de Sub Formularios
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('subformularios','SubFormularioController');
});
/**
 * Rutas para CRUD de Sub Formularios
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('campos','CamposController');
});
/**
 * Rutas para CRUD de Speech
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('speech','SpeechController');
});
/**
 * Rutas para CRUD de Calificaciones
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::get('/calificaciones/eliminarCalificacion/{id}', 'CalificacionesController@destroyCalificacion');
    Route::get('/calificaciones/duplicar/{id}', 'CalificacionesController@duplicate');
    Route::resource('calificaciones','CalificacionesController');
});
/**
 * Rutas para CRUD de Audios_Empresas
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('Audios','AudiosEmpresasController');
});
/**
 * Rutas para CRUD de Agentes
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('Agentes','AgentesController');
});
/**
 * Rutas para CRUD de Agentes
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('Grupos','GruposController');
});
