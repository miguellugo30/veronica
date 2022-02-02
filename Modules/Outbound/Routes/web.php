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

Route::prefix('outbound')->group(function() {
    Route::get('/', 'OutboundController@index');
});

/**
 * Rutas para CRUD de Campanas
 */
Route::group(['namespace' => '\Modules\Outbound\Http\Controllers', 'prefix' => 'outbound', 'middleware' => 'auth', 'name' => 'campanas_outbound.'], function () {
    Route::post('campanas/validar_modo_logueo', 'CampanasController@validar_modo_logueo')->name('campanas.validar_modo_logueo');
    Route::post('campanas/eliminar-participantes', 'CampanasController@eliminar_participantes')->name('campanas_outbound.eliminar_participantes');
    Route::post('campanas/iniciar-campana', 'CampanasController@iniciar_campana')->name('campanas.iniciar');
    Route::post('campanas/detener-campana', 'CampanasController@detener_campana')->name('campanas.detener');
    Route::resource('campanas', 'CampanasController');
});
