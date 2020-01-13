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

Route::prefix('monitor')->group(function() {
    Route::get('/', 'MonitorController@index');
});
/**
 * Rutas para CRUD de Monitoreo
 */
Route::group(['namespace' => '\Modules\Monitor\Http\Controllers', 'prefix' => 'monitor', 'middleware' => 'auth'], function() {
    Route::post('monitoreo/LlamadaEstablecida','MonitoreoController@LlamadaEstablecida');
    Route::post('monitoreo/coaching','MonitoreoController@Llamada_coaching');
    Route::post('monitoreo/conferencia','MonitoreoController@Llamada_conferencia');
    Route::resource('monitoreo','MonitoreoController');
});
