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
    Route::get('/', 'AdministradorController@index')->middleware('auth')->name('administrador');
    Route::get('/sub-menus/{id}', 'AdministradorController@subMenus')->middleware('auth')->name('administrador-sub-menus');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL SUB MODULO DE CUENTAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->namespace('\Modules\Administrador\Http\Controllers')->prefix('administrador')->group( function() {
    Route::get('wizard/empresa/{step?}', 'WizardEmpresaController@wizard')->name('wizard.user');
    Route::post('wizard/empresa/{step?}', 'WizardEmpresaController@wizardPost')->name('wizard.user.post');
});
/**
 * Rutas para CRUD de Distribuidores
 */
Route::middleware(['auth'])->namespace('\Modules\Administrador\Http\Controllers')->prefix('administrador')->group( function() {
    Route::resource('distribuidor','DistribuidoresController');
});
/**
 * Rutas de CRUD de EMRPRESAS
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/empresas/generar_sesion/{id}', 'EmpresasController@generar_sesion');
    Route::resource('empresas','EmpresasController');
});
/**
 * Rutas de CRUD de Extensiones
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::get('/extensiones/create/{id}', 'CatExtensionesController@create');
    Route::resource('extensiones','CatExtensionesController');
});
/**
 * Rutas de CRUD de Perfiles
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::get('/perfil_marcacion/create/{id}', 'PerfilMarcacionController@create');
    Route::resource('perfil_marcacion','PerfilMarcacionController');
});
/**
 * Rutas de CRUD de Prefijos
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::get('/prefijos_marcacion/create/{id}', 'PrefijosMarcacionController@create');
    Route::resource('prefijos_marcacion','PrefijosMarcacionController');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL SUB MODULO DE VOZ
|--------------------------------------------------------------------------
*/
/**
 * Rutas de CRUD de Troncales
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/troncales/sansay/{id}', 'TroncalesController@updateSansay');
    Route::resource('troncales','TroncalesController');
});
/**
 * Rutas de CRUD de CANALES
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::get('/canales/create/{id}', 'CanalesController@create');
    Route::resource('canales','CanalesController');
});
/**
 * Rutas para CRUD de DID
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::get('/did/create/{id}', 'DidController@create');
    Route::resource('did','DidController');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL SUB MODULO DE CONFIGURACION DEL SISTEMA
|--------------------------------------------------------------------------
*/
/**
 * Rutas para CRUD de Modulos
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/modulos/updateOrdering', 'ModulosController@updateOrdering');
    Route::get('/modulos/ordering', 'ModulosController@ordering');
    Route::resource('modulos','ModulosController');
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
 * Rutas para CRUD de Usuarios
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('usuarios','UsuariosController');
});
/*
|--------------------------------------------------------------------------
| RUTAS PARA EL SUB MODULO DE CATALOGOS
|--------------------------------------------------------------------------
*/
/**
 * Rutas de CRUD de Catalogo de TiposCanal
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('cat_tipo_canales','TipoCanalcontroller');
});
/**
 * Rutas de CRUD de Catalogos Estado de Agentes
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('cat_agente','CatEstadoAgenteController');
});
/**
 * Rutas de CRUD de Catalogo de Estado de Clientes
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::post('/cat_cliente/updateOrdering', 'CatEstadoClienteController@updateOrdering');
    Route::get('/cat_cliente/ordering', 'CatEstadoClienteController@ordering');
    Route::resource('cat_cliente','CatEstadoClienteController');
});
/**
 * Rutas de CRUD de Catalogo de Empresas
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('cat_empresa','CatEstadoEmpresaController');
});
/**
 * Rutas de CRUD de Base de Datos
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('basedatos','BasesDatosController');
});
/**
 * Rutas de CRUD de Catalogos de PBX
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('cat_ip_pbx','CatIpPbxController');
});
/**
 * Rutas de CRUD de Catalogo de NAS
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('cat_nas','CatNasController');
});
/**
 * Rutas de CRUD de Licencias Bria
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('licencias_bria','LicenciasBriaController');
});
/**
 * Rutas de CRUD de Campos Plantillas
 */
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador', 'middleware' => 'auth'], function() {
    Route::resource('cat_campos_plantillas','CatCamposPlantillasController');
});
