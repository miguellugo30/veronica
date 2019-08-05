<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="distribuidor">Distribuidor</label>
        <select name="distribuidor" id="distribuidor" class="form-control form-control-sm">
            <option value="" >Selecciona un distribuidor</option>
            @foreach( $catdistriuidor as $distribuidor )
                <option value="{{ $distribuidor->id }}">{{ $distribuidor->servicio }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="prefijo">Prefijo</label>
        <input type="text" class="form-control form-control-sm" id="prefijo" placeholder="Prefijo">
    </div>
</div>
<!--div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelTipoCanal"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveTipoCanales float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->
