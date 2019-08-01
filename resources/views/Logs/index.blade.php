<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="far fa-credit-card"></i> Bitacora de acciones</b></h3>
        <!--div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm newLicencia" ><i class="fas fa-plus"></i> Nueva Licencia</button>
        </div-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex table-responsive">
                <table id="tableLogs" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nivel</th>
                            <th>Usuario</th>
                            <th>Accion</th>
                            <th>Tabla Afectada</th>
                            <th>ID</th>
                            <th>Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr data-id="{{ $log->id }}">
                                <td>{{ date( 'd-m-Y H:i:s', strtotime($log->fecha) )  }}</td>
                                <td>{{ $log->nivel }}</td>
                                <td>{{ $log->Usuarios->email }}</td>
                                <td>{{ $log->accion }}</td>
                                <td>{{ $log->tabla }}</td>
                                <td>{{ $log->id_registro }}</td>
                                <td>{{ $log->mensaje }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
