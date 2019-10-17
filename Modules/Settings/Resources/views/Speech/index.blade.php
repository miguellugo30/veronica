<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-file-audio-o"></i> Speech</h3>
        <div class="box-tools pull-right">
                @can('delete speech')
                <button type="button" class="btn btn-danger  btn-sm deleteSpeech" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                @endcan
                @can('edit speech')
                <button type="button" class="btn btn-warning  btn-sm editSpeech" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                @endcan
                @can('create speech')
                <button type="button" class="btn btn-primary btn-sm newSpeech" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
                @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex" >
                <table id="tableSpeech" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $speech as $speechs )
                            <tr data-id="{{ $speechs->id }}" style="cursor:pointer">
                                <td>{{ $speechs->nombre }}</td>
                                <td>{{ $speechs->descripcion }}</td>
                                <td>{{ $speechs->tipo }}</td>
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
