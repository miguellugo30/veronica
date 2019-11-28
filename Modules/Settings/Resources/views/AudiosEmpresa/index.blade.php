<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-headphones-alt"></i> Audios</h3>
        <div class="box-tools pull-right">
                @can('delete audios')
                <button type="button" class="btn btn-danger  btn-sm deleteAudio" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                @endcan
                @can('create audios')
                <button type="button" class="btn btn-primary btn-sm newAudio" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
                @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex" >
                <table id="tableAudios" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Escuchar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $audios as $audio )
                            <tr data-id="{{ $audio->id }}" style="cursor:pointer">
                                <td>{{ $audio->nombre }}</td>
                                <td>{{ $audio->descripcion }}</td>
                                <td><audio controls preload="metadata" controlsList="nodownload"><source src='http://10.255.242.136/audios/temp/{{ $audio->ruta }}' type="audio/wav">Tu navegador no soporta audio, favor de obtener la ultima version</audio></td>
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
