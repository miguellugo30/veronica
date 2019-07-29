<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Licencia</label>
        <input type="text" class="form-control form-control-sm" id="licencia" name="licencia" placeholder="Licencia">
        @csrf
    </div>
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelLicencia"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveLicencia float-right"><i class="fas fa-save"></i> Guardar</button>
</div>
