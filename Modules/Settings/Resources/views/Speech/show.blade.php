@if ( $speech->tipo == 'estatico' )
    <div class="col">
        <h5>{{ $speech->nombre }}</h5>
        <p class="card-text text-justify">{{ $speech->texto }}</p>
    </div>
@else
    <div class="col">
        <h5 >{{ $speech->nombre }}</h5>
        <hr>
        <p class="card-text text-justify">{{ $bienvenida->texto }}</p>
        <hr>
        <div class="col text-center">
            @foreach ($campos as $opcion)
                @if ( $opcion->tipo == '0' )
                    <button type="button" class="btn btn-primary btn-sm opcion" data-speech-id="{{$speech->id}}" data-id='{{ $opcion->speech_id_hijo }}'>{{ $opcion->nombre }}</button>
                @endif
            @endforeach
        </div>
        <hr>
        <div id="opcion_seleccionada_{{$speech->id}}" class="col" style="display:none"></div>
    </div>
@endif
