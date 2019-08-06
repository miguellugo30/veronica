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

Route::prefix('settings')->group(function() {
    Route::get('/', 'SettingsController@index');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL MODULO DE Tipificaciones
|--------------------------------------------------------------------------
*/
/**
 * Rutas para CRUD de Formularios
 */
Route::group(['namespace' => '\Modules\Settings\Http\Controllers', 'prefix' => 'settings', 'middleware' => 'auth'], function() {
    Route::resource('formularios','FormulariosController');
});
