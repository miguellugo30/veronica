<div class="card card-outline card-primary">
    <div class="card-header">
        <h1 class="card-title"><b><i class="fas fa-cloud-upload-alt"></i> Campañas de Salida</b></h1>
        <div class="card-tools">
            @can('delete campanas')
            <button type="button" class="btn btn-danger  btn-sm deleteCampanaOutbound" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit campanas')
            <button type="button" class="btn btn-warning btn-sm editCampanaOutbound" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
                @can('create campanas')
                <button type="button" class="btn btn-primary btn-sm newCampanaOutbound" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
                @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 border">
                <div class="col-xl-12 py-3 px-lg-3 text-center bg-secondary text-white">
                    <b>Pendiente</b>
                </div>
                <table id="tableCampanas" class="tableCampanas display table table-bordered table-hover table-sm" style="width:100%">
                    <tbody>
                        @foreach ($campanas as $campana)
                            @if ( $campana->Estado_Campanas->first()->id == 1 )
                                <tr data-id="{{ $campana->id }}" style="cursor:pointer">
                                    <td>{{ Str::title( $campana->nombre." - ".$campana->modalidad_marcado ) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3 border">
                <div class="col-xl-12 py-3 px-lg-3 text-center bg-success text-white">
                    <b>En Proceso</b>
                </div>
                <table id="tableCampanas" class="tableCampanas display table table-bordered table-hover table-sm" style="width:100%">
                    <tbody>
                        @foreach ($campanas as $campana)
                            @if ( $campana->Estado_Campanas->first()->id == 2 )
                                <tr data-id="{{ $campana->id }}" style="cursor:pointer">
                                    <td>{{ Str::title( $campana->nombre." - ".$campana->modalidad_marcado ) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3 border">
                <div class="col-xl-12 py-3 px-lg-3 text-center bg-danger text-white">
                    <b>Detenida</b>
                </div>
                <table id="tableCampanas" class="tableCampanas display table table-bordered table-hover table-sm" style="width:100%">
                    <tbody>
                        @foreach ($campanas as $campana)
                            @if ( $campana->Estado_Campanas->first()->id == 3 )
                                <tr data-id="{{ $campana->id }}" style="cursor:pointer">
                                    <td>{{ Str::title( $campana->nombre." - ".$campana->modalidad_marcado ) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3 border viewIndex">
                <div class="col-xl-12 py-3 px-lg-3 text-center bg-info text-white">
                    <b>Completada</b>
                </div>
                <table id="tableCampanas" class="tableCampanas display table table-bordered table-hover table-sm" style="width:100%">
                    <tbody>
                        @foreach ($campanas as $campana)
                            @if ( $campana->Estado_Campanas->first()->id == 4 )
                                <tr data-id="{{ $campana->id }}" style="cursor:pointer">
                                    <td>{{ Str::title( $campana->nombre." - ".$campana->modalidad_marcado ) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>

        </div>
    </div><!--card-header-->
</div><!--card-->


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
