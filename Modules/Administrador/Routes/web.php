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

Route::prefix('administrador')->group(function() {
    Route::get('/', 'AdministradorController@index');
});

Route::prefix('administrador')->group(function() {
    Route::get('/cuentas', 'AdministradorController@create')->name('administracion.cuentas');
});


