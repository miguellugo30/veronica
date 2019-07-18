<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Nuevo Canal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores_canal" id="distribuidores_canal" class="form-control" autofocus>
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
    </div>
    <div class="col-md-12" style="padding:10px;">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelCanal"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveCanal"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
