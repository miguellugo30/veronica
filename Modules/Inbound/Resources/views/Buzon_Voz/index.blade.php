<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-microphone-alt"></i> Buzon De Voz</b></h3>
        <div class="box-tools pull-right">
            @can('delete buzon de voz')
            @endcan
            <button type="button" class="btn btn-danger  btn-sm deleteBuzonVoz" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @can('edit buzon de voz')
            @endcan
            <button type="button" class="btn btn-warning btn-sm editBuzonVoz" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @can('create buzon de voz')
            @endcan
                <button type="button" class="btn btn-primary btn-sm newBuzonVoz" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableBuzonVoz" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre Del Buzón</th>
                            <th>Tiempo Máximo De Gabación</th>
                            <th>Terminar Gabación</th>
                            <th>Anuncio Del Buzón</th>
                            <th>Notificar Vía Correo a</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buzones as $buzon)
                            <tr data-id="{{ $buzon->id }}" style="cursor:pointer">
                            <td>{{ Str::title( $buzon->nombre ) }}</td>
                            <td>{{ Str::title( $buzon->tiempo_maximo ) }}</td>
                            <td>
                                @if($buzon->terminacion == 'y') 
                                Terminacion Con Cualquier Digito
                                @else
                                Terminacion Con #
                                @endif    
                            </td>
                            <td>{{$buzon->Audios_Empresa->nombre}}</td>
                            <td>{{$buzon->correos}}</td>

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
