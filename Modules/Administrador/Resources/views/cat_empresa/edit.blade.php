<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Nuevo Catalogo
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $cat_empresa->nombre }}">
            <input type="hidden" name="id" id="id" value="{{ $id }}">
            @csrf
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelEdoEmp"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger deleteEdoEmp"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary updateEdoEmp"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
