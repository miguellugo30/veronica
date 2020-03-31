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
    Route::get('Metricas_ACD/descargar/{fecha_inicio}/{fecha_fin}', 'ACDController@update');
    Route::resource('Metricas_ACD','ACDController');
});
/**
* Rutas para CRUD de Reporte de Desglose de llamadas
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::get('Desglose_llamadas/descargar/{fecha_inicio}/{fecha_fin}', 'DesgloseLlamadasController@update');
    Route::resource('Desglose_llamadas','DesgloseLlamadasController');
});
/**
* Rutas para CRUD de Reporte de Calificaciones
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('ReporteCalificaciones','ReporteCalificacionesController');
});
/**
* Rutas para CRUD de Reporte de Llamadas por agentes
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('ReporteLlamadasAgentes','ReporteLlamadasAgentesController');
});
/**
* Rutas para CRUD de Reporte de Productividad de agentes
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::resource('ReporteProductividadAgentes','ReporteProductividadAgentesController');
});
/**
* Rutas para CRUD de Reporte de Desglose de llamadas
*/
Route::group(['namespace' => '\Modules\Inbound\Http\Controllers', 'prefix' => 'inbound', 'middleware' => 'auth'], function() {
    Route::get('real_time/agente/{id}','RealTimeController@real_time_agente');
    Route::get('real_time/detener/{id}','RealTimeController@detener_real_time');
    Route::get('real_time/agente/{id_agente}/{id}','RealTimeController@real_time_agente_status');
    Route::get('real_time/agente/{id_agente}/{id}/edit','RealTimeController@real_time_agente_llamada');
    Route::post('real_time/agente/{Agentes_id}/no_disponible','RealTimeController@no_disponible');
    Route::post('real_time/agente/{Agentes_id}/agente_disponible','RealTimeController@agente_disponible');
    Route::post('real_time/agente/{Agentes_id}/historial-llamadas','RealTimeController@historial_llamadas');
    Route::post('real_time/agente/{Agentes_id}/llamadas-abandonadas','RealTimeController@llamadas_abandonadas');
    Route::post('real_time/agente/{Agentes_id}/logeo-extension', 'RealTimeController@logeoExtension')->name('logeoExtension.agente');
    Route::post('real_time/agente/{Agentes_id}/colgar', 'RealTimeController@colgar')->name('colgarExtension.agente');
    Route::post('real_time/agente/{Agentes_id}', 'RealTimeController@store')->name('calificar.agente');

    Route::get('real_time/agente/{id_agente}/formularios/{id}', '\Modules\Settings\Http\Controllers\FormulariosController@show');
    Route::resource('real_time','RealTimeController');
});

