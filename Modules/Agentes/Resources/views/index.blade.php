@extends('adminlte::page_agente')
{{--@extends('administrador::layouts.master')--}}
  @section('title', 'Agentes')

  @section('content_header')@stop

  @section('content')@stop

  @section('css')
      <!--link rel="stylesheet" href="/css/admin_custom.css"-->
  @stop

  @section('js')
      <script>
          $(function() {
              $(".nav-link").removeClass('active');
          });
      </script>
  @stop
