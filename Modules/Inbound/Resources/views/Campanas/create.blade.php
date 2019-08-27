<div class="row">
    <form enctype="multipart/form-data" id="altacampana" method="post">
        <div class="col">
            <fieldset>
                <legend>Configuración:</legend>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre campaña" value="">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="mlogeo">Modalida de Logeo</label>
                    <select name="mlogeo" id="mlogeo" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        <option value="canal_cerrado">Sin Logeo Permanente</option>
                        <option value="canal_abierto">Logeo Permanente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="strategy">Estrategia de Marcado</label>
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
                    <label for="wrapuptime">Tiempo de Ringeo Ext. Agente</label>
                    <input type="text" class="form-control form-control-sm" id="wrapuptime" placeholder="15 - 100 segundos" value="">
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
                                <option value="{{$audio->ruta}}">{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic_announce">Mensaje Agentes no disponibles</label>
                    <select name="periodic_announcee" id="periodic_announce" class="form-control form-control-sm">
                        <option value="call_center/agentes_no_disponibles">Selecciona una opción</option>
                        @foreach ($Audios as $audio)
                                <option value="{{$audio->ruta}}">{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodic_announce_frequency">Repetir mensaje "Agentes no disponibles" cada</label>
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
                    <label for="script">Tipo de Script</label>
                    <select name="script" id="script" class="form-control form-control-sm">
                        <option value="">Seleccione Scripting</option>
                        <option value="">Estatico</option>

                    </select>
                </div>
                <!-- Seccion Alertas de Tiempo y Liberacion de Terminal -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Alertas de Tiempo y Liberacion de Terminal
                </div>
                <div class="form-group">
                    <label for="alertstll">Alerta sonora tiempo en Llamada</label>
                    <input type="text" class="form-control form-control-sm" id="alertstll" placeholder="0 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="alertstdll">Alerta Sonora tiempo definiendo llamada</label>
                    <input type="text" class="form-control form-control-sm" id="alertstdll" placeholder="0 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="libta">Liberacion de Terminal (Regresar a Disponible agente)</label>
                    <input type="text" class="form-control form-control-sm" id="libta" placeholder="0 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="cal_lib">Calificacion de Liberacion (En caso de activar opcion anterior)</label>
                    <select name="cal_lib" id="cal_lib" class="form-control form-control-sm">
                        <option value="">Seleccione Calificacion</option>


                    </select>
                </div>
                <!-- Desvio de llamadas -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                Desvio de llamadas
                </div>


            </fieldset>
        </div>
        <div class="col">
    </form>
</div>
