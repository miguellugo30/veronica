<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $cat_agente->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="email">Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" value="{{ $cat_agente->descripcion }}">
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
<!--div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelEdoAge float-left"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-danger btn-sm deleteEdoAge float-left"><i class="fas fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-primary btn-sm updateEdoAge float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->
