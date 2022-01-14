<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa-phone"></i> Calificaciones</b></h3>
        <div class="card-tools">
            <div class="btn-group dropleft" style="display:none" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Accion
                </button>
                <div class="dropdown-menu">
                    @can('edit calificaciones')
                        <a class="dropdown-item editCalificaciones" href="#"><i class="fas fa-pen-square"></i> Editar</a>
                    @endcan
                        <a class="dropdown-item cloneCalificaciones" href="#"><i class="fas fa-clone"></i> Duplicar</a>
                    @can('view calificaciones')
                        <a class="dropdown-item viewCalificaciones" href="#"><i class="fas fa-eye"></i> Visualizar</a>
                    @endcan
                     <div class="dropdown-divider"></div>
                        @can('delete calificaciones')
                            <a class="dropdown-item deleteCalificaciones" href="#"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        @endcan
                </div>
            </div>
            @can('create calificaciones')
                <button type="button" class="btn btn-primary btn-sm newCalificaciones"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="col-md-12 viewIndex">
            <table id="tableCalificaciones" class="display table table-bordered table-striped table-hover table-sm" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificaciones as $calificacion)
                        <tr data-id="{{ $calificacion->id }}" style="cursor:pointer">
                            <td>{{ $calificacion->nombre }}</td>
                            <td>{{ $calificacion->descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--card-header-->
  </div>
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal_opciones_campo" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalOpciones"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary float-left" id="close_options" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary" id="action_opc"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
