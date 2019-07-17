<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Editar Modulo
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" placeholder="Nombre" value="{{ $modulo->nombre }}">
            <input type="hidden" name="id_modulo" id="id_modulo" value="{{ $id }}">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Descripción</label>
            <input type="text" class="form-control" id="descripcionEdit" name="descripcionEdit" placeholder="Descripcion" value="{{ $modulo->descripcion }}">
        </div>
    </div>
    <div class="col-md-6"  style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelModulo"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger deleteModulo"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveModulo"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
