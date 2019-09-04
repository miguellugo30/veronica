<select name="opciones_{{ $accion.'_'.$num }}" id="opciones" class="form-control form-control-sm">
    @foreach ($info as $v)
        @if ($opcion == 'Cat_Extensiones')
            <option value="{{ $v->id }}">{{$v->extension}}</option>
            @elseif( $opcion == 'hangup' )
            <option value="{{ $v['id'] }}">{{$v['nombre']}}</option>
        @else
            <option value="{{ $v->id }}">{{$v->nombre}}</option>
        @endif
    @endforeach
</select>
