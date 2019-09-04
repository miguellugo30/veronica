<select name="opciones_{{ $num }}" id="opciones" class="form-control form-control-sm">
        @foreach ($info as $v)
            @if ($destino == 'Cat_Extensiones')
                <option value="{{ $v->id }}">{{$v->extension}}</option>
                @elseif( $destino == 'hangup' )
                <option value="{{ $v['id'] }}">{{$v['nombre']}}</option>
            @else
                <option value="{{ $v->id }}">{{$v->nombre}}</option>
            @endif
        @endforeach
    </select>
