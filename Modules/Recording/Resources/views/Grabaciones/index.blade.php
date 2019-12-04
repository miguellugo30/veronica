<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fas fa fa-microphone"></i> Grabaciones</h3>
            <div class="box-tools pull-right">
                    @can('delete grabaciones')
                    <button type="button" class="btn btn-danger  btn-sm deleteGrabacion" style="display:none"><i class="fas fa-trash-alt"></i> Eliminar</button>
                    @endcan
                    @can('create grabaciones')
                    <button type="button" class="btn btn-primary btn-sm downloadGrabacion" style="display:none" data-widget="remove"><i class="fas fa-plus"></i> Descargar</button>
                    @endcan
                <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 viewIndex" >
                    <table id="tableGrabaciones" class="display table table-bordered table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Escuchar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $grabaciones as $grabacion )
                                <tr data-id="{{ $grabacion->id }}" style="cursor:pointer">
                                    <td>{{ $grabacion->nombre_archivo }}</td>
                                    <td>{{ $grabacion->fecha }}</td>
                                    <td><audio controls preload="metadata" controlsList="nodownload"><source src='http://10.255.242.136/audios/temp2/{{ $grabacion->tipo }}_{{ $grabacion->Empresas_id }}/{{ $grabacion->nombre_archivo }}' type="audio/wav">Tu navegador no soporta audio, favor de obtener la ultima version</audio></td>
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

