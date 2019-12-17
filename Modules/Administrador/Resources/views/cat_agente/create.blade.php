<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre *:</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="email">Descripción *:</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion">
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
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>
<!--div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelEdoAge"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveEdoAge float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->
