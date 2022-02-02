<div class="container">

<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title"><b><i class="fas fa-cloud-upload-alt"></i> Campaña: {{ $campana->nombre }}</b></h5>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm returnCampana"><i class="fas fa-arrow-left"></i> Regresar</button>
            @if ( $campana->Estado_Campanas->first()->id == 1 || $campana->Estado_Campanas->first()->id == 3)
                <button type="button" class="btn btn-primary btn-sm startCampana"><i class="fas fa-play-circle"></i> Iniciar</button>
            @endif
            @if ( $campana->Estado_Campanas->first()->id == 2 )
                <button type="button" class="btn btn-primary btn-sm endCampana"><i class="fas fa-stop-circle"></i> Detener</button>
            @endif
            @if ( $campana->Estado_Campanas->first()->id != 2 )
                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>
            @endif
            <div class="btn-group" role="group" aria-label="Basic example">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs"></i> Configuración
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#"><i class="far fa-list-alt"></i> Tipificación</a>
                      <a class="dropdown-item" href="#"><i class="far fa-plus-square"></i> Agregar Registro</a>
                      <a class="dropdown-item" href="#"><i class="far fa-clone"></i> Clonar Campaña</a>
                      <a class="dropdown-item" href="#"><i class="fas fa-headset"></i> Agregar/Eliminar Agentes</a>
                      <a class="dropdown-item" href="#"><i class="fas fa-user-clock"></i> Clientes en Espera</a>
                    </div>
                </div>
            </div>
            @csrf
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="{{ $campana->id }}">
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="col text-right">

        </div><!--col text-rigth-->
        <div class="container mt-2">
            <div class="row">
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-7">Tipo de Logueo:</dt>
                        <dd class="col-sm-5">{{ Str::title( str_replace( '_', ' ', $campana->modalidad_logue) ) }}</dd>
                        <dt class="col-sm-7">Total de Registros:</dt>
                        <dd class="col-sm-5">409</dd>
                        <dt class="col-sm-7">Avance de Camapaña:</dt>
                        <dd class="col-sm-5">88%</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-8">Modalidad de Marcación:</dt>
                        <dd class="col-sm-4">{{ Str::title( $campana->modalidad_marcado ) }}</dd>
                        <dt class="col-sm-8">Estado Actual:</dt>
                        <dd class="col-sm-4">{{$campana->Estado_Campanas->first()->descripcion_estado}}</dd>
                        <dt class="col-sm-7">Fecha de Creación:</dt>
                        <dd class="col-sm-3">.</dd>
                    </dl>
                </div>
                <div class="col">
                    <dl class="row">
                        <dt class="col-sm-6">Detalles de Ejecución:</dt>
                        <dd class="col-sm-6">Datos Importados</dd>
                    </dl>
                </div>
            </div>
        </div><!--container mt-2-->
    </div><!--card-body-->
</div><!--card-->

<div class="row">

    <div class="col-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Enlace de llamadas
                </h3>
                <div class="card-tools"></div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div id="llamadas_sistema" class="col "></div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div>
    <div class="col-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Registro de llamadas
                </h3>
                <div class="card-tools"></div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div id="registro_llamada" class="col "></div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div>
    <div class="col-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Calificación de Llamada
                </h3>
                <div class="card-tools"></div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div id="registro_llamada" class="col "></div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div>
</div><!--row -->
<div class="row">
    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Agentes
                </h3>
                <div class="card-tools"></div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> No Disponibles <span class="badge badge-light">4</span></div>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 1</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 2</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 3</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 4</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 5</li>
                        </ul>
                    </div>
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> Disponibles <span class="badge badge-light">4</span></div>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 1</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 2</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 3</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 4</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 5</li>
                        </ul>
                    </div>
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> Asignando <span class="badge badge-light">4</span></div>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 1</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 2</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 3</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 4</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 5</li>
                        </ul>
                    </div>
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> En Llamada <span class="badge badge-light">4</span></div>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 1</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 2</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 3</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 4</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 5</li>
                        </ul>
                    </div>
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> Llamada Programada <span class="badge badge-light">4</span></div>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 1</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 2</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 3</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 4</li>
                            <li class="list-group-item"><i class="fas fa-headset"></i> Agente 5</li>
                        </ul>
                    </div>
                </div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div>
</div><!--row -->
<div class="row">
    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Estadisticas
                </h3>
                <div class="card-tools"></div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> Enlace de Llamadas </div>
                        <ul class="list-group">
                            @foreach ($estado_cliente as $i)
                                @if ( $i->parametrizar == 0 )
                                    <li class="list-group-item">
                                        {{$i->nombre}}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> Registros Fuera de Marcación</div>
                        <ul class="list-group">
                            @foreach ($estado_cliente as $i)
                                @if ( $i->parametrizar == 1 )
                                    <li class="list-group-item">
                                        {{$i->nombre}}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <div class="bg-info p-2 text-white text-center"> Calificación de Llamadas</div>
                        <ul class="list-group">
                            @foreach ($campana->Grupos->first()->calificaciones as $i)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $i->nombre }}
                                    <span class="badge badge-primary badge-pill">14</span>
                                </li>
                            @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Total</b>
                                    <span class="badge badge-primary badge-pill">28</span>
                                </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div>
</div><!--row -->

</div>
<!--script>
    Highcharts.chart('llamadas_sistema', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Enlace de llamadas'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
            @foreach ($estado_cliente as $i)
                @if ( $i->parametrizar == 0 )
                    {
                        name: "{{$i->nombre}}",
                        y: 61.41,
                    },
                @endif
            @endforeach
        ]
    }]
});


Highcharts.chart('registro_llamada', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Registro de llamadas'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
            @foreach ($estado_cliente as $i)
                @if ( $i->parametrizar == 1 )
                    {
                        name: "{{$i->nombre}}",
                        y: 61.41,
                    },
                @endif
            @endforeach
        ]
    }]
});

Highcharts.chart('llamadas_calificacion', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Calificación de Llamadas'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [

            @foreach($campana->Grupos->first()->calificaciones as $i)
                {
                    name: "{{$i->nombre}}",
                    y: 61.41,
                },
            @endforeach
        ]
    }]
});
</script-->
