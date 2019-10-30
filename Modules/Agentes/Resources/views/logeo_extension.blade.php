@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

<div class="col-12">

    <img src="{{ Storage::url('/fondo/fondo_1.jpg') }}" class="img-fluid mx-auto d-block align-middle" alt="Responsive image" style="width: 50%;margin-top: 10%;">

    <div class="login-box" style="margin-top: -16%;position: relative;margin-right: 26%;">
        <!--div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">AGENTE{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div-->
        <!-- /.login-logo -->
        <div class="login-box-body" style="background: none;">
            <!--p class="login-box-msg">{{-- trans('adminlte::adminlte.login_message') --}}</p-->
                <form action="{{ url("agentes/extension") }}" method="post" name="inicioSesion">
                {!! csrf_field() !!}
                {{ $errors->has('message') }}
                @if ( $errors->getBag('message')->first() != '' )
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->getBag('message')->first() }}
                    </div>
                @endif
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="usuario" class="form-control form-control-sm" value="{{ $agente->usuario }}" placeholder="Usuario">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('extension') ? 'has-error' : '' }}">
                    <input type="txt" name="extension" class="form-control form-control-sm" placeholder="Extension" value="{{ $agente->extension }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('extension'))
                        <span class="help-block">
                            <strong>{{ $errors->first('extension') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row" style="float: right;margin-right: 3px;">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <input type="hidden" name="token_soporte" id="token_soporte" value="{{ isset( $token ) ? $token : '' }}">
                        <button type="submit" class="btn btn-primary btn-block btn-flat btn-sm">Ir</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

</div>
    @php
        if( isset($email) && isset($password) ){
            echo '<script>
                    window.onload=function(){
                        // Una vez cargada la página, el formulario se enviara automáticamente.
		                document.forms["inicioSesion"].submit();
                    }
                </script>';
        }
    @endphp
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
