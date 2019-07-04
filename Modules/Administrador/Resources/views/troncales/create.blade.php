<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Nueva Troncal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores" id="distribuidores" class="form-control">
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" >{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            @csrf
        </div>
        <div class="form-group">
            <label for="ip_media">IP Media</label>
            <input type="text" class="form-control" id="ip_media" placeholder="IP Media">
        </div>
        <div class="form-group">
            <label for="ip_host">IP Host</label>
            <input type="text" class="form-control" id="ip_host" placeholder="IP Host">
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveTroncal"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>
