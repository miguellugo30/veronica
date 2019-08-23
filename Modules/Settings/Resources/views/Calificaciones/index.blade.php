<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-phone"></i> Calificaciones</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-danger  btn-sm deleteCalificaciones" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            <button type="button" class="btn btn-warning btn-sm editCalificaciones" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                                   
            @can('create formularios')
                <button type="button" class="btn btn-primary btn-sm newCalificaciones"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan

            
            
            
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableCalificaciones" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calificaciones as $calificacion)
                            <tr data-id="{{ $calificacion->id }}" style="cursor:pointer">
                                <td>{{ $calificacion->nombre }}</td>
                                <td>{{ $calificacion->tipo_marcacion }}</td>
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
    <div class="modal-dialog" role="document">
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
