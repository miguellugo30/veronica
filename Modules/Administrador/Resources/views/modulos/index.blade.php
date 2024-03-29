<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-th"></i> Módulos
        </h3>
        <div class="card-tools">
            @can('delete modulos')
                <button type="button" class="btn btn-danger  btn-sm deleteModule" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit modulos')
                <button type="button" class="btn btn-warning btn-sm editModule" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                <button type="button" class="btn btn-primary btn-sm orderignModule" style="display:none"> <i class="fas fa-sort-numeric-down"></i> Ordenar</button>
            @endcan
            @can('create modulos')
                <button type="button" class="btn btn-primary btn-sm newModule" ><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableModulos" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modulos as $modulo)
                            <tr data-id="{{ $modulo->id }}" style="cursor:pointer">
                                <td>{{ $modulo->nombre }}</td>
                                <td>{{ $modulo->descripcion }}</td>
                                <td>{{ $modulo->prioridad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.row -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->



<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
