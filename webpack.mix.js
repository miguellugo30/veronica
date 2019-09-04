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
        'resources/js/module_administrador/canales.js',
        'resources/js/module_administrador/empresas.js',
        'resources/js/module_administrador/cat_base_datos.js',
        'resources/js/module_administrador/cat_tipo_canal.js',
        'resources/js/module_administrador/menu.js',
        'resources/js/module_administrador/cat_extensiones.js',
        'resources/js/module_administrador/licenciasBria.js',
        'resources/js/module_settings/menu.js',
    ], 'public/js/administrador.js')
    .js([
        'resources/js/module_settings/menu.js',
        'resources/js/module_settings/formularios.js',
        'resources/js/module_settings/sub_formularios.js',
        'resources/js/module_settings/acciones_formularios.js',
        'resources/js/module_settings/audios.js',
        'resources/js/module_settings/calificaciones.js',
        'resources/js/module_settings/agentes.js',
        'resources/js/module_settings/grupos.js',

    ], 'public/js/settings.js')
    .js([
        'resources/js/module_inbound/menu.js',
        'resources/js/module_inbound/campanas.js',
        'resources/js/module_inbound/CondicionesTiempo.js',
        'resources/js/module_inbound/desvios.js',
        'resources/js/module_inbound/buzon_voz.js',
        'resources/js/module_inbound/Did_Enrutamiento.js',
        'resources/js/module_inbound/ivr.js',
    ], 'public/js/inbound.js');
/*
.sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/app.js', 'public/js/all.js')
    .js('resources/js/usuarios.js', 'public/js/all.js')
    */
