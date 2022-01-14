<br><br>
@if ( Session::has( 'canales' ) )
    @php
        $dataCanales = array_chunk( Session::get( 'canales' ), 5 );
    @endphp
@endif
<div class="col-9" style="float:none; margin:auto">
    <!-- Mostrando los canales de la empresa seleccionada -->
    <div class="form-group">
        <label for="Canal_id">Canal</label>

        <select name="Canal_id" id="Canal_id" class="form-control  form-control-sm Canal_id" data-pos="1">
            <option value="">Selecciona un tipo de canal</option>
            @if ( isset( $dataCanales ) )
            @for ($i = 0; $i < count( $dataCanales ); $i++)
                <option {{ isset( $dataExtensiones ) ? ( $dataExtensiones['canal_id'] == $i ) ? 'selected' : '' : '' }} value="{{$i}}">{{ $dataCanales[$i][1].$dataCanales[$i][4].'/'.$dataCanales[$i][3] }}</option>
            @endfor
        @endif
        </select>
    </div>
    <div class="form-group">
        <!-- Agregar los nuevos dids -->
        <label for="did">Did</label>
        <textarea class="form-control  form-control-sm" style="resize:none;" rows="10" id="did" name="did" placeholder="Ingresa la lista de prefijos en esta area separados por enter."></textarea>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <!-- Agregar la referencia -->
                <label class="col-sm-3 col-form-label" for="referencia">Referencia</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control  form-control-sm" id="referencia" name="referencia" placeholder="Referencia"/>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <!-- Agregar numero real -->
                <label class="col-sm-3 col-form-label" for="numero_real">Numero Real</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control  form-control-sm" id="numero_real" name="numero_real" placeholder="Numero Real"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="gateway">Gateway</label>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gateway" id="gateway1" value="1" >
                        <label class="form-check-label" for="gridRadios1">
                            Habilitado
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gateway" id="gateway2" value="0" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Deshabilitado
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="fakedid">Fakedid</label>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="fakedid" id="fakedid1" value="1" >
                        <label class="form-check-label" for="gridRadios1">
                            Habilitado
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="fakedid" id="fakedid2" value="0" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Deshabilitado
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
