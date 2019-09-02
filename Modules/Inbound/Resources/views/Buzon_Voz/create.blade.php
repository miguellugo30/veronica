<div class="col">
            <fieldset>
                <div class="form-group">
                    <label for="nombre">Nombre Del Buzón De Voz</label>
                    <input type="text" class="form-control form-control-sm" id="nombre"  value="">
                    <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="tiempo_maximo">Tiempo Máximo de Grabación</label>
                    <input type="text" class="form-control form-control-sm" id="tiempo_maximo"  value="" placeholder="En segundos">
                </div>
                <div class="form-group">
                    <label for="terminacion">Terminar Grabación</label>
                        <select name="terminacion" id="terminacion" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                                <option value="k">Terminación Con #</option>
                                <option value="y">Terminación Con Cualquier Digito</option>

                        </select>
                </div>
                <div class="form-group">
                    <label for="Audios_Empresa_id">Anuncio del Buzón</label>
                        <select name="Audios_Empresa_id" id="Audios_Empresa_id" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                            @foreach ($audios as $audio)
                                <option value="{{$audio->id}}">{{$audio->nombre}}</option>

                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="correos">Notificar Vía Correo a</label>
                    <input type="text" class="form-control form-control-sm" id="correos"  value="" placeholder="Para mas de un correo separe con ; ">
                </div>
            </fieldset>
        </div>
