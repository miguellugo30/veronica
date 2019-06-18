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
            <label for="email">Marcar</label>
            <div class="radio">
                <label>
                    <input type="radio" name="marcar" id="marcar" value="y" checked>
                    Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="marcar" id="marcar" value="n">
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Mostrar Agente</label>
            <div class="radio">
                <label>
                    <input type="radio" name="mostrar_agente" id="mostrar_agente" value="y" checked>
                    Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="mostrar_agente" id="mostrar_agente" value="n">
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
                <label for="email">Parametrizar</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="parametrizar" id="parametrizar" value="1" checked>
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="parametrizar" id="parametrizar" value="0">
                        No
                    </label>
                </div>
            </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelEdoCli"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveEdoCli"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
