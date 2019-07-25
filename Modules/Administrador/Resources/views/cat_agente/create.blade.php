<div class="col-md-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control input-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="email">Descripción</label>
        <input type="text" class="form-control input-sm" id="descripcion" placeholder="Descripcion">
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
        <button type="submit" class="btn btn-warning btn-sm cancelEdoAge"><i class="fas fa-times"></i> Cancelar</button>
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm saveEdoAge"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>
