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
* Rutas para CRUD de Desvios
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Buzon_Voz','BuzonVozController');
});
/**
* Rutas para CRUD de Desvios
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('Did_Enrutamiento','DidEnrutamientoController');
});