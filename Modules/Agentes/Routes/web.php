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

//Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'prefix' => 'agentes', 'middleware' => 'auth'], function() {
Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'middleware' => 'auth.agentes'], function() {
    Route::resource('agentes', 'AgentesController');
    Route::post('agentes/colgar', 'AgentesController@colgar')->name('colgar.agente');
    Route::post('agentes/no_disponible', 'AgentesController@no_disponible')->name('no_disponible.agente');
    Route::post('agentes/agente_disponible', 'AgentesController@agente_disponible')->name('agente_disponible.agente');
    Route::post('agentes/historial-llamadas', 'AgentesController@historial_llamadas')->name('historial_llamadas.agente');
    Route::post('agentes/llamadas-abandonadas', 'AgentesController@llamadas_abandonadas')->name('llamadas_abandonadas.agente');
    Route::post('agentes/logeo-extension', 'AgentesController@logeoExtension')->name('logeoExtension.agente');
});

Route::get('/agentes/formularios/{id}', '\Modules\Settings\Http\Controllers\FormulariosController@show');
Route::get('/agentes/speech/{id}', '\Modules\Settings\Http\Controllers\SpeechController@show');
Route::get('/agentes/opciones_transferencia/{id}', '\Modules\Inbound\Http\Controllers\DidEnrutamientoController@show');
