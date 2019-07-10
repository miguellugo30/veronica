<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar Canal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores_canal" id="distribuidores_canal" class="form-control">
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" data-prefijo="{{ $distribuidor->prefijo }}" {{ ( $canal->Cat_Distribuidor_id == $distribuidor->id )  ? 'selected' : '' }}>{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $canal->id }}">
        <div class="form-group">
            <div class="resultDistribuidor">
                <label for="Empresas_id_canal">Empresas</label>
                <select name="Empresas_id_canal" id="Empresas_id_canal" class="form-control">
                    <option value="">Selecciona una empresa</option>
                    @foreach( $empresas as $empresa )
                        <option value="{{ $empresa->id }}" {{ ( $canal->Empresas_id == $empresa->id )  ? 'selected="selected"' : '' }}>{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
                <br>
                <label for="Troncales_id_canal">Troncal</label>
                <select name="Troncales_id_canal" id="Troncales_id_canal" class="form-control">
                    <option value="">Selecciona una troncal</option>
                    @foreach( $troncales as $troncal )
                        <option value="{{ $troncal->id }}"  {{ ( $canal->Troncales_id == $troncal->id )  ? 'selected="selected"' : '' }}>{{ $troncal->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12" style="text-align:center">
            <br>
            <label for="ip">Canal</label>
            <br>
            <div class="col-md-1" style="width: 4%;padding: 0px;font-size: 22px;">
                <label for="">SIP/</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="canal_troncal" id="canal_troncal" placeholder="{ TRONCAL }" readonly>
            </div>
            <div class="col-md-1" style="width: 0%;padding: 0px;font-size: 22px;">
                <label for="">/</label>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="canal_prefijo" id="canal_prefijo" placeholder="{ PREFIJO }" readonly>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="canal_empresa" id="canal_empresa" placeholder="{ ID_EMPRESA }" readonly>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="canal_tipo" id="canal_tipo" placeholder="{ TIPO }" value="{!! substr( $canal->canal, -2 ); !!}">
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelCanal"><i class="fas fa-times"></i> Cancelar</button>
                <button type="submit" class="btn btn-danger deleteCanal"><i class="fas fa-trash-alt"></i> Eliminar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary updateCanal"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

<script>
    $( document ).ready(function() {
        let prefijo = $("#distribuidores_canal option:selected").data('prefijo');
        $("#canal_prefijo").val(prefijo);

        let troncal = $("#Troncales_id_canal option:selected").text();
        $("#canal_troncal").val(troncal);

        let id_Empresa = $("#Empresas_id_canal option:selected").val();
        $("#canal_empresa").val(zfill(id_Empresa, 3));

        /**
         * Funcion para formatear el id de la empresa a 3 dígitos
         * @param {id_empresa} number
         * @param {tamanio} width
         */
        function zfill(number, width) {
            var numberOutput = Math.abs(number); /* Valor absoluto del número */
            var length = number.toString().length; /* Largo del número */
            var zero = "0"; /* String de cero */

            if (width <= length) {
                if (number < 0) {
                    return ("-" + numberOutput.toString());
                } else {
                    return numberOutput.toString();
                }
            } else {
                if (number < 0) {
                    return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
                } else {
                    return ((zero.repeat(width - length)) + numberOutput.toString());
                }
            }
        }
    });
</script>
