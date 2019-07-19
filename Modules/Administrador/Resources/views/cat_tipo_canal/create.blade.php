<fieldset>
    <legend>
        <i class="fas fa-database"></i>
        Nueva Base de Datos
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            @csrf
        </div>
        <div class="form-group">
            <label for="prefijo">prefijo</label>
            <input type="text" class="form-control" id="prefijo" placeholder="prefijo">
        </div>
        <div class="form-group">
            <label for="distribuidor">Distribuidor</label>
            <select name="distribuidor" id="distribuidor" class="form-control">
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $catdistriuidor as $distribuidor )
                    <option value="{{ $distribuidor->id }}">{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelTipoCanal"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveTipoCanales"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>

