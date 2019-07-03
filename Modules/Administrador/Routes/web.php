<?php

/*
|--------------------------------------------------------------------------
| RUTAS PARA EL MODULO DE ADMINISTRADOR
|--------------------------------------------------------------------------
|
| namespace => Indica donde viviran los controladores que usaran las rutas
| prefix => Indica que se antenpondra a la ruta para poder diferenciarlo de los demas modulos
| middleware => Indica que middleware estaran usandos las rutas en todas las peticiones
|
*/
/**
 * Ruta Home del modulo de Administrador
 */
Route::prefix('administrador')->group(function() {
    Route::get('/', 'AdministradorController@index')->middleware('auth');
});
/**
 * Rutas para CRUD de Usuarios
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('usuarios','UsuariosController');
});
/**
 * Rutas para CRUD de Menus
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/menus/updateOrdering', 'MenusController@updateOrdering')->name('menus.updateOrdering');
    Route::get('/menus/ordering', 'MenusController@ordering')->name('menus.ordering');
    Route::resource('menus','MenusController');
});
/**
 * Rutas para CRUD de Sub Menus
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/submenus/updateOrdering', 'SubMenusController@updateOrdering')->name('submenus.updateOrdering');
    Route::get('/submenus/ordering/{id}', 'SubMenusController@ordering')->name('submenus.ordering');
    Route::resource('submenus','SubMenusController');
});
/**
 * Rutas para CRUD de Modulos
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/modulos/updateOrdering', 'ModulosController@updateOrdering');
    Route::get('/modulos/ordering', 'ModulosController@ordering');
    Route::resource('modulos','ModulosController');
});
/**
 * Rutas para CRUD de Distribuidores
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('distribuidor','DistribuidoresController');
});
/**
 * Rutas para CRUD de Dids
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::resource('did','DidController');
});
/**
 * Rutas de CRUD de Catalogos Estado de Agentes
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::resource('cat_agente','CatEstadoAgenteController');
});
/**
 * Rutas de CRUD de Catalogo de Estado de Clientes
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::post('/cat_cliente/updateOrdering', 'CatEstadoClienteController@updateOrdering');
    Route::get('/cat_cliente/ordering', 'CatEstadoClienteController@ordering');
    Route::resource('cat_cliente','CatEstadoClienteController');
});
/**
 * Rutas de CRUD de Catalogo de Empresas
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::resource('cat_empresa','CatEstadoEmpresaController');
});
/**
 * Rutas de CRUD de Catalogos de PBX
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::resource('cat_ip_pbx','CatIpPbxController');
});
/**
 * Rutas de CRUD de Catalogo de NAS
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::resource('cat_nas','CatNasController');
});
/**
 * Rutas de CRUD de Troncales
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::resource('troncales','TroncalesController');
});
