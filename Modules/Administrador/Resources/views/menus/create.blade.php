<fieldset>
        <legend>
            <i class="fas fa-align-justify"></i>
            Nuevo Menú
        </legend>
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                @csrf
            </div>
            <div class="form-group">
                <label for="email">Descripción</label>
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
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelMenu"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveMenu"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
        <br>
        <br>
    </fieldset>
