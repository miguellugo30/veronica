<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Licencia *:</label>
        <input type="text" class="form-control form-control-sm" id="licencia" name="licencia" placeholder="Licencia">
        @csrf
    </div>
    <div class="form-group">
        <label for="name">Numero de Licencias Disponibles *:</label>
        <input type="number" class="form-control form-control-sm" id="disponibles" name="disponibles" placeholder="Licencias Disponibles">
    </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>
<!--div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelLicencia"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveLicencia float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->
