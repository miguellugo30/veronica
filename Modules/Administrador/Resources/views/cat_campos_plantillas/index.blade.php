<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="far fa-list-alt"></i> Campos Plantillas
        </h3>
        <div class="card-tools">
            @can('delete campos plantillas')
                <button type="button" class="btn btn-danger  btn-sm deleteCamPla" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit campos plantillas')
                <button type="button" class="btn btn-warning btn-sm editCamPla" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create campos plantillas')
                <button type="button" class="btn btn-primary btn-sm newCamPla" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableCamPla" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Empresa(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat_campos_plantillas as $cat_campo)
                            <tr data-id="{{ $cat_campo->id }}" style="cursor:pointer">
                                <td>{{ $cat_campo->nombre }}</td>
                                <td><button type="button" class="btn btn-lg btn-secondary btn-sm pop" data-toggle="popover" title="Empresas" data-content="
                                    @foreach ($cat_campo->Empresas as $v)
                                    {{ "<li>".$v->nombre.": </li>" }}
                                    @endforeach
                                "><i class="fas fa-eye"></i></button></td>
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

