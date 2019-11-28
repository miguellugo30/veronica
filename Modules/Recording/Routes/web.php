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
    Route::get('/', 'RecordingController@index')->middleware('auth')->name('recording');
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
    Route::resource('Inbound','InboundController');
    Route::get('Inbound', 'InboundController@index');
    Route::post('Inbound/store/{id}', 'InboundController@store');

    Route::get('Inbound/getAgentes/{id}', 'InboundController@getAgentes')->name('Inbound.getAgentes');
    Route::get('Inbound/getExtensiones/{id}','InboundController@getExtensiones')->name('Inbound.getExtensiones');
    Route::get('Inbound/getCalificaciones/{id}','InboundController@getCalificaciones')->name('Inbound.getCalificaciones');
    Route::get('Inbound/getGrabaciones/{id}','InboundController@getGrabaciones')->name('Inbound.getGrabaciones');

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
