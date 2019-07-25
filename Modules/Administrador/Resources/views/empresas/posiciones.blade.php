<div class="col-6" style="float:none; margin:auto">
    @csrf
    <input type="hidden" name="action" id="action" value="dataPosiciones">
    <div class="form-group">
        <label for="agentes_entrada">Agentes entrada</label>
        <input type="hidden" name="id_empresa" id="id_empresa" value="{{$idEmpresa}}">
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="agentes_entrada" name="agentes_entrada" value="{{ $configEmpresa->agentes_entrada }}" placeholder="Agentes entrada"  {{  in_array( 1, $modulos ) ? '' : 'readonly' }}>
    </div>
    <div class="form-group">
        <label for="agentes_salida">Agentes salida</label>
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="agentes_salida" name="agentes_salida" value="{{ $configEmpresa->agentes_salida }}" placeholder="Agentes salida" {{  in_array( 2, $modulos ) ? '' : 'readonly' }}>
    </div>
    <div class="form-group">
        <label for="agentes_full">Agentes dual</label>
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="agentes_full" name="agentes_full" value="{{ $configEmpresa->agentes_salida }}" placeholder="Agentes dual" {{  in_array( 1, $modulos ) && in_array( 2, $modulos )  ? '' : 'readonly' }}>
    </div>
    <div class="form-group">
        <label for="canal_mensajes_voz">Mensajes de voz</label>
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="canal_mensajes_voz" name="canal_mensajes_voz" value="{{ $configEmpresa->canal_mensajes_voz }}" placeholder="Mensajes de voz" {{  in_array( 10, $modulos ) ? '' : 'readonly' }}>
    </div>
    <div class="form-group">
        <label for="canal_generador_encuestas">Generador de encuestas</label>
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="canal_generador_encuestas" name="canal_generador_encuestas" value="{{ $configEmpresa->canal_generardor_encuestas }}" placeholder="Generador de encuestas" {{  in_array( 8, $modulos ) ? '' : 'readonly' }}>
    </div>
    <div class="form-group">
        <label for="agentes_administrador">Licencias administrador</label>
        <input type="number" min="1" max="10" class="form-control form-control-sm" id="agentes_administrador" name="agentes_administrador" value="{{ $configEmpresa->licencias_administrador }}" placeholder="Agentes administrador" value="1">
    </div>
    <div class="form-group">
        <label for="licencias_ivr_inteligente">Licencias IVR inteligente</label>
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="licencias_ivr_inteligente" name="licencias_ivr_inteligente" value="{{ $configEmpresa->licencias_ivr_inteligente }}" placeholder="Licencias IVR inteligente" {{  in_array( 7, $modulos ) ? '' : 'readonly' }}>
    </div>
    <div class="form-group">
        <label for="licencias_softphone">Licencias Softphone</label>
        <input type="number" min="1" max="200" class="form-control form-control-sm" id="licencias_softphone" name="licencias_softphone" value="{{ $configEmpresa->licencias_softphone }}" placeholder="Licencias Softphone">
    </div>
</div>
