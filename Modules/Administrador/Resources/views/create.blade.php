@extends('adminlte::page')
{{--@extends('administrador::layouts.master')--}}


@section('title', 'AdminLTE')

@section('content_header')
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="background-color: #337ab7;">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
@stop

@section('content')
    <p>DASHBOARD</p>
@stop
