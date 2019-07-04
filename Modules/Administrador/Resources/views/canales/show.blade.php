<label for="Empresas_id_canal">Empresas</label>
<select name="Empresas_id_canal" id="Empresas_id_canal" class="form-control">
    <option value="">Selecciona una empresa</option>
    @foreach( $empresas as $empresa )
        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
    @endforeach
</select>
<br>
<label for="Troncales_id_canal">Troncal</label>
<select name="Troncales_id_canal" id="Troncales_id_canal" class="form-control">
    <option value="">Selecciona una troncal</option>
    @foreach( $troncales as $troncal )
        <option value="{{ $troncal->id }}">{{ $troncal->nombre }}</option>
    @endforeach
</select>
