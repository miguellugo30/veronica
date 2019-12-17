<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="grupo">Grupo *:</label>
            <select name="grupo" id="grupo" class="form-control form-control-sm">
                <option disabled selected value="">Sin Grupo</option>
                @foreach ($grupos as $grupo)
                    <option value="{{$grupo->id}}" {{($grupo->id == $agente->nombre) ? 'selected = "selected"':'' }}>{{$grupo->nombre}}</option>
                @endforeach
            </select>
            <input type="hidden" name="id" id="id"  value="{{$agente->id}}">
            @csrf
        </div>
        <div class="form-group">
            <label for="tipo_licencia">Tipo Licencia *:</label>
            <select name="tipo_licencia" id="tipo_licencia" class="form-control form-control-sm">
                <option disabled selected value="">Selecciona un licencia</option>
                <option value="Inbound"  {{ $agente->tipo_licencia == 'Inbound' ? 'selected=selected' : '' }} {{ ( $empresa->Config_Empresas->agentes_entrada != 0 ) ? '' : 'style=display:none' }}>Inbound</option>
                <option value="Outbound" {{ $agente->tipo_licencia == 'Outbound' ? 'selected=selected' : '' }} {{ ( $empresa->Config_Empresas->agentes_salida != 0 ) ? '' : 'style=display:none' }}>Outbound</option>
                <option value="Full"     {{ $agente->tipo_licencia == 'Full' ? 'selected=selected' : '' }} {{ ( $empresa->Config_Empresas->agentes_dual != 0 ) ? '' : 'style=display:none' }}>Full</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel">Nivel *:</label>
            <input type="number" class="form-control form-control-sm" name="nivel" id="nivel"  placeholder="Nivel" min="0"  value="{{$agente->nivel}}">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre *:</label>
            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Nombre" value="{{$agente->nombre}}">
        </div>
        <div class="form-group">
            <label for="usuario">Usuario *:</label>
            <input type="text" class="form-control form-control-sm" name="usuario" id="usuario" placeholder="Usuario" value="{{$agente->usuario}}">
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña *:</label>
            <input type="text" class="form-control form-control-sm" name="contrasena" id="contrasena" placeholder="Contraseña" value="{{$agente->contrasena}}">
        </div>
        <div class="form-group">
            <label for="canal">Canal *:</label>
            <select name="canal" id="canal" class="form-control form-control-sm">
                <option disabled selected value="">Selecciona un canal</option>
                @foreach ($canales as $canal)
                    <option value="{{$canal->id}}" {{($canal->id == $agente->Canales_id) ? 'selected = "selected"':'' }}>{{$canal->Cat_Tipo_Canales->nombre}}</option>
                @endforeach
            </select>
            <!--input type="text" class="form-control form-control-sm" name="protocolo" id="protocolo"  placeholder=""-->
        </div>
        <div class="form-group">
            <label for="extension">Extensión *:</label>
            <input type="text" class="form-control form-control-sm" name="extension" id="extension" placeholder="Extensión" value="{{$agente->extension}}">
        </div>
        <div class="form-group">
            <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
        </div>
        <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col">
            <fieldset>
                <legend><b>Opciones</b></legend>
                <div class="form-group">
                    <label for="grabacion"><b>Grabacion</b></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mix_monitor" id="mix_monitor" value="1" {{ $agente->mix_monitor == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="mix_monitor">Siempre</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mix_monitor" id="mix_monitor2" value="0" {{ $agente->mix_monitor == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="mix_monitor2">Nunca</label>
                </div>
                <div class="form-group">
                    <br>
                    <label for="calificar_llamada"><b>Calificar llamada</b></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="calificar_llamada" id="calificar_llamada" value="1"  {{ $agente->calificar_llamada == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="calificar_llamada">Si</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="calificar_llamada" id="calificar_llamada2" value="0" {{ $agente->calificar_llamada == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="calificar_llamada2">No</label>
                </div>
                <div class="form-group">
                    <br>
                    <label for="envio_sms"><b>Envio SMS</b></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="envio_sms" id="envio_sms" value="1" {{ $agente->envio_sms == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="calificar_llamada">Si</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="envio_sms" id="envio_sms2" value="0" {{ $agente->envio_sms == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="envio_sms2">No</label>
                </div>
                <div class="form-group">
                    <br>
                    <label for="editar_datos"><b>Editar datos</b></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="editar_datos" id="editar_datos" value="1" {{ $agente->editar_datos == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="calificar_llamada">Si</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="editar_datos" id="editar_datos2" value="0" {{ $agente->editar_datos == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="editar_datos2">No</label>
                </div>
            </fieldset>
        </div>
</div>
