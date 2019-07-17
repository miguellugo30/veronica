<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Nueva Troncal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $baseDatos->nombre }}">
            <input type="hidden" name="id" id="id" value="{{$id}}">
            @csrf
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicacion</label>
            <input type="text" class="form-control" id="ubicacion" placeholder="Ubicacion" value="{{ $baseDatos->ubicacion }}">
        </div>
        <div class="form-group">
            <label for="ip">IP</label>
            <input type="text" class="form-control" id="ip" placeholder="IP" value="{{ $baseDatos->ip }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelBaseDatos"><i class="fas fa-times"></i> Cancelar</button>
                <button type="submit" class="btn btn-danger deleteBaseDatos"><i class="fas fa-trash-alt"></i> Eliminar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary updateBaseDatos"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>
