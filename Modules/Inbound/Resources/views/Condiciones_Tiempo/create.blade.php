<form id="formDataCondicionTiempo">
    <div class="col-12" >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b> Nombre Grupo</b></label>
                    @csrf
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Grupo">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <fieldset>
                <legend>
                    Condiciones Tiempo
                    <input type="button" class="btn btn-primary btn-sm" id = "add" value = "Agregar condición" style="float: right;" />
                </legend>
                <table id='condicion' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
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
                        <tr id="tr_1" class="clonar">
                            <td>
                                <input type="text" class="form-control form-control-sm" name="nombre_campo_1" id="nombre_campo" placeholder="Nombre Campo">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm hora_inicio" size="6" name="hora_inicio_1" id="hora_inicio" placeholder="hora_inicio">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm hora_fin" size="6" name="hora_fin_1" id="hora_fin" placeholder="hora_fin">
                            </td>
                            <td>
                                <select name="dia_semana_inicio_1" id="dia_semana_inicio"  class="form-control form-control-sm" placeholder="dia_demana_inicio" >
                                    <option value="*">-</option>
                                        @foreach ($dias as $dia)
                                            <option value="{{$dia['value']}}">{{ $dia['texto'] }}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="dia_semana_fin_1" id="dia_semana_fin"  class="form-control form-control-sm" placeholder="dia_semana_fin">
                                    <option value="*">-</option>
                                        @foreach ($dias as $dia)
                                            <option value="{{$dia['value']}}">{{ $dia['texto'] }}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm fecha_inicio" name="fecha_inicio_1" id="fecha_inicio" placeholder="Fecha Inicio">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm fecha_final" name="fecha_final_1" id="fecha_final" placeholder="Fecha Final">
                            </td>
                            <td>
                                <select name="destino_verdadero_1" id="destino_verdadero"  class="form-control form-control-sm destinoOpccion" data-accion="si_coincide">
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
                            <td>
                                <div id="opcionesSiCoincide_1"></div>
                            </td>
                            <td>
                                <select name="destino_falso_1" id="destino_falso"  class="form-control form-control-sm destinoOpccion" data-accion="no_coincide">
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
                            <td>
                                <div id="opcionesNoCoincide_1"></div>
                            </td>
                            <td class="tr_clone_remove text-center">
                                <button type="button" name="remove" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>
