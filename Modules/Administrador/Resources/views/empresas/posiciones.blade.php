<fieldset>
        <legend>
        <i class="far fa-building"></i>
        <b>Empresa: {{$nombreEmpresa}}</b>
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        @csrf
        <div class="form-group">
            <label for="agentes_entrada">Agentes entrada</label>
            <input type="text" class="form-control input-sm" id="agentes_entrada" name="agentes_entrada" placeholder="Agentes entrada" disabled>
        </div>
        <div class="form-group">
            <label for="agentes_salida">Agentes salida</label>
            <input type="text" class="form-control input-sm" id="agentes_salida" name="agentes_salida" placeholder="Agentes salida" disabled>
        </div>
        <div class="form-group">
            <label for="agentes_full">Agentes dual</label>
            <input type="text" class="form-control input-sm" id="agentes_full" name="agentes_full" placeholder="Agentes dual" disabled>
        </div>
        <div class="form-group">
            <label for="canal_mensajes_voz">Mensajes de voz</label>
            <input type="text" class="form-control input-sm" id="canal_mensajes_voz" name="canal_mensajes_voz" placeholder="Mensajes de voz" disabled>
        </div>
        <div class="form-group">
            <label for="canal_generador_encuestas">Generador de encuestas</label>
            <input type="text" class="form-control input-sm" id="canal_generador_encuestas" name="canal_generador_encuestas" placeholder="Generador de encuestas" disabled>
        </div>
        <div class="form-group">
            <label for="agentes_administrador">Licencias administrador</label>
            <input type="text" class="form-control input-sm" id="agentes_administrador" name="agentes_administrador" placeholder="Agentes administrador" disabled>
        </div>
        <div class="form-group">
            <label for="licencias_ivr_inteligente">Licencias IVR inteligente</label>
            <input type="text" class="form-control input-sm" id="licencias_ivr_inteligente" name="licencias_ivr_inteligente" placeholder="Licencias IVR inteligente" disabled>
        </div>
        <div class="form-group">
            <label for="licencias_softphone">Licencias Softphone</label>
            <input type="text" class="form-control input-sm" id="licencias_softphone" name="licencias_softphone" placeholder="Licencias Softphone">
        </div>

    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelEmpresa"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveEmpresaModulos">Siguiente <i class="fas fa-arrow-alt-circle-right"></i></button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>
