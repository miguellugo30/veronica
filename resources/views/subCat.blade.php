@extends('adminlte::page')
{{--@extends('administrador::layouts.master')--}}


@section('title', 'AdminLTE')

@section('content_header')
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="background-color: #367FA9;">
        <ul class="nav navbar-nav">
            @foreach ($subCats as $subCat)
                <li><a href="{{ route('subcategoria', $subCat->id ) }}" style="color:#fff">{{ $subCat->nombre }}</span></a></li>
            @endforeach
        </ul>
    </div><!-- /.navbar-collapse -->
@stop

@section('content')
    <p>DASHBOARD</p>
@stop
