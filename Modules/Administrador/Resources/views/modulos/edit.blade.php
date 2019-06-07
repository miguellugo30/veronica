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
            <label for="email">Descripcion</label>
            <input type="text" class="form-control" id="descripcionEdit" name="descripcionEdit" placeholder="Descripcion" value="{{ $modulo->descripcion }}">
        </div>
    </div>
    <div class="col-md-12" style="text-align:center">
        <button type="submit" class="btn btn-primary saveModulo">Guardar</button>
        <button type="submit" class="btn btn-danger cancelModulo">Cancelar</button>
        <button type="submit" class="btn btn-danger deleteModulo">Eliminar</button>
    </div>
    <br>
    <br>
</fieldset>
