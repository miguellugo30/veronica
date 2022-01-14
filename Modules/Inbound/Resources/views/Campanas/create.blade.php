<div class="row">
    <!--form enctype="multipart/form-data" id="altacampana" method="post"-->
        <div class="col">
            <div class="form-group text-right">
                <b>*Campos obligatorios.</b>
            </div>
            <fieldset>
                <div class="form-group">
                    <label for="nombre"><b>Nombre *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre campaña" value="">
                    <input type="hidden" name="agentes_participantes" id="agentes_participantes" value="">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="mlogeo"><b>Modalida de Logueo *:</b></label>
                    <select name="mlogeo" id="mlogeo" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        <option value="canal_cerrado">Sin Logeo Permanente</option>
                        <option value="canal_abierto">Logeo Permanente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="strategy"><b>Estrategia de Marcado *:</b></label>
                    <select name="strategy" id="strategy" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        <option value="random">Aleatorio</option>
                        <option value="fewestcalls">Incremental</option>
                        <option value="ringall">Sonar Todas</option>
                        <option value="roundrobin">Round Robin</option>
                        <option value="rrmemory">Round Robin Memory</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="wrapuptime"><b>Tiempo de Ringeo Ext. Agente *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="wrapuptime" placeholder="15 - 100 segundos" value="">
                </div>
                <!-- Seccion Mesajes y sonidos -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Mensajes y sonidos en la Campaña
                </div>
                <div class="form-group">
                    <label for="msginical"><b>Mensaje al entrar llamada:</b></label>
                    <select name="msginical" id="msginical" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($Audios as $audio)
                                <option value="{{$audio->id}}">{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic_announce"><b>Mensaje Agentes no disponibles:</b></label>
                    <select name="periodic_announce" id="periodic_announce" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($Audios as $audio)
                                <option value="{{$audio->id}}">{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic_announce_frequency"><b>Repetir mensaje "Agentes no disponibles" cada *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="periodic_announce_frequency" placeholder="segundos" value="">
                </div>
                <!--
                <div class="form-group">
                    <label for="musicclass">Publicidad en la espera (opcional)</label>
                    <select name="musicclass" id="musicclass" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($Mohs as $moh)
                                <option value="{{$moh->id}}">{{ $moh->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic-announce-frequency">Repetir Publicidad cada</label>
                    <input type="periodic-announce-frequency" class="form-control form-control-sm" id="periodic-announce-frequency" placeholder="segundos" value="">
                </div> -->
                <!-- Seccion Script -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Script Inicial (Opcional)
                </div>
                <div class="form-group">
                    <label for="script"><b>Tipo de Script *:</b></label>
                    <select name="script" id="script" class="form-control form-control-sm">
                        <option value="">Seleccione Scripting</option>
                        @foreach ($speech as $spech)
                    <option value="{{ $spech->id }}">{{ $spech->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Seccion Alertas de Tiempo y Liberacion de Terminal -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Alertas de Tiempo y Liberacion de Terminal
                </div>
                <div class="form-group">
                    <label for="alertstll"><b>Alerta sonora tiempo en Llamada *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="alertstll" placeholder="0 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="alertstdll"><b>Alerta Sonora tiempo definiendo llamada *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="alertstdll" placeholder="0 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="libta"><b>Liberacion de Terminal (Regresar a Disponible agente) *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="libta" placeholder="0 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="cal_lib"><b>Calificacion de Liberacion (En caso de activar opcion anterior) *:</b></label>
                    <select name="cal_lib" id="cal_lib" class="form-control form-control-sm">
                        <option value="">Seleccione Calificacion</option>
                        @foreach ($calificaciones as $calificacion)
                        <option value="{{ $calificacion->id }}">{{ $calificacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Desvio de llamadas -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Calificacion de Campaña
                </div>
                <div class="form-group">
                    <label for="cal_camp"><b>Calificacion*:</b></label>
                    <select name="cal_camp" id="cal_camp" class="form-control form-control-sm">
                        <option value="">Seleccione Calificacion</option>
                        @foreach ($calificaciones as $calificacion)
                        <option value="{{ $calificacion->id }}">{{ $calificacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>


            </fieldset>
        </div>
        <div class="col">
            <fieldset >
                <legend>Agentes que participan en la campaña <b><button type="button" class="btn btn-danger btn-sm float-right agentesSeleccionados">Quitar</button></b></legend>
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col text-center"><input type="checkbox" name="todos_selec" id="todos_selec"></th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Extension</th>
                        </tr>
                    </thead>
                    <tbody class="agenteSelec">

                    </tbody>
                </table>
            </fieldset>
            <fieldset >
                <legend>Agentes que no participan en la campaña <b><button type="button" class="btn btn-primary btn-sm float-right agentesNoSeleccionados">Agregar</button></b></legend>
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col text-center"><input type="checkbox" name="todos_no_selec" id="todos_no_selec"></th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Extension</th>
                        </tr>
                    </thead>
                    <tbody class="agentesNoSelec">
                        @foreach ($agentes as $agente)
                            <tr id="tr_{{ $agente->id }}">
                                <td class="text-center"><input type="checkbox" class="agentes_no" name="agentes_no" value="{{ $agente->id }}"></td>
                                <td></td>
                                <td>{{ $agente->nombre }}</td>
                                <td>{{ $agente->extension }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </fieldset>
            <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                <ul></ul>
            </div>
        </div>
    <!--/form-->
</div>
