<style>
    .input-group-text {
        font-size: 0.87rem;
    }
    </style>

    <div class="col-12" style="text-align: right;">
        {{--@can('create perfil marcacion')--}}
        <button type="button" class="btn btn-primary btn-sm newPerfilMarcacion" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Perfil</button>
        {{--@endcan--}}
    </div>

    <div class="col-12">
    @csrf
        <input type="hidden" name="action" id="action" value="dataPerfil">
        <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Prefijo Marcacion</th>
                    <th>Canal</th>
                    <th>Did</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perfil_marcacion as $perfil)
                    <tr>
                    <td class="text-center">
                            <input type="checkbox" class="editar_perfil" name="editar_perfil_{{ $perfil->Perfiles->id }}" value="{{ $perfil->Perfiles->id }}">
                        </td>
                        <td class="text-center">
                            <input type="text" name="nombre_{{ $perfil->Perfiles->id }}" id="nombre_{{ $perfil->Perfiles->id }}" value="{{ $perfil->Perfiles->nombre }}" class="form-control form-control-sm" disabled>
                        </td>
                        <td class="text-center">
                            <input type="text" name="descripcion_{{ $perfil->Perfiles->id }}" id="descripcion_{{ $perfil->Perfiles->id }}" value="{{ $perfil->Perfiles->descripcion }}" class="form-control form-control-sm" disabled>
                        </td>
                        <td class="text-center">
                            <select name="prefijo_{{ $perfil->Perfiles->id }}" id="prefijo_{{ $perfil->Perfiles->id }}" class="form-control form-control-sm prefijo" disabled>
                                <option value="">Selecciona un prefijo</option>
                                @foreach ($prefijos as $prefijo)
                                <option value="{{ $prefijo->id }}" {{ $prefijo->id == $perfil->fk_prefijos_marcacion_id ? 'selected = "selected"':'' }}>{{ $prefijo->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <select name="canal_{{ $perfil->Perfiles->id }}" id="canal_{{ $perfil->Perfiles->id }}" class="form-control form-control-sm canal" disabled>
                                <option value="">Selecciona un canal</option>
                                @foreach ($canales as $canal)
                                <option value="{{ $canal->Cat_Tipo_Canales->id }}" {{ $canal->Cat_Tipo_Canales->id == $perfil->Canales->Cat_Tipo_Canales->id ? 'selected = "selected"':'' }}>{{ $canal->Cat_Tipo_Canales->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <select name="did_{{ $perfil->Perfiles->id }}" id="did_{{ $perfil->Perfiles->id }}" class="form-control form-control-sm did" disabled>
                                <option value="">Selecciona un did</option>
                                @foreach ($did as $di)
                                <option value="{{ $di->id }}" {{ $di->id == $perfil->Dids->id ? 'selected = "selected"':'' }}>{{ $di->did }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm deletePerfil" id="delete_{{ $perfil->Perfiles->id }}" style="display:none"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
