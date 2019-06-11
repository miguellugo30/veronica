<fieldset>
    <legend>
        <i class="fas fa-align-justify"></i>
        Editar Menu
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $categoria->nombre }}">
            <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $categoria->id }}">
            @csrf
            @method('PUT')
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" value="{{ $categoria->descripcion}}">
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="1">Sistema</option>
                <option value="2">Cliente</option>
            </select>
        </div>
    </div>
    <div class="col-md-12" style="text-align:center">
        <button type="submit" class="btn btn-primary editMenu"><i class="fas fa-save"></i> Guardar</button>
        <button type="submit" class="btn btn-warning cancelMenu"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-danger deleteMenu"><i class="fas fa-trash-alt"></i> Eliminar</button>
    </div>
    <br>
    <br>
</fieldset>
