<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa-sitemap"></i> IVR</b></h3>
        <div class="card-tools">
            @can('delete ivr')
                <button type="button" class="btn btn-danger  btn-sm deleteIvr" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                @endcan
            @can('edit ivr')
                <button type="button" class="btn btn-warning btn-sm editIvr" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create ivr')
                <button type="button" class="btn btn-primary btn-sm newIvr" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="col-md-12 viewIndex">
            <table id="tableivr" class="display table table-bordered table-striped table-hover table-sm" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Mensaje Bienvenida</th>
                        <th>Tiempo Espera</th>
                        <th>Mensaje Espera Superada</th>
                        <th>Mensaje Opcion Invalida</th>
                        <th>Repeticiones</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=0; $i < count($data); $i ++ )
                        <tr data-id="{{ $data[$i][0] }}" style="cursor:pointer">
                        <td>{{ Str::title( $data[$i][1] ) }}</td>
                        <td>{{ Str::title( $data[$i][4] ) }}</td>
                        <td>{{ Str::title( $data[$i][2] ) }}</td>
                        <td>{{ Str::title( $data[$i][5] ) }}</td>
                        <td>{{ Str::title( $data[$i][6] ) }}</td>
                        <td>{{ Str::title( $data[$i][3] ) }}</td>

                        </tr>
                    @endfor
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
