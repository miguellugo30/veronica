@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
            @isset($url)
                <form action="{{ url("login/$url") }}" method="post" name="inicioSesion">
            @else
                <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post" name="inicioSesion">
            @endisset
                {!! csrf_field() !!}
                {{ $errors->has('message') }}
                @if ( $errors->getBag('message')->first() != '' )
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->getBag('message')->first() }}
                    </div>
                @endif
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="email" class="form-control" value="{{ isset( $email ) ? $email : old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}" value="{{ isset( $password ) ? $password : '' }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <input type="hidden" name="token_soporte" id="token_soporte" value="{{ isset( $token ) ? $token : '' }}">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->

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
