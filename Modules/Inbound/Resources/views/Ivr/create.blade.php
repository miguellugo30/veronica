<div class="col">
            <fieldset>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" id="nombre"  value="">
                    <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">

                    @csrf
                </div>
                <div class="form-group">
                    <label for="mensaje_bienvenida_id">Mensaje Bienvenida</label>
                        <select name="mensaje_bienvenida_id" id="mensaje_bienvenida_id" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                            @foreach ($audios as $audio)
                                <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="tiempo_espera">Tiempo Espera</label>
                    <input type="text" class="form-control form-control-sm" id="tiempo_espera"  value="" placeholder="En segundos">
                </div>
                <div class="form-group">
                    <label for="mensaje_tiepo_espera_id">Mensaje Espera Superada</label>
                            <select name="mensaje_tiepo_espera_id" id="mensaje_tiepo_espera_id" class="form-control form-control-sm">
                                <option value="">Selecciona una opción</option>
                                @foreach ($audios as $audio)
                                    <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                                @endforeach
                            </select>
                </div>
                <div class="form-group">
                    <label for="mensaje_opcion_invalida_id">Mensaje Opcion Invalida</label>
                            <select name="mensaje_opcion_invalida_id" id="mensaje_opcion_invalida_id" class="form-control form-control-sm">
                                <option value="">Selecciona una opción</option>
                                @foreach ($audios as $audio)
                                    <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                                @endforeach
                            </select>
                </div>
                <div class="form-group">
                    <label for="repeticiones">Repeticiones</label>
                    <input type="num" class="form-control form-control-sm" id="repeticiones"  value="">
                </div>
            </fieldset>
        </div>
