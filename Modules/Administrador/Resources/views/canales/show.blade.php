    <div class="col-md-12">
        <input type="hidden" name="Empresa_id" id="Empresa_id" value="{{ $empresas->id }}">
        <input type="hidden" name="action" id="action" value="dataCanales">
        <input type="hidden" name="Cat_Distribuidor_id" id="Cat_Distribuidor_id" value="{{ $empresas->Config_Empresas->Cat_Distribuidor_id }}">
        <input type="hidden" name="preDist" id="preDist" value="{{ $distribuidor->prefijo }}">
        <input type="hidden" name="preEmp" id="preEmp" value="{{ str_pad( $empresas->id, 3, 0, STR_PAD_LEFT ) }}">
        @csrf
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <table  class="table table-striped tableNewCanal">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Protocolo</th>
                    <th>Troncal</th>
                    <th>Prefijo</th>
                    <td><input type = "button" class = "a" id = "add" value = "Agregar canal" /></td>
                </tr>
            </thead>
            <tbody>
                <tr id="tr_1">
                    <td>
                        <select name="tipo_canal_1" id="tipo_canal" class="form-control tipo_canal" data-pos="1">
                            <option value="">Selecciona un tipo de canal</option>
                            @foreach( $canales as $canal )
                            <option value="{{ $canal->id }}" data-pre_tipo="{{ $canal->prefijo }}">{{ $canal->nombre }}</option>
                            @endforeach
                        </select>
                    <td>
                        <input type="text" class="form-control input-sm protocolo" name="protocolo_1" id="protocolo_1" value="" readonly>
                    </td>
                    <td>
                        <select name="Troncales_id_canal_1" id="Troncales_id_canal_1" class="form-control Troncales_id_canal" >
                            <option value="">Selecciona una troncal</option>
                            @foreach( $troncales as $troncal )
                                <option value="{{ $troncal->id }}">{{($troncal->nombre == "") ? "AMD" : $troncal->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" class="Troncales_id" name="Troncales_id_1" id="Troncales_id_1" value="1" disabled>
                    </td>
                    <td>
                        <div class="input-group col-sm-6">
                            <span class="input-group-addon">
                                <label class="preDist">{{ $distribuidor->prefijo }}</label>
                                <label class="preEmp">{{ str_pad( $empresas->id, 3, 0, STR_PAD_LEFT ) }}</label>
                            </span>
                            <input type="text" class="form-control input-sm prefijo" name="prefijo_1" id="prefijo_1" value="">
                        </div>
                    </td>
                    <td class="delete">
                        <input type="button" name="remove" value="Eliminar" class="tr_clone_remove">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<div class="col-md-12" style="padding:10px;">
    <div class="col-md-6" style="text-align:left">
        <!--button type="submit" class="btn btn-warning cancelCanal"><i class="fas fa-times"></i> Cancelar</button-->
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary saveCanal"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>
