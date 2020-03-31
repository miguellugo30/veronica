
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-database"></i> Bases de Datos</h3>
        <div class="box-tools pull-right">
            <div class="btn-group dropleft" style="display:none" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Accion
                </button>
                <div class="dropdown-menu">
                    @can('edit bases de datos')
                        <a class="dropdown-item editBaseDatos" href="#"><i class="fas fa-edit"></i> Editar</a>
                        <a class="dropdown-item viewBaseDatos" href="#"><i class="fas fa-eye"></i> Visualizar</a>
                    @endcan
                    <div class="dropdown-divider"></div>
                    @can('delete bases de datos')
                        <a class="dropdown-item deleteBaseDatos" href="#"><i class="fas fa-trash-alt"></i> Eliminar</a>
                    @endcan
                </div>
            </div>

            @can('create bases de datos')
                <button type="button" class="btn btn-primary btn-sm newBaseDatos" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex" >
                <table id="tableBaseDatos" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Plantilla</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $dataBases as $data)
                            <tr data-id="{{ $data->id }}">
                                <td>{{ $data->nombre }}</td>
                                <td>{{ $data->Plantillas->nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                    ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary"  id="action"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modalRegistros" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalRegistros">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-registros">
                    ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary"  id="action"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->

