<div class="row">
    <!--form enctype="multipart/form-data" id="formDataCampana" method="post"-->
        <div class="col">
            <fieldset>
                <legend>Configuración:</legend>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="hidden" id="id" value="{{$campana->id}}" >
                    <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre campaña" value="{{$campana->nombre}}" disabled>
                    <input type="hidden" name="agentes_participantes" id="agentes_participantes" value="{{ json_encode($idAgentesCampana, true) }}">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="mlogeo">Modalidad de Logueo</label>
                    <input type="hidden" id="mlogueoInicial" name="mlogueoInicial" value="{{$campana->modalidad_logue}}">
                    <select name="mlogeo" id="mlogeo" class="form-control form-control-sm mlogueoEditar">
                        <option value="">Selecciona una opción</option>
                        <option value="canal_cerrado" {{($campana->modalidad_logue == 'canal_cerrado' ) ? 'selected = "selected"':'' }}>Sin Logeo Permanente</option>
                        <option value="canal_abierto" {{($campana->modalidad_logue == 'canal_abierto' ) ? 'selected = "selected"':'' }}>Logeo Permanente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="strategy">Estrategia de Marcado</label>
                    <select name="strategy" id="strategy" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        <option value="random" {{($campana->Campanas_Configuracion->strategy == 'random' ) ? 'selected = "selected"':'' }}>Aleatorio</option>
                        <option value="fewestcalls" {{($campana->Campanas_Configuracion->strategy == 'fewestcalls' ) ? 'selected = "selected"':'' }}>Incremental</option>
                        <option value="ringall" {{($campana->Campanas_Configuracion->strategy == 'ringall' ) ? 'selected = "selected"':'' }}>Sonar Todas</option>
                        <option value="roundrobin" {{($campana->Campanas_Configuracion->strategy == 'roundrobin' ) ? 'selected = "selected"':'' }}>Round Robin</option>
                        <option value="rrmemory" {{($campana->Campanas_Configuracion->strategy == 'rrmemory' ) ? 'selected = "selected"':'' }}>Round Robin Memory</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="wrapuptime">Tiempo de Ringeo Ext. Agente</label>
                    <input type="text" class="form-control form-control-sm" id="wrapuptime" placeholder="15 - 100 segundos" value="{{ $campana->Campanas_Configuracion->wrapuptime}}" >
                </div>
                <!-- Seccion Mesajes y sonidos -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Mensajes y sonidos en la Campaña
                </div>
                <div class="form-group">
                    <label for="msginical">Mensaje al entrar llamada (opcional)</label>
                    <select name="msginical" id="msginical" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($Audios as $audio)
                            <option value="{{$audio->id}}" {{($audio->id == $campana->id_grabacion) ? 'selected = "selected"':'' }}>{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic_announce">Mensaje Agentes no disponibles</label>
                    <select name="periodic_announcee" id="periodic_announce" class="form-control form-control-sm">
                        <option value="call_center/agentes_no_disponibles">Selecciona una opción</option>
                        @foreach ($Audios as $audio)
                                <option value="{{$audio->ruta}}" {{($audio->ruta == $campana->Campanas_Configuracion->periodic_announce) ? 'selected = "selected"':'' }}>{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic_announce_frequency">Repetir mensaje "Agentes no disponibles" cada</label>
                    <input type="text" class="form-control form-control-sm" id="periodic_announce_frequency" placeholder="segundos" value="{{ $campana->Campanas_Configuracion->periodic_announce_frequency}}">
                </div>
                <!--
                <div class="form-group">
                    <label for="musicclass">Publicidad en la espera (opcional)</label>
                    <select name="musicclass" id="musicclass" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>

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
                    <label for="script">Tipo de Script</label>
                    <select name="script" id="script" class="form-control form-control-sm">
                        <option value="">Seleccione Scripting</option>
                        @foreach ($speech as $spech)
                        <option value="{{ $spech->id }}" {{($spech->id == $campana->speech_id) ? 'selected = "selected"':'' }}>{{ $spech->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Seccion Alertas de Tiempo y Liberacion de Terminal -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Alertas de Tiempo y Liberacion de Terminal
                </div>
                <div class="form-group">
                    <label for="alertstll">Alerta sonora tiempo en Llamada</label>
                    <input type="text" class="form-control form-control-sm" id="alertstll" placeholder="0 segundos" value="{{ $campana->time_max_sonora}}">
                </div>
                <div class="form-group">
                    <label for="alertstdll">Alerta Sonora tiempo definiendo llamada</label>
                    <input type="text" class="form-control form-control-sm" id="alertstdll" placeholder="0 segundos" value="{{ $campana->time_max_llamada}}">
                </div>
                <div class="form-group">
                    <label for="libta">Liberacion de Terminal (Regresar a Disponible agente)</label>
                    <input type="text" class="form-control form-control-sm" id="libta" placeholder="0 segundos" value="{{ $campana->time_liberacion}}">
                </div>
                <div class="form-group">
                    <label for="cal_lib">Calificacion de Liberacion (En caso de activar opcion anterior)</label>
                    <select name="cal_lib" id="cal_lib" class="form-control form-control-sm">
                        <option value="">Seleccione Calificacion</option>
                        @foreach ($calificaciones as $calificacion)
                        <option value="{{ $calificacion->id }}" {{($calificacion->id == $campana->Grupos_id) ? 'selected = "selected"':'' }}>{{ $calificacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Desvio de llamadas -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Desvio de llamadas
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
                        @foreach ($agentesCampana as $agente)
                        <tr id="tr_{{ $agente->Agentes->id }}">
                            <td><input type="checkbox" class="agentes_no" name="agentes_no" value="{{ $agente->Agentes->id  }}"></td>
                            <td></td>
                            <td>{{ $agente->Agentes->nombre }}</td>
                            <td>{{ $agente->Agentes->extension }}</td>
                        </tr>
                    @endforeach
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
                            @if ( !in_array( $agente->id, $idAgentesCampana ) )
                                <tr id="tr_{{ $agente->id }}">
                                    <td><input type="checkbox" class="agentes_no" name="agentes_no" value="{{ $agente->id }}"></td>
                                    <td></td>
                                    <td>{{ $agente->nombre }}</td>
                                    <td>{{ $agente->extension }}</td>
                                </tr>
                            @endif
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
