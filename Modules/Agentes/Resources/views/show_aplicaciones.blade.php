<select name="opciones" id="opciones" class="form-control form-control-sm">
    <option value="">Selecciona una destino</option>
    @if ( $opcion == 'Agentes' )
        @foreach ($aplicaciones as $v)
            <option value="{{ $v->id.'|'.$v->extension }}">{{ $v->extension_real }}</option>
        @endforeach
    @elseif ( $opcion == 'Cat_Extensiones' )
        @foreach ($aplicaciones as $v)
            <option value="{{ $v->id }}">{{ $v->nombre }}</option>
        @endforeach
    @else
        @foreach ($aplicaciones as $v => $w)
        <option value="{{ $w->id.'|'.$w->tabla_id }}">{{ $w->nombre }}</option>
    @endforeach
    @endif
</select>
