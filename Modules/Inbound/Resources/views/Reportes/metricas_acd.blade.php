<form id="formDatametricaACD">
    <div class="col-10" >
        <div class="col-md-10">
            <fieldset>
                <legend>
                    Filtros Metricas ACD
                    <input type="button" class="btn btn-primary btn-sm" id = "add" value = "Generar" style="float: right;" />
                </legend>
                <table id='condicion' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Fecha Inicio</th>
                            <th>Hora Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Hora Fin</th>
                            <th>Agente</th>
                            <th>Campaña</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                            <input type="text" class="form-control form-control-sm fecha_inicio" name="fecha_inicio_1" id="fecha_inicio" placeholder="Fecha Inicio" >
                        </td>
                        <td>
                            <div class="hora">
                                <input type="number" name="hora_inicio_1" id="hora_inicio" min="00" max="23" class="form-control form-control-sm" placeholder="--"  onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                <input type="number" name="min_inicio_1" id="min_inicio"  min="0" max="59" class="form-control form-control-sm" placeholder="--" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm fecha_final" name="fecha_final_1" id="fecha_final" placeholder="Fecha Final" size="5">
                        </td>
                        <td>
                            <div class="hora">
                                <input type="number" name="hora_fin_1" id="hora_fin" min="0" max="23" class="form-control form-control-sm" placeholder="--" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                <input type="number" name="min_fin_1" id="min_fin"  min="0" max="59" class="form-control form-control-sm" placeholder="--" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                            </div>
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
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>
