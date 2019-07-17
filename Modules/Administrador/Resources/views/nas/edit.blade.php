<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Editar Catalogo
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $cat_agente->nombre }}">
            <input type="hidden" name="id" id="id" value="{{ $id }}">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Descripción</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" value="{{ $cat_agente->descripcion }}">
        </div>
        <div class="form-group">
            <label for="email">Recibir Llamada</label>
            <div class="radio">
                <label>
                    <input type="radio" name="recibir_llamada" id="recibir_llamada" value="y" {{ ( $cat_agente->recibir_llamada == 'y' ) ? "checked" : "" }} >
                    Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="recibir_llamada" id="recibir_llamada" value="n" {{ ( $cat_agente->recibir_llamada == 'n' ) ? "checked" : "" }}>
                    No
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelEdoAge"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger deleteEdoAge"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary updateEdoAge"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
