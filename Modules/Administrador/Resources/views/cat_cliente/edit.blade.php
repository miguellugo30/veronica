<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Editar Catalogo
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $cat_cliente->nombre }}">
            <input type="hidden" name="id" id="id" value="{{ $id }}">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" value="{{ $cat_cliente->descripcion }}">
        </div>
        <div class="form-group">
            <label for="email">Marcar</label>
            <div class="radio">
                <label>
                    <input type="radio" name="marcar" id="marcar" value="y" {{ ( $cat_cliente->marcar == 'y' ) ? "checked" : "" }}>
                    Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="marcar" id="marcar" value="n" {{ ( $cat_cliente->marcar == 'n' ) ? "checked" : "" }}>
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Mostrar Agente</label>
            <div class="radio">
                <label>
                    <input type="radio" name="mostrar_agente" id="mostrar_agente" value="y" {{ ( $cat_cliente->mostrar_agente == 'y' ) ? "checked" : "" }}>
                    Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="mostrar_agente" id="mostrar_agente" value="n" {{ ( $cat_cliente->mostrar_agente == 'n' ) ? "checked" : "" }}>
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
                <label for="email">Parametrizar</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="parametrizar" id="parametrizar" value="1" {{ ( $cat_cliente->parametrizar == '1' ) ? "checked" : "" }}>
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="parametrizar" id="parametrizar" value="0" {{ ( $cat_cliente->parametrizar == '0' ) ? "checked" : "" }}>
                        No
                    </label>
                </div>
            </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelEdoCli"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger deleteEdoCli"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary updateEdoCli"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>
