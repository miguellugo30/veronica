<!--div class="row" style="float:none; margin:auto">
    <div class="col-2">
        <ul class="list-group menuEmpresa" style="cursor:pointer">
            <li data-opcion="dataGeneral" class="list-group-item active">Vista General</li>
            <li data-opcion="dataEmpresa" class="list-group-item">Informacion empresa</li>
            <li data-opcion="dataInfra" class="list-group-item">Informacion Infraestructura</li>
            <li data-opcion="dataModulo" class="list-group-item">Modulos</li>
            <li data-opcion="dataPosiciones" class="list-group-item">Posiciones en modulos</li>
            <li data-opcion="dataAlmacenamiento" class="list-group-item">Almacenamiento</li>
            <li data-opcion="dataCanales" class="list-group-item">Canales</li>
            <li data-opcion="dataExtensiones" class="list-group-item">Catalogo de extensiones</li>
            <li data-opcion="dataDids" class="list-group-item">Dids</li>
            <li data-opcion="dataAplicaciones" class="list-group-item">Aplicaciones</li>
            <li data-opcion="dataPerfiles" class="list-group-item">Perfiles de Marcacion</li>
            <li data-opcion="dataPrefijos" class="list-group-item">Prefijos de Marcacion</li>
        </ul>
        <br><br>
    </div>
    <div class="col-10 viewForm" >
        <input type="hidden" id="id" name="id" value="{{ $id }}">
        @csrf
        <form id="formDataEmpresa" method="post"></form>
        <br>
        <br>
        <br>
    </div>
</div>
<div class="row">
    <--div class="col-md-6" style="float:none; margin:auto"->
    <div class="col" style="text-align:left">
        <button type="submit" class="btn btn-primary btn-sm cancelEmpresa"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</button>
        <--button type="submit" class="btn btn-danger deleteEmpresa"><i class="fas fa-trash-alt"></i> Eliminar</button->
    </div>
    <div class="col" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm" id="accionActualizar" style="display:none"><i class="fas fa-save"></i> Guardar</button>
    </div>
    <-/div->
</div-->

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Informacion Empresa
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-danger">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar
                            </a>
                        </div>
                    </div>
                  </div>
            </div><!-- .card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Id Empresa:</dt>
                    <dd class="col-sm-9">{{ $empresa->id }}</dd>
                    <dt class="col-sm-3">Empresa:</dt>
                    <dd class="col-sm-9">{{ $empresa->nombre }}</dd>
                    <dt class="col-sm-3">Distribuidor:</dt>
                    <dd class="col-sm-9">{{ $empresa->Config_Empresas->Distribuidores->servicio  }}</dd>
                    <dt class="col-sm-3">Estado:</dt>
                    <dd class="col-sm-9">{{ str_replace( '-', ' ', $empresa->Cat_Estado_Empresa->nombre ) }}</dd>
                </dl>
            </div><!-- .card-body -->
        </div><!-- .card -->
        <br>
        <div class="card">
            <div class="card-header">
                <i class="fas fa-server"></i>
                Informacion Infraestructura
            </div><!-- .card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Dominio:</dt>
                    <dd class="col-sm-9">{{ $empresa->Config_Empresas->Dominio->dominio }}</dd>
                    <dt class="col-sm-3">Ubicacion BD:</dt>
                    <dd class="col-sm-9">{{ $empresa->Config_Empresas->BaseDatos->ubicacion }}</dd>
                    <dt class="col-sm-3">IP BD:</dt>
                    <dd class="col-sm-9">{{ $empresa->Config_Empresas->BaseDatos->ip }}</dd>
                    <dt class="col-sm-3">Nombre MS:</dt>
                    <dd class="col-sm-9">{{ $empresa->Config_Empresas->ms->media_server }}</dd>
                    <dt class="col-sm-3">IP MS:</dt>
                    <dd class="col-sm-9">{{ $empresa->Config_Empresas->ms->ip_pbx }}</dd>
                </dl>
            </div><!-- .card-body -->
        </div><!-- .card -->
        <br>
        <div class="card">
            <div class="card-header">
                <i class="fas fa-th"></i>
                Modulos Contratados
            </div><!-- .card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ol>
                        @foreach ($empresa->Modulos as $item)
                            @if ($loop->iteration == 10)
                                </div>
                                <div class="col">
                            @endif
                            <li>
                                @if ($item->nombre == 'Inbound')
                                    {{ $item->nombre }} || <b>Posiciones: </b> {{ $empresa->Config_Empresas->agentes_entrada }}
                                @elseif( $item->nombre == 'Outbound' )
                                    {{ $item->nombre }} || <b>Posiciones: </b> {{ $empresa->Config_Empresas->agentes_salida }}
                                @elseif( $item->nombre == 'Voice Message' )
                                    {{ $item->nombre }} || <b>Posiciones: </b> {{ $empresa->Config_Empresas->canal_mensajes_voz }}
                                @elseif( $item->nombre == 'Intelligent IVR' )
                                    {{ $item->nombre }} || <b>Posiciones: </b> {{ $empresa->Config_Empresas->licencias_ivr_inteligente }}
                                @elseif( $item->nombre == 'Survey Generator' )
                                    {{ $item->nombre }} || <b>Posiciones: </b> {{ $empresa->Config_Empresas->canal_generador_encuestas }}
                                @else
                                    {{ $item->nombre }}
                                @endif
                            </li>
                        @endforeach
                        <ol>
                    </div><!-- .col-->
                </div><!-- .row -->
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div><!-- .col-->
    <div class="col">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-database"></i>
                Almacenamiento
            </div><!-- .card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Espacio Total:</dt>
                    <dd class="col-sm-9">{{ number_format( ( $empresa->Config_Empresas->almacenamiento_posiciones + $empresa->Config_Empresas->almacenamiento_adicional ) / 1024, 2) }} <b>GB</b></dd>
                </dl>
                <div class="row">
                    <div class="col">
                        <div class="box-body">
                            <div class="row">
                                <div class="col" id="container"></div>
                            </div><!-- .row -->
                        </div><!-- .box-body -->
                    </div><!-- .col-->
                </div><!-- .row -->
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div><!-- .col -->
</div>
<br>
<script>
        $(function() {
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.2f} %<br>Espacio {point.name}: {point.y:.2f} GB</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: 'GB'
                }
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:.2f} GB</b>'
                    }
                }
            },
            series: [{
                name: 'Porcentaje en Disco',
                colorByPoint: true,
                data: [{
                    name: 'Disponible',
                    y: @foreach($config_empresas as $config) {{ ((($config->almacenamiento_adicional)+($config->almacenamiento_posiciones))/1024)-($inbound+$outbound+$manual+$buzon+$audios)/1024 }} @endforeach
                }, {
                    name: 'Inbound',
                    y: {{ ($inbound)/1024 }}
                }, {
                    name: 'Outbund',
                    y: {{ ($outbound)/1024 }}
                }, {
                    name: 'Manual',
                    y: {{ ($manual)/1024 }}
                }, {
                    name: 'Buzon de Voz',
                    y: {{ ($buzon)/1024 }}
                }, {
                    name: 'Audios',
                    y: {{ ($audios)/1024 }}
                }]
            }]
        });
    });
</script>

