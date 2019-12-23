@if ( $error )
    <audio controls autoplay>
        <source src="{{ $ruta }}" type="audio/wav">

        Your browser does not support the audio element.
    </audio>
@else
    <div class="alert alert-danger" role="alert">
        {{ $mensaje }}
    </div>
@endif
