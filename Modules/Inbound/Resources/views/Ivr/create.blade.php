<form id="formCreateIvr">
    <div class="col">
        <table id='condicion' class="table table-striped table-sm tableNewForm">
            <thead>
                <tr>
                <th>Nombre *</th>
                <th>Mensaje Bienvenida *</th>
                <th>Tiempo Espera *</th>
                <th>Mensaje Espera Superada *</th>
                <th>Mensaje Opción Invalida *</th>
                <th>Repeticiones *</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre IVR">
                    </td>
                    <td>
                    <select name="mensaje_bienvenida_id" id="mensaje_bienvenida_id" class="form-control form-control-sm audiosSelect">
                        <option value="">Selecciona una opción</option>
                        @foreach ($audios as $audio)
                            <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                        <input type="number" min="1" class="form-control form-control-sm" id="tiempo_espera" name="tiempo_espera" value="" placeholder="En segundos">
                    </td>
                    <td>
                        <select name="mensaje_tiempo_espera_id" id="mensaje_tiempo_espera_id" class="form-control form-control-sm audiosSelect">
                            <option value="">Selecciona una opción</option>
                            @foreach ($audios as $audio)
                                <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="mensaje_opcion_invalida_id" id="mensaje_opcion_invalida_id" class="form-control form-control-sm audiosSelect">
                            <option value="">Selecciona una opción</option>
                            @foreach ($audios as $audio)
                                <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                            @endforeach
                        </select>

                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" id="repeticiones" name="repeticiones" min="1" placeholder="Repeticiones">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="form-group text-right">
            <b>No se puede ocupar el mismo mensaje en diferentes opciones.</b>
        </div>
        <br><br>
        <fieldset>
            <legend>
                Opciones de IVR
                <input type="button" class="btn btn-primary btn-sm" id="addOpcion" value = "Agregar opción" style="float: right;" />
            </legend>
            <table id="tableOpcionesIvr" class="table table-striped table-sm tableOpciones">
                <thead>
                    <tr>
                        <th>Dígito(s) a presionar *</th>
                        <th>Destino *</th>
                        <th>Opciones *</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="tr_1">
                        <td>
                            <input type="number" name="digito_1" id="digito" class="form-control form-control-sm" min="1" placeholder="Dígito(s)">
                        </td>
                        <td>
                            <select name="destino_1" id="destino"  class="form-control form-control-sm destinoOpccionIvr">
                                <option value="">Selecciona una opción</option>
                                <option value="Audios_Empresa">Anuncio</option>
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
                        <td >
                            <div id="opcionesDestino_1" class="opcionesDestino">
                                <select name="opciones_destino_1" id="destino"  class="form-control form-control-sm destinoOpccionIvr">
                                    <option value="">Selecciona una opción</option>
                                </select>
                            </div>
                        </td>
                        <td class="tr_clone_remove text-center">
                            <button type="button" name="remove" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group text-right">
                <b>* Campos obligatorios.</b>
            </div>
        </fieldset>
    </div>
</form>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>
<input type="hidden" class="form-control form-control-sm" id="Empresas_id" name="Empresas_id" value="{{$empresa_id}}">
