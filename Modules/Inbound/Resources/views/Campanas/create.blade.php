<div class="row">
    <div class="col">
        <fieldset>
            <legend>Configuración:</legend>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="name" placeholder="Nombre campaña" value="">
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
                <label for="wrapuptime ">Tiempo de Ringeo Ext. Agente</label>
                <input type="wrapuptime " class="form-control form-control-sm" id="wrapuptime " placeholder="15 - 100 segundos" value="">
            </div>
            <!-- Seccion Mesajes y sonidos -->
            <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
            Mensajes y sonidos en la Campaña
            </div>
            <div class="form-group">
                <label for="mlogeo">Mensaje al entrar llamada (opcional)</label>
                <select name="mlogeo" id="mlogeo" class="form-control form-control-sm">
                    <option value="">Selecciona una opción</option>

                </select>
            </div>
            <div class="form-group">
                <label for="announce_frequency">Mensaje Agentes no disponibles</label>
                <select name="announce_frequency" id="announce_frequency" class="form-control form-control-sm">
                    <option value="">Selecciona una opción</option>

                </select>
            </div>
            <div class="form-group">
                <label for="wrapuptime ">Repetir mensaje "Agentes no disponibles" cada</label>
                <input type="wrapuptime " class="form-control form-control-sm" id="wrapuptime " placeholder="segundos" value="">
            </div>
            <div class="form-group">
                <label for="periodic-announce">Publicidad en la espera (opcional)</label>
                <select name="periodic-announce" id="periodic-announce" class="form-control form-control-sm">
                    <option value="">Selecciona una opción</option>

                </select>
            </div>
            <div class="form-group">
                <label for="periodic-announce-frequency ">Repetir Publicidad cada</label>
                <input type="periodic-announce-frequency " class="form-control form-control-sm" id="periodic-announce-frequency " placeholder="segundos" value="">
            </div>
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
                <input type="alertstll" class="form-control form-control-sm" id="alertstll" placeholder="0 segundos" value="">
            </div>
            <div class="form-group">
                <label for="alertstdll">Alerta Sonora tiempo definiendo llamada</label>
                <input type="alertstdll " class="form-control form-control-sm" id="alertstdll " placeholder="0 segundos" value="">
            </div>
            <div class="form-group">
                <label for="libta">Liberacion de Terminal (Regresar a Disponible agente)</label>
                <input type="libta" class="form-control form-control-sm" id="libta" placeholder="0 segundos" value="">
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
    </div>
</div>
