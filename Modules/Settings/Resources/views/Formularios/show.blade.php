<style>
    textarea {
        resize: none;
    }
</style>

<input type="hidden" name="idForm" id="idForm" value="{{ Str::snake( $formulario->nombre ) }}">

<form id="{{ Str::snake( $formulario->nombre ) }}" class="formularioView">
    <input type="hidden" name="idFormulario" id="idFormulario" value="{{ $formulario->id }}">
    <div class="col-12" style="float:none; margin:auto">
        @foreach ($campos as $campo)
            @if($campo->tipo_campo == 'text')

                <div class="form-group">
                    <label for="name">{{ Str::ucfirst( $campo->nombre_campo)}}: </label>
                    <input type="{{$campo->tipo_campo}}" class="form-control form-control-sm" id="campo_{{$campo->id}}" name="campo_{{$campo->id}}" placeholder="{{Str::ucfirst( $campo->nombre_campo)}}">
                </div>

            @elseif($campo->tipo_campo == 'textarea')

                <div class="form-group">
                    <label for="name">{{ Str::ucfirst( $campo->nombre_campo )}}: </label>
                    <textarea class="form-control" name="campo_{{$campo->id}}" id="campo_{{$campo->id}}" cols="30" rows="3" placeholder="{{Str::ucfirst( $campo->nombre_campo)}}"></textarea>
                </div>

            @elseif($campo->tipo_campo == 'fecha')

                <div class="form-group">
                    <label for="name">{{ Str::ucfirst( $campo->nombre_campo )}}: </label>
                    <input type="date" class="form-control form-control-sm" name="campo_{{$campo->id}}" id="campo_{{$campo->id}}">
                </div>

            @elseif($campo->tipo_campo == 'select')

                <div class="form-group">
                    <label for="name">{{ Str::ucfirst( $campo->nombre_campo)}}: </label>
                    <select name="{{ Str::snake($campo->nombre_campo)}}" id="{{ Str::snake($campo->nombre_campo)}}" data-id="{{ $campo->id }}" class="form-control form-control-sm">
                        <option value="">Selecciona una opcion</option>
                        @foreach ($campo->Sub_Formularios as $v)
                            <option value="{{ $v->Formularios_id }}">{{ $v->opcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="viewSubForm_{{ $campo->id }}" class="col-12"></div>

            @elseif($campo->tipo_campo == 'numerico')

                <div class="form-group">
                    <label for="name">{{ Str::ucfirst( $campo->nombre_campo)}}: </label>
                    <input type="number" class="form-control form-control-sm"  name="campo_{{$campo->id}}" id="campo_{{$campo->id}}" placeholder="{{Str::ucfirst( $campo->nombre_campo)}}">
                </div>

            @elseif($campo->tipo_campo == 'texto')

                <div class="form-group">
                    <label for="name">{{$campo->nombre_campo}}</label>
                </div>
            @elseif($campo->tipo_campo == 'asignador_folios')

                <label for="name">{{ Str::ucfirst( $campo->nombre_campo)}}: </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">{{ $campo->prefijo }}</span>
                    </div>
                    <input type="text" class="form-control" placeholder="{{ Str::ucfirst( $campo->folio)}}" >
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
