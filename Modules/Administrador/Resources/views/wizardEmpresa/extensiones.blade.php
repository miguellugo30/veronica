<br><br>
@if ( Session::has( 'canales' ) )
    @php
        $dataCanales = array_chunk( Session::get( 'canales' ), 4 );
    @endphp
@endif
<div class="col-6" style="float:none; margin:auto">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label" for="canal_id"><b>Canal :</b></label>
        <div class="col-sm-9">
            <select name="canal_id" id="canal_id" class="form-control form-control-sm">
                <option value="" >Selecciona un canal</option>
                @if ( isset( $dataCanales ) )
                    @for ($i = 0; $i < count( $dataCanales ); $i++)

                    <option value="">{{ $dataCanales[$i][1]."/" }}</option>
                {{-- @foreach ($canales as $canal)
                    <option value="{{$canal->id}}">{{ $canal->protocolo }}{{ $canal->Troncales->nombre }}/{{ $canal->prefijo }}</option>
                @endforeach --}}
                    @endfor
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="">Extensiones</label>
        <div class="form-inline" style="text-align:center">
            <div class="form-group">
                <label for="extension">Extension:</label>
                <input type="number" min="1" class="form-control" id="extension" name="extension" placeholder="Extension">
            </div>
            <div class="form-group">
                <label for="posiciones">Posiciones:</label>
                <input type="number" class="form-control" min="1" max="" id="posiciones" name="posiciones" value="">
            </div>
        </div>
    </div>
</div>
