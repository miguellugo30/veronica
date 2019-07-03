<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Nuevo Catalogo
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
        <div class="form-group">
            <label for="email">Recibir Llamada</label>
            <div class="radio">
                <label>
                    <input type="radio" name="recibir_llamada" id="recibir_llamada" value="y" checked>
                    Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="recibir_llamada" id="recibir_llamada" value="n">
                    No
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelEdoAge"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveEdoAge"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
