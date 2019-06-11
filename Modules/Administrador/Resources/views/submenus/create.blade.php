<fieldset>
        <legend>
            <i class="fas fa-align-justify"></i>
            Nuevo Sub Menu
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
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="1">Sistema</option>
                    <option value="2">Cliente</option>
                </select>
            </div>
        </div>
        <div class="col-md-12" style="text-align:center">
            <button type="submit" class="btn btn-primary saveSubMenu"><i class="fas fa-save"></i> Guardar</button>
            <button type="submit" class="btn btn-warning cancelSubMenu"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <br>
        <br>
    </fieldset>
