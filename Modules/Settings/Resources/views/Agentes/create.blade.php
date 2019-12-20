<div class="row">
    <div class="col">
        <div class="form-group text-right">
            <b>* Campos obligatorios.</b>
        </div>
        <div class="form-group">
            <label for="grupo"><b>Grupo *:</b></label>
            <select name="grupo" id="grupo" class="form-control form-control-sm">
                <option disabled selected value="">Sin Grupo</option>
                @foreach ($grupos as $grupo)
                    <option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
                @endforeach
            </select>
            <input type="hidden" name="Cat_Estado_Agente_id" id="Cat_Estado_Agente_id"  value="1">
            @csrf
        </div>
        <div class="form-group">
            <label for="tipo_licencia"><b>Tipo Licencia *:</b></label>
            <select name="tipo_licencia" id="tipo_licencia" class="form-control form-control-sm">
                <option disabled selected value="">Selecciona un licencia</option>
                <option value="Inbound"  {{ ( $empresa->Config_Empresas->agentes_entrada != 0 ) ? '' : 'style=display:none' }}>Inbound</option>
                <option value="Outbound" {{ ( $empresa->Config_Empresas->agentes_salida != 0 ) ? '' : 'style=display:none' }}>Outbound</option>
                <option value="Full"     {{ ( $empresa->Config_Empresas->agentes_dual != 0 ) ? '' : 'style=display:none' }}>Full</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel"><b>Nivel *:</b></label>
            <input type="number" class="form-control form-control-sm" name="nivel" id="nivel" placeholder="Nivel" min="0" max="5">
        </div>
        <div class="form-group">
            <label for="nombre"><b>Nombre *:</b></label>
            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="usuario"><b>Usuario *:</b></label>
            <input type="text" class="form-control form-control-sm" name="usuario" id="usuario" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label for="contrasena"><b>Contraseña *:</b></label>
            <input type="text" class="form-control form-control-sm" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="canal"><b>Canal *:</b></label>
            <select name="canal" id="canal" class="form-control form-control-sm">
                <option disabled selected value="">Selecciona un canal</option>
                @foreach ($canales as $canal)
                    <option value="{{$canal->id}}">{{$canal->Cat_Tipo_Canales->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="extension"><b>Extensión *:</b></label>
            <select name="extension" id="extension" class="form-control form-control-sm">
                <option value="">Selecciona un extensión</option>
                @foreach ($cat_extensiones as $extension)
                    <option value="{{$extension->extension}}">{{$extension->extension}}</option>
                @endforeach
            </select>
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
                <input class="form-check-input" type="radio" name="mix_monitor" id="mix_monitor" value="1" checked>
                <label class="form-check-label" for="mix_monitor">Siempre</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="mix_monitor" id="mix_monitor2" value="0">
                <label class="form-check-label" for="mix_monitor2">Nunca</label>
            </div>
            <div class="form-group">
                <br>
                <label for="calificar_llamada"><b>Calificar llamada</b></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="calificar_llamada" id="calificar_llamada" value="1" checked>
                <label class="form-check-label" for="calificar_llamada">Si</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="calificar_llamada" id="calificar_llamada2" value="0">
                <label class="form-check-label" for="calificar_llamada2">No</label>
            </div>
            <div class="form-group">
                <br>
                <label for="envio_sms"><b>Envio SMS</b></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="envio_sms" id="envio_sms" value="1">
                <label class="form-check-label" for="calificar_llamada">Si</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="envio_sms" id="envio_sms2" value="0" checked>
                <label class="form-check-label" for="envio_sms2">No</label>
            </div>
            <div class="form-group">
                <br>
                <label for="editar_datos"><b>Editar datos</b></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="editar_datos" id="editar_datos" value="1">
                <label class="form-check-label" for="calificar_llamada">Si</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="editar_datos" id="editar_datos2" value="0" checked>
                <label class="form-check-label" for="editar_datos2">No</label>
            </div>
        </fieldset>
    </div>
</div>
