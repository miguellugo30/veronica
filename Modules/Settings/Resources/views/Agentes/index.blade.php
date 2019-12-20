<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-user-cog"></i> Agentes</h3>
        <div class="box-tools pull-right">
            @can('delete agentes')
                <button type="button" class="btn btn-danger  btn-sm deleteAgente" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit agentes')
                <button type="button" class="btn btn-warning  btn-sm editAgente" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create agentes')
<<<<<<< HEAD
=======
                <button type="button" class="btn btn-primary btn-sm newAgente" ><i class="fas fa-plus"></i> Nuevo</button>
>>>>>>> 2c4ede2c82041d889eaa5ff6c8248298e78f16aa
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex" >
                <table id="tableAgentes" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Grupo</th>
                            <th>Nivel</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Extensión</th>
                            <th>Canal</th>
                            <th>Prefil</th>
                            <th>Prueba</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $agentes as $agente )
                            <tr data-id="{{ $agente->id }}" style="cursor:pointer">
                                <td>{{ $agente->tipo_licencia }} </td>
                                <td>
                                    @if ( $agente->Grupos->isEmpty() )
                                        Sin Grupo
                                    @else
                                        {{ $agente->Grupos[0]->nombre }}
                                    @endif
                                </td>
                                <td>{{ $agente->nivel }}</td>
                                <td>{{ $agente->nombre }}</td>
                                <td>{{ $agente->usuario }}</td>
                                <td>{{ $agente->contrasena }}</td>
                                <td>{{ $agente->extension }}</td>
                                <td>{{ $agente->Canales->Cat_Tipo_Canales->nombre }}</td>
                                <td> </td>
                                <td> </td>
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
    <div class="modal-dialog modal-lg" role="document">
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
