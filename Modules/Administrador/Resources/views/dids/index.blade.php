<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-phone"></i> DID's
        </h3>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableDid" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <!-- Encabezados de la tabla que se mostrara al inicio -->
                    <thead class="thead-light">
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
                    <tbody>
                        @foreach( $Dids as $did )
                            <tr data-id="{{ $did->id }}">
                                <td>{{ $did->Empresas->nombre }}</td>
                                <td>{{$did->Canales->Troncales->nombre."/".$did->Canales->prefijo }}</td>
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
        </div><!-- /.row -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->
