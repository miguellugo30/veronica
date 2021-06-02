<br><br>
@if ( Session::has( 'canales' ) )
    @php
        $dataCanales = array_chunk( Session::get( 'canales' ), 5 );
    @endphp
@endif
@if ( Session::has( 'posiciones' ) )
    @php
        $dataposiciones = Session::get( 'posiciones' );
    @endphp
@endif
@if ( Session::has( 'extensiones' ) )
    @php
        $dataExtensiones = Session::get( 'extensiones' );
    @endphp
@endif
<div class="col-6" style="float:none; margin:auto">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="canal_id"><b>Canal :</b></label>
        <div class="col-sm-8">
            <select name="canal_id" id="canal_id" class="form-control form-control-sm">
                <option value="" >Selecciona un canal</option>
                @if ( isset( $dataCanales ) )
                    @for ($i = 0; $i < count( $dataCanales ); $i++)
                        <option {{ isset( $dataExtensiones ) ? ( $dataExtensiones['canal_id'] == $i ) ? 'selected' : '' : '' }} value="{{$i}}">{{ $dataCanales[$i][1].$dataCanales[$i][4].'/'.$dataCanales[$i][3] }}</option>
                    @endfor
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="extension">Prefijo de Extension:</label>
        <div class="col-sm-8" style="text-align:center">
            <input type="number" min="1" class="form-control form-control-sm" id="extension" name="extension" placeholder="Extension" value="{{ isset( $dataExtensiones ) ? $dataExtensiones['extension'] : '' }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="posiciones">Posiciones a generar:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control form-control-sm" min="1" max="{{ $dataposiciones['agentes_entrada'] + $dataposiciones['agentes_salida'] + $dataposiciones['agentes_full'] }}" id="posiciones" name="posiciones" value="{{ isset( $dataExtensiones ) ? $dataExtensiones['posiciones'] : '' }}" placeholder="Posiciones">
            <small id="emailHelp" class="form-text text-muted">Maximo de posiciones {{ $dataposiciones['agentes_entrada'] + $dataposiciones['agentes_salida'] + $dataposiciones['agentes_full'] }}.</small>
        </div>
    </div>
</div>
