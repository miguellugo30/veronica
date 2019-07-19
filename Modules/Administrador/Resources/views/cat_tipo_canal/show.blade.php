<label for="Troncales_id">Troncal</label>
<select name="Troncales_id" id="Troncales_id" class="form-control">
    <option value="">Selecciona una troncal</option>
    @foreach( $troncales as $troncal )
        <option value="{{ $troncal->id }}">{{ $troncal->nombre }}</option>
    @endforeach
</select>
