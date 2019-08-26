<input type="hidden" name="idForm" id="idForm" value="{{ Str::snake( $formulario->nombre ) }}">

<form id="{{ Str::snake( $formulario->nombre ) }}" class="formularioView">
    <div class="col-12" style="float:none; margin:auto">
        @foreach ($campos as $campo)
            @if($campo->tipo_campo == 'text')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                    <input type="{{$campo->tipo_campo}}" class="form-control form-control-sm" id="formulario" name="formulario" placeholder="{{$campo->nombre_campo}}">
                </div>

            @elseif($campo->tipo_campo == 'textarea')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>

            @elseif($campo->tipo_campo == 'fecha')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                    <input type="date" name="" id="">
                </div>

            @elseif($campo->tipo_campo == 'select')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                    <select name="{{ Str::snake($campo->nombre_campo)}}" id="{{ Str::snake($campo->nombre_campo)}}" data-id="{{ $campo->id }}" class="form-control form-control-sm">
                        <option value="">Selecciona una opcion</option>
                        @foreach ($campo->Sub_Formularios as $v)
                            <option value="{{ $v->Formularios_id }}">{{ $v->opcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="viewSubForm_{{ $campo->id }}" class="col-12"></div>

            @elseif($campo->tipo_campo == 'Numerico')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                    <input type="number" name="" id="">
                </div>

            @elseif($campo->tipo_campo == 'Seperador')

                <div class="form-group">
                    <hr>
                </div>

            @elseif($campo->tipo_campo == 'bloque_oculto')

                <div class="form-group">
                    <button id = 'btn_bloque_ocultos'>ejemplo bloque oculto</button>
                </div>
                <div class="form-group" style='display:none' id='bloque_oculto'>

            @elseif($campo->tipo_campo == 'texto')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                </div>

            @elseif($campo->tipo_campo == 'buscador')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                    <input type="{{$campo->tipo_campo}}" class="form-control form-control-sm" id="formulario" name="formulario" placeholder="{{$campo->nombre_campo}}">
                </div>

            @endif
        @endforeach
        </div>
    </div>
</form>


<!--
<option value="buscador">Buscador</option>
<option value="buscador_historio">Buscador Historio</option>
<option value="asignador_folios">Asignador de Folios</option>
<option value="bloqueInicio">Bloque Inicio</option>
<option value="bloqueFin">Bloque Termino</option>
-->
