@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-blue-light.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-blue-light'  . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top" >
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <!--button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button-->
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="#" class="logo" >
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation" >
                <!-- Sidebar toggle button-->
                <a href="#"  data-toggle="push-menu" role="button">

                    </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                                </a>
                            @else
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                                    </a>
                                <form id="logout-form" action="logout/agentes" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_agente" id="id_agente" value="{{$agente->id}}">
                                    <input type="hidden" name="id_evento" id="id_evento" value="{{$evento}}">
                                    <input type="hidden" name="cierre" id="cierre" value="0">
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <!--div class="pull-left image" style="margin-top: 8px;">
                        <img src="{{-- Storage::url('/fondo/avatar5.png') --}}" class="img-circled-block " alt="User Image">
                    </div-->
                    <div class=" info" >
                        <p>{{ $agente->nombre }}</p>
                        <p>Usr.: {{ $agente->usuario }}</p>
                        <p>Ext.: {{ $agente->extension_real }}</p>
                        @if ( $agenteEstado->Cat_Estado_Agente->nombre == 'Logueo' )
                            <a class="estado-agente"><i class="fa fa-circle text-secondary"></i> {{ $agenteEstado->Cat_Estado_Agente->nombre }}</a>
                        @else
                            <a class="estado-agente"><i class="fa fa-circle text-success"></i> {{ $agenteEstado->Cat_Estado_Agente->nombre }}</a>
                        @endif
                        <input type="hidden" name="id_agente" id="id_agente" value="{{$agente->id}}">
                        <input type="hidden" name="extension" id="extension" value="{{$agente->extension}}">
                        <input type="hidden" name="id_empresa" id="id_empresa" value="{{$agente->Empresas_id}}">
                        @csrf
                    </div>
                </div>
                <hr style="margin-top: 0">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Buscar...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <hr>
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="" placeholder="Telefono">
                        <div class="input-group-prepend">
                            <div class="input-group-text btn-primary" style="cursor:pointer"><i class="fas fa-phone text-white"></i></div>
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-danger m-1 colgar-llamada" disabled><i class="fas fa-phone-slash"></i></button>
                    <button type="button" class="btn btn-info m-1"><i class="fas fa-check"></i></button>
                </div>
                <hr>
                    <div class="col text-center">
                        <label for=""><b>Opciones Avanzadas</b></label>
                        <br>
                        <button type="button" class="btn btn-primary m-1 transferir-llamada">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                        <button type="button" class="btn btn-primary m-1 conferencia-llamada">
                            <i class="fas fa-users"></i>
                        </button>
                    </div>
                <hr>
                    <div class="col text-center">
                        <label for=""><b>No Disponible</b></label>
                        <div class="input-group">
                            <select name="no_disponible" id="no_disponible" class="form-control form-control-sm">
                                <option value="0">Selecciona una opcion</option>
                                @foreach ($eventosAgente as $evento)
                                    <option value="{{$evento->id}}">{{$evento->nombre}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend">
                                <div class="input-group-text btn-primary activar_no_disponible" style="cursor:pointer"><i class="fas fa-ban text-white"></i></div>
                            </div>
                        </div>
                    </div>
                <hr>
                @if ( isset( $modalidad->modalidad_logue ) )
                    @if ( $modalidad->modalidad_logue == 'canal_abierto' )
                    <div class="col">
                        <button type="button" class="logeo-extension btn btn-primary btn-sm btn-block"><i class="fas fa-phone"></i> Logueo en extension</button>
                    </div>
                    @endif
                @endif
                <br>
                <div class="col">
                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="far fa-clock"></i> Llamada programada</button>
                </div>
                <!-- /.sidebar-menu -->
            </section>
            <!--/.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" >
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif
            <div class="view-call  ">

                <div class="col-12 text-center" style="padding-top: 19%;">
                    <i class="fas fa-circle-notch fa-10x fa-spin text-info"></i>
                </div>
                <!-- Content Header (Page header) -->
                <!--section class="content-header" style="margin-right:50px">
                    @yield('content_header')
                </section-->

                <!-- Main content -->
                <!--section class="content viewResult" style="margin-right:50px">
                    @yield('content')
                </section-->
            </div>

            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
        @hasSection('footer')
        <footer class="main-footer">
            @yield('footer')
        </footer>
        @endif

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            <!-- Create the tabs -->
            <div class="row">
                <div class="col-2">
                    <ul class="nav flex-column" role="tablist">
                        <li class="nav-item">
                            <a href="#historial-llamadas" id="view-historial-llamadas" class="nav-link text-center" role="tab" data-toggle="control-sidebar" style="padding: 1rem 1rem">
                                <i class="fas fa-history text-primary fa-2x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#llamadas-perdidas" id="view-llamadas-perdidas" class="nav-link text-center" role="tab" data-toggle="control-sidebar" style="padding: 1rem 1rem">
                                <i class="fa fa-phone-slash text-primary fa-2x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#agenda-dia" id="view-agenda-dia" class="nav-link text-center" role="tab" data-toggle="control-sidebar" style="padding: 1rem 1rem">
                                <i class="fa fa-calendar-alt text-primary fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-10" style="border-left: 1px solid #e0e0e0;">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Home tab content -->
                        <div class="tab-pane " role="tabpanel" id="historial-llamadas">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="control-sidebar-heading"><b>Llamadas Completadas</b></h3>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="close mt-2" aria-label="Close" data-toggle="control-sidebar">
                                        <span class="align-middle " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" style="margin-right: 0px;margin-left: -30px;">
                                <hr>
                                <div class="col-11 result-historial-llamada" style="padding-left: 0px;">

                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- Settings tab content -->
                        <div class="tab-pane" role="tabpanel" id="llamadas-perdidas">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="control-sidebar-heading"><b>Llamadas abandonadas</b></h3>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="close mt-2" aria-label="Close" data-toggle="control-sidebar">
                                        <span class="align-middle " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11 result-llamadas-abandonadas">

                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- Settings tab content -->
                        <div class="tab-pane" role="tabpanel" id="agenda-dia">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="control-sidebar-heading"><b>Agenda del dia</b></h3>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="close mt-2" aria-label="Close" data-toggle="control-sidebar">
                                        <span class="align-middle " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col" id="calendar" style="padding-left: 0px;">

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- ./wrapper -->
    <!-- MODAL NO DISPONIBLE -->
    <div class="modal fade" id="modal-no-disponible" tabindex="-1" role="dialog" aria-labelledby="title-no-disponible" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-no-disponible"></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="agente-disponible">Disponible</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL NO DISPONIBLE -->
    <!-- MODAL NO DISPONIBLE -->
    <div class="modal fade" id="modal-transferencia" tabindex="-1" role="dialog" aria-labelledby="title-no-disponible" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-no-disponible"></h4>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Destino</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control form-control-sm"  name="destino_transferencia" id="destino_transferencia">
                                            <option value="">Selecciona una opcion</option>
                                            <option value="Audios_Empresa" >Anuncio</option>
                                            <option value="Aplicacion">Aplicación</option>
                                            <option value="Campanas">Campaña</option>
                                            <option value="hangup">Colgar llamada</option>
                                            <option value="Condiciones_Tiempo">Condición de Tiempo</option>
                                            <option value="Conferencia">Conferencia</option>
                                            <option value="Desvios">Desvío</option>
                                            <option value="Cat_Extensiones">Extensión</option>
                                            <option value="Ivr">IVR</option>
                                            <option value="Buzon_Voz">Buzón de voz</option>
                                            <option value="Numero_Saliente">Numero saliente</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="col input-telefono-transferir" style="display:none">
                                            <input type="text" class="form-control form-control-sm" id="telefono_transferir" placeholder="Telefono">
                                        </div>
                                        <div id="opciones_transferencia" class="opciones_transferencia">
                                            <select name="opciones_1" id="opciones"  class="form-control form-control-sm ">
                                                <option value="">Selecciona una opcion</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="opcion-transferir-extension" style="display:none">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="tranferir-pantalla">
                                            <label class="form-check-label" for="tranferir-pantalla">
                                                Transferir con pantalla
                                            </label>
                                          </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="realizar-transferir-llamada">Transferir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL NO DISPONIBLE -->

@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
    <!--script src="//{{-- Request::getHost() --}}:6001/socket.io/socket.io.js"></script-->
    @if( isset($monitoreo) )
        <script src="{{ asset('js/agente_monitoreo.js')}}" charset="utf-8"></script>
    @else
        <script src="{{ asset('js/agente.js')}}" charset="utf-8"></script>
    @endif
    <script>
        /*
        $(window).bind('beforeunload', function(e) {
            e.preventDefault();
            // make AJAX call
            alert( "ESTA SEGURO DE SALIR" );
        });
        */
        /*
       window.addEventListener('beforeunload', function (e) {
           return "Do you really want to close?";
        });

        var bPreguntar = true;

        window.onbeforeunload = preguntarAntesDeSalir;

        function preguntarAntesDeSalir() {
            if (bPreguntar)
            return "¿Seguro que quieres salir?";
        }
    */
        /*
        var areYouReallySure = false;
        function areYouSure() {
            if(allowPrompt){
                if (!areYouReallySure && true) {
                    areYouReallySure = true;
                    var confMessage = "***************************************nn E S P E R A !!! nnAntes de abandonar nuestra web, síguenos en nuestras redes sociales como Facebook, Twitter o Instagram.nnnYA PUEDES HACER CLIC EN EL BOTÓN CANCELAR SI QUIERES...nn***************************************";
                    return confMessage;
                }
            }else{
                allowPrompt = true;
            }
        }

        var allowPrompt = true;
        window.onbeforeunload = areYouSure;
        */
    </script>
@stop

