<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-phone"></i> DID's</h3>
        <div class="box-tools pull-right">
            <!--button type="button" class="btn btn-primary btn-xs nuevoDid" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Did</button-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex">
                <div class="col-md-12">
                    <table id="tableDid" class="display table table-bordered table-hover table-sm" style="width:100%">
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
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
