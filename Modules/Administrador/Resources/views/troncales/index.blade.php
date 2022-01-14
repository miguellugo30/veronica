<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-project-diagram"></i> Troncales
        </h3>
        <div class="card-tools">
            @can('delete troncales')
                <button type="button" class="btn btn-danger  btn-sm deleteTroncal" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit troncales')
                <button type="button" class="btn btn-warning btn-sm editTroncal" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create troncales')
                <button type="button" class="btn btn-primary btn-sm newTroncal" data-widget="remove"><i class="fas fa-plus"></i> Nueva</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableTroncales" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Distribuidor</th>
                            <th>Troncal</th>
                            <th>Descripci&oacute;n</th>
                            <th>IP HOST</th>
                            <!--th>Configuraci&oacute;n</th-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($troncales as $troncal)
                            <tr data-id="{{ $troncal->id }}" style="cursor:pointer">
                                <td>{{ $troncal->Cat_Distribuidor->servicio }}</td>
                                <td>{{ $troncal->nombre }}</td>
                                <td>{{ $troncal->descripcion }}</td>
                                <td>{{  $troncal->Troncales_Sansay->host}}</td>
                                <!--td align="center">
                                    <input type="hidden" name="id" id="id" value="{{ $troncal->id }}">
                                    <button type="button" value="{{--$troncal->id--}}" class="btn bg-olive margin btn-sm viewConfig" style="margin: 0px;">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                </td-->
                            </tr>
                        @endforeach
                        <div id="configuracionmodal" class="modal fade">
                        </div>
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
