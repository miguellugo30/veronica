const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/js/app.js',
    'resources/js/module_administrador/usuarios.js',
    'resources/js/module_administrador/modulos.js',
    'resources/js/module_administrador/submenus.js',
    'resources/js/module_administrador/menus.js',
    'resources/js/module_administrador/distribuidores.js',
    'resources/js/module_administrador/dids.js',
    'resources/js/module_administrador/cat_estado_agente.js',
    'resources/js/module_administrador/cat_estado_cliente.js',
    'resources/js/module_administrador/cat_estado_empresa.js',
    'resources/js/module_administrador/cat_ip_pbx.js',
    'resources/js/module_administrador/cat_nas.js',
    'resources/js/module_administrador/troncales.js',
], 'public/js/');
/*
mix.js('resources/js/app.js', 'public/js/all.js')
    .js('resources/js/usuarios.js', 'public/js/all.js')
    .sass('resources/sass/app.scss', 'public/css');
    */