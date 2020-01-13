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
/**
 * Ruta Home del modulo de Recording
 */
Route::prefix('recording')->group(function() {
    Route::get('/', 'RecordingController@index');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL SUB MODULO DE Grabaciones
|--------------------------------------------------------------------------
*/
/**
 * Rutas para CRUD de Grabaciones
 */
Route::group(['namespace' => '\Modules\Recording\Http\Controllers', 'prefix' => 'recording', 'middleware' => 'auth'], function() {
    Route::resource('Grabaciones','GrabacionesController');
});
/**
 * Rutas para CRUD de Inbound
 */
Route::group(['namespace' => '\Modules\Recording\Http\Controllers', 'prefix' => 'recording', 'middleware' => 'auth'], function() {
    Route::get('Inbound/descargar/{fecha_inicio}/{fecha_fin}', 'InboundController@update');
    Route::post('Inbound/escuchar', 'InboundController@listen');
    Route::post('Inbound/descargar', 'InboundController@dowloadZip');
    Route::resource('Inbound','InboundController');
    Route::post('Inbound/store/{id}', 'InboundController@store');

});
/**
 * Rutas para CRUD de Outbound
 */
Route::group(['namespace' => '\Modules\Recording\Http\Controllers', 'prefix' => 'recording', 'middleware' => 'auth'], function() {
    Route::resource('Outbound','OutboundController');
});
/**
 * Rutas para CRUD de Manuales
 */
Route::group(['namespace' => '\Modules\Recording\Http\Controllers', 'prefix' => 'recording', 'middleware' => 'auth'], function() {
    Route::resource('Manuales','ManualesController');
});
/**
 * Rutas para CRUD de Almacenamiento
 */
Route::group(['namespace' => '\Modules\Recording\Http\Controllers', 'prefix' => 'recording', 'middleware' => 'auth'], function() {
    //Route::post('campanas/validar_modo_logueo', 'CampanasController@validar_modo_logueo')->name('campanas.validar_modo_logueo');
    //Route::post('campanas/eliminar-participantes', 'CampanasController@eliminar_participantes')->name('campanas.eliminar_participantes');
    Route::resource('Almacenamiento','AlmacenamientoController');
});
