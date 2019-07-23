<!--
    Se mostraran los tipos de canales en base al distribuidor seleccionado
    en el formulario de alta de canales
 -->
<select name="tipo_canal" id="tipo_canal" class="form-control">
    <option value="">Selecciona un tipo de canal</option>
    @foreach ($tipocanales as $tipocanal)
        <option value="{{$tipocanal->id}}">{{$tipocanal->nombre}}</option>
    @endforeach
</select>
