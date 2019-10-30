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

//Route::prefix('agentes')->group(function() {
//Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'prefix' => 'agentes', 'middleware' => 'auth'], function() {
Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'middleware' => 'guest'], function() {
    Route::resource('agentes', 'AgentesController');
});

Route::get('/agentes/formularios/{id}', '\Modules\Settings\Http\Controllers\FormulariosController@show');

Route::group(['namespace' => '\Modules\Agentes\Http\Controllers', 'prefix' => 'agentes'], function() {
    //Route::post('evento/answerd/', 'EventosPanelController@index');
    Route::post('evento/answerd/', function(){
        event(new \Nimbus\Events\answerdEvent("Heloo how are you"));
    });
});
