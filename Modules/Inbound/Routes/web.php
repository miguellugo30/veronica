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

Route::prefix('inbound')->group(function() {
    Route::get('/', 'InboundController@index');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL MODULO DE Campanas
|--------------------------------------------------------------------------
*/
/**
 * Rutas para CRUD de Campanas
 */
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::post('campanas/validar_modo_logueo', 'CampanasController@validar_modo_logueo')->name('campanas.validar_modo_logueo');
    Route::post('campanas/eliminar-participantes', 'CampanasController@eliminar_participantes')->name('campanas.eliminar_participantes');
    Route::resource('campanas','CampanasController');
});
/**
 * Rutas para CRUD de Condiciones_Tiempo
 */
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Condiciones_Tiempo','CondicionesTiempoController');
});
/**
 * Rutas para CRUD de Desvios
 */
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Desvios','DesviosController');
});
/**
* Rutas para CRUD de Buzon de voz
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Buzon_Voz','BuzonVozController');
});
/**
* Rutas para CRUD de Enrutamientos
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Did_Enrutamiento','DidEnrutamientoController');
});
/**
* Rutas para CRUD de IVR
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Ivr','IvrController');
});
/**
* Rutas para CRUD de IVR Opciones
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Ivr_Opciones','OpcionesIvrController');
});
/**
* Rutas para CRUD de Metricas ACD
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Metricas_ACD','ACDController');
});
/**
* Rutas para CRUD de Reporte de Desglose de llamadas
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Desglose_llamadas','DesgloseLlamadasController');
});

