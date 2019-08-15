@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top" style="height: 50px !important;">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
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
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo" style="background-color: #3c8dbc">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation" style="height: 50px !important;">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button" style="padding: 5px 5px !important;">
                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                    </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fas fa-sign-out-alt"></i> Salir
                                </a>
                            @else
                                <a>{{ Auth::user()->name }} - <?php $rol = Auth::user()->getRoleNames(); echo $rol[0]; ?> ||</a>
                                @if ($modulo == "Administrador")
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                        <i class="fas fa-sign-out-alt"></i> Salir
                                    </a>
                                @else
                                    <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" >
                                            <i class="fas fa-home"></i> Inicio
                                    </a>
                                @endif
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
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
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu tree" data-widget="tree">
                    @foreach ($categorias as $categoria)
                        @can( $categoria->permiso )
                            @if( $categoria->Sub_Categorias->count() == 0 )
                                <li class="sub-menu" data-id="{{ $categoria->id }}">
                            @else
                                <li class="treeview">
                            @endif    
                                <a>
                                    <i class="{{ $categoria->class_icon }} fa-2x"> </i>
                                    <span> {{ $categoria->nombre }} </span>
                                </a>
                                @if( $categoria->Sub_Categorias->count() > 0 )
                                    <ul class="treeview-menu">
                                        @foreach ($categoria->Sub_Categorias as $sub)
                                            @can( $sub->permiso )
                                                <li class="sub-menu" data-id="{{ $sub->id }}"><a href="#"><i class="far fa-building"></i> {{ $sub->nombre }}</a></li>
                                            @endcan
                                        @endforeach
                                    </ul>
                                @endif 
                            </li>
                        @endcan
                    @endforeach
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" >
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header sub-categorias">
                {{--@yield('content_header')--}}
            </section>

            <!-- Main content -->
            <section class="content viewResult">
                @yield('content')
            </section>

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
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
