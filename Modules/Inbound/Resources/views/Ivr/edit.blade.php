<form id="formCreateIvr">
    <div class="col">
        <table id='condicion' class="table table-striped table-sm tableNewForm">
            <thead>
                <tr>
                <th>Nombre</th>
                <th>Mensaje Bienvenida</th>
                <th>Tiempo Espera</th>
                <th>Mensaje Espera Superada</th>
                <th>Mensaje Opción Invalida</th>
                <th>Repeticiones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" class="form-control form-control-sm" id="Empresas_id" name="Empresas_id" value="{{$empresa_id}}">
                        <input type="hidden" class="form-control form-control-sm" id="ivr_id" name="ivr_id" value="{{ $ivr->id }}">
                        @csrf
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre IVR" value="{{ $ivr->nombre }}">
                    </td>
                    <td>
                    <select name="mensaje_bienvenida_id" id="mensaje_bienvenida_id" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($audios as $audio)
                            <option value="{{$audio->id}}" {{ $audio->id == $ivr->mensaje_bienvenida_id ? 'selected = "selected"' : '' }} >{{$audio->nombre}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" id="tiempo_espera" name="tiempo_espera" placeholder="En segundos" value="{{ $ivr->tiempo_espera }}">
                    </td>
                    <td>
                        <select name="mensaje_tiempo_espera_id" id="mensaje_tiempo_espera_id" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                            @foreach ($audios as $audio)
                                <option value="{{$audio->id}}" {{ $audio->id == $ivr->mensaje_tiempo_espera_id ? 'selected = "selected"' : '' }}>{{$audio->nombre}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="mensaje_opcion_invalida_id" id="mensaje_opcion_invalida_id" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                            @foreach ($audios as $audio)
                                <option value="{{$audio->id}}" {{ $audio->id == $ivr->mensaje_opcion_invalida_id ? 'selected = "selected"' : '' }}>{{$audio->nombre}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" id="repeticiones" name="repeticiones" min="1" placeholder="Repeticiones" value="{{ $ivr->repeticiones }}">
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <fieldset>
            <legend>
                Opciones de IVR
                <input type="button" class="btn btn-primary btn-sm" id="addOpcion" value = "Agregar opción" style="float: right;" />
            </legend>
            <table id="tableOpcionesIvr" class="table table-striped table-sm tableOpciones">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Dígito a presionar</th>
                        <th>Destino</th>
                        <th>Opciones</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count( $data ); $i++)
                        <tr id="tr_{{ $i + 1 }}">
                            <td>
                                <input type="hidden" class="form-control form-control-sm" id="opcion_id" name="opcion_id_{{ $i + 1 }}" value="{{ $data[$i][0] }}">
                                <select name="tipo_{{ $i + 1 }}" id="tipo" class="form-control form-control-sm">
                                    <option value="">Selecciona una opción</option>
                                    <option value="digito" {{ 'digito' == $data[$i][1] ? 'selected = "selected"' : '' }} >Dígito</option>
                                    <option value="invalid" {{ 'invalid' == $data[$i][1] ? 'selected = "selected"' : '' }} >Opción Invalida</option>
                                    <option value="timeout" {{ 'timeout' == $data[$i][1] ? 'selected = "selected"' : '' }} >Tiempo de Espera Superado</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="digito_{{ $i + 1 }}" id="digito" class="form-control form-control-sm" min="1" placeholder="Dígito" value="{{ $data[$i][2] }}">
                            </td>
                            <td>
                                <select name="destino_{{ $i + 1 }}" id="destino"  class="form-control form-control-sm destinoOpccionIvr">
                                    <option value="">Selecciona una opción</option>
                                    <option value="Audios_Empresa" {{ 'Audios_Empresa' == $data[$i][3] ? 'selected = "selected"' : '' }} >Anuncio</option>
                                    <option value="Aplicacion" {{ 'Aplicacion' == $data[$i][3] ? 'selected = "selected"' : '' }} >Aplicación</option>
                                    <option value="Campanas" {{ 'Campanas' == $data[$i][3] ? 'selected = "selected"' : '' }} >Campaña</option>
                                    <option value="hangup" {{ 'hangup' == $data[$i][3] ? 'selected = "selected"' : '' }} >Colgar llamada</option>
                                    <option value="Condiciones_Tiempo" {{ 'Condiciones_Tiempo' == $data[$i][3] ? 'selected = "selected"' : '' }} >Condición de Tiempo</option>
                                    <option value="Conferencia" {{ 'Conferencia' == $data[$i][3] ? 'selected = "selected"' : '' }} >Conferencia</option>
                                    <option value="Desvios" {{ 'Desvios' == $data[$i][3] ? 'selected = "selected"' : '' }} >Desvio</option>
                                    <option value="Cat_Extensiones" {{ 'Cat_Extensiones' == $data[$i][3] ? 'selected = "selected"' : '' }} >Extensión</option>
                                    <option value="Ivr" {{ 'Ivr' == $data[$i][3] ? 'selected = "selected"' : '' }} >IVR</option>
                                </select>
                            </td>
                            <td >
                                <div id="opcionesDestino_{{ $i + 1 }}" class="opcionesDestino">
                                    <select name="opciones_{{ $i + 1 }}" id="opciones" class="form-control form-control-sm">
                                        @foreach ($data[$i][5] as $v)
                                            @if ($data[$i][3] == 'Cat_Extensiones')
                                                <option value="{{ $v->id }}" {{ $v->id == $data[$i][4] ? 'selected = "selected"' : '' }} >{{$v->extension}}</option>
                                            @elseif( $data[$i][3] == 'hangup' )
                                                <option value="{{ $v['id'] }}" {{ $v['id'] == $data[$i][4] ? 'selected = "selected"' : '' }} >{{$v['nombre']}}</option>
                                            @else
                                                <option value="{{ $v->id }}" {{ $v->id == $data[$i][4] ? 'selected = "selected"' : '' }} >{{$v->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="tr_remove_opcion_ivr text-center" data-id="{{ $data[$i][0] }}">
                                <button type="button" name="remove" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </fieldset>
    </div>
</form>
