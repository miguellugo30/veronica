<div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Informacion Empresa</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <label >Id Empresa:</label>
                    <br>
                    <label>Empresa:</label>
                    <br>
                    <label>Distribuidor:</label>
                    <br>
                    <label>Estado:</label>
                    <br>
                </div>
                <div class="col-md-9">
                    <p>{{ $empresa->id }}</p>
                    <p>{{ $empresa->nombre }}</p>
                    <p>{{  $empresa->Config_Empresas->Distribuidores->servicio  }}</p>
                    <p>{{ str_replace( '-', ' ', $empresa->Cat_Estado_Empresa->nombre ) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Informacion Infraestructura</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <label>Dominio:</label>
                    <br>
                    <label>Ubicacion BD:</label>
                    <br>
                    <label>IP BD:</label>
                    <br>
                    <label>Nombre MS:</label>
                    <br>
                    <label>IP MS:</label>
                    <br>
                </div>
                <div class="col-md-7">
                    <p>{{ $empresa->Config_Empresas->Dominio->dominio }}</p>
                    <p>{{ $empresa->Config_Empresas->BaseDatos->ubicacion }}</p>
                    <p>{{ $empresa->Config_Empresas->BaseDatos->ip }}</p>
                    <p>{{ $empresa->Config_Empresas->ms->media_server }}</p>
                    <p>{{ $empresa->Config_Empresas->ms->ip_pbx }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Modulos Contratados</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    @foreach ($empresa->Modulos as $item)
                    @if ($loop->iteration == 10)
                        </div>
                        <div class="col-md-6">
                    @endif
                        <label>{{ $item->nombre }}</label><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Almacenamiento</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <label >Espacio Total:</label>
                </div>
                <div class="col-md-6">
                    {{ number_format( ( $empresa->Config_Empresas->almacenamiento_posiciones + $empresa->Config_Empresas->almacenamiento_adicional ) / 1024, 2) }} <b>GB</b>
                </div>
                <div class="col-md-12">
                    <h1>AQUI VA LA GRAFICA</h1>
                </div>
            </div>
        </div>
    </div>
