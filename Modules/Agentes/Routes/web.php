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
Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'middleware' => 'guest'], function() {
    Route::resource('agentes', 'AgentesController');
    Route::post('agentes/colgar', 'EventosAgenteController@colgar')->name('colgar.agente');
    Route::post('agentes/no_disponible', 'EventosAgenteController@no_disponible')->name('no_disponible.agente');
    Route::post('agentes/agente_disponible', 'EventosAgenteController@agente_disponible')->name('agente_disponible.agente');
    Route::post('agentes/historial-llamadas', 'EventosAgenteController@historial_llamadas')->name('historial_llamadas.agente');
    Route::post('agentes/llamadas-abandonadas', 'EventosAgenteController@llamadas_abandonadas')->name('llamadas_abandonadas.agente');
    Route::post('agentes/logeo-extension', 'EventosAgenteController@logeoExtension')->name('logeoExtension.agente');
});


Route::get('/agentes/formularios/{id}', '\Modules\Settings\Http\Controllers\FormulariosController@show');
/*
Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'prefix' => 'agentes'], function() {
    //Route::post('evento/answerd/', 'EventosPanelController@index');
    Route::post('evento/answerd/', function(){
        event(new \Nimbus\Events\answerdEvent("Heloo how are you"));
    });
});
*/
