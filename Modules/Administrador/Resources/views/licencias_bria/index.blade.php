<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="far fa-credit-card"></i> Licencias Bria
        </h3>
        <div class="card-tools">
            @can('create lic bria')
                <button type="button" class="btn btn-primary btn-sm newLicencia" ><i class="fas fa-plus"></i> Nueva Licencia</button>
            @endcan
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="licencias_bria" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Licencias</th>
                            <th>Limite de licencias</th>
                            <th>Ocupadas</th>
                            <th>Empresas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($licencias as $licencia)
                            <tr data-id="{{ $licencia->id }}" style="cursor:pointer">
                                <td>{{ $licencia->licencia }}</td>
                                <td>{{ $licencia->disponibles }}</td>
                                <td>{{ $licencia->disponibles - $licencia->Extensiones->count() == $licencia->disponibles ? 0 : $licencia->ocupadas }}</td>
                                <td>
                                    @if ( $licencia->Extensiones->count() != 0 )
                                        <button type="button" class="btn btn-lg btn-secondary btn-sm pop" data-toggle="popover" title="Empresas" data-content="
                                        <ul>
                                            @foreach ($licencia->Extensiones as $v)
                                                {{ "<li>".$v->Empresas->nombre.": </li>" }}
                                            @endforeach
                                        </ul>
                                        "> <i class="fas fa-eye"></i></button>
                                    @endif
                                </td>
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
                    <button type="button" class="btn btn-sm btn-primary saveLicencia"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
