<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="far fa-credit-card"></i> Licencias Bria</b></h3>
        <div class="box-tools pull-right">
            @can('create lic bria')
                <button type="button" class="btn btn-primary btn-sm newLicencia" ><i class="fas fa-plus"></i> Nueva Licencia</button>
            @endcan
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex table-responsive">
                <table id="licencias_bria" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Licencias</th>
                            <th>Ocupadas</th>
                            <th>Empresas</th>
                            <th>Limite de licencias</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($licencias as $licencia)
                            <tr data-id="{{ $licencia->id }}" style="cursor:pointer">
                                <td>{{ $licencia->licencia }}</td>
                                <td>{{ $licencia->Extensiones->count() }}</td>
                                <td>
                                    @if ( $licencia->Extensiones->count() != 0 )
                                        <button type="button" class="btn btn-lg btn-secondary btn-sm pop" data-toggle="popover" title="Empresas" data-content="
                                        <ul>
                                            @foreach ($licencia->Extensiones as $v)
                                                {{ "<li>".$v->Empresas->nombre.": </li>"}}
                                            @endforeach
                                        </ul>
                                        "> <i class="fas fa-eye"></i></button>
                                    @endif
                                </td>
                                <td>{{ $licencia->disponibles }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

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
                    <button type="button" class="btn btn-sm btn-primary saveLicencia"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
