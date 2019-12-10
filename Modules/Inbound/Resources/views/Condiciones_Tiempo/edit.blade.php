<style>
.hora{
    background-color: white;
    display: inline-flex;
    border: 1px solid #ccc;
    color: #555;
}
.hora input{
    border: none;
    color: #555;
    text-align: center;
    width: 50px;
    height: 29px;
}
</style>
<form id="formDataCondicionTiempo">
    <div class="col-12" >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b> Nombre Grupo</b></label>
                    @csrf
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Grupo" value="{{ $grupo->nombre  }}">
                    <input type="hidden" class="form-control form-control-sm" id="id_grupo" name="id_grupo"  value="{{ $grupo->id  }}">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <fieldset>
                <legend>
                    Condiciones Tiempo
                    <input type="button" class="btn btn-primary btn-sm" id = "add" value = "Agregar condición" style="float: right;"/>
                </legend>
                <table id='condicion' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Nombre condicion</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Dia Semana Inicio</th>
                            <th>Dia Semana Fin</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Destino si coincide</th>
                            <th>Opciones</th>
                            <th>Destino si no coincide</th>
                            <th>Opciones</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @for ( $i = 0; $i < count( $condiciones ); $i++)
                            <tr id="tr_{{ $condiciones[$i][0] }}" class="clonar">
                                <td>
                                    <input type="hidden" class="form-control form-control-sm" name="id_campo_{{ $condiciones[$i][0] }}" id="id_campo" value="{{ $condiciones[$i][0] }}">
                                    <input type="text" class="form-control form-control-sm" name="nombre_campo_{{ $condiciones[$i][0] }}" id="nombre_campo" placeholder="Nombre Campo" value="{{ $condiciones[$i][1] }}">
                                </td>
                                <td>
                                    <div class="hora">
                                        @php
                                            $val = explode(':', $condiciones[$i][2]);
                                        @endphp
                                        <input type="number" name="hora_inicio_{{ $condiciones[$i][0] }}" id="hora_inicio" min="00" max="23" class="form-control form-control-sm" placeholder="--" value="{{$val[0]}}" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                        <input type="number" name="min_inicio_{{ $condiciones[$i][0] }}" id="min_inicio"  min="0" max="59" class="form-control form-control-sm" placeholder="--" value="{{$val[1]}}" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                                    </div>
                                </td>
                                <td>
                                    <div class="hora">
                                        @php
                                            $val = explode(':', $condiciones[$i][3]);
                                        @endphp
                                        <input type="number" name="hora_fin_{{ $condiciones[$i][0] }}" id="hora_fin" min="0" max="23" class="form-control form-control-sm" placeholder="--" value="{{$val[0]}}" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                        <input type="number" name="min_fin_{{ $condiciones[$i][0] }}" id="min_fin"  min="0" max="59" class="form-control form-control-sm" placeholder="--" value="{{$val[1]}}" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                                    </div>
                                </td>
                                <td>
                                    <select name="dia_semana_inicio_{{ $condiciones[$i][0] }}" id="dia_semana_inicio"  class="form-control form-control-sm" placeholder="dia_demana_inicio" >
                                        <option value="*">-</option>
                                            @foreach ($dias as $dia)
                                                <option value="{{$dia['value']}}" {{ $dia['value'] == $condiciones[$i][4] ? 'selected=selected' : ''  }}>{{ $dia['texto'] }}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="dia_semana_fin_{{ $condiciones[$i][0] }}" id="dia_semana_fin"  class="form-control form-control-sm" placeholder="dia_semana_fin">
                                        <option value="*">-</option>
                                            @foreach ($dias as $dia)
                                                <option value="{{$dia['value']}}" {{ $dia['value'] == $condiciones[$i][5] ? 'selected=selected' : ''  }}>{{ $dia['texto'] }}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm fecha_inicio" name="fecha_inicio_{{ $condiciones[$i][0] }}" id="fecha_inicio" placeholder="Fecha Inicio" {{ $condiciones[$i][6] == '*' ? '' : 'value='.date('Y').'-'.$condiciones[$i][7].'-'.$condiciones[$i][6] }}>
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm fecha_final" name="fecha_final_{{ $condiciones[$i][0] }}" id="fecha_final" placeholder="Fecha Final" {{ $condiciones[$i][8] == '*' ? '' : 'value='.date('Y').'-'.$condiciones[$i][9].'-'.$condiciones[$i][8] }}>
                                </td>
                                <td>
                                    <select name="destino_verdadero_{{ $condiciones[$i][0] }}" id="destino_verdadero"  class="form-control form-control-sm destinoOpccion" data-accion="si_coincide">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Audios_Empresa" {{ $condiciones[$i][10] == 'Audios_Empresa' ? 'selected = "selected"' : '' }} >Anuncio</option>
                                        <option value="Aplicacion" {{ $condiciones[$i][10] == 'Aplicacion' ? 'selected = "selected"' : '' }} >Aplicación</option>
                                        <option value="Campanas" {{ $condiciones[$i][10] == 'Campanas' ? 'selected = "selected"' : '' }} >Campaña</option>
                                        <option value="hangup" {{ $condiciones[$i][10] == 'hangup' ? 'selected = "selected"' : '' }} >Colgar llamada</option>
                                        <option value="Condiciones_Tiempo" {{ $condiciones[$i][10] == 'Condiciones_Tiempo' ? 'selected = "selected"' : '' }} >Condición de Tiempo</option>
                                        <option value="Conferencia" {{ $condiciones[$i][10] == 'Conferencia' ? 'selected = "selected"' : '' }} >Conferencia</option>
                                        <option value="Desvios" {{ $condiciones[$i][10] == 'Desvios' ? 'selected = "selected"' : '' }} >Desvio</option>
                                        <option value="Cat_Extensiones" {{ $condiciones[$i][10] == 'Cat_Extensiones' ? 'selected = "selected"' : '' }} >Extensión</option>
                                        <option value="Ivr" {{ $condiciones[$i][10] == 'Ivr' ? 'selected = "selected"' : '' }} >IVR</option>
                                    </select>
                                </td>
                                <td>
                                    <div id="opcionesSiCoincide_{{ $condiciones[$i][0] }}" class="opcionesSi">
                                        <select name="opciones_si_coincide{{ '_'.$condiciones[$i][0] }}" id="opciones_si_coincide" class="form-control form-control-sm">
                                            @foreach ($condiciones[$i][14] as $v)
                                                @if ($condiciones[$i][10] == 'Cat_Extensiones')
                                                    <option value="{{ $v->id }}" {{ $condiciones[$i][11] == $v->id ? 'selected = "selected"' : '' }} >{{$v->extension}}</option>
                                                @elseif( $condiciones[$i][10] == 'hangup' )
                                                    <option value="{{ $v['id'] }}" {{ $condiciones[$i][11] == $v['id'] ? 'selected = "selected"' : '' }} >{{$v['nombre']}}</option>
                                                @else
                                                    <option value="{{ $v->id }}" {{ $condiciones[$i][11] == $v->id ? 'selected = "selected"' : '' }} >{{$v->nombre}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select name="destino_falso_{{ $condiciones[$i][0] }}" id="destino_falso"  class="form-control form-control-sm destinoOpccion" data-accion="no_coincide">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Audios_Empresa" {{ $condiciones[$i][12] == 'Audios_Empresa' ? 'selected = "selected"' : '' }} >Anuncio</option>
                                        <option value="Aplicacion" {{ $condiciones[$i][12] == 'Aplicacion' ? 'selected = "selected"' : '' }} >Aplicación</option>
                                        <option value="Campanas" {{ $condiciones[$i][12] == 'Campanas' ? 'selected = "selected"' : '' }} >Campaña</option>
                                        <option value="hangup" {{ $condiciones[$i][12] == 'hangup' ? 'selected = "selected"' : '' }} >Colgar llamada</option>
                                        <option value="Condiciones_Tiempo" {{ $condiciones[$i][12] == 'Condiciones_Tiempo' ? 'selected = "selected"' : '' }} >Condición de Tiempo</option>
                                        <option value="Conferencia" {{ $condiciones[$i][12] == 'Conferencia' ? 'selected = "selected"' : '' }} >Conferencia</option>
                                        <option value="Desvios" {{ $condiciones[$i][12] == 'Desvios' ? 'selected = "selected"' : '' }} >Desvio</option>
                                        <option value="Cat_Extensiones" {{ $condiciones[$i][12] == 'Cat_Extensiones' ? 'selected = "selected"' : '' }} >Extensión</option>
                                        <option value="Ivr" {{ $condiciones[$i][12] == 'Ivr' ? 'selected = "selected"' : '' }} >IVR</option>
                                    </select>
                                </td>
                                <td>
                                    <div id="opcionesNoCoincide_{{ $condiciones[$i][0] }}" class="opcionesNo">
                                        <select name="opciones_no_coincide{{ '_'.$condiciones[$i][0] }}" id="opciones_no_coincide" class="form-control form-control-sm">
                                            @foreach ($condiciones[$i][15] as $v)
                                                @if ($condiciones[$i][12] == 'Cat_Extensiones')
                                                    <option value="{{ $v->id }}" {{ $condiciones[$i][13] == $v->id ? 'selected = "selected"' : '' }} >{{$v->extension}}</option>
                                                @elseif( $condiciones[$i][12] == 'hangup' )
                                                    <option value="{{ $v['id'] }}" {{ $condiciones[$i][13] == $v['id'] ? 'selected = "selected"' : '' }} >{{$v['nombre']}}</option>
                                                @else
                                                    <option value="{{ $v->id }}" {{ $condiciones[$i][13] == $v->id ? 'selected = "selected"' : '' }} >{{$v->nombre}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="tr_edit_remove text-center" data-id="{{ $condiciones[$i][1] }}">
                                    <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>
