<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        @csrf
        <input type="hidden" name="action" id="action" value="dataPosiciones">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($canales as $canal)
                    <tr>
                        <td><input type="checkbox" name="id" id="id" value="{{ $canal->id }}"></td>
                        <td>{{ $canal->Distribuidores->servicio }}</td>
                        <td>
                            <select name="" id="" readonly="readonly">
                                @foreach ($TipoCanales as $tipoCanal)
                                    <option value="{{ $tipoCanal->id }}" {{ $tipoCanal->id == $canal->Cat_Canales_Tipo_id ? 'selected' : '' }}>{{ $tipoCanal->nombre }}</option>
                                @endforeach
                            </select>
                        <td>{{ $canal->protocolo }}</td>
                        <td>{{ $canal->Troncales->nombre }}</td>
                        <td>{{ $canal->prefijo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</fieldset>
