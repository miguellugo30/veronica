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
            <label for="ubicacion">Ubicacion</label>
            <input type="text" class="form-control" id="ubicacion" placeholder="Ubicacion">
        </div>
        <div class="form-group">
            <label for="ip">IP</label>
            <input type="text" class="form-control" id="ip" placeholder="IP">
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelBaseDatos"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveBaseDatos"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>

