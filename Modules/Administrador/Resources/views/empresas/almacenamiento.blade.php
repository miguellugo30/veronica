<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        @csrf
        <input type="hidden" name="action" id="action" value="dataAlmacenamiento">
        <div class="form-group">
            <label for="agentes_entrada">Almacenamiento por posiciones</label>
            <input type="hidden" name="id_empresa" id="id_empresa" value="{{$idEmpresa}}">
            <input type="text" min="1" max="200" class="form-control input-sm" id="almacenamiento_posiciones" name="almacenamiento_posiciones" value="{{ $configEmpresa->almacenamiento_posiciones / 1024 }} GB" placeholder="Agentes entrada" readonly >
        </div>
        <div class="form-group">
            <label for="canal_mensajes_voz">Espacio contratado adicional</label>
            <input type="text" min="1" max="200" class="form-control input-sm" id="almacenamiento_adicional" name="almacenamiento_adicional" value="{{ $configEmpresa->almacenamiento_adicional / 1024 }} GB" placeholder="Mensajes de voz" >
        </div>

    </div>
</fieldset>
