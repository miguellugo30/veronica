<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa-atlas"></i> Prefijos Marcacion</b></h3>
        <div class="card-tools">
            @can('delete prefijos marcacion')
                <button type="button" class="btn btn-danger btn-sm deletePrefijoMarcacion" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit prefijos marcacion')
                <button type="button" class="btn btn-warning btn-sm editPrefijoMarcacion" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create prefijos marcacion')
                <button type="button" class="btn btn-primary btn-sm newPrefijoMarcacion"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="col-md-12 viewIndex">
            <table id="tablePrefijosMarcacion" class="display table table-bordered table-striped table-hover table-sm" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Prefijo</th>
                        <th>Prefijo_nuevo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prefijos as $prefijo)
                        <tr data-id="{{$prefijo->id}}">
                            <td>{{$prefijo->nombre}}</td>
                            <td>{{$prefijo->descripcion}}</td>
                            <td>{{$prefijo->prefijo}}</td>
                            <td>{{$prefijo->prefijo_nuevo}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--card-header-->
  </div>
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
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
