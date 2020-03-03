<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="far fa-id-card"></i> Perfil Marcacion</h3>
        <div class="box-tools pull-right">
            @can('delete perfil marcacion')
                <button type="button" class="btn btn-danger btn-sm deletePerfilMarcacion" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit perfil marcacion')
                <button type="button" class="btn btn-warning btn-sm editPerfilMarcacion" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create perfil marcacion')
                <button type="button" class="btn btn-primary btn-sm newPerfilMarcacion"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tablePerfilMarcacion" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Prefijo Marcacion</th>
                            <th>canal</th>
                            <th>Did</th>
                        </tr>
                    </thead>
                    <!-- Iterar el arreglo $perfiles que contiene el resultado de consultar todos los registros que contiene la tabla de Perfil Marcacion
                    :: Nombre de Prefijo Marcacion
                    :: Nombre de Perfil
                    :: Nombre de Canal (en la tabla Cat_Tipo_Canales)
                    :: Did
                    -->
                    <tbody>
                        @foreach ($perfil_marcacion as $marcacion)
                            <tr data-id="{{ $marcacion->Perfiles->id }}">
                                <td>{{ $marcacion->Perfiles->nombre }}</td>
                                <td>{{ $marcacion->Perfiles->descripcion }}</td>
                                <td>{{ $marcacion->PrefijosMarcacion->nombre }}</td>
                                <td>{{ $marcacion->Canales->Cat_Tipo_Canales->nombre }}</td>
                                <td>{{ $marcacion->Dids->did }}</td>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
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
