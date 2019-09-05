<div class="col">
    <table id='condicion' class="table table-striped table-sm tableNewForm">
        <thead>
            <tr>
            <th>Nombre</th>
            <th>Mensaje Bienvenida</th>
            <th>Tiempo Espera</th>
            <th>Mensaje Espera Superada</th>
            <th>Mensaje Opcion Invalida</th>
            <th>Repeticiones</th>
            </tr>
        </thead>
        <tbody>
            <tr id="tr_1">
                <td>
                    <input type="text" class="form-control form-control-sm" id="nombre"  value="" placeholder="Nombre IVR">
                    <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">
                </td>
                <td>
                <select name="mensaje_bienvenida_id" id="mensaje_bienvenida_id" class="form-control form-control-sm">
                    <option value="">Selecciona una opción</option>
                    @foreach ($audios as $audio)
                        <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                    @endforeach
                </select>                    
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" id="tiempo_espera"  value="" placeholder="En segundos">
                </td>
                <td>
                    <select name="mensaje_tiepo_espera_id" id="mensaje_tiepo_espera_id" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($audios as $audio)
                            <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="mensaje_opcion_invalida_id" id="mensaje_opcion_invalida_id" class="form-control form-control-sm">
                        <option value="">Selecciona una opción</option>
                        @foreach ($audios as $audio)
                            <option value="{{$audio->id}}">{{$audio->nombre}}</option>
                        @endforeach
                    </select>

                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" id="repeticiones"  value="" placeholder="Repeticiones">
                </td>
            </tr>
        </tbody>
    </table>
</div>
