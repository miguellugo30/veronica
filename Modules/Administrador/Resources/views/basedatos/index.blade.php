<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-database"></i> Bases de Datos
        </h3>
        <div class="card-tools">
            @can('delete cat base datos')
                <button type="button" class="btn btn-danger  btn-sm deleteDataBase" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit cat base datos')
                <button type="button" class="btn btn-warning btn-sm editDataBase" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create cat base datos')
                <button type="button" class="btn btn-primary btn-sm newDataBase" data-widget="remove"><i class="fas fa-plus"></i> Nueva</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableBaseDatos" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Ubicación</th>
                            <th>Nombre</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($basesDatos as $basesDato)
                            <tr data-id="{{ $basesDato->id }}" style="cursor:pointer">
                                <td>{{$basesDato->ubicacion}}</td>
                                <td>{{$basesDato->nombre}}</td>
                                <td>{{$basesDato->ip}}</td>
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
