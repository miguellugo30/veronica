<div class="col-md-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control input-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="ubicacion">Ubicacion</label>
        <input type="text" class="form-control input-sm" id="ubicacion" placeholder="Ubicacion">
    </div>
    <div class="form-group">
        <label for="ip">IP</label>
        <input type="text" class="form-control input-sm" id="ip" placeholder="IP">
    </div>
</div>
<div class="col-md-6" style="float:none; margin:auto">
    <div class="col-md-6" style="text-align:left">
        <button type="submit" class="btn btn-warning btn-sm cancelBaseDatos"><i class="fas fa-times"></i> Cancelar</button>
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm saveBaseDatos"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>
