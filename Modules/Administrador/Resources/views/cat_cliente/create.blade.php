<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="email">Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion">
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
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelEdoCli"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveEdoCli float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

