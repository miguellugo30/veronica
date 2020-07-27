<br>
<br>
@if ( Session::has( 'modulo' ) )
    @php
        $datamodulo = Session::get( 'modulo' );
    @endphp
@endif
<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <div class="col-md-6">
                @foreach ($data['modulos'] as $modulo)
                    @if ($loop->iteration == 6)
                        </div>
                        <div class="col-md-6">
                    @endif
                    <div class="checkbox">
                        <label>
                            <input  type="checkbox"
                                    name="{{ Str::snake( Str::lower( $modulo->nombre ) ) }}"
                                    @if ( isset( $datamodulo ) )
                                        {{ array_key_exists( Str::snake( Str::lower( $modulo->nombre ) ), $datamodulo ) ? 'checked' : '' }}
                                    @endif
                                    class="modulosEmpresa" id="modulo_{{ $modulo->id }}"
                                    value="{{ $modulo->id }}">
                            {{ $modulo->nombre }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</fieldset>
