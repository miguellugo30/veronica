<div class="col-md-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="distribuidor">Distribuidor</label>
        <select name="distribuidor" id="distribuidor" class="form-control input-sm">
            <option value="" >Selecciona un distribuidor</option>
            @foreach( $catdistriuidor as $distribuidor )
                <option value="{{ $distribuidor->id }}" {{ $distribuidor->id == $tipocanales->Cat_Distribuidor_id ? 'selected' : ''}}>{{ $distribuidor->servicio }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control input-sm" id="nombre" placeholder="Nombre" value='{{ $tipocanales->nombre }}'>
        <input type="hidden" class="form-control" id="id" value='{{ $tipocanales->id }}'>
        @csrf
    </div>
    <div class="form-group">
        <label for="prefijo">prefijo</label>
        <input type="text" class="form-control" id="prefijo" placeholder="prefijo" value='{{ $tipocanales->prefijo }}'>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning btn-sm cancelTipoCanal"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger btn-sm deleteTipoCanal"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary btn-sm updateTipoCanal"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
</div>
