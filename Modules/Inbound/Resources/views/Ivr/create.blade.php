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
                    <input type="text" class="form-control form-control-sm" id="nombre"  value="" placeholder="Nombre IVR">
                    <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">
                </td>
                <td>
                <select name="mensaje_bienvenida_id" id="mensaje_bienvenida_id" class="form-control form-control-sm">
                    <option value="">Selecciona una opción</option>
                    @foreach ($audios as $audio)
                        <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                    @endforeach
                </select>
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" id="tiempo_espera"  value="" placeholder="En segundos">
                </td>
                <td>
                    <select name="mensaje_tiepo_espera_id" id="mensaje_tiepo_espera_id" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($audios as $audio)
                            <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="mensaje_opcion_invalida_id" id="mensaje_opcion_invalida_id" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($audios as $audio)
                            <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                        @endforeach
                    </select>

                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" id="repeticiones" min="1" placeholder="Repeticiones">
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
                <tr id="tr_1">
                    <td>
                        <select name="tipo_1" id="tipo" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                            <option value="digito">Dígito</option>
                            <option value="invalid">Opción Invalida</option>
                            <option value="timeout">Tiempo de Espera Superado</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="repeticiones_1" id="repeticiones" class="form-control form-control-sm" min="1" placeholder="Dígito">
                    </td>
                    <td>
                        <select name="destino_1" id="destino"  class="form-control form-control-sm destinoOpccion">
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
                    <td ></td>
                    <td class="tr_clone_remove text-center">
                        <button type="button" name="remove" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>
