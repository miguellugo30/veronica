<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-tty"></i> IVR</b></h3>
        <div class="box-tools pull-right">
            @can('delete ivr')
            @endcan
            <button type="button" class="btn btn-danger  btn-sm deleteIvr" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @can('edit ivr')
            @endcan
            <button type="button" class="btn btn-warning btn-sm editIvr" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @can('create ivr')
            @endcan
                <button type="button" class="btn btn-primary btn-sm newIvr" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableivr" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
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
                        @foreach ($ivrs as $ivr)
                            <tr data-id="{{ $ivr->id }}" style="cursor:pointer">
                            <td>{{ Str::title( $ivr->nombre ) }}</td>
                            <td>{{ Str::title( $ivr->mensaje_bienvenida_id ) }}</td>
                            <td>{{ Str::title( $ivr->tiempo_espera ) }}</td>
                            <td>{{ Str::title( $ivr->mensaje_tiepo_espera_id ) }}</td>
                            <td>{{ Str::title( $ivr->mensaje_opcion_invalida_id ) }}</td>
                            <td>{{ Str::title( $ivr->repeticiones ) }}</td>

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