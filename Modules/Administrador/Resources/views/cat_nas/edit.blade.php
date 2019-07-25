<div class="col-md-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control input-sm" id="nombre" placeholder="Nombre" value="{{ $cat_nas->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="ip_nas">IP NAS</label>
        <input type="text" class="form-control input-sm" id="ip_nas" placeholder="IP NAS" value="{{ $cat_nas->ip_nas }}">
        @csrf
    </div>
</div>
<div class="col-md-6" style="float:none; margin:auto">
    <div class="col-md-6" style="text-align:left">
        <button type="submit" class="btn btn-warning btn-sm cancelNas"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-danger btn-sm deleteNas"><i class="fas fa-trash-alt"></i> Eliminar </button>
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm updateNas"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>
