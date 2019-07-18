<div class="col-12 viewIndex">
    <fieldset>
        <!-- Nombre del apartado DID -->
        <legend>
            <i class="fas fa-phone"></i>
            DID
            <button type="button" class="btn btn-primary btn-xs nuevoDid" style="float: right;">
                <i class="fas fa-plus"></i>
                Nuevo did
            </button>
        </legend>

        <div class="col-md-12">
            <table id="tableDid" class="display table table-striped table-condensed" style="width:100%">
                <!-- Encabezados de la tabla que se mostrara al inicio -->
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Canal</th>
                        <th>Did</th>
                        <th>Referencia</th>
                        <th>Numero Real</th>
                        <th>Gateway</th>
                        <th>Fakedid</th>
                    </tr>
                </thead>
                <!-- Iterar el arreglo $Dids que contiene el resultado de consultar todos los registros que contiene la tabla de Dids
                :: Nombre de Empresa
                :: Canal
                :: Prefijo
                :: DID
                :: Referencia
                :: Numero Real
                :: Gateway
                :: Fakedid
                -->
                <tbody>
                    @foreach( $Dids as $did )
                        <tr data-id="{{ $did->id }}">
                            <td>{{ $did->Empresas->nombre }}</td>
                            <td>{{ $did->Canales->canal }}</td>
                            <td>{{ $did->did }}</td>
                            <td>{{ $did->referencia }}</td>
                            <td>{{ $did->numero_real }}</td>
                            <td>{{ ( $did->gateway == 1 ) ? 'Habilitado' : 'Deshabilitado' }}</td>
                            <td>{{ ( $did->fakedid == 1 ) ? 'Habilitado' : 'Deshabilitado' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>
