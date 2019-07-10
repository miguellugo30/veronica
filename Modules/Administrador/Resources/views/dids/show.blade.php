<!-- Mostrando los canales de la empresa seleccionada -->
<label for="Canal_id">Canal</label>
<select name="Canal_id" id="Canal_id" class="form-control">
    <option value="">Selecciona un canal</option>
    @foreach( $canales as $canal )
        <option value="{{ $canal->id }}">{{ $canal->canal }}</option>
    @endforeach
</select>
<!-- Mostrar el prefijo por defecto 20-->
<label for="prefijo">Prefijo</label>
<input type="number" class="form-control" id="prefijo" placeholder="Prefijo" min="0" value="20"/>
<!-- Agregar los nuevos dids --> 
<label for="did">Did</label>
<textarea class="form-control" style="resize:none;" rows="10" id="did" name="did" placeholder="Ingresa la lista de prefijos en esta area separados por enter."></textarea>
<!-- Agregar la referencia -->
<label for="referencia">Referencia</label>
<input type="text" class="form-control" id="referencia" placeholder="Referencia"/>
<!-- Agregar numero real -->
<label for="numero_real">Numero Real</label>
<input type="text" class="form-control" id="numero_real" placeholder="Numero Real"/>

<label for="gateway">Gateway</label><br>
<label class="radio-inline">
    <input type="radio" id="gatewayhabilitado" name="gateway" value="1" > Habilitado
</label>
<label class="radio-inline">
    <input type="radio" id="gatewaydeshabilitado" name="gateway" value="0" > Deshabilitado
</label><br>
<label for="fakedid">Fakedid</label><br>
<label class="radio-inline">
    <input type="radio" name="fakedid" id="fakedid" value="1" > Habilitado
</label>
<label class="radio-inline">
    <input type="radio" name="fakedid" id="fakedid" value="0" checked> Deshabilitado
</label>