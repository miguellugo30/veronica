<div class="col-md-12" style="text-align: right;">
        <button type="button" class="btn btn-primary btn-xs newCanal" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Canal</button>
</div>

<div class="col-md-12">
    @csrf
    <input type="hidden" name="action" id="action" value="dataCanales">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$idEmpresa}}">
    <table  class="table table-striped">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Distribuidor</th>
                <th>Tipo</th>
                <th>Protocolo</th>
                <th>Troncal</th>
                <th>Prefijo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($canales as $canal)
                <tr>
                    <td><input type="checkbox" class="editar_canal" name="editar_canal_{{ $canal->id }}" id="editar_canal_{{ $canal->id }}" value="{{ $canal->id }}"></td>
                    <td>{{ $canal->Distribuidores->servicio }}</td>
                    <td>
                        <select name="tipo_Canal_{{ $canal->id }}" id="tipo_Canal_{{ $canal->id }}" class="form-control input-sm" disabled>
                            @foreach ($TipoCanales as $tipoCanal)
                                <option value="{{ $tipoCanal->id }}" {{ $tipoCanal->id == $canal->Cat_Canales_Tipo_id ? 'selected' : '' }}>{{ $tipoCanal->nombre }}</option>
                            @endforeach
                        </select>
                    <td>{{ $canal->protocolo }}</td>
                    <td>
                        <select name="troncal_{{ $canal->id }}" id="troncal_{{ $canal->id }}"  class="form-control input-sm" disabled>
                            @foreach ($troncales as $troncal)
                                <option value="{{ $troncal->id }}" {{ $troncal->id == $canal->Troncales_id ? 'selected' : '' }}>{{ $troncal->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="input-group col-sm-6">
                            <span class="input-group-addon">{{ substr( $canal->prefijo, 0, -2 ) }}</span>
                            <input type="text" class="form-control input-sm" name="prefijo_{{ $canal->id }}" id="prefijo_{{ $canal->id }}" value="{{ substr( $canal->prefijo, -2 ) }}" disabled>
                            <input type="hidden" name="prefijo_completo_{{ $canal->id }}" id="prefijo_completo_{{ $canal->id }}" value="{{ substr( $canal->prefijo, 0, -2 ) }}" disabled>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs deleteCanal" id="delete_{{ $canal->id }}" style="display:none"><i class="fas fa-plus"></i> Eliminar Canal</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
