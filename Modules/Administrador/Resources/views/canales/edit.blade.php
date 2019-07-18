<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar Canal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores_canal_editar" id="distribuidores_canal_editar" class="form-control" autofocus>
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" data-prefijo="{{ $distribuidor->prefijo }}" {{ ( $canal->Cat_Distribuidor_id == $distribuidor->id )  ? 'selected' : '' }}>{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
            @csrf
            <br>
            <input type="hidden" name="id" id="id" value="{{ $canal->id }}">
        </div>
    </div>
    <div class="col-md-12" style="padding:10px;">
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
