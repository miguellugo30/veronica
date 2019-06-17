<fieldset>
    <legend>
        <i class="fas fa-align-justify"></i>
        Editar Sub Menu
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $subCategoria->nombre }}">
            <input type="hidden" name="id_subCate" id="id_subCate" value="{{ $id }}">
            @csrf
            @method('PUT')
        </div>
        <div class="form-group">
            <label for="email">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" value="{{ $subCategoria->descripcion }}">
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="1">Sistema</option>
                <option value="2">Cliente</option>
            </select>
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelSubMenu"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger deleteSubMenu"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary editSubMenu"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
