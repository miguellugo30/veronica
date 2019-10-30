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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/agentes/login', 'AgentesLoginController@showAgentesLoginForm');
Route::post('/agentes/login', 'AgentesLoginController@agentesLogin');

Route::get('/agentes/extension', 'AgentesLoginController@showAgentesExtension');
Route::post('/agentes/extension', 'AgentesLoginController@agentesExtension');

Route::post('/logout/agentes', 'AgentesLoginController@agentesLogout')->name('agentes.logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/soporte/{token}', 'SoporteController@index');

Route::prefix('administrador/')->group(function() {
    Route::get('categoria/{id}', 'subCategoriaController@index')->name('categoria')->middleware('auth');
});

Route::prefix('administrador/')->group(function() {
    Route::get('subcategoria/{id}', 'subCategoriaController@index')->name('subcategoria')->middleware('auth');
});
/**
 * Rutas para CRUD de Logs
 */
Route::group(['prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('logs','LogController');
});

