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
                    <label for="strategy"><b>Modalidad de Marcado *:</b></label>
                    <select name="strategy" id="strategy" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        <option value="agente_cliente">Agente - Cliente</option>
                        <option value="preview">Preview</option>
                        <option value="progresivo">Progresivo</option>
                        <option value="predictivo">Predictivo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="wrapuptime"><b>Tiempo de Ringeo *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="wrapuptime" placeholder="15 - 100 segundos" value="">
                </div>
                <div class="form-group">
                    <label for="no_intentos"><b>Número de intentos *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="no_intentos" placeholder="1" value="">
                </div>
                <!-- Seccion Script -->
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                    Script
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
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                    Base de datos
                </div>
                <div class="form-group">
                    <label for="bd"><b>Base de datos:</b></label>
                    <select name="db" id="bd" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($bd as $b)
                                <option value="{{ $b->id }}">{{ $b->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                    Calificación
                </div>
                <div class="form-group">
                    <label for="bd"><b>Calificación:</b></label>
                    <select name="calificacion" id="calificacion" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($calificaciones as $b)
                                <option value="{{ $b->id }}">{{ $b->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                    Dids
                </div>
                <div class="form-group">
                    <label for="dids"><b>Dids:</b></label>
                    <select name="dids" id="dids" class="form-control form-control-sm" multiple>
                        @foreach ($dids as $b)
                            <option value="{{ $b->id }}">{{ $b->did }}</option>
                        @endforeach
                    </select>
                     <small id="didsHelp" class="form-text text-muted">Ctrl + click, para elegir mas de un DID.</small>
                </div>
                <div id="opcion_predictivo" style="display: none">
                    <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
                        Predictivo Logeo Permanente
                    </div>
                    <div class="form-group">
                        <label for="llamadas_agente"><b>Número de llamadas por agente *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="llamadas_agente" placeholder="1" value="">
                    </div>
                    <div class="form-group">
                    <label for="msginical"><b>Mensaje de Bienvenida :</b></label>
                    <select name="msginical" id="msginical" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($Audios as $audio)
                                <option value="{{ $audio->id }}">{{ $audio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
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
