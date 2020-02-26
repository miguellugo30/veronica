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
                    <th></th>
                    <th>Prefijo de Marcacion</th>
                    <th>Perfil</th>
                    <th>Canal</th>
                    <th>Did</th>
                </tr>
            </thead>
            <!-- Iterar el arreglo $perfiles que contiene el resultado de consultar todos los registros que contiene la tabla de Perfil Marcacion
                    :: Nombre de Prefijo Marcacion
                    :: Nombre de Perfil
                    :: Nombre de Canal (en la tabla Cat_Tipo_Canales)
                    :: Did
                    -->
            <tbody>
                @foreach ($perfil_marcacion as $perfil)
                    <tr id="tr_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" data-prefijo="{{ $perfil->PrefijosMarcacion->id }}" data-perfil="{{ $perfil->Perfiles->id }}" data-canal="{{ $perfil->Canales->Cat_Tipo_Canales->id }}" data-did="{{ $perfil->Dids->id }}">
                        <td class="text-center">
                            <input type="checkbox" class="editar_perfil" name="editar_perfil_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" value="{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}">
                        </td>
                        <td class="text-center">
                        <select name="prefijo_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" id="prefijo_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" class="form-control form-control-sm" disabled>
                                <option disabled selected value="">Seleccione un Prefijo de Marcacion</option>
                                    @foreach ($prefijos as $prefijo)
                                        <option value="{{ $prefijo->id }}" {{ $perfil->PrefijosMarcacion->id == $prefijo->id ? 'selected=selected' : '' }}>{{ $prefijo->nombre }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                        <select name="perfil_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" id="perfil_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" class="form-control form-control-sm" disabled>
                                <option disabled selected value="">Seleccione un Perfil</option>
                                    @foreach ($perfiles as $perfile)
                                        <option value="{{ $perfile->id }}" {{ $perfil->Perfiles->id == $perfile->id ? 'selected=selected' : '' }}>{{ $perfile->nombre }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                        <select name="canal_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" id="canal_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" class="form-control form-control-sm" disabled>
                                <option disabled selected value="">Seleccione un Canal</option>
                                    @foreach ($canales as $canal)
                                        <option value="{{ $canal->Cat_Tipo_Canales->id }}" {{ $perfil->Canales->Cat_Tipo_Canales->id == $canal->Cat_Tipo_Canales->id ? 'selected=selected' : '' }}>{{ $canal->Cat_Tipo_Canales->nombre }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                        <select name="did_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" id="did_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" class="form-control form-control-sm" disabled>
                                <option disabled selected value="">Seleccione un Did</option>
                                    @foreach ($did as $di)
                                        <option value="{{$di->id}}" {{ $perfil->Dids->id == $di->id ? 'selected=selected' : '' }}>{{$di->did}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm deletePerfil" id="delete_{{$perfil->PrefijosMarcacion->id.$perfil->Perfiles->id.$perfil->Canales->Cat_Tipo_Canales->id.$perfil->Dids->id}}" style="display:none"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
