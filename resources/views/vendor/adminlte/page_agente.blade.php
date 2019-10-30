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
                    <div class="pull-left image" style="margin-top: 8px;">
                        <img src="{{ Storage::url('/fondo/avatar5.png') }}" class="img-circled-block " alt="User Image">
                    </div>
                    <div class="pull-left info" >
                        <p>{{ $agente->nombre }}</p>
                        <p>Usr.: {{ $agente->usuario }}</p>
                        <p>Ext.: {{ $agente->extension }}</p>
                        <a class="estado-agente"><i class="fa fa-circle text-success"></i> {{ $agente->Cat_Estado_Agente->nombre }}</a>
                        <input type="hidden" name="id_agente" id="id_agente" value="{{$agente->id}}">
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
                    <button type="button" class="btn btn-danger m-1"><i class="fas fa-phone-slash"></i></button>
                    <button type="button" class="btn btn-info m-1"><i class="fas fa-check"></i></button>
                </div>
                <hr>
                    <div class="col text-center">
                        <label for=""><b>Transferir llamada</b></label>
                        <div class="input-group">
                            <select name="" id="" class="form-control form-control-sm">
                                <option value="">a</option>
                                <option value="">b</option>
                                <option value="">c</option>
                            </select>
                            <div class="input-group-prepend">
                                <div class="input-group-text btn-primary" style="cursor:pointer"><i class="fas fa-exchange-alt text-white"></i></div>
                            </div>
                        </div>
                    </div>
                <hr>
                    <div class="col text-center">
                        <label for=""><b>No Disponible</b></label>
                        <div class="input-group">
                            <select name="" id="" class="form-control form-control-sm">
                                <option value="">a</option>
                                <option value="">b</option>
                                <option value="">c</option>
                            </select>
                            <div class="input-group-prepend">
                                <div class="input-group-text btn-primary" style="cursor:pointer"><i class="fas fa-ban text-white"></i></div>
                            </div>
                        </div>
                    </div>
                <hr>
                <div class="col">
                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fas fa-phone"></i> Logueo en extension</button>
                </div>
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
            <div class="view-call">
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
                        <!--li class="nav-item">
                            <a href="#" class="nav-link" role="tab" data-toggle="control-sidebar" style="padding-left: 11px;padding-top: 15px;">
                                <i class="fas fa-arrow-left text-primary fa-2x"></i>
                            </a>
                        </li-->
                        <li class="nav-item">
                            <a href="#historial-llamadas" class="nav-link active" role="tab" data-toggle="control-sidebar" style="padding-left: 11px;padding-top: 15px;">
                                <i class="fas fa-history text-primary fa-2x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#llamadas-perdidas"  class="nav-link"        role="tab" data-toggle="control-sidebar" style="padding-left: 11px;padding-top: 15px;">
                                <i class="fa fa-phone-slash text-primary fa-2x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#agenda-dia"         class="nav-link"        role="tab" data-toggle="control-sidebar" style="padding-left: 11px;padding-top: 15px;">
                                <i class="fa fa-calendar-alt text-primary fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-10">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Home tab content -->
                        <div class="tab-pane active" role="tabpanel" id="historial-llamadas">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="control-sidebar-heading"><b>Historial de llamadas</b></h3>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="close mt-2" aria-label="Close" data-toggle="control-sidebar">
                                        <span class="align-middle " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <h6><b>Llamadas Inbound</b></h6>
                                    <table class="table table-striped table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Campaña</th>
                                                <th>Num.</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
                                                <th>Estatus</th>
                                                <th>Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h6><b>Llamadas Outbound</b></h6>
                                    <table class="table table-striped table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Campaña</th>
                                                <th>Num.</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
                                                <th>Estatus</th>
                                                <th>Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h6><b>Llamadas Manuales</b></h6>
                                    <table class="table table-striped table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Campaña</th>
                                                <th>Num.</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
                                                <th>Estatus</th>
                                                <th>Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                            <tr>
                                                <td>BTC</td>
                                                <td>5528816600</td>
                                                <td>09:49:21</td>
                                                <td>09:52:50</td>
                                                <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                <td><i class="far fa-plus-square text-primary"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                    <div class="col-11">
                                            <h6><b>Llamadas Inbound</b></h6>
                                            <table class="table table-striped table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Campaña</th>
                                                        <th>Num.</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                        <th>Estatus</th>
                                                        <th>Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <h6><b>Llamadas Outbound</b></h6>
                                            <table class="table table-striped table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Campaña</th>
                                                        <th>Num.</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                        <th>Estatus</th>
                                                        <th>Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <h6><b>Llamadas Manuales</b></h6>
                                            <table class="table table-striped table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Campaña</th>
                                                        <th>Num.</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                        <th>Estatus</th>
                                                        <th>Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BTC</td>
                                                        <td>5528816600</td>
                                                        <td>09:49:21</td>
                                                        <td>09:52:50</td>
                                                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                                        <td><i class="far fa-plus-square text-primary"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
    <!--script src="//{{-- Request::getHost() --}}:6001/socket.io/socket.io.js"></script-->
    <script src="{{ asset('js/agente.js')}}" charset="utf-8"></script>

@stop

