<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="ubicacion">Ubicacion</label>
        <input type="text" class="form-control form-control-sm" id="ubicacion" placeholder="Ubicacion">
    </div>
    <div class="form-group">
        <label for="ip">IP</label>
        <input type="text" class="form-control form-control-sm" id="ip" placeholder="IP">
    </div>
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelBaseDatos"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveBaseDatos float-right"><i class="fas fa-save"></i> Guardar</button>
</div>
