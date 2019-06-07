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
/*
Route::prefix('administrador')->name('administrador.')->group(function () {
    Route::resource('usuarios/', 'UsuariosController');
});
*/
Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    // Rutas de los controladores dentro del Namespace "App\Http\Controllers\Admin"
    Route::get('usuarios', 'UsuariosController@index')->name('usuarios.index');
    Route::get('/usuarios/{id}/edit', 'UsuariosController@edit')->name('usuarios.edit');
    Route::get('/usuarios/create', 'UsuariosController@create')->name('usuarios.create');
    Route::post('usuarios', 'UsuariosController@store')->name('usuarios.store');
    Route::put('usuarios/{id}', 'UsuariosController@update')->name('usuarios.update');
    Route::delete('usuarios/{id}', 'UsuariosController@destroy')->name('usuarios.delete');
});

Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::post('/menus/updateOrdering', 'MenusController@updateOrdering')->name('menus.updateOrdering');
    Route::get('/menus/ordering', 'MenusController@ordering')->name('menus.ordering');
    Route::resource('menus','MenusController');
});

Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::post('/submenus/updateOrdering', 'SubMenusController@updateOrdering')->name('submenus.updateOrdering');
    Route::get('/submenus/ordering/{id}', 'SubMenusController@ordering')->name('submenus.ordering');
    Route::resource('submenus','SubMenusController');
});

Route::group(['namespace' => '\Modules\Administrador\Http\Controllers', 'prefix' => 'administrador'], function() {
    Route::post('/modulos/updateOrdering', 'Moduloscontroller@updateOrdering');
    Route::get('/modulos/ordering', 'Moduloscontroller@ordering');
    Route::resource('modulos','Moduloscontroller');
});


Route::get('pruebas', 'UsuariosController@index');
