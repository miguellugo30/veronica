<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-phone"></i> Formularios</b></h3>
        <div class="box-tools pull-right">
            <div class="btn-group dropleft" style="display:none" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item editFormulario" href="#"><i class="fas fa-pen-square"></i> Editar</a>
                    <a class="dropdown-item cloneFormulario" href="#"><i class="fas fa-clone"></i> Clonar</a>
                    <a class="dropdown-item viewFormulario" href="#"><i class="fas fa-eye"></i> Visualizar</a>
                    <div class="dropdown-divider"></div>
                    @can('delete formularios')
                        <a class="dropdown-item deleteFormulario" href="#"><i class="fas fa-trash-alt"></i> Eliminar</a>
                    @endcan
                </div>
            </div>
            @can('create formularios')
                <button type="button" class="btn btn-primary btn-sm newFormulario"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableFormulario" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formularios as $formulario)
                            <tr data-id="{{ $formulario->id }}" style="cursor:pointer">
                                <td>{{ $formulario->nombre }}</td>
                                <td>{{ $formulario->Tipo_Marcacion->tipo }}</td>
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
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal_opciones_campo" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalOpciones"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form id="form_opc">
                        <div class="col" id="opcionesForm" style="display:none">
                            <table id='formulario' class="table table-striped table-sm tableOpc">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Opcion</th>
                                        <th>Sub Formulario</th>
                                        <td>
                                            <button type="button" class="btn btn-primary add_opc btn-sm"><i class="fas fa-plus-square"></i> Agregar</button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="tr_opciones_1" class="clonar">
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm " name="campo_1[]" id="nombre_opcion" placeholder="Nombre Opcion">
                                        </td>
                                        <td>
                                            <select name="campo_1[]" id="form_id"  class="form-control form-control-sm ">
                                                <option value="">Selecciona un Formulario</option>
                                                @foreach ($formularios as $formulario)
                                                    <option value="{{ $formulario->id }}">{{ $formulario->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center tr_clone_remove_opcion">
                                            <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col" id="folioForm" style="display:none">
                            <div class="form-group">
                                <label for="folio"><b> Prefijo</b></label>
                                <input type="text" class="form-control form-control-sm" id="prefijo" name="prefijo" placeholder="Prefijo">
                            </div>
                            <div class="form-group">
                                <label for="folio"><b> Folio</b></label>
                                <input type="text" class="form-control form-control-sm" id="folio" name="folio" placeholder="Folio">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary float-left" id="close_options" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="action_opc"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
