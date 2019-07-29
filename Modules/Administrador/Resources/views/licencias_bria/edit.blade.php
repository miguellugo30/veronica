<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $cat_nas->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="ip_nas">IP NAS</label>
        <input type="text" class="form-control form-control-sm" id="ip_nas" placeholder="IP NAS" value="{{ $cat_nas->ip_nas }}">
        @csrf
    </div>
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelNas"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-danger btn-sm deleteNas"><i class="fas fa-trash-alt"></i> Eliminar </button>
    <button type="submit" class="btn btn-primary btn-sm updateNas float-right"><i class="fas fa-save"></i> Guardar</button>
</div>
