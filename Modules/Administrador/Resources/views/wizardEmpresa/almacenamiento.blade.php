<br>
<br>
@if ( Session::has( 'posiciones' ) )
    @php
        $dataposiciones = Session::get( 'posiciones' );
    @endphp
@endif
@if ( Session::has( 'almacenamiento' ) )
    @php
        $dataalmacenamiento = Session::get( 'almacenamiento' );
    @endphp
@endif
<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        <input type="hidden" name="action" id="action" value="dataAlmacenamiento">
        <div class="form-group">
            <label for="agentes_entrada"><b>Almacenamiento por posiciones ( GB )</b></label>
            <input  type="text"
                    min="1"
                    max="200"
                    class="form-control form-control-sm"
                    id="almacenamiento_posiciones"
                    name="almacenamiento_posiciones"
                    value="{{ ( ( $dataposiciones['agentes_entrada'] + $dataposiciones['agentes_salida'] + $dataposiciones['agentes_full'] ) * 2048 / 1024 ) }} GB"
                    placeholder="Almacenamiento por posiciones" readonly >
        </div>
        <div class="form-group">
            <label for="canal_mensajes_voz"><b>Almacenamiento adicional contratado ( GB )</b></label>
            <input  type="text"
                    min="1"
                    max="200"
                    class="form-control form-control-sm"
                    id="almacenamiento_adicional"
                    name="almacenamiento_adicional"
                    value="{{ isset( $dataalmacenamiento ) ? $dataalmacenamiento['almacenamiento_adicional'] : '500'}}"
                    placeholder="Almacenamiento adicional contratado" >
        </div>
    </div>
</fieldset>
