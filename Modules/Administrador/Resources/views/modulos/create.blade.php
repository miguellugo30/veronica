<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Nuevo Modulo
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion">
        </div>
    </div>
    <div class="col-md-12" style="text-align:center">
        <button type="submit" class="btn btn-primary saveModulo">Guardar</button>
        <button type="submit" class="btn btn-danger cancelModulo">Cancelar</button>
    </div>
    <br>
    <br>
</fieldset>
