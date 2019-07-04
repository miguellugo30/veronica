<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Nuevo Canal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores_canal" id="distribuidores_canal" class="form-control">
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" data-prefijo="{{ $distribuidor->prefijo }}" >{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
            @csrf
        <div class="form-group">
            <div class="resultDistribuidor">
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
                <input type="text" class="form-control" name="canal_tipo" id="canal_tipo" placeholder="{ TIPO }">
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
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveCanal"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>
