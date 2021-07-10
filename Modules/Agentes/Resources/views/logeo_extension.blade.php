@extends('adminlte::master')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth_agentes.css') }}">
@stop

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'login-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="login-box border border-dark rounded text-white">
        <div class="login-logo">
            {!! config('adminlte.logo') !!}
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg"><b>{{ __('adminlte::adminlte.login_message') }}</b></h5>
                <form action="{{ url("agentes/extension") }}" method="post" name="inicioSesion">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email"><b>Usuario</b></label>
                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $agente->usuario }}" placeholder="Usuario" autofocus>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Extension</b></label>
                        <input type="text" name="extension" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Extension" value="{{ $agente->extension }}">
                        @if ($errors->has('extension'))
                            <div class="invalid-feedback">
                                {{ $errors->first('extension') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <div class="col-12">
                            <input type="hidden" name="token_soporte" id="token_soporte" value="{{ isset( $token ) ? $token : '' }}">
                            <button type="submit" class="btn btn-primary btn-block btn-flat rounded-pill ">
                                {{ __('adminlte::adminlte.sign_in') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ( isset($email) && isset($password) )
        <script>
            window.onload=function(){
                // Una vez cargada la página, el formulario se enviara automáticamente.
                document.forms["inicioSesion"].submit();
            }
        </script>
    @endif
@stop

@section('adminlte_js')

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
