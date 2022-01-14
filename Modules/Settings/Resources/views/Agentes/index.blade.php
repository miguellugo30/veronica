<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa-user-cog"></i> Agentes</b></h3>
        <div class="card-tools">
            @can('delete agentes')
                <button type="button" class="btn btn-danger  btn-sm deleteAgente" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
            @endcan
            @can('edit agentes')
                <button type="button" class="btn btn-warning  btn-sm editAgente" style="display:none"><i class="fas fa-edit"></i> Editar</button>
            @endcan
            @can('create agentes')
                <button type="button" class="btn btn-primary btn-sm newAgente" ><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="col-md-12 viewIndex">
            <table id="tableAgentes" class="display table table-bordered table-striped table-hover table-sm" style="width:100%">
                <thead class="thead-light">
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
                                    {{ $agente->Grupos->first()->nombre }}
                                @endif
                            </td>
                            <td>{{ $agente->nivel }}</td>
                            <td>{{ $agente->nombre }}</td>
                            <td>{{ $agente->usuario }}</td>
                            <td>{{ $agente->contrasena }}</td>
                            <td>{{ $agente->extension_real }}</td>
                            <td>
                                @if ( $agente->Canales == null )
                                    Sin Canal
                                @else
                                    {{ $agente->Canales->Cat_Tipo_Canales->nombre }}
                                @endif
                            </td>
                            <td>
                                @if ($agente->Perfiles->isEmpty())
                                    Sin Perfil
                                @else
                                    {{ $agente->Perfiles->first()->nombre }}
                                @endif
                            </td>
                            <td> </td>
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
