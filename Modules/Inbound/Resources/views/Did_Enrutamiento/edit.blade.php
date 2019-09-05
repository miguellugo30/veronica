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
<form id="formDataEnrutamiento">
    <div class="col-12" >
            <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nombre"><b> Descripción</b></label>
                            @csrf
                            <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripción" value="{{$did->descripcion}}">
                            <input type="hidden" class="form-control form-control-sm" name="id" id="id" value="{{ $id }}" >
                        </div>
                    </div>
                </div>
        <fieldset>
            <legend>
                <input type="button" class="btn btn-primary btn-sm" id = "addRuta" value = "Agregar Ruta" style="float: right;" />
            </legend>
            <table id='condicion' class="table table-striped table-sm tableNewForm">
                <thead>
                    <tr style="cursor: s-resize;">
                        <th><i class="fas fa-sort-numeric-down"></i></th>
                        <th>Destino</th>
                        <th>Opciones</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if ($data == NULL )
                        <tr id="tr_1" class="clonar">
                            <td><i class="fas fa-grip-vertical"></i></td>
                            <td>
                                <input type="hidden" class="form-control form-control-sm" name="id_campo_1" id="id_campo" value="" >
                                <select name="destino_1" id="destino"  class="form-control form-control-sm destino">
                                    <option value="">Selecciona una opción</option>
                                    <option value="Audios_Empresa" >Anuncio</option>
                                    <option value="Aplicacion">Aplicación</option>
                                    <option value="Campanas">Campaña</option>
                                    <option value="hangup">Colgar llamada</option>
                                    <option value="Condiciones_Tiempo">Condición de Tiempo</option>
                                    <option value="Conferencia">Conferencia</option>
                                    <option value="Desvios">Desvio</option>
                                    <option value="Cat_Extensiones">Extensión</option>
                                    <option value="Ivr">IVR</option>
                                </select>
                            </td>
                            <td>
                                <div id="opcionesDestino_1" class="opcionesDestino"></div>
                            </td>
                            <td class="tr_remove text-center">
                                <button type="button" name="remove" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @else
                        @php
                            $j = 1;
                        @endphp
                        @for ($i = 0; $i < count( $data ); $i++)
                            <tr id="tr_{{$j}}" class="clonar">
                                <td style="cursor: s-resize;"><i class="fas fa-grip-vertical"></i></td>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm" name="id_campo_{{ $data[$i][0] }}" id="id_campo" value="{{ $data[$i][0] }}" >
                                    <select name="destino_{{ $data[$i][0] }}" id="destino"  class="form-control form-control-sm destino">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Audios_Empresa" {{ $data[$i][2] == "Audios_Empresa"? 'selected = "selected"' : '' }} >Anuncio</option>
                                        <option value="Aplicacion" {{ $data[$i][2] == "Aplicacion"? 'selected = "selected"' : '' }} >Aplicación</option>
                                        <option value="Campanas" {{ $data[$i][2] == "Campanas"? 'selected = "selected"' : '' }} >Campaña</option>
                                        <option value="hangup"{{ $data[$i][2] == "hangup"? 'selected = "selected"' : '' }}>Colgar llamada</option>
                                        <option value="Condiciones_Tiempo"{{ $data[$i][2] == "Condiciones_Tiempo"? 'selected = "selected"' : '' }}>Condición de Tiempo</option>
                                        <option value="Conferencia"{{ $data[$i][2] == "Conferencia"? 'selected = "selected"' : '' }}>Conferencia</option>
                                        <option value="Desvios"{{ $data[$i][2] == "Desvios"? 'selected = "selected"' : '' }}>Desvio</option>
                                        <option value="Cat_Extensiones"{{ $data[$i][2] == "Cat_Extensiones"? 'selected = "selected"' : '' }}>Extensión</option>
                                        <option value="Ivr"{{ $data[$i][2] == "Ivr"? 'selected = "selected"' : '' }}>IVR</option>
                                    </select>
                                </td>
                                <td>
                                    <div id="opcionesDestino_{{ $data[$i][0] }}" class="opcionesDestino">
                                        <select name="opciones_{{ $data[$i][0] }}" id="opciones" class="form-control form-control-sm">
                                            @foreach ($data[$i][4] as $v)
                                                @if ($data[$i][2] == 'Cat_Extensiones')
                                                    <option value="{{ $v->id }}" {{ $data[$i][3] == $v->id ? 'selected = "selected"' : '' }} >{{$v->extension}}</option>
                                                @elseif( $data[$i][2] == 'hangup' )
                                                    <option value="{{ $v['id'] }}" {{ $data[$i][3] == $v['id'] ? 'selected = "selected"' : '' }} >{{$v['nombre']}}</option>
                                                @else
                                                    <option value="{{ $v->id }}" {{ $data[$i][3] == $v->id ? 'selected = "selected"' : '' }} >{{$v->nombre}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="tr_edit_remove text-center" data-id="{{ $data[$i][0] }}">
                                    <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @php
                                $j++;
                            @endphp
                        @endfor
                    @endif
                </tbody>
            </table>
        </fieldset>
    </div>
</form>
