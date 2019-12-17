<div class="col">
    <fieldset>
        <div class="form-group">
            <label for="nombre"><b>Nombre *:</b></label>
            <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="">
            <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">
            @csrf
        </div>
        <div class="form-group">
            <label for="tiempo_maximo"><b>Tiempo Máximo de Grabación *:</b></label>
            <input type="number" min="1" class="form-control form-control-sm" id="tiempo_maximo"  value="" placeholder="En segundos">
        </div>
        <div class="form-group">
            <label for="terminacion"><b>Terminar Grabación *:</b></label>
            <select name="terminacion" id="terminacion" class="form-control form-control-sm">
                <option value="">Selecciona una opción</option>
                    <option value="k">Terminación Con #</option>
                    <option value="y">Terminación Con Cualquier Digito</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Audios_Empresa_id"><b>Anuncio del Buzón *:</b></label>
            <select name="Audios_Empresa_id" id="Audios_Empresa_id" class="form-control form-control-sm">
                <option value="">Selecciona una opción</option>
                @foreach ($audios as $audio)
                    <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="correos"><b>Notificar Vía Correo a:</b></label>
            <input type="text" class="form-control form-control-sm" id="correos"  value="" placeholder="Para mas de un correo separe con ; ">
            <small id="emailHelp" class="form-text text-muted">Para mas de un correo separe con punto y coma </small>
        </div>
        <div class="form-group text-right">
            <b>* Campos obligatorios.</b>
        </div>
    </fieldset>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>
