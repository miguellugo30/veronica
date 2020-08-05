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
                    <div class="custom-control custom-checkbox">
                        <input  type="checkbox"
                                name="{{ Str::snake( Str::lower( $modulo->nombre ) ) }}"
                                @if ( isset( $datamodulo ) )
                                    {{ array_key_exists( Str::snake( Str::lower( $modulo->nombre ) ), $datamodulo ) ? 'checked' : '' }}
                                @endif
                                class="modulosEmpresa custom-control-input" id="modulo_{{ $modulo->id }}"
                                value="{{ $modulo->id }}">
                        <label for="modulo_{{ $modulo->id }}" class="custom-control-label">
                            {{ $modulo->nombre }}
                        </label>
                    </div>
                @endforeach
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                    <label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
                </div>
            </div>
        </div>
    </div>
</fieldset>
