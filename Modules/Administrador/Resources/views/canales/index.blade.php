<div class="col-12 viewIndex">
    <fieldset >
        <!-- Nombre del apartado Canales -->
        <legend>
            <i class="fas fa-project-diagram"></i>
            Catalogo de Canales
            <button type="button" class="btn btn-primary btn-xs newCanal" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo Canal
            </button>
        </legend>
        <!-- Encabezados de la tabla que se mostrara al inicio -->
        <table id="tableCanales" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Distribuidor</th>
                        <th>Empresa</th>
                        <th>Tipo</th>
                        <th>Protocolo</th>
                        <th>Troncal</th>
                        <th>Prefijo</th>                       
                    </tr>
                </thead>
                <!-- Iterar el arreglo $canales que contiene el resultado de consultar todos los registros que contiene la tabla de Canales
                :: Nombre de Distribuidor
                :: Nombre de Empresa
                :: Troncal
                :: Tipo de canal
                :: Canal
                -->
                <tbody>
                    @foreach ($canales as $canal)
                        <tr data-id="{{ $canal->id }}">
                            <td>{{ $canal->Distribuidores->servicio }}</td>
                            <td>{{ $canal->Empresas->nombre }}</td>
                            <td>{{ $canal->Cat_Tipo_Canales->nombre }}</td>
                            <td>{{ $canal->protocolo }}</td>
                            <td>{{ $canal->Troncales->nombre }}</td>
                            <td>{{ $canal->prefijo }}</td>                  
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>
