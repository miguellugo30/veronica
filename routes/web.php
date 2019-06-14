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

Route::resource('pruebaGet', 'EjemploController');

##-------

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('administrador/')->group(function() {
    Route::get('categoria/{id}', 'subCategoriaController@index')->name('categoria');
});

Route::prefix('administrador/')->group(function() {
    Route::get('subcategoria/{id}', 'subCategoriaController@index')->name('subcategoria');
});

//Route::resource('usuarios/', 'UsuariosController');
//Route::resource('administrador/usuarios/', '\Modules\Administrador\Http\Controllers\UsuariosController');
