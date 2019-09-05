<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-fax"></i> Enrutamientos DID's</b></h3>
        <div class="box-tools pull-right">
            @can('delete didenrutamiento')
            @endcan
            <button type="button" class="btn btn-danger  btn-sm deletedidenrutamiento" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @can('edit didenrutamiento')
            @endcan
            <button type="button" class="btn btn-warning btn-sm editdidenrutamiento" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @can('create didenrutamiento')
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tabledidenrutamientos" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Did</th>
                            <th>Descripcion</th>
                            <th>Aplicacion Principal</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count( $data ); $i++)
                            <tr data-id="{{ $data[$i][0] }}" style="cursor:pointer">
                                <td>{{ $data[$i][1] }}</td>
                                <td>{{ $data[$i][2] }}</td>
                                <td>{{ $data[$i][3] }}</td>
                                <td>{{ $data[$i][4] }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                    ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary" id="action"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->