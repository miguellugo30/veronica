<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i>
                Informacion Empresa
            </div>
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
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-server"></i>
                Informacion Infraestructura
            </div>
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
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-th"></i>
                Modulos Contratados
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ol>
                        @foreach ($empresa->Modulos as $item)
                            @if ($loop->iteration == 10)
                                </div>
                                <div class="col6">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-database"></i>
                Almacenamiento
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Espacio Total:</dt>
                    <dd class="col-sm-9">{{ number_format( ( $empresa->Config_Empresas->almacenamiento_posiciones + $empresa->Config_Empresas->almacenamiento_adicional ) / 1024, 2) }} <b>GB</b></dd>
                </dl>
                <div class="row">
                    <div class="col">
                        <h1>AQUI VA LA GRAFICA</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
