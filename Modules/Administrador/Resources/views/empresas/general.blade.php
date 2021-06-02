<div class="row">
    <div class="col">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Empresa
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a class="dropdown-item edit" id="editEmpresa">
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
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Id Empresa:</dt>
                    <dd class="col-sm-9">{{ $empresa->id }}</dd>
                    <dt class="col-sm-3">Empresa:</dt>
                    <dd class="col-sm-9">{{ Str::title( $empresa->nombre ) }}</dd>
                    <dt class="col-sm-3">Distribuidor:</dt>
                    <dd class="col-sm-9">{{ Str::title( $empresa->Config_Empresas->Distribuidores->servicio ) }}</dd>
                    <dt class="col-sm-3">Estado:</dt>
                    <dd class="col-sm-9">{{ str_replace( '-', ' ', $empresa->Cat_Estado_Empresa->nombre ) }}</dd>
                    <dt class="col-sm-3">Zona Horaria:</dt>
                    <dd class="col-sm-9">{{ str_replace( '-', ' ', $empresa->Config_Empresas->zona_horaria ) }}</dd>
                    <input type="hidden" name="empresa_id" id="empresa_id" value="{{$empresa->id}}">
                </dl>
            </div><!-- .card-body -->
        </div><!-- .card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-server"></i>
                    Infraestructura
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a id="editInfraestructura" class="edit dropdown-item">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                        </div>
                    </div>
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <dl class="row">
                            <dt class="col-sm-4">Dominio:</dt>
                            <dd class="col-sm-8">{{ $empresa->Config_Empresas->Dominio->dominio }}</dd>
                        </dl>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-7">
                        <dl class="row">
                            <dt class="col-sm-4">Ubicacion BD:</dt>
                            <dd class="col-sm-8">{{ $empresa->Config_Empresas->BaseDatos->ubicacion }}</dd>
                            <dt class="col-sm-4">Nombre MS:</dt>
                            <dd class="col-sm-8">{{ $empresa->Config_Empresas->ms->media_server }}</dd>
                        </dl>
                    </div>
                    <div class="col-5">
                        <dl class="row">
                            <dt class="col-sm-3">IP BD:</dt>
                            <dd class="col-sm-9">{{ $empresa->Config_Empresas->BaseDatos->ip }}</dd>
                            <dt class="col-sm-3">IP MS:</dt>
                            <dd class="col-sm-9">{{ $empresa->Config_Empresas->ms->ip_pbx }}</dd>
                        </dl>
                    </div>
                </div>
            </div><!-- .card-body -->
        </div><!-- .card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-th"></i>
                    Modulos Contratados
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a id="editModulos" class="dropdown-item edit">
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
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="list-group list-group-flush">
                        @foreach ($empresa->Modulos as $item)
                            @if ($loop->iteration == 10)
                                </div>
                                <div class="col">
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if ($item->nombre == 'Inbound')
                                    {{ $item->nombre }}
                                    <span class="badge badge-primary badge-pill">Posiciones: {{ $empresa->Config_Empresas->agentes_entrada }}</span>
                                    @elseif( $item->nombre == 'Outbound' )
                                    {{ $item->nombre }}
                                    <span class="badge badge-primary badge-pill">Posiciones: {{ $empresa->Config_Empresas->agentes_salida }}</span>
                                    @elseif( $item->nombre == 'Voice Message' )
                                    {{ $item->nombre }}
                                    <span class="badge badge-primary badge-pill">Posiciones: {{ $empresa->Config_Empresas->canal_mensajes_voz }}</span>
                                    @elseif( $item->nombre == 'Intelligent IVR' )
                                    {{ $item->nombre }}
                                    <span class="badge badge-primary badge-pill">Posiciones: {{ $empresa->Config_Empresas->licencias_ivr_inteligente }}</span>
                                    @elseif( $item->nombre == 'Survey Generator' )
                                    {{ $item->nombre }}
                                    <span class="badge badge-primary badge-pill">Posiciones: {{ $empresa->Config_Empresas->canal_generador_encuestas }}</span>
                                @else
                                    {{ $item->nombre }}
                                @endif
                            </li>
                        @endforeach
                        <ul>
                    </div><!-- .col-->
                </div><!-- .row -->
            </div><!-- .card-body -->
        </div><!-- .card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-phone"></i>
                    Dids
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a id="" class="dropdown-item ">
                                <i class="far fa-plus-square"></i>
                                Nuevo
                            </a>
                            <a id="editDid" class="dropdown-item edit">
                                <i class="fas fa-pencil-alt"></i>
                                <input type="hidden" name="editSelectedDid" id="editSelectedDid" value="">
                                Editar
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-danger">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar
                            </a>
                        </div>
                    </div>
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <table class="table table-striped table-sm tableDids">
                    <thead class="thead-light">
                        <tr>
                            <th>Did</th>
                            <th># Real</th>
                            <th>Referencia</th>
                            <th>Gateway</th>
                            <th>Fakedid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dids as $did)
                            <tr data-id="{{$did->id}}">
                                <td>{{ $did->did }}</td>
                                <td>{{ $did->numero_real }}</td>
                                <td>{{ $did->referencia }}</td>
                                <td>
                                    @if ($did->gateway == 1)
                                        Habilitado
                                    @else
                                        Deshabilitado
                                    @endif
                                </td>
                                <td>
                                    @if ($did->fakedid == 1)
                                        Habilitado
                                    @else
                                        Deshabilitado
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div><!-- .col-->
    <div class="col ">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-database"></i>
                    Almacenamiento
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a id="editAlmacenamiento" class="dropdown-item edit">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                        </div>
                    </div>
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <dl class="row text-center">
                    <dt class="col-sm-3">Espacio Total:</dt>
                    <dd class="col-sm-9">{{ number_format( ( $empresa->Config_Empresas->almacenamiento_posiciones + $empresa->Config_Empresas->almacenamiento_adicional ) / 1024, 2) }} <b>GB</b></dd>
                </dl>
                <div class="row">
                    <div class="col" id="container"></div>
                </div><!-- .row -->
            </div><!-- .card-body -->
        </div><!-- .card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exchange-alt"></i>
                    Canales
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a id="" class="dropdown-item">
                                <i class="far fa-plus-square"></i>
                                Nuevo
                            </a>
                            <a id="editCanales" class="dropdown-item edit">
                                <i class="fas fa-pencil-alt"></i>
                                <input type="hidden" name="editSelectedCanal" id="editSelectedCanal" value="">
                                Editar
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-danger">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar
                            </a>
                        </div>
                    </div>
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <table class="table table-striped table-sm tableCanales">
                    <thead class="thead-light">
                        <tr>
                            <th>Protocolo</th>
                            <th>Troncal</th>
                            <th>Prefijo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($canales as $canal)
                            <tr data-id="{{$canal->id}}">
                                <td>{{ $canal->protocolo }}</td>
                                <td>{{ $canal->Troncales->nombre }}</td>
                                <td>{{ $canal->prefijo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- .card-body -->
        </div><!-- .card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-headphones-alt"></i>
                    Extensiones
                </h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            <a id="" class="dropdown-item ">
                                <i class="far fa-plus-square"></i>
                                Nuevo
                            </a>
                            <a id="editExtensiones" class="dropdown-item edit">
                                <i class="fas fa-pencil-alt"></i>
                                <input type="hidden" name="editSelectedExtension" id="editSelectedExtension" value="">
                                Editar
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-danger">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar
                            </a>
                        </div>
                    </div>
                </div><!--.card-tools-->
            </div><!-- .card-header -->
            <div class="card-body">
                <table class="table table-striped table-sm tableExtensiones">
                    <thead class="thead-light">
                        <tr>
                            <th>Extension</th>
                            <th>Licencia Bria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extensiones as $extension)
                            <tr data-id="{{$extension->id}}">
                                <td>{{ $extension->extension }}</td>
                                <td>
                                    @if ( $extension->Licencias == NULL )
                                        Sin Licencia
                                    @else
                                        {{ $extension->Licencias->licencia }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- .card-body -->
        </div><!-- .card -->

    </div><!-- .col -->
</div>
<br>


<!-- Modal -->
<div class="modal fade modalEdit" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
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
            exporting: {
                enabled:false
            },
            series: [{
                name: 'Porcentaje en Disco',
                colorByPoint: true,
                data: [{
                    name: 'Disponible',
                    y:{{
                        (
                            $empresa->Config_Empresas->almacenamiento_posiciones + $empresa->Config_Empresas->almacenamiento_adicional
                        )
                        /1024
                        -
                        (
                            $inbound+$outbound+$manual+$buzon+$audios
                        )
                        /1024
                    }}
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

        $(".tableDids").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "pageLength": 5
        });

        $(".tableExtensiones").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "pageLength": 5
        });

        $(".tableCanales").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "pageLength": 5
        });


    });
</script>
